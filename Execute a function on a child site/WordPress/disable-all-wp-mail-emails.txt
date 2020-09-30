add_filter('wp_mail','disabling_emails', 10,1);
function disabling_emails( $args ){
    unset ( $args['to'] );
    return $args;
}
