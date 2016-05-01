<?php
$date   = date_i18n( get_option( 'date_format' ), strtotime( get_the_date( 'r' ) ) );
$author = get_the_author();
?>
<h2 class="text-xs-center"><?php printf( __( 'Published %1$s by %2$s', 'founder' ), $date, $author ); ?></h2>