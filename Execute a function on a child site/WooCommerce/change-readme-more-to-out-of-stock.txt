add_filter( 'woocommerce_product_add_to_cart_text', 'wc_archive_custom_cart_button_text' );
  
function wc_archive_custom_cart_button_text( $text ) {
   global $product;       
   if ( $product && ! $product->is_in_stock() ) {           
      return 'Out of stock';
   } 
   return $text;
}
