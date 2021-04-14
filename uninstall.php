<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}
delete_option('the_cats_api_key');
