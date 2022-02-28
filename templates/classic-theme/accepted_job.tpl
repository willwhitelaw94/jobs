{OVERALL_HEADER}
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{LANG_JOB_ALERT}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li>{LANG_JOB_ALERT}</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                {USER_SIDEBAR}
            </div>
        <div class="col-lg-9 col-md-12">
            <!-- Dashboard Box -->
            <div class="col-xl-12">
                <div class="dashboard-box margin-top-0">

                    <!-- Headline -->
                    <div class="headline">
                        <h3><i class="icon-material-outline-assignment"></i> My Tasks</h3>
                    </div>

                    <div class="content">
                        <ul class="dashboard-box-list">
                            <li>
                                <!-- Job Listing -->
                                <div class="job-listing width-adjustment">

                                    <!-- Job Listing Details -->
                                    <div class="job-listing-details">

                                        <!-- Details -->
                                        <div class="job-listing-description">
                                            <h3 class="job-listing-title"><a href="#">Design a Landing Page</a> <span class="dashboard-status-button yellow">Expiring</span></h3>

                                            <!-- Job Listing Footer -->
                                            <div class="job-listing-footer">
                                                <ul>
                                                    <li><i class="icon-material-outline-access-time"></i> 23 hours left</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Task Details -->
                                <ul class="dashboard-task-info">
                                    <li><strong>3</strong><span>Bids</span></li>
                                    <li><strong>$22</strong><span>Avg. Bid</span></li>
                                    <li><strong>$15 - $30</strong><span>Hourly Rate</span></li>
                                </ul>

                                <!-- Buttons -->
                                <div class="buttons-to-right always-visible">
                                    <a href="dashboard-manage-bidders.html" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Clients Working on this Job <span class="button-info">3</span></a>
                                    <a href="#" class="button gray ripple-effect ico" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                    <a href="#" class="button gray ripple-effect ico" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                                </div>
                            </li>

                            <li>
                                <!-- Job Listing -->
                                <div class="job-listing width-adjustment">

                                    <!-- Job Listing Details -->
                                    <div class="job-listing-details">

                                        <!-- Details -->
                                        <div class="job-listing-description">
                                            <h3 class="job-listing-title"><a href="#">Food Delivery Mobile Application</a></h3>

                                            <!-- Job Listing Footer -->
                                            <div class="job-listing-footer">
                                                <ul>
                                                    <li><i class="icon-material-outline-access-time"></i> 6 days, 23 hours left</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Task Details -->
                                <ul class="dashboard-task-info">
                                    <li><strong>3</strong><span>Bids</span></li>
                                    <li><strong>$3,200</strong><span>Avg. Bid</span></li>
                                    <li><strong>$2,500 - $4,500</strong><span>Fixed Price</span></li>
                                </ul>

                                <!-- Buttons -->
                                <div class="buttons-to-right always-visible">
                                    <a href="dashboard-manage-bidders.html" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Manage Bidders <span class="button-info">3</span></a>
                                    <a href="#" class="button gray ripple-effect ico" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                    <a href="#" class="button gray ripple-effect ico" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>




<!-- Edit Review Popup
================================================== -->
<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab1">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Change Review</h3>
                    <span>Rate <a href="#">Herman Ewout</a> for the project <a href="#">WordPress Theme Installation</a> </span>
                </div>

                <!-- Form -->
                <form method="post" id="change-review-form">

                    <div class="feedback-yes-no">
                        <strong>Was this delivered on budget?</strong>
                        <div class="radio">
                            <input id="radio-rating-1" name="radio" type="radio" checked>
                            <label for="radio-rating-1"><span class="radio-label"></span> Yes</label>
                        </div>

                        <div class="radio">
                            <input id="radio-rating-2" name="radio" type="radio">
                            <label for="radio-rating-2"><span class="radio-label"></span> No</label>
                        </div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Was this delivered on time?</strong>
                        <div class="radio">
                            <input id="radio-rating-3" name="radio2" type="radio" checked>
                            <label for="radio-rating-3"><span class="radio-label"></span> Yes</label>
                        </div>

                        <div class="radio">
                            <input id="radio-rating-4" name="radio2" type="radio">
                            <label for="radio-rating-4"><span class="radio-label"></span> No</label>
                        </div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Your Rating</strong>
                        <div class="leave-rating">
                            <input type="radio" name="rating" id="rating-1" value="1" checked/>
                            <label for="rating-1" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-2" value="2"/>
                            <label for="rating-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-3" value="3"/>
                            <label for="rating-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-4" value="4"/>
                            <label for="rating-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-5" value="5"/>
                            <label for="rating-5" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <textarea class="with-border" placeholder="Comment" name="message" id="message" cols="7" required>Excellent programmer - helped me fixing small issue.</textarea>

                </form>

                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="change-review-form">Save Changes <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>
<!-- Edit Review Popup / End -->


<!-- Leave a Review for Freelancer Popup
================================================== -->
<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab2">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Leave a Review</h3>
                    <span>Rate <a href="#">Peter Valentín</a> for the project <a href="#">Simple Chrome Extension</a> </span>
                </div>

                <!-- Form -->
                <form method="post" id="leave-review-form">

                    <div class="feedback-yes-no">
                        <strong>Was this delivered on budget?</strong>
                        <div class="radio">
                            <input id="radio-1" name="radio" type="radio" required>
                            <label for="radio-1"><span class="radio-label"></span> Yes</label>
                        </div>

                        <div class="radio">
                            <input id="radio-2" name="radio" type="radio" required>
                            <label for="radio-2"><span class="radio-label"></span> No</label>
                        </div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Was this delivered on time?</strong>
                        <div class="radio">
                            <input id="radio-3" name="radio2" type="radio" required>
                            <label for="radio-3"><span class="radio-label"></span> Yes</label>
                        </div>

                        <div class="radio">
                            <input id="radio-4" name="radio2" type="radio" required>
                            <label for="radio-4"><span class="radio-label"></span> No</label>
                        </div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Your Rating</strong>
                        <div class="leave-rating">
                            <input type="radio" name="rating" id="rating-radio-1" value="1" required>
                            <label for="rating-radio-1" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-radio-2" value="2" required>
                            <label for="rating-radio-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-radio-3" value="3" required>
                            <label for="rating-radio-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-radio-4" value="4" required>
                            <label for="rating-radio-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="rating" id="rating-radio-5" value="5" required>
                            <label for="rating-radio-5" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <textarea class="with-border" placeholder="Comment" name="message2" id="message2" cols="7" required></textarea>

                </form>

                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="leave-review-form">Leave a Review <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>
<!-- Leave a Review Popup / End -->


{OVERALL_FOOTER}
