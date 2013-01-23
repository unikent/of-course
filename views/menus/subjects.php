
<a href="" id="campuses_and_centres_anchor">Subjects</a>

 <div id="campuses_and_centres_links" class="megamenu" style="display: none; ">
    <div class="maps_megacontentarea">
        <?php foreach($subjects as $subject): ?>
            <div class="megacontentsection">
               <a href='<?php echo Flight::url("{$type}/{$year}/subjects/{$subject->id}/{$subject->name}"); ?>'><?php echo $subject->name; ?></a>
            </div>
        <?php endforeach;?>
    </div>
</div>
