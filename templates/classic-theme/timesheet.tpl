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


            <!-- Row -->
            <div class="row" style="margin-bottom: 20px">
                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-material-outline-assignment"></i> My Timesheets</h3>
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

            <!-- Row -->
            <div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-feather-folder-plus"></i> Submit a Timesheet</h3>
                        </div>

                        <div class="content with-padding padding-bottom-10">
                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="submit-field">
                                        <h5>Agreement</h5>
                                        <select class="selectpicker with-border" data-size="7" title="Select Category">
                                            <option>Client A</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="submit-field">
                                        <h5>Rate</h5>
                                        <select class="selectpicker with-border" data-size="7" title="Select Category">
                                            <option>Saturday - $45/hr</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>When did you complete your shift?</h5>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="input-with-icon">
                                                    <input class="with-border" type="text" placeholder="Start">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="input-with-icon">
                                                    <input class="with-border" type="text" placeholder="Finish">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-xl-12">
                                    <div class="submit-field">
                                        <h5>Details of Shift</h5>
                                        <textarea cols="30" rows="5" class="with-border"></textarea>
                                        <div class="uploadButton margin-top-30">
                                            <input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload" multiple/>
                                            <label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
                                            <span class="uploadButton-file-name">Images or documents that might be helpful in describing your project</span>
                                        </div>
                                    </div>
                                    <div class="feedback-yes-no margin-top-0">
                                        <div class="radio">
                                            <input id="radio-1" name="radio" type="radio" checked>
                                            <label for="radio-1"><span class="radio-label"></span> No Reportable Incidents</label>
                                        </div>

                                        <div class="radio">
                                            <input id="radio-2" name="radio" type="radio">
                                            <label for="radio-2"><span class="radio-label"></span> An Incident Occured</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <a href="#" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Post Timesheet</a>
                </div>

            </div>
            <!-- Row / End -->


        </div>
        </div>
    </div>
</div>


{OVERALL_FOOTER}
