<?php if(isset($course->student_profiles) && is_array($course->student_profiles) && !empty($course->student_profiles)){ ?>
<div class="card card-overlay student-profiles">
	<div class="card-body kent-slider kent-slider-dark">
		<?php foreach($course->student_profiles as $profile){
			$banner_image = (empty($profile->banner_image_id)) ? Flight::asset('images/default-profile-feature.jpg') : $profile->banner_image_id->sizes->full->url;
			$banner_image_alt = (empty($profile->banner_image_id)) ?'Students preparing for their graduation ceremony at Canterbury Cathedral' : $profile->banner_image_id->caption;
		?>
		<div class="kent-slide">
			<div class="card-title-wrap card-title-wrap-link">
				<a href="<?php echo Flight::url('profiles/'. $level .'/'. $profile->slug); ?>" class="card-title-link"><h2 class="card-title">Student Profile
				<div class="text-white"><?php echo $profile->name; ?></div></h2></a>
				<a href="<?php echo Flight::url('profiles/'. $level .'/'. $profile->slug); ?>" class="faux-link-overlay" aria-hidden="true">Student Profile <?php echo $profile->name; ?></a>
				<p class="card-text"><?php echo $profile->course; ?></p>
			</div>
			<div class="card-media-wrap">
				<img src="<?php echo $banner_image ?>" class="card-img<?php echo (!empty($profile->banner_image_id) && in_array($profile->banner_image_id->focus, array('top','bottom')))? '-' . $profile->banner_image_id->focus : ''; ?>" alt="<?php echo $banner_image_alt; ?>">
			</div>
			<?php if(!empty($profile->quote)){ ?>
			<div class="card-img-overlay-link card-img-overlay-bottom-shaded card-overlay-inline-md">
				<a class="card-title-link" href="<?php echo Flight::url('profiles/'. $level .'/'. $profile->slug); ?>" tabindex="0">
					<p class="card-subtitle chevron-link">&ldquo;<span class="quote-text"><?php echo strip_tags($profile->quote); ?></span>&rdquo;</p>
				</a>
				<a class="faux-link-overlay" href="<?php echo Flight::url('profiles/'. $level .'/'. $profile->slug); ?>" aria-hidden="true" tabindex="0"><?php echo strip_tags($profile->quote); ?></a>
			</div>

			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
