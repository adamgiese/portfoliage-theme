<?php
function skeleton_theme_customizer($wp_customize) {
  $wp_customize->remove_section('colors');
  //add "customizer" section
  $wp_customize->add_section( 'skeleton_logo_section', array(
    'title'       => __( 'Logo', 'skeleton'),
    'priority'    => 30,
    'description' => 'Set a logo to be used in the title. Remove an image to use the site title.'
  ));

  $wp_customize->add_section( 'skeleton_title_background_section', array(
    'title'       => __( 'Title Background', 'skeleton'),
    'priority'    => 30,
    'description' => 'Upload title background.'
  ));
  $wp_customize->add_setting('skeleton_logo');
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skeleton_logo', array(
    'label'       => __( 'Logo', 'skeleton' ),
    'section'     => 'skeleton_logo_section',
    'settings'    =>  'skeleton_logo',
  )));

  $wp_customize->add_setting('skeleton_title_background');
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skeleton_title_background', array(
    'label'       => __( 'Title Background', 'skeleton' ),
    'section'     => 'skeleton_title_background_section',
    'settings'    =>  'skeleton_title_background',
  )));
}

add_action( 'customize_register', 'skeleton_theme_customizer' );
?>
