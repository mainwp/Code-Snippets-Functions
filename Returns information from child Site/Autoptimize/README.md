## Autoptimize Clearing Cache on your Child Sites

Tested version of WordPress 5.8.

This file is a code snippet that is used for [Autoptimize By Frank Goossens (futtta)](https://wordpress.org/plugins/autoptimize/).

## Things to do

1. If your not sure what this does check the [Code Snippets Functions Readme](https://github.com/mainwp/Code-Snippets-Functions/blob/master/README.md)
2. As with all code snippets located in this git, **TEST** the code snippet on one of your test sites **BEFORE** sending the code snippet to all your MainWP Child sites!

## Code snippet functions help

If you run into any issues or questions please use the [MainWP Support](https://mainwp.com/support/) page and open a ticket for the fastest response.

## Cache Enabler Clearing Cache Tutorial

[Autoptimize Clear Cache API](https://github.com/futtta/autoptimize/blob/7479fbca809206d38325e6f6f5307b7afa7bd3d4/classes/autoptimizeCache.php#L350) and [Clearing Cache discussion on GitHub Issues](https://github.com/futtta/autoptimize/pull/119#issuecomment-346184739) code and example found on the GitHub repository of the plugin.

The PHP snippet below can be used to clear the cache via a third party such as a Cron Job for example. The first section initializes the WordPress environment, normally this PHP file should be located in your WordPress root directory. The second if performs the action of completely clearing the cache and with the third if you have the ability to specify which post ID you would like to clear the cache for.

```
// initilize WordPress environment
if ( !defined('ABSPATH') ) {
	require_once('./wp-load.php');
}

if (class_exists('autoptimizeCache')) {
  autoptimizeCache::clearall();
  echo "Autoptimize Cache cleared successfully!";
} else {
  echo "Autoptimize Clearing cache failed!";
}
```
