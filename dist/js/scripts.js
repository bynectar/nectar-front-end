// Main Javascript File

// Vertical Centering
function verticalCenter(){
	$('.vertical-center-wrap').each(function(){
		// Get wrapper height and element height and calculate offset for centering
		var wrapHeight = $(this).height();
		var itemHeight = $('.vertical-center',this).height();
		var offset = ( ( wrapHeight - itemHeight ) / 2 ) + 'px';
		$('.vertical-center',this).css('margin-top',offset);
	});
}

// Before .ready()
verticalCenter();

$(document).ready(function(){
	
	// Init Functions
	verticalCenter(); // Vertical Centering
	
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();
		if ( scroll > 0 ){
			$('html').addClass('scroll');
		} else {
			$('html').removeClass('scroll');
		}
	});
	
	$(window).resize(function(){
		verticalCenter();
	});
	
});