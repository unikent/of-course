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

	$('.fees-tables').hide();
	$('.fees-toggle').click(function() {
		$('.fees-tables').slideToggle();
	});

	/**
	 * Module showhide
	 */
	$('.module-collapse').click(function() {
	  $(this).find('i').toggleClass('icon-plus').toggleClass('icon-minus');
	});

	$('.form-row-study-type').hide();
	$('.courses-sits-enquire-parttime').hide();
	$('.courses-sits-apply-parttime').hide();

	$('#enquire-study-type').change(function () {
		$('.courses-sits-enquire-fulltime').toggle();
		$('.courses-sits-enquire-parttime').toggle();
	});
	$('#apply-study-type').change(function () {
		$('.courses-sits-apply-fulltime').toggle();
		$('.courses-sits-apply-parttime').toggle();
	});

	/**
	* Apply tab
	*/
	// set up defaults for the first hit on the page
	var applyawardlink = '';
	if ($('#apply-study-award option').first().val() != undefined) {
		applyawardlink = ".award-link-" + $('#apply-study-award option').first().val();
	}
	$('.courses-sits-apply > .apply-link').hide();

	if ($('#apply-study-type').val() == 'ft') {
		$('.courses-sits-apply > .fulltime-link' + applyawardlink).show();
	}
	if ($('#apply-study-type').val() == 'pt') {
		$('.courses-sits-apply > .parttime-link' + applyawardlink).show();
	}

	var feeslink = $('.fees-link');
	feeslink.click(function(){
		toggleFees();
	});

	function toggleFees (show){

		show = typeof show !== 'undefined' ? show : !$('.fees-tables').is(":visible");

		if (show) {
			$('.fees-tables').attr("aria-expanded","true").slideDown(400);
			$(".fees-link i.toggler").removeClass('icon-chevron-down');
			$(".fees-link i.toggler").addClass('icon-chevron-up');
		}
		else{
			$('.fees-tables').attr("aria-expanded","false").slideUp(400);
			$(".fees-link i.toggler").removeClass('icon-chevron-up');
			$(".fees-link i.toggler").addClass('icon-chevron-down');
		}
	}

	// when things change...
	$('#apply-study-type,#apply-study-award').change(function () {

		// hide everything
		$('.courses-sits-apply > .apply-link').hide();
		
		// now show relevant links
		if ($('#apply-study-type').val() == 'ft') {
			$('.courses-sits-apply > .fulltime-link').show();
			 if(!$('.fulltime-link').length){
			 	$('.courses-sits-apply-hidden-ft').show();
			 }
			 else{
			 	$('.courses-sits-apply-hidden-ft').hide();
			 	$('.courses-sits-apply-hidden-pt').hide();
			 }
		}
		if ($('#apply-study-type').val() == 'pt') {
			$('.courses-sits-apply > .parttime-link').show();
			 if(!$('.parttime-link').length){
			 	$('.courses-sits-apply-hidden-pt').show();
			 }
			 else{
			 	$('.courses-sits-apply-hidden-pt').hide();
			 	$('.courses-sits-apply-hidden-ft').hide();
			 }
		}

	});

	/**
	* Enquire tab
	*/
	
	$('.courses-sits-enquire > .apply-link').hide();

	if ($('#enquire-study-type').val() == 'ft') {
		$('.courses-sits-enquire > .fulltime-link.enquire-link').show();
	}
	if ($('#enquire-study-type').val() == 'pt') {
		$('.courses-sits-enquire > .parttime-link.enquire-link').show();
	}


	// set up some vars
	var prospectus = false;
	var enquire = false;
	var fulltime = false;
	var parttime = false;

	// when things change for the award, type, and enquire/prospectus changers
	$('#enquire,#prospectus,#enquire-study-type,#enquire-study-award').change(enquiries_status_check);

	// when people click on the apply, enquire, or prospectus links
	// we show the appropriate tab, and for enquire and prospectus we show the appropriate radio button clicked
	$('.apply-adm-link').click(function () {
		pantheon.show_tab('apply');
	});

	$('.enquire-adm-link').click(function () {
		pantheon.show_tab('enquiries');
		$('#prospectus').prop('checked', false);
		$('#enquire').prop('checked', true);
		enquiries_status_check();
	});

	$('.pros-adm-link').click(function () {
		pantheon.show_tab('enquiries');
		$('#enquire').prop('checked', false);
		$('#prospectus').prop('checked', true);
		enquiries_status_check();
	});

	/**
	* checks the currently selected enquiries/prospectus, award, and ft/pt options and shows the appropriate classes
	*/
	function enquiries_status_check() {

		if ($('#enquire').is(':checked'))
		{
			enquire = true;
			prospectus = false;
		}
		else if ($('#prospectus').is(':checked'))
		{
			prospectus = true;
			enquire = false;
		}
		if ($('#enquire-study-type').val() == 'ft')
		{
			// in fulltime mode
			fulltime = true;
		}
		if ($('#enquire-study-type').val() == 'pt')
		{
			// in parttime mode
			parttime = true;
		}

		// hide everything
		$('.courses-sits-enquire > .apply-link').hide();

		// award-link changes depending on the value of the award currently chosen
		var awardlink = '';
		if ($('#enquire-study-award').val() != undefined) {
			awardlink = ".award-link-" + $('#enquire-study-award').val();
		}

		// now show relevant links
		if (prospectus && fulltime) {
			$('.courses-sits-enquire > .fulltime-link.prospectus-link' + awardlink).show();
			if(!$('.fulltime-link' + awardlink).length){
			 	$('.courses-sits-enquire-hidden-ft').show();
			 	$('.courses-sits-enquire-hidden-pt').hide();
			 }
			 else{
			 	$('.courses-sits-enquire-hidden-ft').hide();
			 	$('.courses-sits-enquire-hidden-pt').hide();
			 }
		}
		if (prospectus && parttime) {
			$('.courses-sits-enquire > .parttime-link.prospectus-link' + awardlink).show();
			if(!$('.parttime-link' + awardlink).length){
			 	$('.courses-sits-enquire-hidden-pt').show();
			 	$('.courses-sits-enquire-hidden-ft').hide();
			 }
			 else{
			 	$('.courses-sits-enquire-hidden-ft').hide();
			 	$('.courses-sits-enquire-hidden-pt').hide();
			 }
		}

		if (enquire && fulltime) {
			$('.courses-sits-enquire > .fulltime-link.enquire-link' + awardlink).show();
			if(!$('.fulltime-link' + awardlink).length){
			 	$('.courses-sits-enquire-hidden-ft').show();
			 	$('.courses-sits-enquire-hidden-pt').hide();
			 }
			 else{
			 	$('.courses-sits-enquire-hidden-ft').hide();
			 	$('.courses-sits-enquire-hidden-pt').hide();
			 }
		}
		if (enquire && parttime) {
			$('.courses-sits-enquire > .parttime-link.enquire-link' + awardlink).show();
			if(!$('.parttime-link' + awardlink).length){
			 	$('.courses-sits-enquire-hidden-pt').show();
			 	$('.courses-sits-enquire-hidden-ft').hide();
			 }
			 else{
			 	$('.courses-sits-enquire-hidden-ft').hide();
			 	$('.courses-sits-enquire-hidden-pt').hide();
			 }
		}
		return true;

	}

	// new apply links
	$(".apply-form").css('visibility', 'visible');
	$(".apply-form").css('display', 'block');
	$(".apply-link").hide();
	$("#apply-link-dummy").show();
	var award = $("#award").val();
	var type = $("#type").val();
	var year = $("#year").val();
	var linkid = 'apply-link-' + award + '-' + type + '-' + year;
	if ($("#" + linkid).length > 0) {
		$("#apply-link-dummy").hide();
		$("#" + linkid).show();
	}
	$("#award").change(function(){
		award = $(this).val();
		linkid = 'apply-link-' + award + '-' + type + '-' + year;
		$(".apply-link").hide();
		if ($("#" + linkid).length > 0) {
			$("#apply-link-dummy").hide();
			$("#" + linkid).show();
		}
		else {
			$("#apply-link-dummy").show();
		}
	});
	$("#type").change(function(){
		type = $(this).val();
		linkid = 'apply-link-' + award + '-' + type + '-' + year;
		$(".apply-link").hide();
		if ($("#" + linkid).length > 0) {
			$("#apply-link-dummy").hide();
			$("#" + linkid).show();
		}
		else {
			$("#apply-link-dummy").show();
		}
	});
	$("#year").change(function(){
		year = $(this).val();
		linkid = 'apply-link-' + award + '-' + type + '-' + year;
		$(".apply-link").hide();
		if ($("#" + linkid).length > 0) {
			$("#apply-link-dummy").hide();
			$("#" + linkid).show();
		}
		else {
			$("#apply-link-dummy").show();
		}
	});
	//if ( $("#type").val() == 'pleaseselect' ) $("#type").css('border-color', 'red');

}); 

