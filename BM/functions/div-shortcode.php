<?php

class BM_Div_Shortcode {

  function __construct() {
    add_shortcode('div', [$this, 'shortcode']);
  }

  function shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
      'class' => '',
    ), $atts));

    $class = $class ? " class=\"$class\"" : NULL;

    return "<div$class>$content</div>";
  }
}

new BM_Div_Shortcode;
