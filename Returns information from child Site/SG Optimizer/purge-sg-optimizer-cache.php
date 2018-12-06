<?php
if ( function_exists( 'sg_cachepress_purge_cache' ) ) {
  sg_cachepress_purge_cache();
  echo "Cache cleared successfully!";
} else {
  echo "Clearing cache failed!";
}
?>
