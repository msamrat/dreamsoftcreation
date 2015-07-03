
function check_availability(id)
{

	jQuery.ajax({
		url:ajaxurl,
		type:'POST',
		data:{
			action: 'check_availability_carseller',
		post_id: id
		},
		beforeSend:function(){
					 jQuery.blockUI({message: '<img src="'+pluginurl+'/images/ajax-loader.gif">', css: {border: 'none', backgroundColor: 'transparent', }});



                },
		success:function(result){
    	// console.log(result);
    	
    
    	
    	if (jQuery('#check_availabitlity_form').length ==0 ) {
    		jQuery('body').append(result);
    		
    	}
    	else
    	{
    		
    		jQuery('#check_availabitlity_form').remove();
    		jQuery('body').append(result);
    	}
    	

    		jQuery.blockUI({ 
    			 
    			css:{
	    			cursor:'default',
	    			width:'600px', 
	        		top:'20%',
	        		left:'29%',
	        		border:'0px',
	        		'border-radius':'8px',
    			},
	    		overlayCSS:  {
	    			cursor:'default'
	    		}, message: jQuery('#check_availabitlity_form') 
    		}); 
    		
  		}
  	});



	
}

function hideform()
{
	jQuery('body').unblock();
}
jQuery('#lead-form').live('submit',function(){
	
	jQuery.ajax({
		url:ajaxurl,
		type:'POST',
		data:{
			action: 'send_avaibility_request_carseller',
		formdata: jQuery( this ).serialize()
		},
		beforeSend:function(){
				jQuery('#lead-form').block({message: '<b>Please wait we are sending your request...</b>', css: {border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff',left:'155px', width:'45%' },
    	 overlayCSS: {width:'113.5%',height:'114%', left:'-6.8%',top:'-6.8%'},});

                },
		success:function(result){
    		
			

    	 
    		
    			jQuery('#lead-form').html(result)
    		
    		// console.log(result);
  		}
  	});

	return false;
});

function showfloorplan()
{
    if(jQuery('#modal-properties').length || jQuery('#modal-floorplans').length)
    {
    jQuery('body').block({message: jQuery('#dlp-modal'), css: {
            padding: '15px', 
            backgroundColor: 'transparent', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            top: '1px', 
                left: '', 
                right: '100px', 
                border: 'none',
                  position: 'absolute', 
            color: '#fff',left:'155px', width:'45%', cursor:'default' },
         overlayCSS: {cursor:'default', top: '1px',},});

        jQuery('#dlp-modal').parent().css('top','5%');
    }
    if(jQuery('#modal-properties').length)
    {
        jQuery('#modal-floorplans').hide();
        jQuery('#modal-properties').show();
    }
    else if(jQuery('#modal-floorplans').length)
    {
       jQuery('#modal-floorplans').show(); 
    }
    
}
function showfloorplan_button(planname)
{
    jQuery('#modal-properties').hide();

    jQuery('#modal-floorplans').hide();
    jQuery('#dlp-modal .lightbox .modal-tabs li').removeClass('active');
    jQuery('#dlp-modal .lightbox .modal-tabs li.'+planname).addClass('active');
    jQuery('#'+planname).show();
    
}








jQuery(function($) {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});











jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
    var slideCount = $('#dlp-modal #floorplan-carousel ul li').length;
    var slideWidth = $('#dlp-modal #floorplan-carousel ul li').width();
    var slideHeight = $('#dlp-modal #floorplan-carousel ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    
    $('#dlp-modal #floorplan-carousel').css({ width: slideWidth, height: slideHeight });
    
    $('#dlp-modal #floorplan-carousel ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
    
    $('#dlp-modal #floorplan-carousel ul li:last-child').prependTo('#dlp-modal #floorplan-carousel ul');

    function moveLeft() {
        $('#dlp-modal #floorplan-carousel ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#dlp-modal #floorplan-carousel ul li:last-child').prependTo('#dlp-modal #floorplan-carousel ul');
            $('#dlp-modal #floorplan-carousel ul').css('left', '');
        });
    };

    function moveRight() {
        $('#dlp-modal #floorplan-carousel ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#dlp-modal #floorplan-carousel ul li:first-child').appendTo('#dlp-modal #floorplan-carousel ul');
            $('#dlp-modal #floorplan-carousel ul').css('left', '');
        });
    };

    $('a.arrow-holder.left').click(function () {
        moveLeft();
    });

    $('a.arrow-holder.right').click(function () {
        moveRight();
    });

}); 




jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
    var slideCount = $('#dlp-modal #modal-properties ul li').length;
    var slideWidth = $('#dlp-modal #modal-properties ul li').width();
    var slideHeight = $('#dlp-modal #modal-properties ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    
    $('#dlp-modal #modal-properties').css({ width: slideWidth, height: slideHeight });
    
    $('#dlp-modal #modal-properties ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
    
    $('#dlp-modal #modal-properties ul li:last-child').prependTo('#dlp-modal #modal-properties ul');

    function moveLeft() {
        $('#dlp-modal #modal-properties ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#dlp-modal #modal-properties ul li:last-child').prependTo('#dlp-modal #modal-properties ul');
            $('#dlp-modal #modal-properties ul').css('left', '');
        });
    };

    function moveRight() {
        $('#dlp-modal #modal-properties ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#dlp-modal #modal-properties ul li:first-child').appendTo('#dlp-modal #modal-properties ul');
            $('#dlp-modal #modal-properties ul').css('left', '');
        });
    };

    $('a.arrow-holder.left').click(function () {
        moveLeft();
    });

    $('a.arrow-holder.right').click(function () {
        moveRight();
    });

}); 