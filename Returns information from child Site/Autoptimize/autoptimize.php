<?php
if (class_exists('autoptimizeCache')) {
  autoptimizeCache::clearall();
  echo "Autoptimize Cache cleared successfully!";
} else {
  echo "Autoptimize Clearing cache failed!";
}
?>
