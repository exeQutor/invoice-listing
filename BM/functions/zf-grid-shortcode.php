<?php

class BM_ZF_Grid_Shortcode {

  function __construct() {
    add_shortcode('row', [$this, 'row']);
    add_shortcode('column', [$this, 'column']);
  }

  function row($atts, $content) {
  	$content = preg_replace( "/\[\/column\](\<br \/\>|\<\/p\>.?\<p\>).?\[column/s", '[/column][column', $content );

   	return '<div class="grid-x">' . do_shortcode($content) . '</div>';
  }

  function column($atts, $content) {
    $atts = shortcode_atts( array(
      'small' => 12,
      'medium' => null,
      'large' => null
    ), $atts );

    $atts['medium'] = ( $atts['medium'] == null ) ? $atts['small'] : $atts['medium'];
    $atts['large'] = ( $atts['large'] == null ) ? $atts['medium'] : $atts['large'];

    extract($atts);

    $sizes = 'small-' . $small . ' medium-' . $medium . ' large-' . $large;

    return '<div class="cell ' . $sizes . '">' . do_shortcode($content) . '</div>';
  }
}

new BM_ZF_Grid_Shortcode;
