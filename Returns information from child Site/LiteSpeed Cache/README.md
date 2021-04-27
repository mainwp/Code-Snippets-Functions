## LiteSpeed Cache Purge on your Child Sites

Tested version of WordPress 5.7.1.

This file is a code snippet that is used for [LiteSpeed Cache By LiteSpeed Technologies](https://wordpress.org/plugins/litespeed-cache/).

## Things to do

1. If your not sure what this does check the [Code Snippets Functions Readme](https://github.com/mainwp/Code-Snippets-Functions/blob/master/README.md)
2. As with all code snippets located in this git, **TEST** the code snippet on one of your test sites **BEFORE** sending the code snippet to all your MainWP Child sites!

## Code snippet functions help

If you run into any issues or questions please use the [MainWP Support](https://mainwp.com/support/) page and open a ticket for the fastest response.

## LiteSpeed Cach Clearing Cache Tutorial

[LiteSpeed_Cache_API::purge_all()](https://www.litespeedtech.com/support/wiki/doku.php/litespeed_wiki:cache:lscwp:api#litespeed_cache_apipurge_all)'s code and example found on the support site of the plugin.

```
LiteSpeed_Cache_API::purge_post($id)
Purges a single post by id.

LiteSpeed_Cache_API::purge_all()
Purges all existing caches.
```

The PHP snippet below can be used to clear the cache via a third party such as a Cron Job for example. The first section initializes the WordPress environment, normally this PHP file should be located in your WordPress root directory. The second if performs the action of completely clearing the cache and with the third if you have the ability to specify which post ID you would like to clear the cache for.



```
// initilize WordPress environment
if ( !defined('ABSPATH') ) {
	require_once('./wp-load.php');
}

if (class_exists('LiteSpeed_Cache_API')) {
  LiteSpeed_Cache_API::purge_all();
  echo "LiteSpeed Cache cleared successfully!";
} else {
  echo "LiteSpeed Cache Clearing cache failed!";
}

if (class_exists('LiteSpeed_Cache_API')) {
  LiteSpeed_Cache_API::purge_post(111);
  echo "LiteSpeed Cache for post 111 cleared successfully!";
} else {
  echo "LiteSpeed Cache Clearing failed for post 111 !";
}
```
