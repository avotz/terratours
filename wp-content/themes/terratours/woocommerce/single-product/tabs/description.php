<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
global $product;
$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) ) );

?>

<div class="product-description">
	<?php if($product->get_attribute( 'pa_fitness-level' )) : ?>
	<div class="fitness-level">
		<strong>Fitness Level</strong>
		<div class="fitness-img">
			<img src="<?php echo get_template_directory_uri();  ?>/img/<?php echo sanitize_title($product->get_attribute( 'pa_fitness-level' )); ?>.png" alt="<?php echo $product->get_attribute( 'pa_fitness-level' ); ?>">
		</div>
		
	</div>
<?php endif; ?>
	<?php the_content(); ?>

	
</div>

