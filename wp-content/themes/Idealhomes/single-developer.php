<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
	$bannerImage = get_the_post_thumbnail_url( get_the_ID(),'full');
 $id=get_the_ID();
?>

  <section class="developers-banner sec-padding">
      <div class="container">
        <div class="developers-detail">
          <div class="developers-detail-content">
            <div class="developers-logo">
              <div class="img">
                <img src="<?php echo $bannerImage;?>" />
              </div>
            </div>
            <div class="developers-content">
              <div class="top-content">
                <h1><?php the_title();?></h1>
              </div>
              <div class="mid-content">
                <ul class="brif-detail">
                  <li>
                    <i class="bi bi-bank"></i>
                    <span class="title">Established</span>
                    <span class="txt"><?php echo get_field('established');?></span>
                  </li>
                  <li>
                    <i class="bi bi-buildings"></i>
                    <span class="title">Total -Projects</span>
                    <span class="txt"><?php echo get_field('total_-projects');?></span>
                  </li>
                  <li>
                    <i class="bi bi-building-up"></i>
                    <span class="title">Ongoing Projects</span>
                    <span class="txt"><?php echo get_field('ongoing_projects');?></span>
                  </li>
                  <li>
                    <i class="bi bi-pin-map"></i>
                    <span class="title">City Present</span>
                    <span class="txt"><?php echo get_field('city_present');?></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="bottom-content">
            <div id="profile-description">
              <div class="text show-more-height">
                <?php the_content();?>
              </div>
              <div class="show-more">Read More</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="container sec-padding">
      <form id="smallCategoryFIlter1" class="developerform" method="post">
        <div class="project-listing-page">
          <div class="project-filter-div">
            <div class="project-filter sec-padding">
              <ul class="filter-options">
                  <?php
                    $taxonomy = 'property-room'; // Replace with your taxonomy name
                    
                    $terms = get_terms([
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                    'parent'     => 0, // Get only parent terms
                    ]);
                    
                    if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                    ?>
                <li>
                  <label for="1bhk">
                    <input
                      name="options[]"
                      class="pagin1"
                      type="checkbox"
                      value="<?php echo $term->term_id;?>"
                      id="<?php echo $term->slug;?>"
                    />
                    <span class="txt-label"><?php echo $term->name;?></span>
                  </label>
                </li>
             <?php } } ?>
                <input type="hidden" id="rs" name="builderId" value="<?php echo get_the_ID();?>" />
               
              </ul>
             
            </div>
          </div>
          <div class="project-filter-content homeclst">
            <div id="products">
				<div id="ajax-loader" style="display: none;">
				</div>
              <div class="project-listing-row" id="pajax">
				  
				   <?php
				
				  
				  $args = array(
					'post_type'      => 'property', // Replace with your custom post type
					'meta_key'       => 'selected_developer', // Replace with your custom field key
					'meta_value'     => $id, // Replace with the value you're filtering by
					'posts_per_page' => -1, // Get all posts (change to a number if needed)
					);

				 $posts = get_posts($args);
				   foreach ($posts as $post) {

                   $img = get_the_post_thumbnail_url( get_the_ID(),'full');
                  ?>
				  
              
                 <div class="project-grid" data-type="1bhk">
                  <div class="project-listing-box" >
                    <div class="img">
                      <a
                        href="<?php echo get_permalink();?>"
                      >
                        <img
                          src="<?php echo $img;?>"
                        />
                      </a>
						<?php
						$terms = get_the_terms(get_the_ID(), 'property-type');
                            if ($terms && !is_wp_error($terms)) {
                            $terms_list = array();
                            foreach ($terms as $term) {
                              $rs = $term->name;
                            }
							}
						?>
						<?php if($rs=='Rent'){?>
						<span class="new-launch1"><?php echo $rs;?></span>
						<?php }else{ ?>
						<span class="new-launch"><?php echo $rs;?></span>
						<?php } ?>
                    </div>
                    <div class="content">
                      <a
                        href="<?php echo get_permalink();?>"
                      >
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
                          <i class="bi bi-currency-rupee"></i><?php echo get_field('pprice');?>
                        </p>
                        <span class="btn enqbtn" ><a href="<?php echo get_page_link(26);?>">Contact us</a></span>
                      </div>
                    </div>
                  </div>
                </div>
               
                 <?php  } ?>
 
              </div>

            </div>
          </div>
        </div>
      </form>
    </div> 
<style>
	#ajax-loader {
    display: none;
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    position: absolute;
    top: 87%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
	.ppp {
    margin-left: 557px;
    margin-bottom: 1rem;
	color:red;	
}
</style>
    <style>
    .add-to-fav, .new-launch1 {
    position: absolute;
    z-index: 9;
}
    .new-launch1 {
    background: blue;
    color: #fff;
    font-size: 10px;
    top: 10px;
    left: 10px;
    padding: 3px 10px;
    border-radius: 50px;
}
</style>

  
<?php get_footer(); ?>
