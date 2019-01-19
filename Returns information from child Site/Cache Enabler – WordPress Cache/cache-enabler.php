<?php
if ( has_action('ce_clear_cache') ) {
    do_action('ce_clear_cache');
    echo "Cache cleared successfully!";
} else {
    echo "Clearing cache failed!";
}
?>
