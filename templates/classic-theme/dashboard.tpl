{OVERALL_HEADER}
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
                    <div class="col-lg-8">
                        <h2>{LANG_DASHBOARD}</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                                <li>{LANG_DASHBOARD}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                        <a class="button ripple-effect" rel="nofollow" target="_blank" role="button" href="{LINK_PROFILE}/{USERNAME}">{LANG_PROFILE_PUBLIC}</a>
                        <span class="resend_count" id="resend_count16"></span>
                        </div>
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
            <div class="col-lg-9 col-md-12 js-accordion">
                <div class="dashboard-box margin-top-0">
                    <div class="content with-padding">
                        <div class="row dashboard-profile">
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="dashboard-avatar-box">
                                    <img src="{SITE_URL}storage/profile/{AVATAR}" alt="{LANG_NAME}">
                                    <div>
                                        <h2>{AUTHORNAME}</h2>
                                        <small>{LANG_YOU_LOGIN}: {LASTACTIVE}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12 text-right">
                                IF('{USERTYPE}' == "user"){
                                IF({RESUME_ENABLE}){
                                <span class="dashboard-badge"><strong>{RESUMES}</strong><i
                                            class="icon-feather-paperclip"></i> {LANG_MY_RESUMES}</span>
                                            {:IF}
                                <span class="dashboard-badge"><strong>{FAVORITEADS}</strong><i
                                            class="icon-feather-heart"></i> {LANG_FAV_JOBS}</span>
                                ELSEIF('{USERTYPE}' == "employer"){
                                <span class="dashboard-badge"><strong>{MYADS}</strong><i
                                            class="icon-feather-briefcase"></i> {LANG_JOBS}</span>
                     <span class="dashboard-badge"><strong>
                        IF("{SUB_TITLE}"!=""){
                        {SUB_TITLE}
                        {ELSE}
                        {LANG_FREE}
                        {:IF}
                    </strong><i class="icon-feather-gift"></i> {LANG_MEMBERSHIP}</span>
                                {:IF}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="margin-top-20 row">
                        <div class=" col-xl-6 col-md-6">
                            <div class="notification error closeable">
                            <p>Please fill in all the fields required</p>
                            <a class="close" href="#"></a>
                        </div>
                        </div>
                        <div class=" col-xl-6 col-md-6">

                            <div class="notification success closeable">
                                <p>You did it, now relax and enjoy it</p>
                                <a class="close" href="#"></a>
                            </div>
                            </div>
                        <div class=" col-xl-6 col-md-6">
                            <div class="notification warning closeable">
                                <p>Change this and that and try again</p>
                                <a class="close" href="#"></a>
                            </div>
                        </div>
                        <div class=" col-xl-6 col-md-6">
                             <div class="notification notice closeable">
                                <p>Please check the information below</p>
                                <a class="close" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fun Facts Container -->
                <div class="fun-facts-container">
                    <div class="fun-fact" data-fun-fact-color="#36bd78">
                        <div class="fun-fact-text">
                            <span>Task Bids Won</span>
                            <h3>22</h3>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-material-outline-gavel"></i></div>
                    </div>
                    <div class="fun-fact" data-fun-fact-color="#b81b7f">
                        <div class="fun-fact-text">
                            <span>Jobs Applied</span>
                            <h3>4</h3>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
                    </div>
                    <div class="fun-fact" data-fun-fact-color="#efa80f">
                        <div class="fun-fact-text">
                            <span>Reviews</span>
                            <h3>28</h3>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-material-outline-rate-review"></i></div>
                    </div>

                    <!-- Last one has to be hidden below 1600px, sorry :( -->
                    <div class="fun-fact" data-fun-fact-color="#2a41e6">
                        <div class="fun-fact-text">
                            <span>This Month Views</span>
                            <h3>987</h3>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
                    </div>
                </div>


                <!-- Row -->
                <div class="row">
                    <div class="col-xl-8">
                        <!-- Dashboard Box -->
                        <div class="dashboard-box main-box-in-row">
                            <div class="headline">
                                <h3><i class="icon-feather-bar-chart-2"></i> Your Profile Views</h3>
                                <div class="sort-by">
                                    <select class="selectpicker hide-tick">
                                        <option>Last 6 Months</option>
                                        <option>This Year</option>
                                        <option>This Month</option>
                                    </select>
                                </div>
                            </div>
                            <div class="content">
                                <!-- Chart -->
                                <div class="chart">
                                    <canvas id="chart" width="100" height="45"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Dashboard Box / End -->
                    </div>
                    <div class="col-xl-4">

                        <!-- Dashboard Box -->
                        <!-- If you want adjust height of two boxes
                             add to the lower box 'main-box-in-row'
                             and 'child-box-in-row' to the higher box -->
                        <div class="dashboard-box child-box-in-row">
                            <div class="headline">
                                <h3><i class="icon-material-outline-note-add"></i> Notes</h3>
                            </div>

                            <div class="content with-padding">
                                <!-- Note -->
                                <div class="dashboard-note">
                                    <p>Meeting with candidate at
                                    <div class="note-footer">
                                        <span class="note-priority high">High Priority</span>
                                        <div class="note-buttons">
                                            <a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                            <a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Note -->
                                <div class="dashboard-note">
                                    <p>Extend premium </p>
                                    <div class="note-footer">
                                        <span class="note-priority low">Low Priority</span>
                                        <div class="note-buttons">
                                            <a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                            <a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Note -->
                                <div class="dashboard-note">
                                    <p>Send payment </p>
                                    <div class="note-footer">
                                        <span class="note-priority medium">Medium Priority</span>
                                        <div class="note-buttons">
                                            <a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                            <a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-note-button">
                                <a href="#small-dialog" class="popup-with-zoom-anim button full-width button-sliding-icon">Add Note <i class="icon-material-outline-arrow-right-alt"></i></a>
                            </div>
                        </div>
                        <!-- Dashboard Box / End -->
                    </div>
                </div>
                <!-- Row / End -->


                <!-- Row -->
                <div class="row">

                    <!-- Dashboard Box -->
                    <div class="col-xl-6">
                        <div class="dashboard-box">
                            <div class="headline">
                                <h3><i class="icon-material-baseline-notifications-none"></i> Notifications</h3>
                                <button class="mark-as-read ripple-effect-dark" data-tippy-placement="left" title="Mark all as read">
                                    <i class="icon-feather-check-square"></i>
                                </button>
                            </div>
                            <div class="content">
                                <ul class="dashboard-box-list">
                                    <li>
                                        <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                                        <span class="notification-text">
										<strong>Michael Shannah</strong> applied for a job <a href="#">Full Stack Software Engineer</a>
									</span>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="notification-icon"><i class=" icon-material-outline-gavel"></i></span>
                                        <span class="notification-text">
										<strong>Gilber Allanis</strong> placed a bid on your <a href="#">iOS App Development</a> project
									</span>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="notification-icon"><i class="icon-material-outline-autorenew"></i></span>
                                        <span class="notification-text">
										Your job listing <a href="#">Full Stack Software Engineer</a> is expiring
									</span>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                                        <span class="notification-text">
										<strong>Sindy Forrest</strong> applied for a job <a href="#">Full Stack Software Engineer</a>
									</span>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="notification-icon"><i class="icon-material-outline-rate-review"></i></span>
                                        <span class="notification-text">
										<strong>David Peterson</strong> left you a <span class="star-rating no-stars" data-rating="5.0"></span> rating after finishing <a href="#">Logo Design</a> task
									</span>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Box -->
                    <div class="col-xl-6">
                        <div class="dashboard-box">
                            <div class="headline">
                                <h3><i class="icon-material-outline-assignment"></i> Invoices</h3>
                            </div>
                            <div class="content">
                                <ul class="dashboard-box-list">
                                    <li>
                                        <div class="invoice-list-item">
                                            <strong>Professional Plan</strong>
                                            <ul>
                                                <li><span class="unpaid">Unpaid</span></li>
                                                <li>Order: #326</li>
                                                <li>Date: 12/08/2019</li>
                                            </ul>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="pages-checkout-page.html" class="button">Finish Payment</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="invoice-list-item">
                                            <strong>Professional Plan</strong>
                                            <ul>
                                                <li><span class="paid">Paid</span></li>
                                                <li>Order: #264</li>
                                                <li>Date: 10/07/2019</li>
                                            </ul>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="pages-invoice-template.html" class="button gray">View Invoice</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="invoice-list-item">
                                            <strong>Professional Plan</strong>
                                            <ul>
                                                <li><span class="paid">Paid</span></li>
                                                <li>Order: #211</li>
                                                <li>Date: 12/06/2019</li>
                                            </ul>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="pages-invoice-template.html" class="button gray">View Invoice</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="invoice-list-item">
                                            <strong>Professional Plan</strong>
                                            <ul>
                                                <li><span class="paid">Paid</span></li>
                                                <li>Order: #179</li>
                                                <li>Date: 06/05/2019</li>
                                            </ul>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="pages-invoice-template.html" class="button gray">View Invoice</a>
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


<!--Apply for a job popup-
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
            <li><a href="#tab">Add Note</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Do Not Forget 😎</h3>
                </div>

                <!-- Form -->
                <form method="post" id="add-note">

                    <select class="selectpicker with-border default margin-bottom-20" data-size="7" title="Priority">
                        <option>Low Priority</option>
                        <option>Medium Priority</option>
                        <option>High Priority</option>
                    </select>

                    <textarea name="textarea" cols="10" placeholder="Note" class="with-border"></textarea>

                </form>

                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="add-note">Add Note <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>
<!-- Apply for a job popup / End -->

<link media="all" rel="stylesheet" type="text/css"
      href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/styles/simditor.css"/>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/mobilecheck.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/module.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/uploader.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/hotkeys.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/simditor.js"></script>

<script>
    var error = "";
    function checkAvailabilityUsername() {
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'username=' + $("#username").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $("#user-availability-status").html(data);
                }
                else {
                    error = 0;
                    $("#user-availability-status").html("");
                }
            },
            error: function () {
            }
        });
    }
    function checkAvailabilityEmail() {
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $("#email-availability-status").html(data);
                }
                else {
                    error = 0;
                    $("#email-availability-status").html("");
                }
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }
    function checkAvailabilityPassword() {
        var length = $('#password').val().length;
        if (length != 0) {
            var PASSLENG = "{LANG_PASSLENG}";
            if (length < 5 || length > 21) {
                $("#password-availability-status").html("<span class='status-not-available'>" + PASSLENG + "</span>");
            }
            else {
                $("#password-availability-status").html("");
            }
        }

    }

    function checkRePassword() {
        if ($('#password').val() != $('#re_password').val()) {
            var PASS = "{LANG_PASS_NOT_MATCH}";
            $("#password-availability-status").html("<span class='status-not-available'>" + PASS + "</span>");
        } else {
            $("#password-availability-status").html("");
        }
    }

    jQuery(window).on('load',function (e) {
        jQuery('#password').val("");
    });
    jQuery(function($) {
        $("#category").on('change', function(){
            var catid = $(this).val();
            var selectid = $(this).data('subcat');
            var data = { action: "getsubcatbyid", catid: catid, selectid : selectid };
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: data,
                success: function(result){
                    $("#sub_category").html(result).selectpicker('refresh');
                }
            });
        });
        $("#category").trigger('change');
    });
