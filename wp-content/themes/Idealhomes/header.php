<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the site name.
	bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) ) {
	echo " | $site_description";
}

	// Add a page number if necessary:
if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
	/* translators: %s: Page number. */
	echo esc_html( ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) ) );
}

?>
	</title>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	
</head>

     
      <body>

   
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
              <img class="developersec"  src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="IdealHomes Logo"/>
            </a>
            <button
               class="navbar-toggler"
               type="button"
               data-bs-toggle="collapse"
               data-bs-target="#navbarNav"
               aria-controls="navbarNav"
               aria-expanded="false"
               aria-label="Toggle navigation"
               >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                 	<?php
				  			if ( has_nav_menu( 'primary' ) ) {
				  				wp_nav_menu(
				  					array(
				  						'container'  => '',
				  						'items_wrap' => '%3$s',
				  						'theme_location' => 'primary',
				  					)
				  				);

				  			}
				  			?>
               </ul>
            </div>
         </div>
      </nav>

   

				  		

