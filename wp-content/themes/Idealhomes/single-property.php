<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();


?>

     <section class="detail-page">
        <div class="container clearfix m-padding0">
            <div class="content-row-360">
                <div class="left-container">
                    <div class="top-detail-box">
                        <div class="">
                            <div id="demo" class="carousel slide" data-bs-ride="carousel">
                                <!-- Indicators/dots -->
                                <div class="carousel-indicators">
									<?php
									$n=0;
									if( have_rows('property_slider') ):
									while( have_rows('property_slider') ) : the_row();
                                    ?>
               <button type="button" data-bs-target="#demo" data-bs-slide-to="<?php echo $n;?>" <?php if($n==0){echo 'class="active"';}?>></button>
                                   
								<?php $n++; endwhile; endif;?>
                                </div>
                                <!-- The slideshow/carousel -->
                                <div class="carousel-inner">
									<?php
									$n=0;
									if( have_rows('property_slider') ):
									while( have_rows('property_slider') ) : the_row();
									$slider_image =get_sub_field('slider_image');
                                    ?>
                                   <div class="carousel-item <?php if($n==0){echo 'active';}?>">
                                      <img src="<?php echo $slider_image;?>" alt="Los Angeles" class="d-block w-100">
                                   </div>
                                 <?php $n++; endwhile; endif;?>
                                </div>
                       
                                <!-- Left and right controls/icons -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                </button>
                             </div>
                        </div>
                        <div class="property-details-box">
                            <h1 class="project-title">
                                <strong><?php the_title();?></strong>
                                <span class="loc"><a href="javascript:void(0);"><?php echo get_field('paddress');?></a>
                                </span>
                            </h1>

                            <div class="discription-row">
                                <div class="left-content">
                                    <span class="prop-des">
                                        <i class="bi bi-building"></i> By
										<?php $did= get_field('selected_developer'); ?>
                                        <a href="<?php echo get_the_permalink($did);?>"><?php   echo get_the_title($did);?></a>
                                    </span>
                                </div>
                                <div class="right-content">
                                    <span class="prop-des"><i class="bi bi-house-gear"></i> <?php
                            $terms = get_the_terms(get_the_ID(), 'property-room');
                            if ($terms && !is_wp_error($terms)) {
                            $terms_list = array();
                            foreach ($terms as $term) {
                            $terms_list[] = $term->name;
                            }
                            
                            echo implode(', ', $terms_list);
                            }
                            ?>
                          </span>
                                </div>
                            </div>
                            <div class="discription-row">
                                <div class="left-content d-none d-sm-block">
                                    <span class="prop-des"><i class="bi bi-bounding-box"></i> <?php echo get_field('area_sq_ft');?>
                                    </span>
                                </div>
                                <div class="right-content m-padding">
                                    <span class="price"><?php echo get_field('pprice');?></span>
                                    <div class="prop-des d-md-none">
                                        <i class="bi bi-bounding-box"></i> <?php echo get_field('area_sq_ft');?>
                                    </div>
                                </div>
                            </div>
                            <div class="discription-row">
                                <div class="left-content">
									   <?php  
                         $rera=get_field('approved_by_rera'); 
                         if($rera[0]=='Yes'){
                         ?>
                          <span class="reratext"
                            >RERA <i class="bi bi-check-lg"></i
                          ></span>
                          <?php } ?>
                                   
                                </div>
                            </div>

                            <div class="discription-row">
                                <div class="left-content">
                                    <span class="prop-des"><i class="bi bi-clock-history"></i> Last Updated Date <?php echo get_the_modified_time('d F, Y');?></span>
                                </div>
                            </div>
                        </div>
                        <!--- project details --->
                    </div>

                    <div class="property-details-box ad" id="Overviewmainbox">
                        <div id="overview">
                            <h2 class="main-heading">Overview of <?php the_title();?></h2>
                        </div>
                        <ul class="overview-list">
                            <li>
                                <div class="box-grid">
                                    <span class="heading">Project Area</span>
                                    <span class="txt"><?php echo get_field('area_sq_ft');?></span>
                                </div>
                            </li>
                            <li>
                                <div class="box-grid">
                                    <span class="heading">Project Type</span>
                                    <span class="txt"><?php echo get_field('project_type_p');?></span>
                                </div>
                            </li>
                            <li>
                                <div class="box-grid">
                                    <span class="heading">Project Status</span>
                                    <span class="txt"><?php echo get_field('project_status_p');?></span>
                                </div>
                            </li>
                            <li>
                                <div class="box-grid">
                                    <span class="heading">Possession on</span>
                                    <span class="txt"><?php echo get_field('possession_on');?></span>
                                </div>
                            </li>
                            <li>
                                <div class="box-grid">
                                    <span class="heading">Configurations</span>
                                    <span class="txt">
							<?php
                            $terms = get_the_terms(get_the_ID(), 'property-room');
                            if ($terms && !is_wp_error($terms)) {
                            $terms_list = array();
                            foreach ($terms as $term) {
                            $terms_list[] = $term->name;
                            }
                            
                            echo implode(', ', $terms_list);
                            }
                            ?></span>
                                </div>
                            </li>
                        </ul>
                        <div id="profile-description">
                            <div class="text show-more-height">
                                <h3>
                                    <span style="font-size: 20px"><strong>About <?php the_title();?></strong></span>
                                </h3>
                               <?php the_content();?>
                            </div>
                            <div class="show-more">Read More</div>
                        </div>
                        <!-- <div class="common-act-btn text-center">
                            <span class="btn btn-secondary enqbtn enqbtnonload">Inquire Now !</span>
                        </div> -->
                    </div>

                    <div class="property-details-box" id="amentiesmainbox">
                        <h2 class="main-heading"><?php the_title();?> Amenities</h2>
                        <div class="amenties-row">
							
							<?php 
							$faicon = array(
								'fa-home' => 'Club House', 
								'fa-swinpool' => 'Swimming Pool', 
								'fa-child' => 'Kids Play Area',
								'fa-braille' => 'Open Space',
								'fa-battery-full' => 'Power Backup',
								'fa-building' => 'Multipurpose Hall',
								'fa-video' => 'Video Security',
								'fa-forklift' => 'Lift',
								'fa-user' => '24X7 Security',
								'fa-globe-asia' => 'Earthquake Resistant',
								'fa-running' => 'Jogging Track',
								'fa-maintenance-staff' => 'Maintenance Staff',
							);
							$new_array = array();	
							$amenities= get_field('amenities');
							
							
							foreach ($faicon as $icon => $name) {
								if (in_array($name, $amenities)) {
									$new_array[$icon] = $name;
								}
							}
							
							
                            foreach($new_array as $icon => $name) {
								?>
                            <div class="amenties-grid">
                                <div class="amenties-box">
                                    <i class="fa <?php echo $icon;?>" aria-hidden="true"></i>
                                    <div class="amenties-txt"><?php echo $name;?></div>
                                </div>
                            </div>
							<?php } ?>
                        </div>
                    </div>

                    <div class="property-details-box" id="Specificationmainbox">
                        <h2 class="main-heading"><?php the_title();?> Specification</h2>
                        <ul>
							<?php
									$n=0;
									if( have_rows('specification') ):
									while( have_rows('specification') ) : the_row();
							       $specification_title =get_sub_field('specification_title');
                                    ?>
                                   <li><?php echo $specification_title;?></li>
                                   
								<?php $n++; endwhile; endif;?>
                         
                        </ul>
                    </div>

                    <div class="property-details-box" id="aboutDeveloper">
                        <h2 class="main-heading">Watch Video</h2>
                        <div class="developers-detail">
                            <div class="developers-detail-content">
                                <iframe width="100%" height="315" src="<?php echo get_field('video_link');?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                         
                            </div>
                         
                        </div>
                    </div>
                </div>

                <div class="right-fixed-form sticky-aside-form">
                    <div class="property-details-box">
                        <div class="main-heading">I AM INTERESTED IN</div>
                        <div class="prop-lead-form">
                         <?php echo do_shortcode('[contact-form-7 id="ff36865" title="Contact form 1"]') ?>            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php get_footer(); ?>
