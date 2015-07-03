<?php
function latest_cars($atts) {
    	
    	wp_enqueue_style( 'carsellers', plugins_url('css/style.css', __FILE__) );
    	wp_enqueue_style( 'check_availability', plugins_url('css/check_availability.css', __FILE__) );
    	wp_enqueue_script( 'carsellers', plugins_url('js/carsellers.js', __FILE__) );
    	wp_enqueue_script( 'blockUI', plugins_url('js/blockUI.js', __FILE__) );
    	// wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
    	
	if(!empty($atts))
	{

		?>

		<div id="luxury-carsellers">
		<div class="full-width-line"></div>
		<h1 class="luxury-heading">Latest <strong>Vehicles</strong></h1>

		<?php 
		$no_of_carsellers= $atts[0];

		$args = array( 'post_type' => 'carsellers', 'posts_per_page' => $no_of_carsellers );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$post_id=get_the_ID();

			$car_meta = get_post_meta( get_the_ID() );	
			// echo '<pre>';
			// print_r($car_meta);
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
					// echo '<pre>';
					// print_r($car_meta);
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
						<a href="javascript:void(0);"  class="check_availability" onclick="check_availability(<?php echo $post_id;?>);"> Request  <strong>Information</strong></a>
				</div>

			</div>

			<?php 
			
		endwhile;
		echo '</div>';
	}
	else
	{
		echo 'Please select number of carsellers to show or check are you using right short code.';
	}
    
}
add_shortcode( 'latest_cars', 'latest_cars' );