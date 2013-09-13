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
	$('.courses-sits-apply > .fulltime-link' + applyawardlink).show();

	// when things change...
	$('#apply-study-type,#apply-study-award').change(function () {

		// hide everything
		$('.courses-sits-apply > .apply-link').hide();

		// award-link changes depending on the value of the award currently chosen
		var applyawardlink = '';
		if ($('#apply-study-award').val() != undefined) {
			applyawardlink = ".award-link-" + $('#apply-study-award').val();
		}
		
		//to show the 'there are no matching items' box
		var counter = 0;

		// now show relevant links
		if ($('#apply-study-type').val() == 'ft') {
			$('.courses-sits-apply > .fulltime-link' + applyawardlink).show();
			if(!$('.fulltime-link' + applyawardlink).length){
				counter++;
			}
		}
		if ($('#apply-study-type').val() == 'pt') {
			$('.courses-sits-apply > .parttime-link' + applyawardlink).show();
			if(!$('.parttime-link' + applyawardlink).length){
				counter++;
			}
			
		}
		
		alert(counter);
		
		if(counter == 0){
			//show the 'no matching items' box
			$('.courses-sits-apply-hidden').show();
		}

	});

	/**
	* Enquire tab
	*/
	// set up defaults for the first hit on the page
	var awardlink = '';
	if ($('#apply-study-award option').first().val() != undefined) {
		awardlink = ".award-link-" + $('#enquire-study-award option').first().val();
	}
	$('.courses-sits-enquire > .apply-link').hide();
	$('.courses-sits-enquire > .fulltime-link.enquire-link' + awardlink).show();

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
		pantheon.show_tab('apply', '#ug_apply_form');
	});

	$('.enquire-adm-link').click(function () {
		pantheon.show_tab('enquiries', '#ug_enquiries_form');
		$('#prospectus').prop('checked', false);
		$('#enquire').prop('checked', true);
		enquiries_status_check();
	});

	$('.pros-adm-link').click(function () {
		pantheon.show_tab('enquiries', '#ug_enquiries_form');
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
		}
		if (prospectus && parttime) {
			$('.courses-sits-enquire > .parttime-link.prospectus-link' + awardlink).show();
		}

		if (enquire && fulltime) {
			$('.courses-sits-enquire > .fulltime-link.enquire-link' + awardlink).show();
		}
		if (enquire && parttime) {
			$('.courses-sits-enquire > .parttime-link.enquire-link' + awardlink).show();
		}
		return true;

	}
	

}); 

