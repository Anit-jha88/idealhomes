<?php
/**
 * Template Name: About
 
 */

get_header(); 
if( !empty(get_the_post_thumbnail_url( get_the_ID(),'full')) ):
	$bannerImage = get_the_post_thumbnail_url( get_the_ID(),'full');
else:
	$bannerImage = get_template_directory_uri().'/images/dealerBannerImg.png';
endif;

?>

 <section class="about-banner">
      <div class="banner-content">
        <div class="container">
          <div class="heading">
            <h1><?php the_title();?></h1>
          </div>
        </div>
      </div>
    </section>

    <section class="sec-padding">
      <div class="container">
       <?php the_content();?>
        <div class="our-vision mobile-x-scroll">
          <div class="row">
            <div class="col-md-4">
              <div class="vision-box">
                <div class="title"><?php echo get_field('our_vision_title');?></div>
                <div class="txt">
                  <read-more limit="110" more="Read More" less="Read Less">
                    <p>
                     <?php echo get_field('our_vision_content');?>
                      <a class="readMore">Read More</a>
                    </p>
                  </read-more>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="vision-box">
                <div class="title"> <?php echo get_field('our_mission_title');?></div>
                <div class="txt">
                  <read-more limit="110" more="Read More" less="Read Less">
                    <p>
                       <?php echo get_field('our_mission_content');?>

                      <a class="readMore">Read More</a>
                    </p>
                  </read-more>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="vision-box">
                <div class="title"> <?php echo get_field('our_goal_title');?></div>
                <div class="txt">
                  <read-more limit="110" more="Read More" less="Read Less">
                    <p>
                      <?php echo get_field('our_goal_content');?>

                      <a class="readMore">Read More</a>
                    </p>
                  </read-more>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
<!--
    <section class="sec-padding about-counter-sec">
      <div class="container">
        <div class="about-counter">
          <div class="counter-grid">
            <div class="counter-box">
              <div class="counts"> <?php echo get_field('cities');?>
</div>
              <p>CITIES</p>
            </div>
          </div>
          <div class="counter-grid">
            <div class="counter-box">
              <div class="counts"> <?php echo get_field('projects');?></div>
              <p>PROJECTS</p>
            </div>
          </div>
          <div class="counter-grid">
            <div class="counter-box">
              <div class="counts"><?php echo get_field('developers');?></div>
              <p>DEVELOPERS</p>
            </div>
          </div>
          <div class="counter-grid">
            <div class="counter-box">
              <div class="counts"><?php echo get_field('customers');?></div>
              <p>CUSTOMERS</p>
            </div>
          </div>
          <div class="counter-grid">
            <div class="counter-box">
              <div class="counts"><?php echo get_field('worth_property_sold');?></div>
              <p>WORTH PROPERTY SOLD</p>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <section class="sec-padding mobile-x-scroll">
      <div class="container">
        <div class="sec-heading">
          <h2>Leadership</h2>
        </div>
        <div class="row">
			   <?php
                
                
                if( have_rows('leadership') ):
                while( have_rows('leadership') ) : the_row();
                
                ?>
         
           
      
          <div class="col-md-4">
            <div class="leadership-box">
              <div class="img">
                <img src="<?php echo get_sub_field('profile_images');?>" />
              </div>
              <div class="content">
                <p class="name"><?php echo get_sub_field('nm');?></p>
                <p class="degination"><?php echo get_sub_field('dg');?></p>
                <!-- <read-more limit="170" more="Read More" less="Read Less"> -->
                  <p>
                    <?php echo get_sub_field('description');?>
                    <!-- <a class="readMore">Read More</a> -->
                  </p>
                <!-- </read-more> -->
              </div>
            </div>
          </div>
			 <?php endwhile; endif;?>
        </div>
			 
      </div>
    </section>
<?php get_footer(); ?>