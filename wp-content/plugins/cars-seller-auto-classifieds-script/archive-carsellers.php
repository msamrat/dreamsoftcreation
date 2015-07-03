<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package adamos
 * @since adamos 1.0
 */

get_header(); 

wp_register_style( 'carsellers', plugins_url( 'cars-seller-auto-classifieds-script/css/style.css' ) );

wp_enqueue_style( 'carsellers' );
wp_register_style( 'check_availability', plugins_url('cars-seller-auto-classifieds-script/css/check_availability.css') );
wp_enqueue_style( 'check_availability' );
wp_enqueue_script( 'carsellers', plugins_url('js/carsellers.js', __FILE__) );
wp_enqueue_script( 'blockUI', plugins_url('js/blockUI.js', __FILE__) );
?>
		
		<div class="content-area carsellers-category-list width-container">
			<div class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
				<div id="luxury-carsellers">
				
				
				
					<h1 class="luxury-heading-categaory" >
						<?php

						single_cat_title( '', true );
						
							?>
					</h1>
					<?php
						if ( is_category() ) {
							// show an optional category description
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

						} elseif ( is_tag() ) {
							// show an optional tag description
							$tag_description = tag_description();
							if ( ! empty( $tag_description ) )
								echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
						}
					?>
				<!-- .page-header -->
				

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); 
				 $post_id=get_the_ID();

				$car_meta = get_post_meta( get_the_ID() );	
			// echo '<pre>';
			// print_r($post_meta);
			// die;
				$permalink = get_permalink( $post_id );
			
				?>
					<div class="carseller_section">
				<div class="carseller_image">

				<?php 
				echo '<a href="'.$permalink.'">';
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				  the_post_thumbnail();

				}
				else{
					echo '<img src="'.plugins_url('cars-seller-auto-classifieds-script').'/images/no-image.png" title="';
					the_title();
					echo '">';
				} 
				echo '</a>';

				?>
					
				</div>
				<div class="carseller_title_location">
					<h2 class="carseller_title"><?php echo '<a href="'.$permalink.'">';
					 the_title();
					 echo '</a>';?></h2>
					<?php
					if(!empty($car_meta['car_our_price'][0]))
					{
						
							$currency_symbol=get_currency_symbol();
							// print_r($currency_symbol);
							// echo $currency_symbol['symbol'];
							echo '<div >&nbsp;&nbsp;<span class="pcd-price" style="color: #4a8ec9;font-size:21px;"><b>Price:</b> '.$currency_symbol['symbol'].'&nbsp;'.number_format($car_meta['car_our_price'][0],0).' </span></div>
								';
						
					}
			
					?>
					
				</div>

				<div class="carseller-view-button">
						<a href="<?php echo  $permalink;?>" class="view_details"> view <strong>details</strong></a>
						<a href="javascript:void(0);"  class="check_availability" onclick="check_availability(<?php echo $post_id;?>);"> Check <strong>Availability</strong></a>
				</div>

			</div>
				<?php endwhile; ?>
				</div>
				<?php adamos_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>