/*
menu.js

Required for the megamenu.
*/
jQuery(document).ready(function($){
	
	// show/hide the maps megamenu
	$(".search_links li.toplink").hover(
		function() {
			var mnu = $(this).children(".megamenu");
			mnu.css('display','none');
			mnu.fadeIn(350);
		},
		function(){
			$(this).children(".megamenu").stop().css('opacity',1);
			
			// Close all megamenus when hover is left
			$(this).parent().find(".megamenu").css('display','none');
		}
	);
	
});