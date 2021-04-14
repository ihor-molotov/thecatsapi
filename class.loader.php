<?php

/**
 * Plugin Name: TheCatApi
 * Plugin URI: https://github.com/ihor-molotov/thecatsapi.git
 * Description: This plugin work with TheCatsApi  and show info about 5 random breeds
 * Author: Ihor Dzhavala
 * Version: 1.0
 * Domain Path: /languages/
 * 
 * */

defined("ABSPATH") or die();

if (!class_exists('TheCatsAPi_Loader')) {

  class TheCatsAPi_Loader
  {
    public function init()
    {
      require_once('admin/class.admin.php');

      add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);

      add_action('wp_enqueue_scripts', [$this, 'enqueue_public_styles']);

      add_shortcode('show_cats_on_page', [$this, 'show_cats_page']);
    }

    public function enqueue_admin_styles()
    {
      wp_enqueue_style('thecatsapi_style', plugins_url('/includes/admin/style.css', __FILE__));
    }

    public function enqueue_public_styles()
    {
      wp_enqueue_style('thecatsapi_style', plugins_url('/includes/public/style.css', __FILE__));
      wp_register_style('thecatsapi_bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css');
      wp_enqueue_style('thecatsapi_bootstrap');
      wp_enqueue_script('bootstrap_script', '//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js');
    }

    public function show_cats_page()
    {
      $api_key = get_option('the_cats_api_key', '');
      include plugin_dir_path(__FILE__) . 'public/public_template.php';
    }
  }

  $cats = new TheCatsAPi_Loader();
  $cats->init();
}
