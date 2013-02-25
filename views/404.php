<article class="container">
    <div class='row-fluid'>
        <div class='span12'>
            <h1>We were unable to find <?php echo (!empty($slug)) ? "'{$slug}' "  : " a course "; ?><?php if(isset($id)): ?> with the id <?php echo $id;?> <?php endif; ?> </h1>
        </div>
    </div>
    <div class='row-fluid' style='min-height:300px;'>
        <div class='span7'>
            <p><strong>Sorry but we could not find the programme you were attempting to view.</strong></p>
            <p>Try using the search above to find what you are looking for or alternatively go back to the <a href='<?php echo BASE_URL; ?>'>courses index page</a>.</p>
       
            <?php if(!empty($slug)): ?>
                <?php
                    $limit = 6;
                    $found = array();
                
                    foreach($programmes as $programme){
                       if(strpos($programme->name, $slug) !==false || strpos($programme->slug, $slug) !==false){
                            $link = Flight::url("{$level}/{$year_for_url}{$programme->id}/{$programme->slug}");
                            $found[] = "<li><a href='{$link}'>{$programme->name}</a></li>";
                        }
                        if(sizeof($found) >= $limit)break;
                    }  
                ?>
                <?php if(sizeof($found) != 0): ?>
                <h4>Are any of these what you're looking for?</h4>
                <ul>
                    <?php foreach($found as $link){ echo $link ;} ?>
                </ul>
                <?php endif; ?>
            <?php endif; ?>

        </div>
        <div class='span5'>
            <div class='well'>
                <h3>Not looking for a course?</h3>
                    <p>Maybe some of these links will be more helpful</p>
                    <ul>
                        <li><a href="http://www.kent.ac.uk">Go to the University of Kent homepage</a></li>
                        <li><a href="http://www.kent.ac.uk/applicants/">Visit the applicants site</a></li>
                        <li><a href="http://www.kent.ac.uk/maps/">View campus maps</a></li>
                        <li><a href="http://www.kent.ac.uk/contact/">Contact us</a></li>
                    </ul>
            </div>
        </div>
    </div>
</article>

<!--
    
Debug Info:
<?php
   if(isset($error)) echo $error->getCode().': '.$error->getMessage();
   if(isset($error_msg)) echo $error_msg;
?>

-->
