<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * Template Name: Page Private Shuttle 
 * @package terratours
 */
$q = get_query_var('search');

get_header(); ?>
 <?php if ( has_post_thumbnail() ) :

        $id = get_post_thumbnail_id($post->ID);
        $thumb_url = wp_get_attachment_image_src($id,'tour-gallery', true);
        ?>

      <div id="bgImage" class="bgPage" style="background-image: url('<?php echo get_template_directory_uri();  ?>/img/pattern.png'), url(<?php echo $thumb_url[0] ?>); display:block;"></div>
        <!-- <ul id="bannerNav">
            <li rel="<?php echo $thumb_url[0] ?>" class="on"></li>
        
        </ul> -->
        
        
    <?php else : ?>
            <div id="bgImage" class="bgPage" style="background-image: url('<?php echo get_template_directory_uri();  ?>/img/pattern.png'), url(<?php echo get_template_directory_uri();  ?>/img/banner2.png); display:block;"></div>
            <!-- <ul id="bannerNav">
                <li rel="<?php echo get_template_directory_uri();  ?>/img/banner2.png" class="on"></li>
            
            </ul> -->
            

    <?php endif; ?>

        
<!-- <section class="banner banner-page"></section> -->
	<section class="main hexagonals">
		<div class="inner">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				

      endwhile; // End of the loop.
      
  
			?>
         <div class="transfer-filters">
					<form method="get" action="<?php echo esc_url( home_url( '/private-transport/?search='. $q) ); ?>" class="form-filters-transfer">
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Destination…', 'placeholder' ) ?>" value="<?php echo $q ?>" name="search" title="" />
						 <!-- <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" /> -->
					</form>
					
				</div>     
			  <ul class="featured-items">
            	
            
            <?php

                 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
               if($q){
               
                $args = array(
                    'post_type' => 'product',
                    's' => $q,
                    'orderby' => array('menu_order' => 'ASC', 'title' => 'ASC'),
                    'posts_per_page' => 50,
                    'paged' => $paged,
                  'tax_query' => array(
                      array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => 'private-shuttle'
                      )
                    )
                    
                  );
                
              }else{
                $args = array(
                    'post_type' => 'product',
                    //'order' => 'ASC',
                    'orderby' => array('menu_order' => 'ASC', 'title' => 'ASC'),
                    'posts_per_page' => 50,
                    'paged' => $paged,
                  'tax_query' => array(
                      array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => 'private-shuttle'
                      )
                    )
                    
                  );
              }
                $items = new WP_Query( $args );
                 // Pagination fix
                  $temp_query = $wp_query;
                  $wp_query   = NULL;
                  $wp_query   = $items;
                 
                  
                if( $items->have_posts() ) {
                  while( $items->have_posts() ) {
                     $items->the_post();
                   
                    ?>
                         <li class="image">
                            <span class="hex1"><span class="hex2"><a href="<?php the_permalink(); ?>" class="hexInner">
                                <span class="title"><?php the_title(); ?></span>
                                <?php if ( has_post_thumbnail() ) :

                                          $id = get_post_thumbnail_id($post->ID);
                                          $thumb_url = wp_get_attachment_image_src($id,'tour-item', true);
                                          ?>
                                          
                                          <img src="<?php echo $thumb_url[0] ?>"  alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                                        
                                      <?php endif; ?>
                                      
                               
                            </a></span></span>
                        </li>
                        
                    <?php
                   
                     
                  }
                }
                
              ?>
              </ul>
              <?php  the_posts_pagination( array( 'mid_size' => 2 ) ); 
                    wp_reset_postdata(); ?>

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
/*get_sidebar();*/
get_footer();

