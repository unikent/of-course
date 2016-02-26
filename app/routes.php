<?php
// Setup main object
$courses = new CoursesController();
$modules = new ModulesController();

/**
 * Course page routes
 *
 */

// Define routes
// AJAX
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/', array($courses,'ajax_subjects_page'));
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/@year:current', array($courses,'ajax_subjects_page'));
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/@year:[0-9]+', array($courses,'ajax_subjects_page'));

Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/', array($courses,'ajax_leaflets_data'));
Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/@year:current', array($courses,'ajax_leaflets_data'));
Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/@year:[0-9]+', array($courses,'ajax_leaflets_data'));

Flight::route('/ajax/search/@level:undergraduate|postgraduate/', array($courses,'ajax_search_data'));
Flight::route('/ajax/search/@level:undergraduate|postgraduate/@year:current', array($courses,'ajax_search_data'));
Flight::route('/ajax/search/@level:undergraduate|postgraduate/@year:[0-9]+', array($courses,'ajax_search_data'));

// Preview
Flight::route('/@level:undergraduate|postgraduate/preview/@hash', array($courses,'preview'));

// simpleview
Flight::route('/@level:undergraduate|postgraduate/simpleview/@hash', array($courses,'simpleview'));

//XCRIP-CAP feed
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/xcri', array($courses, 'xcri_cap'));
Flight::route('/@level:undergraduate|postgraduate/xcri', array($courses, 'xcri_cap_noyear'));
Flight::route('/xcri', array($courses, 'xcri_cap_noparams'));

// Search
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/search/@search_type/@search_string', array($courses,'search'));
Flight::route('/@level:undergraduate|postgraduate/search/@search_type/@search_string', array($courses,'search_noyear'));
Flight::route('/@level:undergraduate|postgraduate/search', array($courses,'search_noyear'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/search', array($courses,'search'));

// New courses
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/new', array($courses,'new_courses'));
Flight::route('/@level:undergraduate|postgraduate/new', array($courses,'new_courses_noyear'));

// study abroad option
Flight::route('/@level:postgraduate/@year:[0-9]+/study-abroad', array($courses,'study_abroad'));
Flight::route('/@level:postgraduate/study-abroad', array($courses,'study_abroad_noyear'));


//Subject leaflets
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/leaflets', array($courses,'leaflets'));
Flight::route('/@level:undergraduate|postgraduate/leaflets', array($courses,'leaflets_noyear'));

//apply page
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/apply-online/@id:[0-9]+/@slug', array($courses,'apply'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/apply-online/@id:[0-9]+', array($courses,'apply'));
Flight::route('/@level:undergraduate|postgraduate/apply-online/@id:[0-9]+/@slug', array($courses,'apply_noyear'));
Flight::route('/@level:undergraduate|postgraduate/apply-online/@id:[0-9]+', array($courses,'apply_noyear'));

// Courses
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/@id:[0-9]+/@slug', array($courses, 'view'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/@id:[0-9]+', array($courses, 'view'));
Flight::route('/@level:undergraduate|postgraduate/@id:[0-9]+/@slug', array($courses, 'view_noyear'));
Flight::route('/@level:undergraduate|postgraduate/@id:[0-9]+', array($courses, 'view_noyear'));

// Legacy Courses
// These URLS look like: /undergrad/subjects/<subject name>/<slug>
Flight::route('/@level:undergrad|postgrad/subjects/[A-Za-z0-9\-_]+/@slug', function($level, $slug) use($courses){
	$courses->redirect_handler($slug, $level);
});
// Malformed ug/pg levels for search
Flight::route('/@level:undergrad|postgrad|ug|pg/@year:[0-9]+/search', function($level, $year) use($courses){
	$courses->redirect_handler("search", $level, $year);
});
Flight::route('/@level:undergrad|postgrad|ug|pg/search', function($level, $year) use($courses){
	$courses->redirect_handler("search", $level);
});
// Malformed ug/pg levels for programmes
Flight::route('/@level:undergrad|postgrad|ug|pg/@id:[0-9]+/@slug', function($level, $id, $slug) use($courses){
	$courses->redirect_handler($slug, $level, null, $id);
});
Flight::route('/@level:undergrad|postgrad|ug|pg/@year:[0-9]+/@id:[0-9]+/@slug', function($level, $year, $id, $slug) use($courses){
	$courses->redirect_handler($slug, $level, $year, $id);
});

/**
 * Module page routes
 *
 */
Flight::route('/modules', array($modules, 'index'));
Flight::route('/modules/collection', array($modules,'collections'));
Flight::route('/modules/collection/@collection', array($modules,'collection'));
Flight::route('/modules/disclaimer', array($modules,'disclaimer'));
Flight::route('/modules/module/@code', array($modules,'view'));


Flight::route('/modulecatalogue', array($modules,'legacy_url'));
Flight::route('/modulecatalogue/index.html', array($modules,'legacy_url'));
Flight::route('/modulecatalogue/modules/@code', array($modules,'legacy_url'));
Flight::route('/modulecatalogue/disclaimer.html', function (){ return Flight::redirect('https://www.kent.ac.uk/termsandconditions/', 301); });
Flight::route('/modulecatalogue/humanities.html', function (){ return Flight::redirect('/modules/collection/H2', 301); });
Flight::route('/modulecatalogue/sciences.html', function (){ return Flight::redirect('/modules/collection/SPS2', 301); });
Flight::route('/modulecatalogue/socialsciences.html', function (){ return Flight::redirect('/modules/collection/SS2', 301); });
Flight::route('/modulecatalogue/collections/@code', array($modules,'legacy_collection_url'));
Flight::route('/modulecatalogue/collections/@code/@crap', array($modules,'legacy_collection_url'));
