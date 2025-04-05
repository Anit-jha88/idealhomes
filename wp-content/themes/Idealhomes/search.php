<?php
/**
 * The template for displaying search results pages
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

		<?php if ( have_posts() ) : ?>

	
			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
 $image=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
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
			<?php
				// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => __( 'Previous page', 'twentysixteen' ),
					'next_text'          => __( 'Next page', 'twentysixteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
				)
			);

			// If no content, include the "No posts found" template.
		else :
		?>
		<p align="center">No Result Found</p>
		<?php

		endif;
		?>

	  </div>
      </div>
   </section>


<?php get_footer(); ?>
