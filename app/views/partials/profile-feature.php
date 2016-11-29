<?php if(isset($course->student_profiles) && is_array($course->student_profiles) && !empty($course->student_profiles)){ ?>
<div class="card card-overlay student-profiles">
	<div class="card-body kent-slider">
		<?php foreach($course->student_profiles as $profile){
			$banner_image = (empty($profile->banner_image_id)) ? Flight::asset('images/default-profile-feature.jpg') : $profile->banner_image_id->url;
			$banner_image_alt = (empty($profile->banner_image_id)) ?'Students preparing for their graduation ceremony at Canterbury Cathedral' : $profile->banner_image_id->caption;
		?>
		<div class="kent-slide">
			<div class="card-title-wrap card-title-wrap-link">
				<a href="<?php echo Flight::url('profiles/'. $level .'/'. $profile->slug); ?>" class="card-title-link"><h2 class="card-title">Student Profile
				<div class="text-white"><?php echo $profile->name; ?></div></h2></a>
			</div>
			<div class="card-media-wrap">
				<img src="<?php echo $banner_image ?>" class="card-img" alt="<?php echo $banner_image_alt; ?>">
			</div>
			<div class="card-img-overlay-bottom-shaded text-xs-right">
				<h3 class="card-subtitle"><?php echo $profile->course; ?></h3>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>