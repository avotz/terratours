<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package terratours
 */

?>

<footer class="footer">
<div class="inner">
	 <div class="footer-container flex-container-sb">

		
		<div class="footer-contact">
		   
			<a href="mailto::info@terratours.com" class="footer-contact-link">info@terratours.com</a> | 
			<a href="<?php echo esc_url( home_url( '/general-policies' ) ); ?>">General policies</a>
		</div>
		 <div class="footer-copyright">
		 <span class="copy">Copyright © 2017. All Rights Reserved.</span>   
		   
		 <span class="avotz"><a href="http://www.avotz.com" target="_blank"><i class="icon-avotz"></i></a></span>
		   
		</div>
		
	</div>
	
</div>


</footer>
<div class="site-social">

<a href="#" class="site-social-link"><i class="fa fa-facebook"></i></a>
<a href="#" class="site-social-link"><i class="fa fa-google-plus"></i></a>
<a href="#" class="site-social-link"><i class="fa fa-youtube"></i></a>
</div>

<div id="tour-popup" class="request-popup white-popup mfp-hide mfp-with-anim">
		<?php echo do_shortcode('[contact-form-7 id="29" title="Contact form"]');
        ?>               
	    
	</div>

<?php wp_footer(); ?>

</body>
</html>
