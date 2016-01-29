function module_datatable(table, options){
	// Options
	var options = $.extend( {}, {
		api_endpoint: "https://api-test.kent.ac.uk/api/v1/modules/collection/all",
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
    		 	"data": "code",
    		 	"type": "html" 
    		},
    		{ 
    			"orderable": false, 
    			"searchable": false,
    		 	"targets": 1, 
    		 	"data": "title",
    		 	"type": "html" 
    		},
    		{ 
    			"orderable": false,
    			"searchable": false,
    			"targets": 2,
    			"data": "sds_code",
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
	 		"url": options.api_endpoint + "?format=datatables",
	 		"dataSrc": function ( json ) {

	 		 	for(var i in json.data){
	 		 		json.data[i].title = '<a href="' + json.data[i].code + '">'  + json.data[i].title +'</a>';
	 		 		json.data[i].code = '<a href="' + json.data[i].code + '">'  + json.data[i].code +'</a>';
	 		 	}
			    return json.data;
			}
	 	}
 	});

	//options
}
 	//http://datatables.net/forums/discussion/5714/solved-how-do-i-disable-the-cache-busting-query-parameter-that-datatables-attaches