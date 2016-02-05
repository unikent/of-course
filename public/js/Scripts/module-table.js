function module_datatable(table, options){
	// Options
	var options = $.extend( {}, {
		api_endpoint: "https://api-test.kent.ac.uk/api/v1/modules/collection/all",
		base_url: "https://kent.ac.uk/courses/modules/module",
		deferLoading: false,
	}, options );

	// configure table
	table.DataTable({
		"sPaginationType": "bootstrap",
	 	"columnDefs": [
	 		{ 
    			"orderable": false, 
    			"searchable": false,
    		 	"targets": 0, 
    		 	"data": "sds_code",
    		 	"type": "html" 
    		},
    		{ 
    			"orderable": false, 
    			"searchable": false,
    		 	"targets": 1, 
    		 	"data": "title",
    		 	"type": "html" 
    		}
    	],
    	//"pageLength": 25,
    	"pageLength": 25,
		"deferLoading": (options.deferLoading) ? table.attr("data-count") : null,
		/// set count
		"serverSide": true,
		"processing": true,
	 	"sDom": "ft<'muted pull-right'i><'clearfix'>p", 
	 	"ajax": {
	 		"cache": true,
	 		"url": options.api_endpoint + "?format=datatables",
	 		"dataSrc": function ( json ) {
	 			// Set name from handbook title
	 			$("#collection_title_"+table.attr("data-collection")).text(json.title);

	 		 	for(var i in json.data){

					if(json.data[i].DT_RowClass !=='inactive') {
						json.data[i].title = '<a href="' + options.base_url + json.data[i].sds_code + '">' + json.data[i].title + '</a>';
						json.data[i].sds_code = '<a href="' + options.base_url + json.data[i].sds_code + '">' + json.data[i].sds_code + '</a>';
					}else{
						json.data[i].title = json.data[i].title +  ' - <em>Module not currently running</em>';
					}
	 		 	}
			    return json.data;
			}
	 	}
 	});

}