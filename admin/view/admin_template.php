<h1><?php _e('TheCatsAPI Settings', 'capi'); ?></h1>

<p><?php _e('You can use this shortcode for display pets filter page :', 'capi'); ?> </p>
<h4 class="shortcode"> [show_cats_on_page]</h4>

<div class="wrap">

  <form method="POST">
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row" style="padding-top: 10px;"><label for="the_cats_api_key">X-API-KEY</label></th>
          <td style="padding-top: 10px;"><input type="text" name="the_cats_api_key" id="the_cats_api_key" value="<?php echo $api_key; ?>" class="regular-text" /></td>
        </tr>
      </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'capi'); ?>"></p>
  </form>
</div>