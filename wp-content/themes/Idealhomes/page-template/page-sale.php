<?php
/**
 * Template Name: Sale
 
 */

get_header(); 
if( !empty(get_the_post_thumbnail_url( get_the_ID(),'full')) ):
	$bannerImage = get_the_post_thumbnail_url( get_the_ID(),'full');
else:
	$bannerImage = get_template_directory_uri().'/asset/images/welcome-to-animation-production.png';
endif;

?>
      <div class="container sec-padding">
		  <div class="sec-heading">
               <h2>Property For Sale</h2>
            
            </div>
      <form id="smallCategoryFIlter1" class="developerform" method="post">
        <div class="project-listing-page">
          <div class="project-filter-div">
            <div class="project-filter ">
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
                      class="pagin"
                      type="checkbox"
                      value="<?php echo $term->term_id;?>"
                      id="<?php echo $term->slug;?>"
                    />
                    <span class="txt-label"><?php echo $term->name;?></span>
					  <input type="hidden" id="rs" value="6" />
                  </label>
                </li>
             <?php } } ?>
                <input type="hidden" name="builderId" value="5" />
                <input
                  type="hidden"
                  name="builderName"
                  value="Godrej Properties"
                />
              </ul>
             
            </div>
          </div>
          <div class="project-filter-content homeclst">
            <div id="products">
				<div id="ajax-loader" style="display: none;">
				</div>
              <div class="project-listing-row" id="pajax">
                  <?php
                        $term_id = 6; // Replace with your taxonomy term ID
                        $taxonomy = 'property-type'; // Replace with your custom taxonomy name
                        $post_type = 'property'; // Replace with your custom post type
                        
                        $args = array(
                        'post_type'      => $post_type,
                        'posts_per_page' => -1, // Get all posts
                        'tax_query'      => array(
                        array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'term_id',
                        'terms'    => $term_id,
                        ),
                        ),
                        );
                        
                        $query = new WP_Query($args);
                        
                        if ($query->have_posts()) {
                        while ($query->have_posts()) {
                        $query->the_post();
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
						<span class="new-launch"><?php echo get_field('project_status_p');?></span>
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
               
                 <?php } wp_reset_postdata(); } ?>
             
             
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
    top: 37%;
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
<?php get_footer(); ?>