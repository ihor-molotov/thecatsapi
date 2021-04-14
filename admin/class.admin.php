<?php
defined("ABSPATH") or die();

if (!class_exists('TheCatsAPi_Admin')) {

  class TheCatsAPi_Admin
  {
    public function init()
    {
      add_action('admin_menu', [$this, 'add_admin_menu_page']);
    }


    public function add_admin_menu_page()
    {
      add_menu_page(
        'TheCatsApi',
        'TheCatsApi',
        'manage_options',
        'the_cats_settings',
        array($this, 'admin_menu_page'),
        'dashicons-pets',
        5
      );
    }

    public function admin_menu_page()
    {

      if (isset($_POST['the_cats_api_key'])) {
        update_option('the_cats_api_key', $_POST['the_cats_api_key']);
      }

      $api_key = get_option('the_cats_api_key', '');

      require_once plugin_dir_path(__FILE__) . '/view/admin_template.php';
    }
  }

  $admin_init = new TheCatsAPi_Admin();
  $admin_init->init();
}
