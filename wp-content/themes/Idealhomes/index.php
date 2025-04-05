<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

  
    <section>
        <!-- BLOG GRID START -->
        <div class="container ptb-60">
            <div class="row">
                           
                          <?php
                        
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            
                            $args = array(
                            'post_type'      => 'post', // Or your custom post type
                            'posts_per_page' => 9,
                            'paged'          => $paged,
                            );
                            
                            $custom_query = new WP_Query($args);
                            
                            if ($custom_query->have_posts()) :
                            
                            while ($custom_query->have_posts()) : $custom_query->the_post();
                            $image=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
                        
                           ?>
                           
                            <div class="col-lg-4">
                <div class="blog-grid">
                  <figure class="bg-preview-pic">
                      <a href="<?php the_permalink();?>">
                        <img src="<?php echo $image[0];?>" alt="">
                      </a>
                  </figure>
                  <div class="bg-caption">
                    <div class="caption-content blogHome">
                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <div class="post-details">
                            <ul>
                                <li><a href="#.">Admin</a></li>
                                <li class="date"><?php echo get_the_date('d M Y');?></li>
                            </ul>
                        </div>
                        <p><?php echo substr(get_the_content(),0,100);?>..</p>
                        <h5><a href="<?php the_permalink();?>">Read More</a></h5>
                    </div>
                  </div>
                </div>  
              </div>
                           
                         

                            
                    <?php   endwhile; ?>
                    
                    
                     </div>
            <div class="site-pagination">
                <nav aria-label="Page navigation example">
                  <?php
                            custom_pagination($custom_query); 
                            wp_reset_postdata();
                            else :
                            echo 'No posts found.';
                            endif;
                            ?>
                </nav>
            </div> 
        </div> 
        <!-- BLOG GRID END -->
    </section>
    
                    
                    
                    
                            
                            
                          
                            
                            
                            
                          
                      
  

<?php get_footer(); ?>
