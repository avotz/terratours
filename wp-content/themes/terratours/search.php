<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package terratours
 */

get_header(); ?>
<?php if ( has_post_thumbnail() ) :

        $id = get_post_thumbnail_id($post->ID);
        $thumb_url = wp_get_attachment_image_src($id,'tour-gallery', true);
        ?>

        <div id="bgImage" class="bgPage" style="background-image: url(<?php echo $thumb_url[0] ?>); display:block;"></div>
        <!-- <ul id="bannerNav">
            <li rel="<?php echo $thumb_url[0] ?>" class="on"></li>
        
        </ul> -->
        
        
    <?php else : ?>
            <div id="bgImage" class="bgPage" style="background-image: url(<?php echo get_template_directory_uri();  ?>/img/banner2.png); display:block;"></div>
            <!-- <ul id="bannerNav">
                <li rel="<?php echo get_template_directory_uri();  ?>/img/banner2.png" class="on"></li>
            
            </ul> -->
            

    <?php endif; ?>

        


	<section class="main">
		<div  class="inner">

		 <div class="blog-container flex-container-sb">
		 	<div class="blog-info">
				<?php
				if ( have_posts() ) : ?>
		
					<header class="page-header">
						<h1 class="page-title"><?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'terratours' ), '<span>' . get_search_query() . '</span>' );
						?></h1>
					</header><!-- .page-header -->
		
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
		
						/**
						 * Run the loop for the search to output the results.
						* If you want to overload this in a child theme then include a file
						* called content-search.php and that will be used instead.
						*/
						get_template_part( 'template-parts/content', 'search' );
		
					endwhile;
		
					the_posts_navigation();
		
				else :
		
					get_template_part( 'template-parts/content', 'none' );
		
				endif; ?>
	 
			 </div>
			 <div class="blog-sidebar">
			 <?php
					get_sidebar();?>
			 </div>
		 </div>
		 


		</div><!-- #main -->
	</section><!-- #primary -->

<?php

get_footer();

