<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			
				<div class = "big-pic" >
					<div class = "boxInPic">
					  Lumber brought directly to you!
					</div>	
				</div>
				
				<div class = "big-pic" id = "two">
					<div class = "boxInPic">
					Wood for any project	
					</div>
				</div>
				
				<div class = "big-pic" id = "three">
					<div class = "boxInPic">
					Contact us with any questions
					</div>
				</div>
				
				<div class = "big-pic" id = "four">
					<div class = "boxInPic">
						Great Prices, Great Service
					</div>
				</div>
				
					<div style="text-align:center">
					  <span class="dot"  id = "0"></span> 
					  <span class="dot" id = "1"></span> 
					  <span class="dot" id = "2"></span> 
					  <span class="dot"  id = "3"></span> 
                    </div>
							

			<?php
			/**
			 * Functions hooked in to homepage action
			 *
			 * @hooked storefront_homepage_content      - 10
			 * @hooked storefront_product_categories    - 20
			 * @hooked storefront_recent_products       - 30
			 * @hooked storefront_featured_products     - 40
			 * @hooked storefront_popular_products      - 50
			 * @hooked storefront_on_sale_products      - 60
			 * @hooked storefront_best_selling_products - 70
			 */
			do_action( 'homepage' ); ?>
		
		<!--yellow box down below -->
		<div id = "box">
			<div id = "leftSide">
				<h1 id = "slogan">We Love Lumber</h1>
				<p id = "belowSlogan"> We want to help you take on your next lumber project!</p>
			</div>
			
			<div id = "ImageContainer">
				
			</div>
			
		</div>
		
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();



