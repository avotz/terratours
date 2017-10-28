<?php


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
  
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 4 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
/** woocommerce **/
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 2; // arranged in 2 columns
    return $args;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
        return '';
    }


add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {

    if ( is_product() && ! has_term( 'Tour', 'product_cat' ) ) {
      //unset( $tabs['description'] );  
    }
   
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}

//modificar tab description con la informacion short-description
add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
function woo_custom_description_tab( $tabs ) {
  if ( is_product() && !has_term( 'Tour', 'product_cat' )  ) {
    $tabs['description']['title'] = 'Availability';  // Custom description callback
  }
  $tabs['description']['callback'] = 'woo_custom_description_tab_content';  // Custom description callback

  return $tabs;
}

function woo_custom_description_tab_content() {
  if ( is_product() && has_term( 'Tour', 'product_cat' )  ) {
    woocommerce_get_template( 'single-product/short-description.php' );
  }else{
    woocommerce_get_template( 'single-product/tabs/description.php' );
    if ( is_product() && has_term( 'Private shuttle', 'product_cat' )  ) {
      echo '<p class="note note-maximum">Maximum groups of 10 people click on the inquiry button to obtain special prices.</p>';
    }
    woocommerce_get_template( 'single-product/price.php' );
    do_action( 'woocommerce_single_product_summary' );

  }
}
//agregar tab details con la informacio de description
add_filter( 'woocommerce_product_tabs', 'woo_details_tab' );
function woo_details_tab( $tabs ) {
  
  // Adds the new tab
  if ( is_product() && has_term( 'Tour', 'product_cat' )  ) {
      $tabs['details'] = array(
        'title'   => __( 'Details', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_details_tab_content'
      );
}

  return $tabs;

}
function woo_details_tab_content() {

 
    woocommerce_get_template( 'single-product/tabs/description.php' );
  
  
}
//agregar tab gallery 
add_filter( 'woocommerce_product_tabs', 'woo_gallery_tab' );
function woo_gallery_tab( $tabs ) {
  
  // Adds the new tab
  if ( is_product() && has_term( 'Tour', 'product_cat' )  ) {
    $tabs['gallery'] = array(
      'title'   => __( 'Gallery', 'woocommerce' ),
      'priority'  => 60,
      'callback'  => 'woo_gallery_tab_content'
    );
  }
  return $tabs;

}
function woo_gallery_tab_content() {


  woocommerce_get_template( 'single-product/product-thumbnails.php' );
  
}

//agregar tab gallery 
add_filter( 'woocommerce_product_tabs', 'woo_book_tab' );
function woo_book_tab( $tabs ) {
  
  // Adds the new tab
   if ( is_product() && has_term( 'Tour', 'product_cat' ) ) {
    $nameTab = __( 'Book Now', 'woocommerce' );
   }else{
     $nameTab = __( 'Availability', 'woocommerce' );
   }
   if ( is_product() && has_term( 'Tour', 'product_cat' )  ) {
    $tabs['book'] = array(
      'title'   => $nameTab,
      'priority'  => 70,
      'callback'  => 'woo_book_tab_content'
    );
  }
  return $tabs;

}
function woo_book_tab_content() {

 
  woocommerce_get_template( 'single-product/price.php' );
  do_action( 'woocommerce_single_product_summary' );
  
}

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     unset($fields['billing']['billing_address_1']);
     unset($fields['billing']['billing_address_2']);
     unset($fields['billing']['billing_country']);
     unset($fields['billing']['billing_city']);
   unset($fields['billing']['billing_postcode']);
   unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_company']);

   $fields['order']['order_comments']['placeholder'] = 'e.g. child seats';
    $fields['order']['order_comments']['label'] = 'Important Notes';
     

     return $fields;
}
// add_action( 'woocommerce_checkout_billing', 'my_checkout_msg' );

