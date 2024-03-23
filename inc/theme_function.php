<?php

function ikr_customizar_register($wp_customize){

  //Header Area Function
  $wp_customize->add_section('ali_header_area', array(
    'title' =>__('Header Area', 'alihossain'),
    'description' => 'If you interested to update your header area, you can do it here.'
  ));

  $wp_customize->add_setting('ali_logo', array(
    'default' => get_bloginfo('template_directory') . '/img/logo.png',
  ));

  $wp_customize-> add_control(new WP_Customize_Image_Control($wp_customize, 'ali_logo', array(
    'label' => 'Logo Upload',
    'description' => 'If you interested to change or update your logo you can do it.',
    'setting' => 'ali_logo',
    'section' => 'ali_header_area',
  ) ));

  // Menu Position Option
  $wp_customize->add_section('ali_menu_option', array(
    'title' => __('Menu Position Option', 'alihossain'),
    'description' => 'If you interested to change your menu position you can do it.'
  ));

  $wp_customize->add_setting('ali_menu_position', array(
    'default' => 'right_menu',
  ));

  $wp_customize-> add_control('ali_menu_position', array(
    'label' => 'Menu Position',
    'description' => 'Select your menu position',
    'setting' => 'ali_menu_position',
    'section' => 'ali_menu_option',
    'type' => 'radio',
    'choices' => array(
      'left_menu' => 'Left Menu',
      'right_menu' => 'Right Menu',
      'center_menu' => 'Center Menu',
    ),
  ));


  // Footer Option
  $wp_customize->add_section('ali_footer_option', array(
    'title' => __('Footer Option', 'alihossain'),
    'description' => 'If you interested to change or update your footer settings you can do it.'
  ));

  $wp_customize->add_setting('ali_copyright_section', array(
    'default' => '&copy; Copyright 2021 | Procoder BD',
  ));

  $wp_customize-> add_control('ali_copyright_section', array(
    'label' => 'Copyright Text',
    'description' => 'If need you can update your copyright text from here',
    'setting' => 'ali_copyright_section',
    'section' => 'ali_footer_option',
  ));



  // add custom post catagory 
  $wp_customize -> add_section('ikr_custom_post_catagory',[
    'title'       => __('Custom Post Category','ikrobin'),
    'description' => 'Add Custom Catagories for posts.',
  ]);
  $wp_customize-> add_setting('ikr_custom_post_setting',[
    'default' => '',
    'sanitize_callback' => 'absint', 
  ]);
  $wp_customize->add_control('ikr_custom_post_setting', array(
    'label' => __('Select Category for Next Three Posts', 'ikrobin'),
    'section' => 'ikr_custom_post_catagory',
    'type' => 'select',
    'choices' => customizer_category_choices(), // Function to retrieve category choices
));
// Add customizer controls for selecting additional categories
$wp_customize->add_setting('ikr_custom_post_setting_2', array(
  'default' => '',
  'sanitize_callback' => 'absint', 
));

$wp_customize->add_control('ikr_custom_post_setting_2', array(
  'label' => __('Select Second Category for Posts 2', 'ikrobin'),
  'section' => 'ikr_custom_post_catagory',
  'type' => 'select',
  'choices' => customizer_category_choices(), // Function to retrieve category choices
));

$wp_customize->add_setting('ikr_custom_post_setting_3', array(
  'default' => '',
  'sanitize_callback' => 'absint', 
));

$wp_customize->add_control('ikr_custom_post_setting_3', array(
  'label' => __('Select Third Category for Posts 3', 'ikrobin'),
  'section' => 'ikr_custom_post_catagory',
  'type' => 'select',
  'choices' => customizer_category_choices(), // Function to retrieve category choices
));


}

add_action('customize_register', 'ikr_customizar_register');



// Function to retrieve category choices
function customizer_category_choices() {
  $categories = get_categories();
  $choices = array();
  foreach ($categories as $category) {
      $choices[$category->term_id] = $category->name;
  }
  return $choices;
}
