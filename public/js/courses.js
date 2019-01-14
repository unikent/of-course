// scroll menu (a select box) replaces tabs on mobile resolution. This code generates the select based on the tab navigation in use
// CSS is used to hide/show the select itself
$(document).ready(function(){
    $('#applyButton').click(function(){
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
            console.log('click');
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

	$(window).on('viewport:resize', function(){
		KIS_Widget_React()
	});

	KIS_Widget_React();
});

function KIS_Widget_React(){
	$fulltime = $('#unistats-widget-frame-ft');
	$parttime = $('#unistats-widget-frame-pt');

	if(ResponsiveBootstrapToolkit.is('<lg')){

		if($fulltime.length > 0 && $fulltime.prop('src').includes('horizontal')){
			$fulltime.prop('src', $fulltime.prop('src').replace('horizontal', 'vertical')).css('height', '500px').css('width', '190px');
		}
		if($parttime.length > 0 && $parttime.prop('src').includes('horizontal')) {
			$parttime.prop('src', $parttime.prop('src').replace('horizontal', 'vertical')).css('height', '500px').css('width', '190px');
		}

	}else{

		if($fulltime.length > 0 && $fulltime.prop('src').includes('vertical')) {
			$fulltime.prop('src', $fulltime.prop('src').replace('vertical', 'horizontal')).css('width', '615px').css('height', '150px');
		}
		if($parttime.length > 0 && $parttime.prop('src').includes('vertical')) {
			$parttime.prop('src', $parttime.prop('src').replace('vertical', 'horizontal')).css('width', '615px').css('height', '150px');
		}
	}
}