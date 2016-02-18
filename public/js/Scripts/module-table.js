function module_datatable(table, options){
	// Options
	var options = $.extend( {}, {
		api_endpoint: "https://api-test.kent.ac.uk/api/v1/modules/collection/all",
		base_url: "https://kent.ac.uk/courses/modules/module",
		data:false
	}, options );

	var oldStart=0;
	// configure table
	table.DataTable({
		data: options.data,
		order:[[0, 'asc']],
		"sPaginationType": "bootstrap",
	 	"columnDefs": [
	 		{
    		 	"targets": 0, 
    		 	"render": function(data,type,row){
					return (row.running?'<a href="' + options.base_url + row.sds_code + '">':'') + row.sds_code + (row.running?'</a>':'');
				}
    		},
    		{
    		 	"targets": 1, 
    		 	"render": function(data,type,row){
					return (row.running?'<a href="' + options.base_url + row.sds_code + '">':'') + row.title + (row.running?'</a>':' - <em>this module is not currently running</em>');
				}
    		}
    	],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$(nRow).addClass( aData.running?'running':'inactive');
			return nRow;
		},
		"fnDrawCallback": function (o) {
			if ( o._iDisplayStart != oldStart ) {
				var targetOffset = $(".daedalus-tabs").first().offset().top;
				$('html,body').animate({scrollTop: targetOffset}, 600);
				oldStart = o._iDisplayStart;
			}
		},
    	//"pageLength": 25,
    	"pageLength": 25,
		/// set count
	 	"sDom": "ft<'muted pull-right'i><'clearfix'>p", 
	 	"ajax": options.data?false:{
	 		"cache": true,
	 		"url": options.api_endpoint,
	 		"dataSrc": function ( json ) {
	 			// Set name from handbook title
	 			$("#collection_title_"+table.attr("data-collection")).text(json.title);
				var m = [];
	 		 	for(var i in json.modules){
					m.push(json.modules[i]);
	 		 	}
			    return m;
			}
	 	}
 	});

}