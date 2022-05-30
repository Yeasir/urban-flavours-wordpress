<?php /* Template Name: Service Area */ ?>

<?php get_header(); ?>
    <!-- /. contactus-section start here -->
    <div class="contactus-section">
        <div class="container-fluid no-gutters">
            <div class="row align-items-center ">
                <div class="col-lg-3 col-md-6 col-sm-12  ml-auto  ">
                    <div class="service-wrap pt-5 pb-5 text-justify">
                        <?php
                        while ( have_posts() ) :the_post();?>
                        <h3 class="text-uppercase green-text  font-weight-bold"><?php the_title();?></h3>
                        <form action="" id="serviceFrm" method="post">
                            <div class="form-group input-group">
                                <div class="input-group addon">
                                    <input type="text" for="filtersubmit" class="form-control"  placeholder="Zip Code">
                                    <span class="input-group-addon" id="filtersubmit"><i  class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <?php echo get_the_content();?>
                        <?php endwhile;?>
                    </div>
                    <div class="hours-text pt-3">
                        <h6 class="green-text font-weight-bold">Hours</h6>
                        <p><?php echo get_field('open_hours', 'option');?></p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 com-sm-6 p-0 ">
                    <div class="service-map-area">
                        <div class="service-map-box" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. contactus-section end here -->
    <div class="service-modal available">
        <div class="modal-wrapper modal-transition">
            <div class="modal-body ">
                <div class="modal-content  border-bottom text-center mb-3 ">
                    <div class="delivery ">
                        <i class="fa fa-check green-text" aria-hidden="true"></i>
                        <?php echo get_field('delivery_available_text', 'option');?></p>
                    </div>
                </div>
                <ul class="info list-inline float-right m-0 p-0">
                    <li class="list-inline-item">
                        <p>ETA: <span class="estimoarri"></span></p>
                    </li>
                    <li class="list-inline-item">
                        <p>Fee: <span class="scfee"></span></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="service-modal not-available">
        <div class="modal-wrapper modal-transition">
            <div class="modal-body ">
                <div class="modal-content border-0 text-center">
                    <div class="delivery-not">
                        <i class="fa fa-exclamation red-text"></i>
                        <?php echo get_field('delivery_unavailable_text', 'option');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
