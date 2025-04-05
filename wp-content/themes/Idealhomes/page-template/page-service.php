<?php
/**
 * Template Name: Service
 
 */

get_header(); 
if( !empty(get_the_post_thumbnail_url( get_the_ID(),'full')) ):
	$bannerImage = get_the_post_thumbnail_url( get_the_ID(),'full');
else:
	$bannerImage = get_template_directory_uri().'/asset/images/welcome-to-animation-production.png';
endif;

?>
  <section class="sec-padding gray-bg why-buy-us row-scroll-m">
         <div class="container">
            <div class="sec-heading">
               <h2><?php the_title();?></h2>
               <p>
                 <?php echo get_the_content(); ?>
               </p>
            </div>
            <div class="row">
               
               <?php
                
                
                if( have_rows('our_services') ):
                while( have_rows('our_services') ) : the_row();
                
                ?>
               <div class="col-md-4 col-6">
                  <div class="why-buy-box">
                     <img src="<?php echo get_sub_field('service_images');?>" />
                     <div class="title"><?php echo get_sub_field('service_name');?></div>
                     <read-more limit="125" more="Read More" less="Read Less">
                        <p>
                          <?php echo get_sub_field('service_description');?>
                           <a class="readMore">Read More</a>
                        </p>
                     </read-more>
                  </div>
               </div>
				  <?php endwhile; endif;?>
             
             
            </div>
         </div>
      </section>  
<?php get_footer(); ?>
  