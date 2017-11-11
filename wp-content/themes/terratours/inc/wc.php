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
/*add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

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

   

    echo '</div>';

}*/
/**
 * Process the checkout
 */
/*add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

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
*/
/**
 * Update the order meta with field value
 */
/*add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

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
}*/

/**
 * Display field value on the order edit page
 */
/*add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Pick up location').':</strong> ' . get_post_meta( $order->id, 'Pick up location', true ) . '</p>';
    echo '<p><strong>'.__('Drop off location').':</strong> ' . get_post_meta( $order->id, 'Drop off location', true ) . '</p>';
    echo '<p><strong>'.__('Flight').':</strong> ' . get_post_meta( $order->id, 'Flight', true ) . '</p>';
    echo '<p><strong>'.__('Airline').':</strong> ' . get_post_meta( $order->id, 'Airline', true ) . '</p>';
    echo '<p><strong>'.__('Pick up time').':</strong> ' . get_post_meta( $order->id, 'Pick up time', true ) . '</p>';
}*/

//dynamic checkout fields

function terratours_filter_checkout_fields($fields){
    $fields['extra_fields'] = array(
    'tourtransfer_details' => array(
        'type' => 'tourtransfer_details',
        'required'      => false,
        'label' => __( 'Item Details' )
        ),
    );

    return $fields;

}
add_filter( 'woocommerce_checkout_fields', 'terratours_filter_checkout_fields' );


function terratours_filter_checkout_field_group( $field, $key, $args, $value ){
    $op_cart_count = WC()->cart->get_cart();//get_cart_contents_count();
  
    $html = '';
    $html .= '<div class="tourtransfer_details flex-container-sb">';  
    //for ( $i = 1; $i <= $op_cart_count; $i++) {
  foreach ( WC()->cart->get_cart() as $cart_item ) {
        $item_name = $cart_item['data']->get_title();
        $i = $cart_item['data']->get_id();
    

        $html .= '<div class="tourtransfer_details_item">';  
        $html .= '<h2>'. $item_name .'</h2>'; 
        $html .= woocommerce_form_field( "tourtransfer_details[$i][pickup_location]", array(
            "type" => "text",
            "return" => true,
            "value" => "",
            "required"      => true,
            "label" => __( "Pick up" )
            )
        );
        $html .= woocommerce_form_field( "tourtransfer_details[$i][dropoff_location]", array(
            "type" => "text",
            "return" => true,
            "value" => "",
            "required"      => true,
            "label" => __( "Drop Off" )
            )
        );
         $html .= woocommerce_form_field( "tourtransfer_details[$i][passengers]", array(
            "type"          => "text",
            "return" => true,
            "value" => "",
            "class"         => array("date-of-birth form-row-wide"),
            "required"      => true,
            "label"         => __("Passengers"),
    
        
            )
        );
         $html .= woocommerce_form_field( "tourtransfer_details[$i][time]", array(
            "type" => "text",
            "return" => true,
            "value" => "",
            "required"      => true,
            "label" => __( "Pickup time" )
            )
        );
        $html .= woocommerce_form_field( "tourtransfer_details[$i][flight]", array(
            "type" => "text",
            "return" => true,
            "value" => "",
            "required"      => true,
            "label" => __( "Flight" )
            )
        );
       
       
        $html .= woocommerce_form_field( "tourtransfer_details[$i][airline]", array(
            "type"          => "text",
            "return" => true,
            "value" => "",
            "required"      => false,
            "label"         => __("Airline"),
    
        
            )
        );

        $html .='</div>';
     

    }
    $html .='</div>';
    return $html;
}
add_filter( 'woocommerce_form_field_tourtransfer_details', 'terratours_filter_checkout_field_group', 10, 4 );

// display the extra field on the checkout form
function terratours_extra_checkout_fields(){ 

    $checkout = WC()->checkout();

    foreach ( $checkout->checkout_fields['extra_fields'] as $key => $field ) :

        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );

    endforeach;


}
add_action( 'woocommerce_checkout_after_customer_details' ,'terratours_extra_checkout_fields' );

/**
 * Sanitize our custom field
 * 
 */
