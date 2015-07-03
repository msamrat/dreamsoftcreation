<?php
// Create Slider
    function banner_slider_template() {
		global $prefix;
        // Query Arguments
        $args = array(
            'post_type' => 'slides',
			'cat' => $id
        );  
		
        // The Query
        $the_query = new WP_Query( $args );
 
        // Check if the Query returns any posts
        if ( $the_query->have_posts() ) {
 
            // Start the Slider ?>
            <div class="flexslider">
				<div class="container">
			      <div class="row">            
	                <ul class="slides">
						<?php
                        // The Loop
                        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <li>
                            <?php // Check if there's a Slide URL given and if so let's a link to it
                            if ( get_post_meta( get_the_id(), $prefix . 'url', true) != '' ) { ?>
                                <a href="<?php echo esc_url( get_post_meta( get_the_id(), $prefix . 'url', true) ); ?>">
                            <?php }
                            // The Slide's Image
//                            echo ('<img src="' . wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) . '" />');
                            the_post_thumbnail();
                            // Close off the Slide's Link if there is one
                            if ( get_post_meta( get_the_id(), $prefix . 'url', true) != '' ) { ?>
                                </a>
                            <?php } ?>
                            </li>
                        <?php endwhile; ?>
		              </ul><!-- .slides -->
	                </div>
                </div>
            </div><!-- .flexslider -->
        <?php }
 
        // Reset Post Data
        wp_reset_postdata();
    }
?>