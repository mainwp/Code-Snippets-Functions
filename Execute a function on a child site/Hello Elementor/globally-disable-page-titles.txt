function ele_disable_page_title( $return ) {
   return false;
}
add_filter( 'hello_elementor_page_title', 'ele_disable_page_title' );
