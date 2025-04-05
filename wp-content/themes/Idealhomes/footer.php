      <footer class="sec-padding site-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <h4>Contact Us</h4>
                  <p class="footer-txt">
                     A- 714, Kailash business Park, Hiranandani linking road,
                     vikhroli-400079
                  </p>
                  <div class="share-footer">
                     <h4>Follow us on</h4>
                     <div class="social-share-footer">
                        <a href="#."><i class="bi bi-facebook"></i></a>
                        <a href="#."><i class="bi bi-linkedin"></i></a>
                        <a href="#."><i class="bi bi-instagram"></i></a>
                        <a href="#."><i class="bi bi-twitter-x"></i></a>
                        <a href="#."><i class="bi bi-youtube"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-md-2">
                  <h4>Quick Links</h4>
                  <div class="footer-link">
                     <ul>
                         <?php
                                               wp_nav_menu( array(
                                                   'menu_class'=>'menu',
                                                  'menu_id' => 'menu-useful-links',
                                                   'container' => 'ul',
                                                 'menu' => 'Footer menu', // Replace 'your-menu-slug' with the actual menu slug
                       
                                                ) );
                                               ?>
                     </ul>
                  </div>
               </div>
               <div class="col-md-6">
                  <iframe
                     loading="lazy"
                     src="https://maps.google.com/maps?q=Mumbai%2Cpowai&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near"
                     title="Mumbai,powai"
                     aria-label="Mumbai,powai"
                     width="100%"
                     height="100%"
                     ></iframe>
               </div>
               <p class="copyrights">
                  Copyright 2025 IdealHomes. All rights reserved. | Developed By <a href="https://www.mkstechnosoft.com/" target="_blank"> Technosoft</a>
               </p>
            </div>
         </div>
      </footer>
   
   
   
   
   
<?php wp_footer(); ?>

<script>
jQuery(document).ready(function($) {

    $('.dropdown-menu li > a').addClass('dropdown-item');
	$('.dropdown-menu li').removeClass('nav-item nav-item-type-post_type nav-item-object-page nav-item-30');
	$('.dropdown-menu li > a').removeClass('nav-link');

});
	</script>

</body>
</html>
