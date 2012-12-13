$().ready(function() {
	//Store data ref
	var searchBox = $('input[name="search"]');
	var dataStore = [];
	var dom;

	var selectedIDX = 0;

	//private 
	// Find Matches (where search item is part of s_str)
	var findMatches = function(str){
		var matches = [];
		var itm;
		//s_str is lowercased so match using a lowercased value
		str = str.toLowerCase();
		
		//Find matching elemements
		for(var c=0; c<dataStore.length; c++){
			itm = dataStore[c];
			if(itm.s_str.indexOf(str) !== -1){
				matches.push(itm);
			}
		}
		//return matching items
		return matches;
	}
	//generate results & append to dom
	var showResults = function(found){

		selectedIDX = 0;
		//hide/show box
		if(found.length===0){ 
			dom.parent().css('left','-999px'); 
		}else{ 
			dom.parent().css('left', searchBox.position().left+'px'); 
		}
		//clear
		dom.html("");
		//add results
		for(var c=0; c<found.length; c++){
			var itm = $("<li data-idx='"+c+"'><a href='" + found[c].url + "'>"+ found[c].title +"</a></li>");
			if(selectedIDX === c) itm.addClass("selected");
			dom.append(itm);
		}	
		//select item by hover
		$("#jquery-live-search li").hover(function(e){
			selectItem($(this).attr('data-idx'));
		});
	}
	//Select an item from the results
	var selectItem = function(idx){
		//Ensure is int, str type numbers may be returned here.
		selectedIDX = parseInt(idx);
		$("#jquery-live-search li").each(function(){$(this).removeClass("selected")});
		$("#jquery-live-search li[data-idx="+idx+"]").addClass("selected");
	}

	//Load datastore when searchBox is first clicked
	searchBox.focus(function(e){
		if(dataStore.length == 0){
			//build searchbox results dom
			dom = $("<ul></ul>");
			$("body").append(dom);
			dom.wrap("<div id='jquery-live-search' tabindex='100' style='left:-999px'></div>");

			var p = dom.parent();
			p.css('top', searchBox.position().top+searchBox.height()+'px');
			//Load data
			$.get(base_path+'api/searchlist',function(data){
				//Ask nicely if jQuery will parse are data for us, since IE7 has no native support
				dataStore = $.parseJSON(data);
				if(searchBox.val() != '') {
					$('input[name="search"]').trigger('keyup');
				}
			});
			//Hook up focus listeners
			dom.parent().blur(function(){ focusCheck() });
			searchBox.blur(function(){ focusCheck() });
		}else{
			//activate if reslected
			if(searchBox.val()!='')$('input[name="search"]').trigger('keyup');
		}	
	});

	//hide on search/results unselected
	var focusCheck = function(){
		setTimeout(function(){
			if(!dom.parent().is(":focus") && !searchBox.is(":focus")){
				dom.parent().css('left','-999px');	
			}
		},150);
	}
	//key down needs to be used to catch people hitting enter in IE
	searchBox.keydown(function(e){
		//get value
		var val = $(this).val();
		//On enter, if we have a result, go to it!
		if(e.which===13 && val != ''){
			found = findMatches(val);
		 	if(found.length !=0)window.location = found[selectedIDX].url;
		}
		
	});
	//On keyup trigger search
	searchBox.keyup(function(e){

		var k = e.which;
		var val = $(this).val();

		var found = [];

		if(val != '') found = findMatches(val);

		//Special actions
		if(k == 38 || k == 40 || k== 13){
			//on up/down
			if(k == 38 && selectedIDX != 0) selectItem(selectedIDX-1);
			if(k == 40 && selectedIDX != found.length-1) selectItem(selectedIDX+1);

			//dont update results
			e.preventDefault;
			return false;
		}
		//Display results
		showResults(found);
	});

});