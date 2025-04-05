<?php
/**
 * Template for displaying Category Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


   

    <section>
        <!-- BLOG GRID START -->
        <div class="container ptb-60"><h2 align="center"><?php	printf( __( ' %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );?> </h2>
            <div class="row">
                           
                           <?php 
							if (have_posts()) :
							while ( have_posts() ) : the_post(); 
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
