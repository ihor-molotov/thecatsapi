<div class="container-fluid cats_container">
  <?php
  if ($api_key) {
    include plugin_dir_path(__FILE__) . 'view/cats_form.php';
  } else {
    include plugin_dir_path(__FILE__) . 'view/errors/empty_api_key.php';
  }
  ?>
</div>