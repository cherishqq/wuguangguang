<?php
if ( in_category('shop') ) {
include(TEMPLATEPATH . '/single-shop.php');
}
else {
include(TEMPLATEPATH . '/single-z.php');
}
?>