<h2>Entry requirements</h2>

<?php echo $course->entry_requirements; ?>

<section class="info-section">
	<h3>General entry requirements</h3>
	<?php echo $course->globals->pg_general_entry_requirements ?>
</section>

<?php if(!empty($course->english_language_requirements_intro_text)): ?>
<section class="info-section">
	<h3>English entry requirements</h3>
	<?php echo $course->english_language_requirements_intro_text ?>
</section>
<?php endif; ?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Qualification</th>
			<th>Rating</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>IELTS</td>
			<td>
				<?php echo $course->ielts_english_language_requirement ?>
			</td>
		</tr>
		<tr>
			<td>TOEFL internet-based</td>
			<td>
				<?php echo $course->toefl_english_language_requirements ?>
			</td>
		</tr>
		<tr>
			<td>Cambridge Certificate in Proficiency in English</td>
			<td>
			??
			</td>
		</tr>
		<tr>
		<td>Cambridge Advanced Certificate in English</td>
		<td>
		??
		</td>
		</tr>
		<tr>
			<td>Cambridge Certificate in Proficiency in English</td>
			<td>
			??
			</td>
		</tr>
		<tr>
			<td>Pearson Test of English Academic (PTE academic)</td>
			<td>
				<?php echo $course->pearson_test_english_language_requirements ?>
			</td>
		</tr>

	</tbody>
</table>
