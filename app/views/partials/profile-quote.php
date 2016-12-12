<?php
foreach($course->careers_profile as $profile){

if(!empty($profile->quote)){
	$profile_image = (!empty($profile->profile_image_id)) ? $profile->profile_image_id->sizes->full->url :  false;
?>
<blockquote>
	<?php if($profile_image) { ?><img class="rounded-circle" src="<?php echo $profile_image; ?>" alt="<?php echo $profile->name; ?>"><?php } ?>
	<?php echo $profile->quote; ?>
	<cite><?php echo $profile->name; ?>
	<span><?php echo $profile->course; ?></span>
	</cite>
</blockquote>
<?php  }}