</script>
<link href="{SITE_URL}templates/{TPL_NAME}/css/select2.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/{LANG_CODE}.js"></script>
<script>
    /* Get and Bind cities */
    $('#jobcity').select2({
        ajax: {
            url: ajaxurl + '?action=searchCityFromCountry',
            dataType: 'json',
            delay: 50,
            data: function (params) {
                return {
                    q: params.term, /* search term */
                    page: params.page
                };
            },
            processResults: function (data, params) {
                /*
                 // parse the results into the format expected by Select2
                 // since we are using custom formatting functions we do not need to
                 // alter the remote JSON data, except to indicate that infinite
                 // scrolling can be used
                 */
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 10) < data.totalEntries
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, /* let our custom formatter work */
        minimumInputLength: 2,
        templateResult: function (data) {
            return data.text;
        },
        templateSelection: function (data, container) {
            return data.text;
        }
    });
</script>
<link href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/bootstrap-datepicker.min.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/js/chart.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.{LANG_CODE}.min.js" charset="UTF-8"></script>

<script>
    Chart.defaults.global.defaultFontFamily = "Nunito";
    Chart.defaults.global.defaultFontColor = '#888';
    Chart.defaults.global.defaultFontSize = '14';

    var ctx = document.getElementById('chart').getContext('2d');

    var chart = new Chart(ctx, {
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June"],
            // Information about the dataset
            datasets: [{
                label: "Views",
                backgroundColor: 'rgba(42,65,232,0.08)',
                borderColor: '#2a41e8',
                borderWidth: "3",
                data: [196,132,215,362,210,252],
                pointRadius: 5,
                pointHoverRadius:5,
                pointHitRadius: 10,
                pointBackgroundColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointBorderWidth: "2",
            }]
        },

        // Configuration options
        options: {

            layout: {
                padding: 10,
            },

            legend: { display: false },
            title:  { display: false },

            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: false
                    },
                    gridLines: {
                        borderDash: [6, 10],
                        color: "#d8d8d8",
                        lineWidth: 1,
                    },
                }],
                xAxes: [{
                    scaleLabel: { display: false },
                    gridLines:  { display: false },
                }],
            },

            tooltips: {
                backgroundColor: '#333',
                titleFontSize: 13,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                bodyFontSize: 13,
                displayColors: false,
                xPadding: 10,
                yPadding: 10,
                intersect: false
            }
        },


    });

</script>
{OVERALL_FOOTER}

