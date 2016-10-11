<!-- prospectus modal -->
<div class="modal modal-course fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="Conctact Us" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="modal-title">Contact us</h3>
            </div>
            <div class="modal-body">
                <div class="content-page">
                    <div class="content-container">
                        <div class="content-main">
                            <section class="info-section contacts">
                                <h3>Contacts</h3>
                                <section class="info-subsection">
                                    <h4>Related schools</h4>
                                    <ul>
                                        <li><a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
                                        <?php if(!empty($course->additional_school[0])): ?>
                                            <li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </section>
                                <section class="info-subsection">
                                    <h4>Enquiries</h4>
                                    <?php echo $course->enquiries ?>
                                </section>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


