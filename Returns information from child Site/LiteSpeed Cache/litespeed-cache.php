<?php
if (class_exists('LiteSpeed_Cache_API')) {
  LiteSpeed_Cache_API::purge_all();
  echo "LiteSpeed Cache cleared successfully!";
} else {
  echo "LiteSpeed Cache Clearing cache failed!";
}
?>
