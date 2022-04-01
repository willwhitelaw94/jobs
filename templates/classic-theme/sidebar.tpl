<link href="{SITE_URL}templates/{TPL_NAME}/css/mystyle.css" rel="stylesheet"/>
<style>
.dashboard-nav ul li.active-submenu ul {
    max-height: 450px !important;
}
</style>

<div class="dashboard-sidebar">
    <div class="dashboard-sidebar-inner">
        <div class="dashboard-nav-container">
            <a href="#" class="dashboard-responsive-nav-trigger">
                <span class="hamburger hamburger--collapse">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
                </span>
                <span class="trigger-title">{LANG_DASH_NAVIGATION}</span>
            </a>
            <div class="dashboard-nav">
                <div class="dashboard-nav-inner">
                    <ul data-submenu-title="{LANG_MY_ACCOUNT}">
                        <li class="IF('{URISEGMENT}' == 'dashboard'){ echo active {:IF}"><a href="{LINK_DASHBOARD}"><i
                                        class="icon-feather-grid"></i> {LANG_DASHBOARD}</a></li>
                        IF('{QUICKAJAXCHAT}'=='on'){
                        <li class="IF('{URISEGMENT}' == 'message'){ active {:IF}"><a href="{LINK_MESSAGE}"><i
                                        class="icon-feather-message-circle"></i> {LANG_MESSAGE}s</a></li>
                        <li class=""><a href="{LINK_WALLET}"><i
                        class="icon-feather-briefcase"></i> {LANG_WALLET}</a></li>
                        {:IF}
                        IF('{USERTYPE}' == "employer"){
                        IF({COMPANY_ENABLE}){
                        <li><a href="{LINK_FAVUSERS}"><i class="icon-feather-heart"></i> {LANG_FAV_USERS}
                                <span class="nav-tag">{FAVORITEUSERSS}</span></a></li>

                        {:IF}
                        {:IF}

                    </ul>
                   
                    IF('{USERTYPE}'){
                    <ul data-submenu-title="{LANG_MY_JOBS}">
                        IF('{USERTYPE}' == "user"){
                        IF({RESUME_ENABLE}){
                        <li class="IF('{URISEGMENT}' == 'my-resumes'){ active {:IF}"><a href="{LINK_RESUMES}"><i
                                        class="fa fa-envelope-open"></i> {LANG_MY_RESUMES} <span class="nav-tag">{RESUMES}</span></a></li>
                        {:IF}

                        <li><a href="{LINK_FAVJOBS}"><i class="icon-feather-heart"></i> {LANG_FAV_JOBS}
                                <span class="nav-tag">{FAVORITEADS}</span></a></li>
                        <li><a href="{LINK_APPLIED_JOBS}"><i class="icon-feather-briefcase"></i> {LANG_APPLIED_JOBS}
                                <span class="nav-tag">{APPLIEDJOBS}</span></a></li>

                        <li><a href="{LINK_ACCEPTED_JOBS}"><i class="fa fa-check-circle"></i> Accepted Job
                                <span class="nav-tag">0</span></a></li>

                        ELSEIF('{USERTYPE}' == "employer"){
                        <li><a href="{LINK_MYCOMPANIES}"><i
                                        class="icon-feather-box"></i> My Clients <span
                                        class="nav-tag">{COMPANIES}</span></a></li>
                        <li><a href="{LINK_MYJOBS}"><i
                                        class="icon-feather-briefcase"></i> {LANG_MY_JOBS} <span
                                        class="nav-tag">{MYADS}</span></a></li>
                        <li><a href="{LINK_PENDINGJOBS}"><i
                                        class="icon-feather-clock"></i> {LANG_PENDING_JOBS} <span
                                        class="nav-tag">{PENDINGADS}</span></a></li>
                        <li><a href="{LINK_HIDDENJOBS}"><i
                                        class="icon-feather-eye-off"></i> {LANG_HIDDEN_JOBS} <span
                                        class="nav-tag">{HIDDENADS}</span></a></li>
                        <li><a href="{LINK_EXPIREJOBS}"><i
                                        class="icon-feather-alert-octagon"></i> {LANG_EXPIRED_JOBS}
                                <span class="nav-tag">{EXPIREADS}</span></a></li>
                        <li><a href="{LINK_RESUBMITJOBS}"><i
                                        class="icon-feather-rotate-cw"></i> {LANG_RESUBMITTED_JOBS}
                                <span class="nav-tag">{RESUBMITADS}</span></a></li>

                        {:IF}
                    </ul>
                    {:IF}
                    <ul data-submenu-title="Transactions">

                        <li class="IF('{PAGEURI}' == 'bank-account'){ active {:IF}">
                            <a href="{LINK_BANK_DETAILS}">
                                <i class="fa fa-bank"></i>
                                {LANG_BANK_DETAILS}</a></li>


                        <li class="IF('{PAGEURI}' == 'timesheets'){ active {:IF}">
                            <a href="{LINK_TIMESHEET}">
                                <i class="fa fa-clock-o"></i>
                                Timesheets</a></li>

                        <li class="IF('{PAGEURI}' == 'timesheets'){ active {:IF}">
                            <a href="{LINK_INVOICE}">
                                <i class="fa fa-file"></i>
                                Invoices</a></li>

                        <li class="IF('{PAGEURI}' == 'timesheets'){ active {:IF}">
                            <a href="{LINK_REVIEW}">
                                <i class="fa fa-star"></i>
                                Reviews</a></li>

                        IF('{USERTYPE}' == "employer"){
                        <li><a href="{LINK_MEMBERSHIP}"><i
                                        class="icon-feather-gift"></i> {LANG_MEMBERSHIP}</a></li>

                        <li><a href="{LINK_TRANSACTION}"><i
                                        class="icon-feather-file-text"></i> {LANG_TRANSACTIONS}</a></li>
                        {:IF}

                        IF('{USERTYPE}' == "user"){

                        {:IF}



                    </ul>
                    <ul data-submenu-title="{LANG_ACCOUNT}">
                        IF('{USERTYPE}' == "user"){
                        <li  class="IF('{URISEGMENT}' == 'edit-profile'){ active active-submenu{:IF}"><a href="#"><i
                                        class="icon-feather-edit"></i> {LANG_EDITPROFILE}</a>
                            <ul class="submenu submenu_cust">
                                <li class="IF(('{URISEGMENT}' == 'edit-profile') AND ('{PAGEURI}' == '') ){ active {:IF}"><a href="{LINK_EDITPROFILE}">{LANG_PROFILE_DETAILS}</a></li>
                                <li class="IF('{PAGEURI}' == 'rate-and-availability'){ active {:IF}"><a href="{LINK_RATE_AVAILABILITY}">{LANG_RATE_AVAILABILITY}</a></li>
                                <li class="IF('{PAGEURI}' == 'languages'){ active {:IF}"><a href="{LINK_LANGUAGES}">{LANG_LANGUAGES}</a></li>
                                <li class="IF('{PAGEURI}' == 'cultural-backgrounds'){ active {:IF}"><a href="{LINK_CULTURAL_BACKGROUNDS}">{LANG_CULTURAL_BACKGROUNDS}</a></li>
                                <li class="IF('{PAGEURI}' == 'religion'){ active {:IF}"><a href="{LINK_RELIGION}">{LANG_RELIGION}</a></li>
                                <li class="IF('{PAGEURI}' == 'my-experiences'){ active {:IF}"><a href="{LINK_EXPERIENCES}">{LANG_MY_EXPERIENCES}</a></li>
                                <li class="IF('{PAGEURI}' == 'my-educations'){ active {:IF}"><a href="{LINK_EDUCATIONS}">{LANG_MY_EDUCATIONS}</a></li>
                                <li class="IF('{PAGEURI}' == 'my-skills'){ active {:IF}"><a href="{LINK_SKILLS}">{LANG_SKILLS}</a></li>
                                <li class="IF('{PAGEURI}' == 'immunisation-info'){ active {:IF}"><a href="{LINK_IMMUNISATION_INFO}">{LANG_IMMUNISATION_INFO}</a></li>
                                <li class="IF('{PAGEURI}' == 'about-me'){ active {:IF}"><a href="{LINK_ABOUT_ME}">{LANG_ABOUT_ME}</a></li>
                                <li class="IF('{PAGEURI}' == 'preference'){ active {:IF}"><a href="{LINK_PREFERENCE}">{LANG_PREFERENCE}</a></li>
                                IF({CUSTOM_FIELD_ENABLE}){
                                    <li class="IF('{PAGEURI}' == 'user-custom-fields'){ active {:IF}"><a href="{LINK_USER_CUSTOM_FIELDS}">{LANG_CUSTOM_FIELDS} </a></li>
                                {:IF}
                            </ul>
                        </li>
                        ELSEIF('{USERTYPE}' == "employer"){
                        <li class="IF(('{URISEGMENT}' == 'edit-profile') AND ('{PAGEURI}' == '') ){ active {:IF}"><a href="{LINK_EDITPROFILE}">{LANG_PROFILE_DETAILS}</a></li>
                        {:IF}

                        <li class="IF('{PAGEURI}' == 'user-documents'){ echo active {:IF}"><a href="{LINK_MY_DOCUMENTS}"><i
                        class="fa fa-file-text "></i> Documents</a></li>

                        <li class="IF('{PAGEURI}' == 'account'){ echo active {:IF}"><a href="{LINK_ACCOUNT}"><i
                                        class="fa fa-user "></i> Account Details</a></li>

                        <li><a href="{LINK_JOBALERT}"><i class="icon-feather-bell"></i> Notifications
                            </a></li>
                        <li><a href="{LINK_LOGOUT}"><i class="icon-feather-log-out"></i> {LANG_LOGOUT}
                            </a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>