<?php
/**
 * Template Name: Contact
 
 */

get_header(); 
if( !empty(get_the_post_thumbnail_url( get_the_ID(),'full')) ):
	$bannerImage = get_the_post_thumbnail_url( get_the_ID(),'full');
else:
	$bannerImage = get_template_directory_uri().'/images/dealerBannerImg.png';
endif;

?>

   <section class="sec-padding contact-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h1><?php the_title();?></h1>
            <p class="text-contact">
             <?php echo get_the_content();?>
            </p>

           <p class="text-contact"><strong><?php echo get_field('member_name');?></strong><br><?php echo get_field('member_deg');?><br><?php echo get_field('contact_number');?></p>

            <p class="text-contact"><strong><?php echo get_field('member_2nd');?></strong><br><?php echo get_field('member_2nd_deg');?><br><?php echo get_field('contact_number_2');?></p>

            <div class="contact-info-box">
              <p class="title">Corporate Headquarter</p>
              <p class="address">
                <?php echo get_field('corporate_headquarter');?>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-inq-box">
              <h4 class="main-heading">Connect with us!</h4>
              <div class="prop-lead-form">
              <?php echo do_shortcode('[contact-form-7 id="ff36865" title="Contact form 1"]') ?> 
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
   
<?php get_footer(); ?>