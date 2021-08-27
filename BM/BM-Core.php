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

    // Base stylesheet (compiled Foundation SASS)
    wp_enqueue_style('app', get_template_directory_uri() . '/dist/assets/css/app.css', [], time());

    // WordPress's required styles.css
		wp_enqueue_style('styles', get_bloginfo('stylesheet_url'), [ 'app' ]);


    /******************
		 * SCRIPTS / JS
		 ******************/

    wp_register_script('bm-theme', get_template_directory_uri() . '/dist/assets/js/app.js', array('jquery'), time(), true);
		wp_localize_script('bm-theme', 'OBJ', array(
			'homeurl' => home_url(),
			'ajaxurl' => admin_url('admin-ajax.php'),
			'apiurl' => home_url('wp-json/wp/v2'),
			'max_invoices' => wp_count_posts('invoice')->publish
		));
		wp_enqueue_script('bm-theme');
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
