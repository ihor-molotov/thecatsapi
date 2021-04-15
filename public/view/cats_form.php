<?php

/**
 * Get list of breets for select
 */

$get_breeds_url  = 'https://api.thecatapi.com/v1/breeds?limit=5';
$breeds = wp_remote_get(
  $get_breeds_url,
  array(
    'headers' => array(
      'x-api-key' => $api_key,
    )
  )
);
$list_of_breeds = wp_remote_retrieve_body($breeds);

$list_of_breeds = json_decode($list_of_breeds);

$responce_code = wp_remote_retrieve_response_code($breeds);

if ($responce_code == 200) {
?>
  <div class="cat_wrapper">
    <h3 class="thecats_title"><?php _e('The Cat API - Cats as a Service.', 'capi'); ?></h3>
    <div class="form-wrapper">
      <form method="POST" class="main_form">
        <select class="form-select" name="pets_breed" id="pets">
          <?php foreach ($list_of_breeds as $breed) : ?>
            <option value="<?php echo $breed->id ?>"><?php echo $breed->name; ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-success"><?php _e('Get info about breed', 'capi'); ?></button>
      </form>
    </div>
  </div>


  <?php } else {
  include plugin_dir_path(__FILE__) . '/errors/bad_request.php';
}

/**
 * Get info about selected breed
 */


if (!empty($_REQUEST['pets_breed'])) {
  $selected_breed_url = 'https://api.thecatapi.com/v1/images/search?breed_id=' . $_REQUEST['pets_breed'];
  $selected_response = wp_remote_get(
    $selected_breed_url,
    array(
      'headers' => array(
        'x-api-key' => $api_key,
      )
    )
  );
  $selectes_breed = wp_remote_retrieve_body($selected_response);

  $breed_response_info = json_decode($selectes_breed);

  $selected_breed_responce_code = wp_remote_retrieve_response_code($selected_response);

  if ($selected_breed_responce_code == 200) { ?>
    <div class="cat_output">

      <h2> <?php _e('Breed :', 'capi'); ?> <?php echo $breed_response_info[0]->breeds[0]->name ?></h2>

      <div class="image">
        <img src="<?php echo $breed_response_info[0]->url ?>" alt="<?php echo $breed_response_info[0]->breeds[0]->name ?>">
      </div>
      <div class="info_block">
        <p><strong><?php _e('Country:', 'capi'); ?> </strong><?php echo $breed_response_info[0]->breeds[0]->origin ?></p>
        <p><strong><?php _e('Description :', 'capi'); ?> </strong> <?php echo $breed_response_info[0]->breeds[0]->description ?> </p>
        <p><strong><?php _e('Temperament : ', 'capi'); ?> </strong><?php echo $breed_response_info[0]->breeds[0]->temperament ?></p>
        <p><strong><?php _e('Average life span : ', 'capi'); ?> </strong><?php echo $breed_response_info[0]->breeds[0]->life_span ?></p>
        <p><strong><?php _e('Alternative names:', 'capi'); ?> </strong><?php echo $breed_response_info[0]->breeds[0]->alt_names ?></p>
      </div>
    </div>

<?php } else {
    include plugin_dir_path(__FILE__) . '/errors/bad_request.php';
  }
}