function terratours_custom_process_checkout_field_tourtransfer_details( $posted ){

    $clean = array();

    foreach( $posted as $item ){
        if ( ! $item["pickup_location"] )
            wc_add_notice( __( '<strong>Pick up location</strong> is a required field.' ), 'error' );

        if ( ! $item["dropoff_location"] )
            wc_add_notice( __( '<strong>Drop off location</strong> is a required field.' ), 'error' );
          
        if ( ! $item["passengers"] )
          wc_add_notice( __( '<strong>Pick up time</strong> is a required field.' ), 'error' );
        
        if ( ! $item["time"] )
          wc_add_notice( __( '<strong>Pick up time</strong> is a required field.' ), 'error' );
        
        if ( ! $item["flight"] )
          wc_add_notice( __( '<strong>Flight</strong> is a required field.' ), 'error' );


        $details = terratours_custom_checkout_clean_tourtransfer_details( $item );

        if( ! empty( $details ) ){
            $clean[] = $details;
        }
    }

    return $clean;
}
add_filter( 'woocommerce_process_checkout_tourtransfer_details_field', 'terratours_custom_process_checkout_field_tourtransfer_details' );


function terratours_custom_checkout_clean_tourtransfer_details( $item = array() ){
    $details = array();
    if( isset( $item["pickup_location"] ) ){
        $details['pickup_location'] = sanitize_text_field( $item["pickup_location"] );
    }
    if( isset( $item["dropoff_location"] ) ){
        $details['dropoff_location'] = sanitize_text_field( $item["dropoff_location"] );
    }
    if( isset( $item["flight"] ) ){
        $details['flight'] = sanitize_text_field( $item["flight"] );
    }
    if( isset( $item["time"] ) ){
        $details['time'] = sanitize_text_field( $item["time"] );
    }
    if( isset( $item["passengers"] ) ){
        $details['passengers'] = sanitize_text_field( $item["passengers"] );
    }
    if( isset( $item["airline"] ) ){
        $details['airline'] = sanitize_text_field( $item["airline"] );
    }
   
    return $details;
}


/**
 * update_post_meta
 * 
 */
function terratours_custom_checkout_field_update_order_meta( $order_id, $posted ){

    if( ! empty( $posted["tourtransfer_details"] ) ){
        update_post_meta( $order_id, "_tourtransfer_details", $posted["tourtransfer_details"] );
    } else {
        delete_post_meta( $order_id, "_tourtransfer_details" );
    }

}
add_action( 'woocommerce_checkout_update_order_meta', 'terratours_custom_checkout_field_update_order_meta', 10, 2 );


// display the extra data in the order admin panel
function terratours_display_order_data_in_admin( $order ){  

    $tourtransfer_details = get_post_meta( $order->id, "_tourtransfer_details", true ); 

    if( ! empty( $tourtransfer_details ) ) { 

        $tourtransfer_defaults = array(
                "pickup_location" => "",
                "dropoff_location" => "",
                "flight" => "",
                "time" => "",
                "passengers" => "",
                "airline" => "",
               
            );

    ?>
    <div class="tourtransfer_data">
        <h4><?php _e( "Services Details", "terratours" ); ?></h4>
        <?php 
            $i = 1;

            foreach( $tourtransfer_details as $item ){

                $item = wp_parse_args( $item, $tourtransfer_defaults );

                echo "<p><strong>" . sprintf( __( "Item #%s", "terratours" ), $i  ) . "</strong>" . "<br/>";
                echo __( "Pick up", "terratours" ) . ' : ' . $item["pickup_location"] . "<br/>";
                echo __( "Drop off", "terratours" ) . ' : ' . $item["dropoff_location"] . "<br/>";
                echo __( "Flight", "terratours" ) . ' : ' . $item["flight"] . "<br/>";
                echo __( "Pick up time", "terratours" ) . ' : ' . $item["time"] . "<br/>";
                echo __( "Passengers", "terratours" ) . ' : ' . $item["passengers"] . "<br/>";
                echo __( "Airline", "terratours" ) . ' : ' . $item["airline"] . "<br/>";
                

                echo "</p>";

                $i++;

            }

         ?>
    </div>
<?php }
}
add_action( "woocommerce_admin_order_data_after_order_details", "terratours_display_order_data_in_admin" );


add_filter( 'woocommerce_booking_single_check_availability_text', 'wooninja_booking_check_availability_text' );

function wooninja_booking_check_availability_text() {
	return "Add To Cart";
}



