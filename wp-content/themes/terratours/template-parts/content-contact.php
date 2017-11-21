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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.8364967588514!2d-85.67141628520626!3d9.947558392887123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwNTYnNTEuMiJOIDg1wrA0MCcwOS4yIlc!5e0!3m2!1sen!2scr!4v1511288248077" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
	</div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
