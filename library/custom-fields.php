<?php

add_action('add_meta_boxes','skeleton_meta_boxes');
function skeleton_meta_boxes() {
  $post_types = ['skeleton_project'];
  foreach ($post_types as $post_type) {
    //is current?
    add_meta_box(
      'skeleteon_is_current_box',
      'Current?',
      'skeleton_is_current_callback',
      $post_type
    );
  }
}
function skeleton_is_current_callback($post) {
  $id = $post->ID;
  wp_nonce_field('skeleton_is_current_box','skeleton_is_current_nonce');
  $cb_string = '';
  $checkboxes = [
    [
      'slug'   =>   'skeleton_is_current',
      'name'   =>   'Is the Project Current?'
    ]
  ];
  foreach ($checkboxes as $checkbox) {
    $slug = $checkbox['slug'];
    $name = $checkbox['name'];
    $value = get_post_meta($id, $slug, true);
    if ($value == 'checked') {
      $checked = 'checked';
    } else {
      $checked = '';
    }
    $cb_string .= "<label><input $checked type='checkbox' name='$slug' id='$slug' value='checked'>$name</label><br/>";
  }
  echo $cb_string;
}

//on post save...
add_action('save_post','skeleton_save_posts');
function skeleton_save_posts($post_id) {
  $nonces = [
    [
      'box'   =>  'skeleton_is_current_box',
      'value' =>  'skeleton_is_current_nonce'
    ]
  ];
  foreach ($nonces as $nonce) {
    $value = $nonce['value'];
    $box = $nonce['box'];
    if ( ! isset( $_POST[$value] ) ) {
      return;
    }
    if ( ! wp_verify_nonce( $_POST[$value], $box ) ) {
      return;
    }
  }
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }
  $custom_fields = ['skeleton_is_current'];
  foreach ($custom_fields as $custom_field) {
    $new_value = sanitize_text_field( $_POST[$custom_field] );
    error_log($_POST[$custom_field]);
    update_post_meta($post_id, $custom_field, $new_value);
  }
}


?>
