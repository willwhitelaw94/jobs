{OVERALL_HEADER}
{BREADCRUMBS}
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                {USER_SIDEBAR}
            </div>
        <div class="col-lg-9 col-md-12">

            <div class="dashboard-box margin-top-0">
                <div class="headline">
                    <h3><i class="icon-feather-clock"></i> {LANG_MYTIMESHEET} &ndash; <a href="{LINK_ADD_SHIFT}">{LANG_ADD_SHIFT}</a></h3>
                </div>
               
            </div>
            <div class="listings-container margin-top-35">

            <!-- Row -->
            <div class="row" style="margin-bottom: 20px">
                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <!-- <div class="headline">
                            <h3><i class="icon-material-outline-assignment"></i>{LANG_MYTIMESHEET}</h3>
                        </div> -->

                        <div class="content">
                            <ul class="dashboard-box-list">
                                <li>
                                    <!-- Job Listing -->
                                    <div class="job-listing width-adjustment">

                                        <!-- Job Listing Details -->
                                        <div class="job-listing-details">

                                            <!-- Details -->
                                            <div class="job-listing-description">
                                                <h3 class="job-listing-title"><a href="#">{Worker Name}</a> <span class="dashboard-status-button yellow">Overdue</span></h3>

                                                <!-- Job Listing Footer -->
                                                <div class="job-listing-footer">
                                                    <ul>
                                                        <li><i class="icon-material-outline-access-time"></i> 4 Hrs on 24/02/2022</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Task Details -->
                                    <ul class="dashboard-task-info">
                                        <li><strong>$85</strong><span>Due</span></li>

                                        <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>Submitted</span></li>
                                        <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>Approved</span></li>
                                        <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>Pending</span></li>
                                        <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>Disbursed</span></li>

                                    </ul>

                                    <!-- Buttons -->
                                    <div class="buttons-to-right always-visible">
                                        IF('{USERTYPE}' == "employer"){
                                        <a href="dashboard-manage-bidders.html" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Approve Timesheet</a>
                                        {:IF}
                                        IF('{USERTYPE}' == "user"){
                                        <a href="#" class="button gray ripple-effect ico" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                        <a href="#" class="button gray ripple-effect ico" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                                        {:IF}
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Row / End -->

          
            </div>

        </div>
        </div>
    </div>
</div>


{OVERALL_FOOTER}
