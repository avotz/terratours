<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
					<?php if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_format() );

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
