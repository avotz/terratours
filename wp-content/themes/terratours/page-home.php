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
 *
 * @package terratours
 */

get_header(); ?>
<div id="bgImage" style="background-image: url(<?php echo get_template_directory_uri();  ?>/img/banner2.png); display:block;"></div>
        <ul id="bannerNav">
            <li rel="<?php echo get_template_directory_uri();  ?>/img/banner2.png" class="on"></li>
            <li rel="<?php echo get_template_directory_uri();  ?>/img/banner3.png"></li>
            <li rel="<?php echo get_template_directory_uri();  ?>/img/banner1.png"></li>
        </ul>
<section class="banner">
          
           
        </section>
     <section class="hexagonals">
        <div class="inner">
            <ul class="featured-items">
                <li class="image">
                    <span class="hex1"><span class="hex2"><a href="#" class="hexInner">
                        <span class="title">Lorem ipsum</span>
                        <img src="<?php echo get_template_directory_uri();  ?>/img/item.jpg">
                    </a></span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2"><a href="#" class="hexInner">
                        <span class="title">dolor sit amet</span>
                        <img src="<?php echo get_template_directory_uri();  ?>/img/item4.jpg">
                    </a></span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner">
                                            <span class="title">Lorem ipsum</span>
                                            <img src="<?php echo get_template_directory_uri();  ?>/img/item.jpg"></a>
                                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2"><a href="#" class="hexInner">
                        <span class="title">dolor sit amet</span>
                        
                        <img src="<?php echo get_template_directory_uri();  ?>/img/item5.jpg">
                    </a></span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"><span class="title">Lorem ipsum </span><img src="<?php echo get_template_directory_uri();  ?>/img/item2.jpg"></a>
                                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"> <span class="title">dolor sit amet </span><img src="<?php echo get_template_directory_uri();  ?>/img/item6.jpg"></a>
                                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"><img src="<?php echo get_template_directory_uri();  ?>/img/item4.jpg"></a>
                                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"> <span class="title">dolor sit amet </span><img src="<?php echo get_template_directory_uri();  ?>/img/item5.jpg"></a>
                                    </span></span>
                </li>
                        <li class="quizLink link">
                    <span class="hex1"><span class="hex2"><a href="#" class="hexInner">
                        <span class="title">Our Tours</span>
                        <span class="subtitle">Which do you choose?</span>
                       
                    </a></span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2"><a href="#" class="hexInner" target="new">
                        <span class="title">dolor sit amet </span>
                       <img src="<?php echo get_template_directory_uri();  ?>/img/item.jpg">
                    </a></span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"><span class="title">Lorem ipsum </span><img src="<?php echo get_template_directory_uri();  ?>/img/item.jpg"></a>
                                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"><img src="<?php echo get_template_directory_uri();  ?>/img/item2.jpg">
                                            <span class="title">Lorem ipsum </span>
                                        </a>
                                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                        <a href="#" target="_blank" class="hexInner">
                        <img src="<?php echo get_template_directory_uri();  ?>/img/item6.jpg">
                        <span class="title">Lorem ipsum </span>
                        </a>
                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"><img src="<?php echo get_template_directory_uri();  ?>/img/item3.jpg"></a>
                                    </span></span>
                </li>
                        <li class="image">
                    <span class="hex1"><span class="hex2">
                                        <a href="#" class="hexInner"><img src="<?php echo get_template_directory_uri();  ?>/img/item4.jpg"></a>
                                    </span></span>
                </li>
              
            </ul>
        </div>
        
        </section>
<?php

get_footer();
