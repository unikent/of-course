<div class="tabContent" id="tab3">
  <h2>Entry requirements</h2>
  <p><?php echo $course->entry_requirements_overriding_text;?></p>
  <h3>Home/EU students </h3>
  <p><?php echo $course->homeeu_students_intro_text;?></p>
  
  <kentSnippetTable alternate="rows" snippetPack='Default' snippetVersion='1.0'>
    <table class="em">
      <tr>
        <th width="45%">Qualification</th>
        <th width="55%">Typical offer/minimum requirement</th>
      </tr>
      <tr>
        <td>A level</td>
        <td><?php echo $course->a_level ?></td>
      </tr>
      <tr>
        <td>GCSE</td>
        <td><?php echo $course->cgse ?></td>
      </tr>
      <tr>
        <td>Cambridge Pre-U</td>
        <td><?php echo $course->cambridge_preu ?></td>
      </tr>
      <tr>
        <td>International Baccalaureate</td>
        <td><?php echo $course->international_baccalaureate ?></td>
      </tr>
      <tr>
        <td>Access to HE Diploma</td>
        <td><?php echo $course->access_to_he_diploma ?></td>
      </tr>
      <tr>
        <td>BTEC Level 5 HND</td>
        <td><?php echo $course->btec_level_5_hnd ?></td>
      </tr>
      <tr>
        <td>BTEC Level 3 Extended Diploma (formerly BTEC National Diploma) </td>
        <td><?php echo $course->btec_level_3_extended_diploma_formerly_btec_national_diploma ?></td>
      </tr>
      <tr>
        <td>Scottish Qualifications</td>
        <td><?php echo $course->scottish_qualifications ?></td>
      </tr>
      <tr>
        <td>Irish Leaving Certificate</td>
        <td><?php echo $course->irish_leaving_certificate ?></td>
      </tr>
    </table>
    <h3>International students<a href="/courses/undergrad/apply/entry.html"></a></h3>
    <p><?php echo $course->international_students_intro_text ?></p>
    <table class="em">
      <tr>
        <td>Kent International Foundation Programme</td>
        <td><?php echo $course->kent_international_foundation_programme ?></td>
      </tr>
      <tr>
        <td>English Language Requirements</td>
        <td><?php echo $course->english_language_requirements ?></td>
      </tr>
    </table>
    <p>Please also see our <a href="/courses/undergrad/apply/entry.html">general entry requirements.</a></p>
  </kentSnippetTable>
</div>