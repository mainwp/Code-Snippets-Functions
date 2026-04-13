<?php
/**
 * MainWP Code Snippets - Detect suspicious wp-config.php append after wp-settings.php require
 * Targets the wpos-analytics / Essential Plugin supply chain attack (August 2025)
 */

function mainwp_find_wp_config_path() {
	$paths = array(
		ABSPATH . 'wp-config.php',
		dirname( ABSPATH ) . '/wp-config.php',
	);
	foreach ( $paths as $path ) {
		if ( file_exists( $path ) && is_readable( $path ) ) {
			return $path;
		}
	}
	return false;
}

$config_path = mainwp_find_wp_config_path();
if ( ! $config_path ) {
	echo 'ERROR: Could not locate a readable wp-config.php file.';
	return;
}

if ( ! is_readable( $config_path ) ) {
	echo 'ERROR: wp-config.php exists but cannot be read. Check file permissions.';
	return;
}

$content = file_get_contents( $config_path );
if ( false === $content ) {
	echo 'ERROR: Could not read wp-config.php. The file may be restricted by server permissions (open_basedir).';
	return;
}

$line_endings_normalized = str_replace( array( "\r\n", "\r" ), "\n", $content );
$lines                   = explode( "\n", $line_endings_normalized );
$alerts                  = array();
$matched_line            = '';
$matched_line_number     = 0;

// 1) Look for code appended after the wp-settings.php require line.
//    Catches both require and require_once variants.
foreach ( $lines as $index => $line ) {
	if ( strpos( $line, 'wp-settings.php' ) !== false &&
	     ( strpos( $line, 'require_once' ) !== false || strpos( $line, 'require' ) !== false ) ) {

		$matched_line        = $line;
		$matched_line_number = $index + 1;

		// Flag trailing content after the semicolon that is not a comment or a closing PHP tag.
		// Safe trailing content: // comment, # comment, /* comment,
		if ( preg_match( '/wp-settings\.php[\'"]?\s*\)?\s*;\s*(.+)$/i', $line, $m ) ) {
			$trailing = trim( $m[1] );

			if ( $trailing !== '' && ! preg_match( '/^(\/\/|#|\/\*|\?>\s*$)/', $trailing ) ) {
				$alerts[] = 'Suspicious content found on the same line after the wp-settings.php require statement.';
			}
		}

		// Flag eval() or base64_decode() anywhere on the wp-settings.php line.
		if ( preg_match( '/\beval\s*\(|\bbase64_decode\s*\(/i', $line ) ) {
			$alerts[] = 'eval() or base64_decode() detected on the wp-settings.php require line — high confidence indicator.';
		}
	}
}

// 2) Check for known indicators specific to this attack.
$indicators = array(
	// Network / C2 indicators
	'analytics.essentialplugin.com'      => 'C2 domain (analytics.essentialplugin.com) found — phone-home address used by the malicious plugin.',
	// Dropper file name (designed to look like core wp-comments-post.php)
	'wp-comments-posts.php'              => 'Backdoor dropper filename (wp-comments-posts.php) referenced in wp-config.php.',
	// Code markers left by the injector
	'wpos-analytics'                     => 'Plugin module identifier (wpos-analytics) found in wp-config.php.',
	'wpos_analytics_anl'                 => 'Malware function marker (wpos_analytics_anl) found — strong indicator of active injection.',
	'Plugin Wpos Analytics Data Starts'  => 'Malware block comment marker found — confirms injected payload is present.',
	// Blockchain C2 resolution
	'ethereum'                           => 'Ethereum reference found in wp-config.php — used by this malware to resolve its C2 server via smart contract.',
	'web3'                               => 'Web3 reference found in wp-config.php — no legitimate reason for this in a config file.',
);

foreach ( $indicators as $indicator => $message ) {
	if ( stripos( $content, $indicator ) !== false ) {
		$alerts[] = $message;
	}
}

// 3) Check for the backdoor dropper file in the webroot.
$dropper_path = ABSPATH . 'wp-comments-posts.php';
if ( file_exists( $dropper_path ) ) {
	$alerts[] = 'CRITICAL: Backdoor dropper file wp-comments-posts.php found in webroot (' . $dropper_path . '). This file should not exist.';
}

// 4) Size sanity check — injected payload adds ~6KB.
$file_size    = strlen( $content );
$size_warning = '';
if ( $file_size > 9000 ) {
	$size_warning = 'wp-config.php is unusually large (' . $file_size . ' bytes). Clean configs are typically under 5KB. This alone is not proof of compromise, but warrants inspection.';
}

// --- Output ---

if ( empty( $alerts ) ) {
	echo 'OK: No compromise indicators detected in wp-config.php.' . "\n";
	echo 'Checked file: ' . $config_path . "\n";
	if ( $matched_line_number ) {
		echo 'wp-settings.php require located on line ' . $matched_line_number . '.' . "\n";
	}
	echo 'File size: ' . $file_size . ' bytes.' . "\n";
	if ( $size_warning ) {
		echo "\nNOTE: " . $size_warning . "\n";
	}
	return;
}

echo '*** CRITICAL: Potential compromise indicators detected ***' . "\n\n";
echo 'File: ' . $config_path . "\n";
echo 'File size: ' . $file_size . ' bytes.' . "\n";

if ( $matched_line_number ) {
	echo "\nwp-settings.php require line: " . $matched_line_number . "\n";
	echo 'Line content:' . "\n";
	echo $matched_line . "\n";
}

echo "\nAlerts:\n";
foreach ( $alerts as $alert ) {
	echo '  - ' . $alert . "\n";
}

if ( $size_warning ) {
	echo "\nNOTE: " . $size_warning . "\n";
}

echo "\nDo not delete or modify wp-config.php without taking a backup first.";
echo "\nIf compromise is confirmed, initiate a full site cleanup — patching the plugin alone is not sufficient.";
