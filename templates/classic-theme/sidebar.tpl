<link href="{SITE_URL}templates/{TPL_NAME}/css/mystyle.css" rel="stylesheet"/>
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
                        <li  class="IF('{URISEGMENT}' == 'edit-profile'){ active active-submenu{:IF}"><a href="#"><i
                            class="icon-feather-edit"></i> {LANG_EDITPROFILE}</a>
                            IF('{USERTYPE}' == "user"){
                                <ul class="submenu submenu_cust">
                                    <li class="IF(('{URISEGMENT}' == 'edit-profile') AND ('{PAGEURI}' == '') ){ active {:IF}"><a href="{LINK_EDITPROFILE}">{LANG_PROFILE_DETAILS}</a></li>
                                    <li class="IF('{PAGEURI}' == 'bank-account'){ active {:IF}"><a href="{LINK_BANK_DETAILS}">{LANG_BANK_DETAILS}</a></li>
                                    <li class="IF('{PAGEURI}' == 'rate-and-availability'){ active {:IF}"><a href="{LINK_RATE_AVAILABILITY}">{LANG_RATE_AVAILABILITY}</a></li>
                                    <li class="IF('{PAGEURI}' == 'languages'){ active {:IF}"><a href="{LINK_LANGUAGES}">{LANG_LANGUAGES}</a></li>
                                    <li class="IF('{PAGEURI}' == 'cultural-backgrounds'){ active {:IF}"><a href="{LINK_CULTURAL_BACKGROUNDS}">{LANG_CULTURAL_BACKGROUNDS}</a></li>
                                    
                                </ul>
                            {:IF}     
                        </li>
                        
                        IF('{USERTYPE}' == "employer"){
                        <li><a href="{LINK_MEMBERSHIP}"><i
                                        class="icon-feather-gift"></i> {LANG_MEMBERSHIP}</a></li>
                        {:IF}
                    </ul>
                    
                  
                   
                    IF('{USERTYPE}'){
                    <ul data-submenu-title="{LANG_MY_JOBS}">
                        IF('{USERTYPE}' == "user"){
                        IF({RESUME_ENABLE}){
                        <li><a href="{LINK_RESUMES}"><i
                                        class="icon-feather-paperclip"></i> {LANG_MY_RESUMES} <span
                                        class="nav-tag">{RESUMES}</span></a></li>
                        {:IF}
                        <li><a href="{LINK_EXPERIENCES}"><i class="icon-feather-award"></i> {LANG_MY_EXPERIENCES}</a></li>
                        <li><a href="{LINK_APPLIED_JOBS}"><i class="icon-feather-briefcase"></i> {LANG_APPLIED_JOBS}
                                <span class="nav-tag">{APPLIEDJOBS}</span></a></li>
                        <li><a href="{LINK_FAVJOBS}"><i class="icon-feather-heart"></i> {LANG_FAV_JOBS}
                                <span class="nav-tag">{FAVORITEADS}</span></a></li>
                        <li><a href="{LINK_JOBALERT}"><i class="icon-feather-bell"></i> {LANG_JOB_ALERT}
                            </a></li>
                        ELSEIF('{USERTYPE}' == "employer"){
                        IF({COMPANY_ENABLE}){
                        <li><a href="{LINK_MYCOMPANIES}"><i
                                        class="icon-feather-box"></i> {LANG_MY_COMPANIES} <span
                                        class="nav-tag">{COMPANIES}</span></a></li>
                        {:IF}
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
                        <li><a href="{LINK_FAVUSERS}"><i class="icon-feather-heart"></i> {LANG_FAV_USERS}
                                <span class="nav-tag">{FAVORITEUSERSS}</span></a></li>
                        {:IF}
                    </ul>
                    {:IF}

                    <ul data-submenu-title="{LANG_ACCOUNT}">
                        IF('{QUICKAJAXCHAT}'=='on'){
                        <li><a href="{LINK_MESSAGE}"><i
                                        class="icon-feather-message-circle"></i> {LANG_MESSAGE}</a></li>
                        {:IF}
                        IF('{USERTYPE}' == "employer"){
                        <li><a href="{LINK_TRANSACTION}"><i
                                        class="icon-feather-file-text"></i> {LANG_TRANSACTIONS}</a></li>
                        {:IF}
                        <li><a href="{LINK_LOGOUT}"><i class="icon-feather-log-out"></i> {LANG_LOGOUT}
                            </a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>