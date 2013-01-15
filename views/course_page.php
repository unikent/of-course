<kentPageBody>
    <kentPageBodyLeft>
        <kentMenuGenerator name='left' maxDepth='3'>
            <!-- InstanceBeginEditable name="menuParameters" -->
            <param:menuGenerator name='buildAllMenus' value='true' />
            <param:menuGenerator name='forceMenuHighlight' value='' />
            <!-- InstanceEndEditable -->
        </kentMenuGenerator>
    </kentPageBodyLeft>
    <kentPageBodyRight>
        <kentUtilityBar/>
        <kentPageContent>
            <!-- InstanceBeginEditable name="content" -->
            <h1><?php echo $course->programme_title; ?> <?php echo $course->award; ?> - <?php echo $course->year; ?></h1>
            <p><?php echo  $course->programme_abstract; ?></p>
            
            <div class="snippetBox">
                <div class="tabs">
                    <ul class="tabsFallBackNav">
                        <li><a href="#tab1">Overview</a></li>
                        <li><a href="#tab2">Structure</a></li>
                        <li><a href="#tab3">Teaching and assessment</a></li>
                        <li><a href="#tab3">Careers</a></li>
                        <li><a href="#tab3">Entry requirements</a></li>
                        <li><a href="#tab3">Fees and funding</a></li>
                        <li><a href="#tab3">Apply</a></li>
                        <li><a href="#tab3">Further info</a></li>
                    </ul>
                    <?php Flight::render('tabs/overview', array('course'=>$course)); ?>
                    <?php Flight::render('tabs/structure', array('course'=>$course)); ?>
                    <?php Flight::render('tabs/teaching', array('course'=>$course)); ?>
                    <?php Flight::render('tabs/careers', array('course'=>$course)); ?>
                    <?php Flight::render('tabs/entry', array('course'=>$course)); ?>
                    <?php Flight::render('tabs/fees', array('course'=>$course)); ?>
                    <?php Flight::render('tabs/apply', array('course'=>$course)); ?>
                    <?php Flight::render('tabs/info', array('course'=>$course)); ?>
                </div>
            </div>
            
            <!-- InstanceEndEditable -->
        </kentPageContent>
    </kentPageBodyRight>
</kentPageBody>