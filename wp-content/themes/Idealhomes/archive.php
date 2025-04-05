<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="pq-breadcrumb">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-12">
               <nav aria-label="breadcrumb">
                  <div class="pq-breadcrumb-title">
                     <h2><?php single_term_title();?></h2> </div>
                  <div class="pq-breadcrumb-container mt-2">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>"><i class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active"><?php single_term_title();?></li>
                     </ol>
                  </div>
               </nav>
            </div>
            <div class="col-lg-4">
               <div class="pq-breadcrumb-img text-right wow fadeInRight"></div>
            </div>
         </div>
      </div>
   </div>
   <!--=================================
         Banner end-->
   <!--=================================
         conatct-us start-->

         <section class="explore wow fadeInDown" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInDown;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pq-section pq-style-1 text-center">
                         
                            <h5 class="pq-section-title">Our Products</h5>
                        </div>
                    </div>
                </div>
      
                <div class="row wow animated fadeInUp">
                    <?php
                    if ( have_posts() ) : 
                    // Start the loop.
                    while ( have_posts() ) :
                    the_post();
                    
                    ?>  
                    <div class="col-lg-3 col-md-3 mt-4 mt-md-0">
                        <div class="pq-service-box pq-style-5">
                            <div class="pq-service-block">
                                <div class="pq-service-img">
                                    <?php $image=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); ?>
                       <img src="<?php echo $image[0];?>"  alt="<?php the_title();?>">
                                </div>
                                <div class="pq-service-box-info">
                                    <div class="pq-info-text">
                                        <a href="<?php the_permalink();?>">
                                            <h5 class="pq-service-title"><?php the_title();?></h5>
                                        </a>
                                    </div>
                                    <a href="<?php the_permalink();?>">
                                        <div class="pq-service-icon">
                                            <i class="ti-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php endwhile; 	else :?>
                   <div class="col-12">
                       <p align="center">No Product Found!</p>
                    </div>
                    <?php	endif;?>
                </div>
            </div>
        </section>


<?php get_footer(); ?>
