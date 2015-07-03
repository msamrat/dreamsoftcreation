<?php
/**
 * The Template for displaying all single posts.
 *
 * @package adamos
 * @since adamos 1.0
 */



wp_enqueue_script('jquery');
wp_enqueue_script( 'jquerymigrate', plugins_url('js/jquery-migrate.min.js', __FILE__) );
wp_enqueue_script( 'modernizr', plugins_url('js/modernizr-2.6.2.min.js', __FILE__) );
wp_enqueue_style( 'pluginstyle', plugins_url('css/style.css', __FILE__) );
wp_enqueue_style( 'check_availability', plugins_url('css/check_availability.css', __FILE__) );


get_header();

wp_enqueue_script( 'jquery-ui-tabs');


/*footer js*/
wp_enqueue_script( 'carsellers', plugins_url('js/carsellers.js', __FILE__) );
wp_enqueue_script( 'blockUI', plugins_url('js/blockUI.js', __FILE__) );
wp_enqueue_script( 'scriptsjqueryui', plugins_url('js/script.js', __FILE__) );
wp_enqueue_script( 'pluginsjs', plugins_url('js/plugins.js', __FILE__) );

/*footer js*/

$post_meta = get_post_meta( get_the_ID() );	

$post_id=get_the_ID();
			// echo '<pre>';
			// print_r($post_meta);
			// die;
 ?>
 



    <script type="text/javascript">


  jQuery(function() {
    jQuery( "#progression-tab-container" ).tabs();
  });


  </script>


 	</div>

 	<div class="slider-other-info" id="middle-content">


   
   <div class="width-container">
      <div id="page-title">
         
         <?php  
          if(get_the_title(get_the_ID()))
          {
            echo '<div class="carseller-title">';
            echo '<h1 id="page-heading">'.get_the_title(get_the_ID()).'</h1>';
            echo '</div>';
          }
          $car_data=get_post_meta(get_the_ID());
         
          ?>
      </div>
      <div id="content-container">
         <article id="post-383" class="post-383 vehicle type-vehicle status-publish has-post-thumbnail hentry">
            <div class="content-container-boxed">
               <div class="vehicle-index-gallery">
                  <div id="vehicle_slider" class="flexslider">
                     <ul class="slides">


                        <?php

                        if(!empty($car_data['car_carsellers_images'][0]))
                        {
                          $car_images=unserialize($car_data['car_carsellers_images'][0]);
                          $count=0;
                          foreach ($car_images as $key => $value) {
                            if($count==0)
                            {
                            echo '<li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">';
                            }
                            else
                            {
                              echo '<li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">';
                            }
                            $count++;

                            echo '<a href="#"><img src="'.$value['car_carsellers_image']['url'].'" alt="shutterstock_171375653" draggable="false"></a>';
                            echo '</li>';


                          }
                        }
                        ?>
                    
                        
                     </ul>
                  </div>
                  <div id="carousel-vehicle" class="flexslider">
                     <div class="flex-viewport" style="overflow: hidden; position: relative;"></div>
                     <ul class="flex-direction-nav">
                        <li><a class="flex-prev flex-disabled" href="http://redline.progressionstudios.com/inventory/2010-audi-a3/#" tabindex="-1">Previous</a></li>
                        <li><a class="flex-next" href="http://redline.progressionstudios.com/inventory/2010-audi-a3/#" tabindex="-1">Next</a></li>
                     </ul>
                     <div class="flex-viewport" style="overflow: hidden; position: relative;">
                        <ul class="slides" style="width: 1600%; transition: 0s; -webkit-transition: 0s; -webkit-transform: translate3d(0px, 0px, 0px); transform: translate3d(0px, 0px, 0px);">
                      


                           <?php

                        if(!empty($car_data['car_carsellers_images'][0]))
                        {
                          $car_images=unserialize($car_data['car_carsellers_images'][0]);
                          $count=0;
                          foreach ($car_images as $key => $value) {
                            if($count==0)
                            {
                            echo '<li class="flex-active-slide" style="width: 100px; float: left; display: block;">';
                            }
                            else
                            {
                              echo '<li   style="width: 100px; float: left; display: block;">';
                            }
                            $count++;

                            echo '

                            <img src="'.$value['car_carsellers_image']['url'].'" alt="shutterstock_171375653" style="width:84px;" draggable="false">

                            ';
                            echo '</li>';


                          }
                        }
                        ?>



                        </ul>
                     </div>
                     <ul class="flex-direction-nav">
                        <li><a class="flex-prev flex-disabled" href="#" tabindex="-1">Previous</a></li>
                        <li><a class="flex-next" href="#" tabindex="-1">Next</a></li>
                     </ul>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="clearfix"></div>
               <div id="progression-tab-container" class="progression-tab-container" data-easytabs="true">
                  <ul class="progression-etabs">
                     <li class="progression-tab "><a href="#progression-description"  class="">Description</a></li>
                     <li class="progression-tab"><a href="#progression-specs" class="">Specifications</a></li>
                     <li class="progression-tab chk-availability"><a href="javascript:void(0);" onclick="check_availability(<?php echo $post_id;?>);" class="check_availability ">Request Information</a></li>
                  </ul>
                  <div class="progression-panel-container" style="">
                     <div id="progression-description"  class="active" style="display: block; position: static; visibility: visible;">
                        <h3>Vehicle Description</h3>
                        <p><?php echo $car_data['car_Vehicle_Description'][0]?></p>
                     </div>
                     <div id="progression-specs"  class="" style="display: none;">
                        <h3>Vehicle Specifications</h3>
                        <ul id="pro-vehicle-specifications">

                        <?php


                        if(!empty($car_data['car_model'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Model:</span> <span class="spec-value">'.$car_data['car_model'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_registration_date'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Registration Date:</span> <span class="spec-value">'.$car_data['car_registration_date'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_running_status'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Running Status:</span> <span class="spec-value">'.$car_data['car_running_status'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_ownership'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Ownership:</span> <span class="spec-value">'.$car_data['car_ownership'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_insurance_status'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Insurance Status:</span> <span class="spec-value">'.$car_data['car_insurance_status'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_fuel_type'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Fuel Type:</span> <span class="spec-value">'.$car_data['car_fuel_type'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_mileage'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Mileage:</span> <span class="spec-value">'.$car_data['car_mileage'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_condition'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Condition:</span> <span class="spec-value">'.$car_data['car_condition'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_exterior_color'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Exterior Color:</span> <span class="spec-value">'.$car_data['car_exterior_color'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_interior_color'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Interior Color:</span> <span class="spec-value">'.$car_data['car_interior_color'][0].'</span>
                            </li>';
                        }
                        if(!empty($car_data['car_transmission'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Transmission:</span> <span class="spec-value">'.$car_data['car_transmission'][0].'</span>
                            </li>';
                        }

                        if(!empty($car_data['car_engine'][0]))
                        {
                          echo '<li> 
                              <span class="spec-label">Engine:</span> <span class="spec-value">'.$car_data['car_engine'][0].'</span>
                            </li>';
                        }



                        ?>

                        </ul>
                     </div>
                     
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
         </article>
      </div>
      <div id="car-sidebar">
         <div id="price-sidebar" class="sidebar-item widget widget_text">
            <h5 class="widget-title">Vehicle Price</h5>
            <div id="sidebar-price">
               <p class="pcd-pricing">
               <span class="pcd-price"><b>Price:</b> <?php 
               $currency_symbol=get_currency_symbol();
               echo $currency_symbol['symbol'].'&nbsp;'.number_format($post_meta['car_our_price'][0],0)?> </span><br></p>
            </div>
            

            <div class="chk-availability sidebar-button-price">
        <a href="javascript:void(0);"  class="check_availability progression-button" id="button-select-progression" onclick="check_availability(<?php echo $post_id;?>);"> Request <strong>Information</strong></a>
      </div>
         </div>
         <div class="sidebar-divider"></div>
      </div>
   </div>
   <div class="clearfix"></div>





 </div>















<?php //get_sidebar(); ?>
<?php get_footer(); ?>


  


