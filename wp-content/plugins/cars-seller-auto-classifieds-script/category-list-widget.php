<?php

class category_list_widget_carseller extends WP_Widget {

	// constructor
	function category_list_widget_carseller() {
		parent::WP_Widget(false, $name = __('carseller Category list', 'category_list_widget_carseller') );
	}

	// widget form creation
	// widget form creation
function form($instance) {

// Check values
if( $instance) {
     $title = esc_attr($instance['title']);
     
     $selected_categories=$instance['category_list'];
     
} else {
     $title = '';
    
     $selected_categories='';
}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'category_list_widget_carseller'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>


<p>
<label for="<?php echo $this->get_field_id('category_list'); ?>"><?php _e('Select Categories to show on front:', 'category_list_widget_carseller'); ?></label><br>
<span style="font-size: 11px;font-weight: bold;">Please use ctrl button to select multiple categories.</span>

<?php 

	$taxonomy = 'carsellers_category';
$terms = get_terms($taxonomy);
	// $terms = get_object_taxonomies( 'carsellers_category' );
// echo '<pre>';
// 	print_r($terms);
	
        if( $terms )
        {
            printf(
                '<select multiple="multiple" name="%s[]" id="%s" class="widefat" size="15">',
                $this->get_field_name('category_list'),
                $this->get_field_id('category_list')
            );
            foreach ($terms as $post)
            {
                printf(
                    '<option value="%s" class="hot-topic" %s style="margin-bottom:3px;">%s</option>',
                    $post->term_id,
                    in_array( $post->term_id, $selected_categories) ? 'selected="selected"' : '',
                    $post->name
                );
            }
            echo '</select>';
        }
        else
            echo 'No Category found.';
        ?>

</p>
<?php
}

	// widget update
	function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      
      $instance['category_list'] = esc_sql($new_instance['category_list']);
   
     return $instance;
}

	// widget display
	function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $selected_categories=$instance['category_list'];
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text category_list_widget_carseller_box">';

   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }

   // Check if text is set
   if( $text ) {
      echo '<p class="category_list_widget_carseller_text">'.$text.'</p>';
   }
   // Check if textarea is set
   if( $selected_categories ) {
   		// print_r( $selected_categories);
   		echo '<div class="carseller_category_list">
   				<ul>';
   		$taxonomy = 'carsellers_category';
		$terms = get_terms($taxonomy);
		if( $terms )
        {
        	foreach ($terms as $term)
        	{
        		if(in_array( $term->term_id, $selected_categories))
        		{
        		$term = sanitize_term( $term, $taxonomy );

    			$term_link = get_term_link( $term, $taxonomy );
    			if ( is_wp_error( $term_link ) ) {
			        continue;
			    }

			    
			    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
				}
               
               
        	}
        }


   		// foreach ($selected_categories as $value)
     //    {
     //    	echo $value;
     //    	$term = get_terms( $value, 'carsellers_category' );
     //    	echo '<pre>';
     //    	print_r($term);
     //    	die;
     //    	echo  '<a href="">test</a>';
     //    }
        echo '</ul></div>';    
   		$term = get_term( $term_id, $taxonomy );

     // echo '<p class="category_list_widget_carseller_textarea">'.$textarea.'</p>';
   }
   echo '</div>';
   echo $after_widget;
}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("category_list_widget_carseller");'));