// function my_checkout_msg() {
// 	echo '<p>This page is 100% secure. Thank you for your business!</p>';
// }
/**
 * Add the field to the checkout
 */
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    echo '<div id="tour_pickup_location">';
 
        woocommerce_form_field( 'pickup_time', array(
          'type'          => 'text',
          'class'         => array('my-field-class form-row-wide'),
          'label'         => __('Pick up time'),
          'placeholder'   => __(''),
          'required'  => true,
          ), $checkout->get_value( 'pickup_time' ));
  
    woocommerce_form_field( 'pickup_location', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Pick up location'),
        'placeholder'   => __(''),
        'required'  => true,
        ), $checkout->get_value( 'pickup_location' ));
    
        woocommerce_form_field( 'dropoff_location', array(
          'type'          => 'text',
          'class'         => array('my-field-class form-row-wide'),
          'label'         => __('Drop off location'),
          'placeholder'   => __(''),
          'required'  => true,
          ), $checkout->get_value( 'dropoff_location' ));
        
          woocommerce_form_field( 'flight', array(
            'type'          => 'text',
            'class'         => array('my-field-class form-row-wide'),
            'label'         => __('Flight'),
            'placeholder'   => __(''),
            'required'  => true,
            ), $checkout->get_value( 'flight' ));
          
            woocommerce_form_field( 'airline', array(
              'type'          => 'text',
              'class'         => array('my-field-class form-row-wide'),
              'label'         => __('Airline'),
              'placeholder'   => __(''),
              'required'  => true,
              ), $checkout->get_value( 'airline' ));

    /*woocommerce_form_field( 'tour_date', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Tour date'),
        'placeholder'   => __('dd/mm/yyyy'),
        'required'  => true,
        'input_class' => array('datepicker')
        ), $checkout->get_value( 'tour_date' ));*/

    echo '</div>';

}
/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['pickup_location'] )
        wc_add_notice( __( '<strong>Pick up location</strong> is a required field.' ), 'error' );

     if ( ! $_POST['dropoff_location'] )
        wc_add_notice( __( '<strong>Drop off location</strong> is a required field.' ), 'error' );
      
      if ( ! $_POST['flight'] )
        wc_add_notice( __( '<strong>Flight</strong> is a required field.' ), 'error' );

      if ( ! $_POST['airline'] )
        wc_add_notice( __( '<strong>Airline</strong> is a required field.' ), 'error' );

        if ( ! $_POST['pickup_time'] )
        wc_add_notice( __( '<strong>Pick up time</strong> is a required field.' ), 'error' );
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['pickup_location'] ) ) {
        update_post_meta( $order_id, 'Pick up location', sanitize_text_field( $_POST['pickup_location'] ) );
    }
    if ( ! empty( $_POST['dropoff_location'] ) ) {
        update_post_meta( $order_id, 'Drop off location', sanitize_text_field( $_POST['dropoff_location'] ) );
    }
    if ( ! empty( $_POST['flight'] ) ) {
        update_post_meta( $order_id, 'Flight', sanitize_text_field( $_POST['flight'] ) );
    }
  if ( ! empty( $_POST['airline'] ) ) {
      update_post_meta( $order_id, 'Airline', sanitize_text_field( $_POST['airline'] ) );
  }
  if ( ! empty( $_POST['pickup_time'] ) ) {
    update_post_meta( $order_id, 'Pick up time', sanitize_text_field( $_POST['pickup_time'] ) );
}
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Pick up location').':</strong> ' . get_post_meta( $order->id, 'Pick up location', true ) . '</p>';
    echo '<p><strong>'.__('Drop off location').':</strong> ' . get_post_meta( $order->id, 'Drop off location', true ) . '</p>';
    echo '<p><strong>'.__('Flight').':</strong> ' . get_post_meta( $order->id, 'Flight', true ) . '</p>';
    echo '<p><strong>'.__('Airline').':</strong> ' . get_post_meta( $order->id, 'Airline', true ) . '</p>';
    echo '<p><strong>'.__('Pick up time').':</strong> ' . get_post_meta( $order->id, 'Pick up time', true ) . '</p>';
}




