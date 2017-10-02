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
        <div class="contact-container flex-container-sb">
            <div class="contact-info">
                    <?php
                    the_content();

                    
                ?>
            </div>
            <div class="contact-media">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15684.919025455205!2d-85.4281962!3d10.639251!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x756af3ebd14361a2!2sAvotz+Web+Works!5e0!3m2!1ses-419!2s!4v1442615525574" width="600" height="250" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>
        </div>
	</div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
