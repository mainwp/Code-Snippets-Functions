<?php
if ( has_action( 'litespeed_purge_all' ) ) { 
  do_action( 'litespeed_purge_all' );
  echo "LiteSpeed Cache cleared successfully!", PHP_EOL;
} else {
  echo "LiteSpeed Cache not installed", PHP_EOL;
}
?>
