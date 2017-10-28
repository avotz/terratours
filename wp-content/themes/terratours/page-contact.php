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
 * Template Name: Page Contact
 * @package terratours
 */

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

        


	<section class="main">
		<div  class="inner">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'contact' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
/*get_sidebar();*/
get_footer();
