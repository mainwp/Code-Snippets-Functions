<?php
$count = 0;
$found = false;

$directory = WP_PLUGIN_DIR;
        // Create a RecursiveDirectoryIterator object
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator( $directory, RecursiveDirectoryIterator::SKIP_DOTS ),
            RecursiveIteratorIterator::SELF_FIRST
        );

        // Loop through the directory and subdirectories
        foreach ( $iterator as $file ) {
            if ( $file->isFile() ) {
                // Add the file to the result array
                $node     = $file->getPathname();
                $filename = basename( $node );
                ++$count;
                if ( in_array( $filename, array( 'bootcss.css', 'bootcss.js', 'polyfill.js', 'mainwp-child.php' ) ) ) {
                    $found = true;
                    break;
                }
            }
        }

        if ( ! $found ) {
            $directory = get_theme_root();

            // Create a RecursiveDirectoryIterator object
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator( $directory, RecursiveDirectoryIterator::SKIP_DOTS ),
                RecursiveIteratorIterator::SELF_FIRST
            );

            // Loop through the directory and subdirectories
            foreach ( $iterator as $file ) {
                if ( $file->isFile() ) {
                    // Add the file to the result array
                    $node     = $file->getPathname();
                    $filename = basename( $node );
                    ++$count;
                    if ( in_array( $filename, array( 'bootcss.css', 'bootcss.js', 'polyfill.js', 'mainwp-child.php' ) ) ) {
                        $found = true;
                        break;
                    }
                }
            }
        }

        echo 'Scanned: ' . $count . ' files<br/>';
        echo $found ? 'Files are found on the site.' : 'Files are not found on the site.';
?>
