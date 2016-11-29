<?php 
use \unikent\kent_theme\kentThemeHelper;

$banner_image = (empty($profile->banner_image_id)) ? Flight::asset('images/default-profile-feature.jpg') : $profile->banner_image_id->url;
$banner_image_alt = (empty($profile->banner_image_id)) ?'Students preparing for their graduation ceremony at Canterbury Cathedral' : $profile->banner_image_id->caption;


if(!empty($profile->video)){
	$matches = false;
	preg_match('/^https?:\/\/(?:youtu\.be|(?:www\.|m\.)?youtube\.com)\/?(?:watch|embed)?(?:.*?v=|v\/|\/)([\w-]+)/i',$profile->video,$matches);
	if(count($matches) !== 2){
		$profile->video = false;
	}else{
		$profile->video = $matches[1];
	}
}

?>
<div class="card card-overlay header-card-overlay  ">
	<div class="card-body">
		<div class="card-media-wrap<?php echo $profile->video?' video-launcher':''; ?>"<?php echo $profile->video?' data-mode="fullscreen"':''; ?>>
			<?php if($profile->video){ ?>
			<div class="video-player">
				<div data-video-id="<?php echo $profile->video; ?>" data-type="youtube">&nbsp;</div>
			</div>
			<?php } ?>
			<img class="card-img" src="<?php echo $banner_image; ?>" alt="<?php echo $banner_image_alt; ?>">
			<div class="attribution">
				<i class="kf-camera"></i>
				<span><a href="" aria-expanded="true">Image title</a>. <a href="" class="active" aria-expanded="true">Attribution License</a></span>
			</div>
		</div>
		<div class="card-title-wrap force-block content-contained pull-bottom ">
			<h1 class="card-title">Student Profile
				<div class="text-white"><?php echo $profile->name; ?></div>
			</h1>
			<p class="card-text"><?php echo $profile->course; ?></p>
		</div>
	</div>
</div>
<div class="content-container">
	<div class="content-full">
		<?php
		KentThemeHelper::breadcrumb(array(
										'Student Profiles'=>'/profiles',
										ucfirst($level) =>Flight::url('profiles/'.$level),
										$profile->name . ' - ' . $profile->course =>''
									));
		?>
	</div>
</div>
<div class="content-container">
	<div class="content-main">
		<div class="lead">
			<?php echo $profile->lead; ?>
		</div>

		<?php echo $profile->content;

		?>
	</div>
	<aside class="content-aside">
		<?php if(!empty($profile->quote)){ ?>
		<h2 class="sr-only">Quote <?php echo $profile->name; ?></h2>
		<blockquote class="text-accent">
			<?php if(!empty($profile->profile_image_id)){ ?>
			<img src="<?php echo $profile->profile_image_id->url; ?>" class="rounded-circle" alt="<?php echo $profile->name; ?>">
			<?php } ?>
			<?php echo $profile->quote; ?>
			<cite><?php echo $profile->name; ?></cite>
		</blockquote>
		<?php } ?>

		<?php if(!empty($profile->links)){ ?>
		<nav>
			<h3>See also</h3>
			<?php echo $profile->links; ?>
		</nav>
		<?php } ?>
	</aside>
</div>

