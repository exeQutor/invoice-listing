<?php

class Burgosoft {

  function __construct() {
    $this->register_nav_menus();
    $this->add_theme_support();

    add_filter('show_admin_bar', '__return_false');
    // add_filter('show_admin_bar', [$this, 'show_admin_bar']);
    add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
    add_action('after_setup_theme', [$this, 'after_setup_theme']);

    add_post_type_support( 'page', 'excerpt' );

    if (function_exists('acf_add_options_page')) {
      acf_add_options_page();
    }
  }

  function show_admin_bar() {
    if (is_front_page()) {
      return false;
    } else {
      return true;
    }
  }

  function wp_enqueue_scripts() {

    /******************
		 * STYLES / CSS
		 ******************/

    // MeanMenu
 		wp_enqueue_style('meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.min.css');

    // Slick
		wp_enqueue_style('slick', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick.css');
		wp_enqueue_style('slick-theme', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick-theme.css');

    // Base stylesheet (compiled Foundation SASS)
    wp_enqueue_style('app', get_template_directory_uri() . '/assets/css/app.css', [], time());

    // WordPress's required styles.css
		wp_enqueue_style('styles', get_bloginfo('stylesheet_url'), [ 'app' ]);

    // Styles specific for home page
		// if (is_front_page()) wp_enqueue_style('home', get_template_directory_uri() . '/assets/css/home.css');


    /******************
		 * SCRIPTS / JS
		 ******************/

    // if (is_front_page()) {
 		// 	// Remove WordPress's jQuery and use our own
 		// 	wp_deregister_script('jquery');
 		// 	wp_enqueue_script('jquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.min.js', [], false, true);
 		// }

    // Foundation what-input dependency
		wp_enqueue_script('what-input', get_template_directory_uri() . '/node_modules/what-input/dist/what-input.min.js', [], false, true);

		// Load the complete version of Foundation
		wp_enqueue_script('foundation', get_template_directory_uri() . '/node_modules/foundation-sites/dist/js/foundation.min.js', ['jquery', 'what-input'], false, true);

    // MeanMenu
		wp_enqueue_script('meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.min.js', ['jquery'], false, true);

    // Stellar JS
		wp_enqueue_script('stellar', get_template_directory_uri() . '/node_modules/jquery.stellar/jquery.stellar.js', ['jquery'], false, true);

    // Slick Carousel
		wp_enqueue_script('slick', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick.min.js', ['jquery'], false, true);

    // Load any custom javascript
    wp_enqueue_script('bm-theme', get_template_directory_uri() . '/assets/js/app.min.js', array('jquery'), time(), true);

    // Script specific for home page
		// if (is_front_page()) {
		// 	wp_enqueue_script('velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.0/velocity.js', ['bm-theme', 'jquery'], false, true);
		// 	wp_enqueue_script('velocity-ui', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.0/velocity.ui.js', ['bm-theme', 'jquery'], false, true);
		// 	wp_enqueue_script('home', get_template_directory_uri() . '/assets/js/home.js', ['bm-theme', 'jquery'], false, true);
		// }
  }

  function after_setup_theme() {
    add_theme_support('title-tag');
  }

  function register_nav_menus() {
    register_nav_menus();
  }

  function add_theme_support() {
    add_theme_support('post-thumbnails');
  }
}

new Burgosoft;
