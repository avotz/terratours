<?php


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
  
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 4 );

//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
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

/**
 * Add the field to the checkout
 */
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    echo '<div id="tour_pickup_location">';

    woocommerce_form_field( 'tour_pickup_location', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Pickup Location'),
        'placeholder'   => __('Pickup'),
        'required'  => true,
        ), $checkout->get_value( 'tour_pickup_location' ));

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
    if ( ! $_POST['tour_pickup_location'] )
        wc_add_notice( __( '<strong>Pick up location</strong> is a required field.' ), 'error' );

     /*if ( ! $_POST['tour_date'] )
        wc_add_notice( __( '<strong>Tour date</strong> is a required field.' ), 'error' );*/
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['tour_pickup_location'] ) ) {
        update_post_meta( $order_id, 'Pick up location', sanitize_text_field( $_POST['tour_pickup_location'] ) );
    }
    /* if ( ! empty( $_POST['tour_date'] ) ) {
        update_post_meta( $order_id, 'Tour date', sanitize_text_field( $_POST['tour_date'] ) );
    }*/
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Pick up location').':</strong> ' . get_post_meta( $order->id, 'Pick up location', true ) . '</p>';
    //*echo '<p><strong>'.__('Tour date').':</strong> ' . get_post_meta( $order->id, 'Tour date', true ) . '</p>';**/
}




