## Purge Cache Enabler – WordPress Cache on your Child Sites

Tested version of WordPress 5.0

This file is a code snippet that is used for [Cache Enabler – WordPress Cache Plugin By KeyCDN](https://wordpress.org/plugins/cache-enabler/).

## Things to do

1. If your not sure what this does check the [Code Snippets Functions Readme](https://github.com/mainwp/Code-Snippets-Functions/blob/master/README.md)
2. As with all code snippets located in this git, **TEST** the code snippet on one of your test sites **BEFORE** sending the code snippet to all your MainWP Child sites!

## Code snippet functions help

If you run into any issues or questions please use the [MainWP Support](https://mainwp.com/support/) page and open a ticket for the fastest response.

## Cache Enabler Clearing Cache Tutorial

[Clearing Cache Via Third Party](https://www.keycdn.com/support/wordpress-cache-enabler-plugin#clearing-cache-via-third-party)'s code and example found on the support site of the plugin.

The PHP snippet below can be used to clear the cache via a third party such as a Cron Job for example. The first section initializes the WordPress environment, normally this PHP file should be located in your WordPress root directory. The second if performs the action of completely clearing the cache and with the third if you have the ability to specify which post ID you would like to clear the cache for.

```
// initilize WordPress environment
if ( !defined('ABSPATH') ) {
	require_once('./wp-load.php');
}

if ( has_action('ce_clear_cache') ) {
    do_action('ce_clear_cache');
}

if ( has_action('ce_clear_post_cache') ) {
    do_action('ce_clear_post_cache', 1111); // post_id
}
```
