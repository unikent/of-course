<h2>Entry requirements</h2>

<?php echo $course->entry_requirements; ?>

<section class="info-section">
	<?php echo $course->globals->pg_general_entry_requirements ?>
</section>

<?php if(!empty($course->english_language_requirements_intro_text)): ?>
<section class="info-section">
	<h3>English language entry requirements</h3>
	<?php echo $course->english_language_requirements_intro_text ?>
</section>
<?php endif; ?>
