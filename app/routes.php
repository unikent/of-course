<?php 
// Setup main object
$main = new CoursesController();

// Define routes
// AJAX
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/', array($main,'ajax_subjects_page'));
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/@year:current', array($main,'ajax_subjects_page'));
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/@year:[0-9]+', array($main,'ajax_subjects_page'));

Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/', array($main,'ajax_leaflets_data'));
Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/@year:current', array($main,'ajax_leaflets_data'));
Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/@year:[0-9]+', array($main,'ajax_leaflets_data'));

Flight::route('/ajax/search/@level:undergraduate|postgraduate/', array($main,'ajax_search_data'));
Flight::route('/ajax/search/@level:undergraduate|postgraduate/@year:current', array($main,'ajax_search_data'));
Flight::route('/ajax/search/@level:undergraduate|postgraduate/@year:[0-9]+', array($main,'ajax_search_data'));


// Preview
Flight::route('/@level:undergraduate|postgraduate/preview/@hash', array($main,'preview'));

// simpleview
Flight::route('/@level:undergraduate|postgraduate/simpleview/@hash', array($main,'simpleview'));

//XCRIP-CAP feed
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/xcri', array($main, 'xcri_cap'));
Flight::route('/@level:undergraduate|postgraduate/xcri', array($main, 'xcri_cap_noyear'));
Flight::route('/xcri', array($main, 'xcri_cap_noparams'));

// Search
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/search/@search_type/@search_string', array($main,'search'));
Flight::route('/@level:undergraduate|postgraduate/search/@search_type/@search_string', array($main,'search_noyear'));
Flight::route('/@level:undergraduate|postgraduate/search', array($main,'search_noyear'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/search', array($main,'search'));

// New courses
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/new', array($main,'new_courses'));
Flight::route('/@level:undergraduate|postgraduate/new', array($main,'new_courses_noyear'));

// study abroad option
Flight::route('/@level:postgraduate/@year:[0-9]+/study-abroad', array($main,'study_abroad'));
Flight::route('/@level:postgraduate/study-abroad', array($main,'study_abroad_noyear'));


//Subject leaflets
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/leaflets', array($main,'leaflets'));
Flight::route('/@level:undergraduate|postgraduate/leaflets', array($main,'leaflets_noyear'));

//apply page
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/apply-online/@id:[0-9]+/@slug', array($main,'apply'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/apply-online/@id:[0-9]+', array($main,'apply'));
Flight::route('/@level:undergraduate|postgraduate/apply-online/@id:[0-9]+/@slug', array($main,'apply_noyear'));
Flight::route('/@level:undergraduate|postgraduate/apply-online/@id:[0-9]+', array($main,'apply_noyear'));

// Courses
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/@id:[0-9]+/@slug', array($main, 'view'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/@id:[0-9]+', array($main, 'view'));
Flight::route('/@level:undergraduate|postgraduate/@id:[0-9]+/@slug', array($main, 'view_noyear'));
Flight::route('/@level:undergraduate|postgraduate/@id:[0-9]+', array($main, 'view_noyear'));

// Legacy Courses
// These URLS look like: /undergrad/subjects/<subject name>/<slug>
Flight::route('/@level:undergrad|postgrad/subjects/[A-Za-z0-9\-_]+/@slug', function($level, $slug) use($main){
	$main->redirect_handler($slug, $level);
}); 
// Malformed ug/pg levels for search
Flight::route('/@level:undergrad|postgrad|ug|pg/@year:[0-9]+/search', function($level, $year) use($main){
	$main->redirect_handler("search", $level, $year);
}); 
Flight::route('/@level:undergrad|postgrad|ug|pg/search', function($level, $year) use($main){
	$main->redirect_handler("search", $level);
}); 
// Malformed ug/pg levels for programmes
Flight::route('/@level:undergrad|postgrad|ug|pg/@id:[0-9]+/@slug', function($level, $id, $slug) use($main){
	$main->redirect_handler($slug, $level, null, $id);
}); 
Flight::route('/@level:undergrad|postgrad|ug|pg/@year:[0-9]+/@id:[0-9]+/@slug', function($level, $year, $id, $slug) use($main){
	$main->redirect_handler($slug, $level, $year, $id);
});