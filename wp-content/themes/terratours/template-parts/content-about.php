<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package terratours
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <div class="about-container flex-container-sb">
            <div class="about-info">
                    <?php
                    the_content();

                    
                ?>
            </div>
            <div class="about-media">
           
            <?php $images = rwmb_meta( 'rw_gallery_thumb', 'type=image&size=property-thumb' ); 
	             if ( $images ) : ?>
	             
                 <div class="owl-carousel page-carousel">
                   
	                     <?php foreach ( $images as $image ){?>
                            <figure class="woocommerce-product-gallery__image page-gallery" style="background-image: url('<?php echo esc_url( $image['url'] ) ?>');">
                                <a href="<?php echo $image['url']; ?> "  class="package-gallery"></a>
                            </figure> 
	                     		
	                      <?php } ?>
                  </div>
	        
			  	<?php endif; ?>
    
                
                
            </div>
        </div>
	</div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
