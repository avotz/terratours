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
<div id="bgImage" style="background-image: url(<?php echo get_template_directory_uri();  ?>/img/banner2.jpg); display:block;"></div>
        <ul id="bannerNav">
            <li rel="<?php echo get_template_directory_uri();  ?>/img/banner2.jpg" class="on"></li>
            <li rel="<?php echo get_template_directory_uri();  ?>/img/banner-1.png"></li>
            <li rel="<?php echo get_template_directory_uri();  ?>/img/banner-3.png"></li>
        </ul>
<section class="banner">
          
           
        </section>
     <section class="hexagonals">
        <div class="inner">
            <ul class="featured-items">
                <li class="quizLink link">
                            <span class="hex1"><span class="hex2"><a href="#" class="hexInner">
                                <span class="title">Featured</span>
                                <span class="subtitle">Tours & Destinations</span>
                            
                            </a></span></span>
                        </li>
                <?php

                 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $args = array(
                  'post_type' => 'product',
                  //'order' => 'ASC',
                  'orderby' => array('menu_order' => 'ASC', 'title' => 'ASC'),
                  'posts_per_page' => 13,
                   'paged' => $paged,
                 'tax_query' => array(
                    array(
                      'taxonomy' => 'product_cat',
                      'field' => 'slug',
                      'terms' => 'featured'
                    )
                  )
                  
                );
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
                <!-- <li class="image">
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
               -->
            </ul>
        </div>
        
        </section>
<?php

get_footer();
