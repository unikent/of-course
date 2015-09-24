/*
CourseFilterTable

Helper for creating course search/filter pages

Example:

$(document).ready(function(){

	var programme_list = new CourseFilterTable({
		table: $('#programme-list'),
		globalFilter: $('input.advanced-text-search'),
		columnFilters: {
			"2": $('select.campus-search'),
			"3": $('select.attendance-mode-search'),
			"4" : $('select.subject-categories-search'),
	 		"6": $('select.course-options-search')
		}
	}); 

});
*/
function CourseFilterTable(data){

	var score_result = function(result, search, search_len){
	 		
 		var score = 0, idx;
 		// key value index
		idx = result.indexOf(search);

		// In title at all, boost score by 100
		score += (idx !== -1) ? 100 : 0;

		// If perfect title match so far +250
		if(idx === 0){
			score += 250;
		}else if(result.indexOf(' '+search) !== -1){
			// Boost score by 50 if match is start of any word
			score += 50;
		}
 		
		// Add another 100 if length also matches.
		score += (idx === 0 && result.length === search.length) ? 100 : 0;

		// lower score for difference in length
		score -= Math.abs(search_len-result.length)

		return score;
 	}

	var programme_list_data = {};

	var programme_list = data.table.DataTable({
	 	//"order": [[ 0, "desc" ]],
	 	"sPaginationType": "bootstrap",
	 	"iDisplayLength": 50,
	 	"serverSide": false,
	 	"sDom": "t<'muted pull-right'i><'clearfix'>p", // no need for this since we're implementing our own search
	 	initComplete: function () {
	 		var api = this.api();

	 		programme_list_data.sortCol = api.columns()[0].length-1;
	 		programme_list_data.sortValCol = programme_list_data.sortCol-1;
	 		// hook up global filter
	 		data.globalFilter.on('keyup', function(){
	 		
	 			// Create custom sorter based on search value
	 			var search = data.globalFilter.val();
	 			var search_len = search.length;

	 			// don't sort unless > 2 chars
	 			if(search.length > 2){
		 			$.fn.dataTable.ext.search.push(
				    	function( settings, data, dataIndex, raw, i) {
				    		// get cell, find payload and cal & set scoring
				    		var c = api.cell(dataIndex, programme_list_data.sortCol);
				    		c.data(score_result(data[programme_list_data.sortValCol], search.toLowerCase(), search_len));
				    		
				    		return true;
						}
					);
		 		}

	 			// filter
	 			api.search(search);

	 			// don't sort unless > 2 chars
	 			if(search.length > 2){
		 			api.column(programme_list_data.sortCol).order('desc');
	 			}
	 			// Clear listener
	 			$.fn.dataTable.ext.search = [];

	 			//draw
	 			api.draw();
	 		});

	 		// hook up sub filter
	 		for(var i in data.columnFilters){
	 			// Hook up filter event to col + provide required details
	 			data.columnFilters[i].attr('data-col', i).on('change', function(){
	 				// apply filter
	 				api.column($(this).attr('data-col')).search($(this).val()).draw();
	 			});
	 		}
	 	}
	});
}
