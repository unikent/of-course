function module_datatable(table, options){

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

	// Options
	var options = $.extend( {}, {
        id: 'modules',
		api_endpoint: "https://api-test.kent.ac.uk/api/v1/modules/collection/all",
		base_url: "https://kent.ac.uk/courses/modules/module",
		data:false,
        keyword_filter:false,
        subject_filter:false
	}, options );

    module_list_data[options.id] = {};

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
    		},
            {
                "targets": 2,
                "data": function( row, type, set, meta ){
                    return row.title.toLowerCase() + ' ' + row.sds_code.toLowerCase();
                },
                "visible": false
            },
            {
                "targets": 3,
                "render": function(data,type,row){
                    return typeof data !== 'undefined' ? data : '';
                },
                "visible": false
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

    	"pageLength": 25,
        "sDom": "t<'muted pull-right'i><'clearfix'>p",
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
	 	},
        initComplete: function () {
            var api = this.api();

            module_list_data[options.id].sortCol = api.columns()[0].length-1;
            module_list_data[options.id].sortValCol = module_list_data[options.id].sortCol-1;
            // hook up global filter
            options.keyword_filter.on('keyup', function(){

                // Create custom sorter based on search value
                var search = options.keyword_filter.val();
                var search_len = search.length;

                // don't sort unless > 2 chars
                if(search.length > 2){
                    $.fn.dataTable.ext.search.push(
                        function( settings, data, dataIndex, raw, i) {
                            // get cell, find payload and cal & set scoring
                            console.log(score_result(data[module_list_data[options.id].sortValCol], search.toLowerCase(), search_len));

                            var c = api.cell(dataIndex, module_list_data[options.id].sortCol);
                            c.data(score_result(data[module_list_data[options.id].sortValCol], search.toLowerCase(), search_len));

                            return true;
                        }
                    );
                }

                // filter
                api.search(search);

                // don't sort unless > 2 chars
                if(search.length > 2){
                    api.column(module_list_data[options.id].sortCol).order('desc');
                }
                // Clear listener
                $.fn.dataTable.ext.search = [];

                //draw
                api.draw();
            });

           options.subject_filter.on('change', function(){
                    // apply filter
                    api.column(0).search($(this).val()).draw();
            });
            // Trigger any existing filters
            options.subject_filter.change();

        }
 	});

}