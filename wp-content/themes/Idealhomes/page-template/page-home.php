<?php
/**
 * Template Name: Home
 
 */

get_header(); 
if( !empty(get_the_post_thumbnail_url( get_the_ID(),'full')) ):
	$bannerImage = get_the_post_thumbnail_url( get_the_ID(),'full');
else:
	$bannerImage = get_template_directory_uri().'/images/dealerBannerImg.png';
endif;

?>

<div class="home-slider">
    <!-- Carousel wrapper -->
        <div id="carouselVideoExample" data-mdb-carousel-init class="carousel slide carousel-fade" data-mdb-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <video class="img-fluid" autoplay loop muted id="myVideo">
                    <source src="<?php echo get_field('video_banner');?>" type="video/mp4" /></video>
                    <div class="carousel-caption d-none d-md-block">
                       
                       
                    </div>
                </div>
            </div>
        </div>
    <!-- Carousel wrapper -->
    </div>

      <div class="discover-commercial">
         <a href="<?php echo get_page_link(20);?>" class="active">Sale</a> <a href="<?php echo get_page_link(22);?>">Rent</a>
      </div>
      <section class="sec-padding">
         <div class="container-fluid">
            <div class="sec-heading">
               <h2>Trending Projects</h2>
               <p>The Noteworthy Real Estate in India</p>
            </div>
            <div class="trending-project-row">
               <!-- <div class="view-all-content">
                  <div class="project-listing-box view-all-project">
                    <i class="bi bi-buildings"></i>
                    <div class="heading">Best Sellers in india</div>
                    <p>
                      The latest residential offerings from the best builders in
                      india, handpicked by our team of experts just for you and backed
                      by our widely acclaimed transaction and financial services.
                    </p>
                    <div><a href="#" class="btn btn-primary">View All</a></div>
                  </div>
                  </div> -->
               <div class="slider-content">
                  <div
                     id="trendingProjectSlider"
                     class="owl-carousel round-arrow project-scroll-m owl-loaded owl-drag" >
                     <div class="owl-stage-outer">
                        <div class="owl-stage">
							  <?php
                       
                        $post_type = 'property'; // Replace with your custom post type
                        
                        $args = array(
                        'post_type'      => $post_type,
                        'posts_per_page' => 6, // Get all posts
                        
                        );
                        
                        $query = new WP_Query($args);
                        
                        if ($query->have_posts()) {
                        while ($query->have_posts()) {
                        $query->the_post();
                        $img = get_the_post_thumbnail_url( get_the_ID(),'full');
                  ?>
                           <div class="owl-item active">
                              <div class="project-grid">
                                 <div class="project-listing-box">
                                    <div class="img">
                                       <a href="<?php echo get_permalink();?>">
                                       <img
                                          src="<?php echo $img;?>"
                                          data-src="<?php echo $img;?>"
                                          class="treanding"
                                          alt="<?php echo get_the_title();?>"
                                          />
                                       </a>
                                       <span class="new-launch"><?php echo get_field('project_status_p');?></span>
                                    </div>
                                    <div class="content">
                                       <a href="<?php echo get_permalink();?>">
                                          <div class="top-content">
                                             <h3 class="title"><?php echo get_the_title();?></h3>
											<?php  
											 $rera=get_field('approved_by_rera'); 
											 if($rera[0]=='Yes'){
											 ?>
											  <span class="reratext"
												>RERA <i class="bi bi-check-lg"></i
											  ></span>
											  <?php } ?>
                                          </div>
                                           <p>By <?php
                        $terms = get_field('selected_developer');
		                echo get_the_title($terms);
		                ?></p>
                                         <p><?php echo get_field('paddress');?></p>
                                          <div class="mid-content">
                                           <?php
                            $terms = get_the_terms(get_the_ID(), 'property-room');
                            if ($terms && !is_wp_error($terms)) {
                            $terms_list = array();
                            foreach ($terms as $term) {
                            $terms_list[] = $term->name;
                            }
                            
                            echo '<p>'.implode(', ', $terms_list).'</p>';
                            }
                            ?>
                                             <p><?php echo get_field('area_sq_ft');?></p>
                                          </div>
                                       </a>
                                       <div class="bottom-content">
                                          <p class="price">
                                             <i class="bi bi-currency-rupee"></i> <?php echo get_field('pprice');?>
                                          </p>
                                          <span class="btn enqbtn" ><a href="<?php echo get_page_link(26);?>">Contact us</a></span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
							<?php } wp_reset_postdata(); } ?>
                         
                          
                          
                        
                        </div>
                     </div>
                     <div class="owl-nav">
                        <button
                           type="button"
                           role="presentation"
                           class="owl-prev disabled"
                           >
                        <i class="bi bi-chevron-left"></i></button
                           ><button type="button" role="presentation" class="owl-next">
                        <i class="bi bi-chevron-right"></i>
                        </button>
                     </div>
                     <div class="owl-dots">
                        <button role="button" class="owl-dot active">
                        <span></span></button
                           ><button role="button" class="owl-dot"><span></span></button
                           ><button role="button" class="owl-dot"><span></span></button
                           ><button role="button" class="owl-dot"><span></span></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="sec-padding">
         <div class="container">
            <div class="sec-heading">
               <h2>Featured Cities</h2>
               <p>Find your home in the city of your choice</p>
            </div>
            <div
               id="featuredCitiesSlider"
               class="owl-carousel round-arrow slider-scroll-mobile owl-loaded owl-drag"
               >
               <div class="owl-stage-outer">
                  <div class="owl-stage">
                     
                  
                     <?php
                
                
                if( have_rows('featured_cities') ):
                while( have_rows('featured_cities') ) : the_row();
                
                ?>
                     <div class="owl-item">
                        <div class="item">
                           <a
                              href="#."
                              class="featured-city-box"
                              >
                              <div class="img-box">
                                 <img
                                    width="100%"
                                    height="200"
                                    src="<?php echo get_sub_field('city_image');?>"
                                    class="featuressection"
                                    alt="Kolkata"
                                    />
                                 <h3 class="title"><?php echo get_sub_field('city_name');?></h3>
                              </div>
                              <div class="options-txt"><?php echo get_sub_field('option_count');?></div>
                           </a>
                        </div>
                     </div>
                     <?php endwhile; endif;?>
                  
                  </div>
               </div>
               <div class="owl-nav">
                  <button type="button" role="presentation" class="owl-prev disabled">
                  <i class="bi bi-chevron-left"></i></button
                     ><button type="button" role="presentation" class="owl-next">
                  <i class="bi bi-chevron-right"></i>
                  </button>
               </div>
               <div class="owl-dots">
                  <button role="button" class="owl-dot active"><span></span></button
                     ><button role="button" class="owl-dot"><span></span></button>
               </div>
            </div>
         </div>
      </section>
      <section class="sec-padding gray-bg why-buy-us row-scroll-m">
         <div class="container">
            <div class="sec-heading">
               <h2>Why Choose us ?</h2>
               <p>
                  Aspects that make Ideal Homes Indias leading Real Estate Advisory
               </p>
            </div>
            <div class="row">
           
             
               <?php
                
                
                if( have_rows('why_choose_us') ):
                while( have_rows('why_choose_us') ) : the_row();
                
                ?>
              
              
               <div class="col-md-4 col-6">
                  <div class="why-buy-box">
                       <img src="<?php echo get_sub_field('why_choose_us__images');?>" />
                     <div class="title"><?php echo get_sub_field('why_choose_us__title');?></div>
                     <read-more limit="125" more="Read More" less="Read Less">
                        <p>
                          <?php echo get_sub_field('why_choose_us_description');?>
                           <a class="readMore">Read More</a>
                        </p>
                     </read-more>
                  </div>
               </div>
				<?php endwhile; endif;?>
            </div>
         </div>
      </section>
      <div id="leadDeveloper">
         <section class="sec-padding developers-scroll-m">
            <div class="container">
               <div class="sec-heading">
                  <h3>Leading Real Estate Developers</h3>
               </div>
               <div
                  id="leadingDevelopersSlider"
                  class="owl-carousel round-arrow slider-scroll-mobile owl-loaded owl-drag"
                  >
                  <div class="owl-stage-outer">
                     <div class="owl-stage">
                          <?php
                            $args = array(
                            'post_type' => 'developer', // Replace with your custom post type
                           
                            'posts_per_page' => -1, 
                            'order' => 'ASC',
                            );
                            
                            $query = new WP_Query($args);
                            
                            if ($query->have_posts()) {
                            while ($query->have_posts()) {
                            $query->the_post();
                           $img = get_the_post_thumbnail_url( get_the_ID(),'full');
                       ?>
                        <div class="owl-item active">
                           <div class="item">
                              <div class="developers-box">
                                 <a href="<?php the_permalink();?>"
                                    ><img
                                    class="developersec"
                                    src="<?php echo $img;?>"
                                    data-src="<?php echo $img;?>"
                                    alt="<?php echo get_the_title();?>"
                                    width="100%"
                                    height="60"
                                    /></a>
                              </div>
                           </div>
                        </div>
                        
                       <?php } wp_reset_postdata(); } ?>
                     </div>
                  </div>
                  <div class="owl-nav">
                     <button
                        type="button"
                        role="presentation"
                        class="owl-prev disabled"
                        >
                     <i class="bi bi-chevron-left"></i></button
                        ><button type="button" role="presentation" class="owl-next">
                     <i class="bi bi-chevron-right"></i>
                     </button>
                  </div>
                  <div class="owl-dots">
                     <button role="button" class="owl-dot active"><span></span></button
                        ><button role="button" class="owl-dot"><span></span></button
                        ><button role="button" class="owl-dot"><span></span></button>
                  </div>
               </div>
            </div>
         </section>
      </div>
            
<?php get_footer(); ?>