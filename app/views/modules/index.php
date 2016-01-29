<h1>Module Catalogue</h1>

<p>The Module catalog contains information about academic modules taught at the university. <a href="#">Disclaimer</a>.</p>

<div class="daedalus-tabs">
	<ul class="nav nav-tabs">
		<li><a href="#all">All collections</a></li>
		<li><a href="#humanities">Humanities (UG)</a></li>
		<li><a href="#sciences">Sciences (UG)</a></li>
		<li><a href="#social">Social Sciences (UG)</a></li>
		<li><a href="#postgraduate">Postgraduate</a></li>
		<li><a href="#brussels">Brussels</a></li>
		<li><a href="#paris">Paris</a></li>
		<li><a href="#wild">Wild Modules</a></li>
	</ul>
	<div class="tab-content">
		<section id="all">
			<h2>Overview</h2>
			
			<table class="dataTable table table-striped">
				<thead>
					<tr>
						<th>Module Code</th>
						<th>Module title</th>
						<th>Alternate module code</th>
					</tr>
				</thead>

				<?php foreach($modules->modules as $module){ ?>
					<tr>
						<td><a href="modules/<?php echo $module->code ?>"><?php echo $module->code ?></a></td>
						<td><a href="modules/<?php echo $module->code ?>"><?php echo $module->title ?></a></td>
						<td><?php echo $module->sds_code ?></td>
					</tr>
				<?php } ?>
				
			</table>


		</section>
		<section id="humanities">
			<h2>Humanities</h2>
		</section>
		<section id="sciences">
			<h2>Sciences (UG)</h2>
		</section>
		<section id="social">
			<h2>Social Sciences (UG)</h2>
		</section>
		<section id="postgraduate">
			<h2>Postgraduate</h2>
		</section>
		<section id="brussels">
			<h2>Brussels</h2>
		</section>
		<section id="paris">
			<h2>Paris</h2>
		</section>
		<section id="wild">
			<h2>Wild Modules</h2>
		</section>
	</div>
</div>


<div class="row-fluid" style="clear:both;">
	<div class="span4">
		<h3>Why study at kent</h3>
		<a href="http://www.kent.ac.uk/courses/undergraduate/why/index.html"><img style="width:100%" src="http://www.kent.ac.uk/courses/menu/top/images/220x110-ug-why-2015.jpg" alt="student"></a>
		<p> Attend an Open Day of visit us when it suites you.</p>
	</div>
	<div class="span4">
		<h3>Quality Accommodation</h3>
		<a href="http://www.kent.ac.uk/courses/funding/undergraduate/index.html"><img  style="width:100%" src="http://www.kent.ac.uk/courses/menu/top/images/220x110-ug-feesfunding-2015.png" alt="students eating breakfast"></a>
		<p>Our first-class accommodation will ensure you feel at home.</p>
	</div>
	<div class="span4">
		<h3>Superb Student experience</h3>
		<a href="http://www.kent.ac.uk/courses/undergraduate/prospectus/index.html"><img  style="width:100%" src="http://www.kent.ac.uk/courses/menu/top/images/220x110-ug-brochure-2015.png" alt="2015 prospectus"></a>
		<p>Find out why our students love studying at Kent.</p>
	</div>
</div>


<kentScripts>
	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/moduletable.min.js'); ?>"></script>
<script>
	$('.dataTable').DataTable({
	//	"sPaginationType": "bootstrap",
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
		"deferLoading": 200,
		/// set count
		"serverSide": true,
		"processing": true,
	 	"sDom": "ft<'muted pull-right'i><'clearfix'>p", 
	 	"ajax": {
	 		"url": "https://api-test.kent.ac.uk/api/v1/modules/collection/all?format=datatables",
	 		"dataSrc": function ( json ) {

	 		 	for(var i in json.data){
	 		 		json.data[i].title = '<a href="modules/' + json.data[i].code + '">'  + json.data[i].title +'</a>';
	 		 		json.data[i].code = '<a href="modules/' + json.data[i].code + '">'  + json.data[i].code +'</a>';
	 		 	}
			    return json.data;
			}
	 	}
 	});
 	//http://datatables.net/forums/discussion/5714/solved-how-do-i-disable-the-cache-busting-query-parameter-that-datatables-attaches
 </script>
</kentScripts>