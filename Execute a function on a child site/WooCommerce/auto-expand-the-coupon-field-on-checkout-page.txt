add_action( 'wp_footer', 'woocommerce_show_coupon', 99 );
function woocommerce_show_coupon() {
echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
$(\'.checkout_coupon\').show();
});
</script>
';
}
