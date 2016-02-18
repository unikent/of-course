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
		//if($(this).val()==='#fees-tables-link'){
		//	$('.fees-tables').slideDown();
		//}
	});
	// Add class & add to page
	select_tmp.addClass("programme-scroll-menu");
	$(".daedalus-tabs .nav-tabs").append(select_tmp);

	//$('.fees-tables').hide();
	$('.fees-toggle').click(function() {
		$('.fees-tables').slideToggle();
	});


	/**
	 * Module showhide
	 */
	$('.module-collapse').click(function() {
	  $(this).find('i').toggleClass('icon-plus').toggleClass('icon-minus');
	});


	$('#showMore').click(function(e){
		e.preventDefault();
		$('#more').slideToggle();
	});
	/**
	 * Apply page
	 */

	var $apply_form = $(".apply-form");
	var $apply_link_ucas = $("#apply-link-ucas");
	var $apply_link_courses = $(".apply-link-courses");
	var $apply_link_dummy = $("#apply-link-dummy");
	var $full_time_text = $(".full-time-text");
	var $part_time_text =$(".part-time-text");


	$apply_form.css('visibility', 'visible');
	$apply_form.css('display', 'block');

	$apply_link_courses.hide();
	$apply_link_dummy.show();
	$apply_link_ucas.hide();
	$full_time_text.hide();
	$part_time_text.hide();

	$apply_link_dummy.tooltip();

	// the radio button list for the same-award-multiple-delivery edge case
	$('input[type=radio][name=delivery]').change(function(){
		$apply_link_courses.hide();
		var id = 'apply-link-' + $(this).val();
		$apply_link_dummy.hide();
		$("#" + id).show();
	});

	var $award = $("#award");
	var $type = $("#type");
	var $year = $("#year");

	var award = $award.val();
	var type = $type.val();
	var year = $year.val();

	updateApplyLinks();
	changeType();

	$award.change(function(){
		award = $(this).val();
		updateApplyLinks();
	});
	$type.change(function(){
		type = $(this).val();
		changeType();
	});

	function changeType() {

		switch(type){
			case 'full-time-ug-ucas':
				$apply_link_ucas.show();
				$apply_link_courses.hide();
				$apply_link_dummy.hide();
				$full_time_text.show();
				$part_time_text.hide();
				break;
			case 'full-time-ug-direct':
				$apply_link_ucas.hide();
				type = 'full-time';
				updateApplyLinks();
				$apply_link_dummy.hide();
				$full_time_text.show();
				$part_time_text.hide();
				break;
			case 'full-time':
				updateApplyLinks();
				$full_time_text.show();
				$part_time_text.hide();
				break;
			case 'part-time':
				updateApplyLinks();
				$apply_link_ucas.hide();
				$full_time_text.hide();
				$part_time_text.show();
				break;
			default :
				// `pleaseselect` option
				$apply_link_courses.hide();
				$apply_link_ucas.hide();
				$full_time_text.hide();
				$part_time_text.hide();
				$apply_link_dummy.show();
				break;
		}

	}

	function updateApplyLinks() {
		linkid = 'apply-link-' + award + '-' + type + '-' + year;
		$apply_link_courses.hide();
		if ($("#" + linkid).length > 0) {
			$apply_link_dummy.hide();
			$("#" + linkid).show();
		}
		else {
			$apply_link_dummy.show();
		}
	}

});
