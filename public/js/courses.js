// scroll menu (a select box) replaces tabs on mobile resolution. This code generates the select based on the tab navigation in use
// CSS is used to hide/show the select itself
$(document).ready(function(){
	// Create select and add each "tab" as an option
	var select_tmp = $(document.createElement("select"));
	$(".daedalus-tabs .nav-tabs li a").each(function(){
		select_tmp.append("<option value='"+$(this).attr("href")+"'>"+$(this).text()+"</option>");
	});
	// Connect to selects change event, to fire off scrollTo
	select_tmp.change(function(){
		$('html, body').stop().animate({
            scrollTop: $($(this).val()).offset().top
        }, 500);
	});
	// Add class & add to page
	select_tmp.addClass("programme-scroll-menu");
	$(".daedalus-tabs .nav-tabs").append(select_tmp);

	/**
	 * Module showhide
	 */
	$('.module-collapse').click(function() {
	  $(this).find('i').toggleClass('icon-plus-sign').toggleClass('icon-minus-sign');
	});
}); 

