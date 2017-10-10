<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'terratours' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'terratours' ); ?></p>

						<?php
							get_search_form();

							the_widget( 'WP_Widget_Recent_Posts' );
						?>

						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'terratours' ); ?></h2>
							<ul>
							<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
							?>
							</ul>
						</div><!-- .widget -->

						<?php

							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'terratours' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

							the_widget( 'WP_Widget_Tag_Cloud' );
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
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

