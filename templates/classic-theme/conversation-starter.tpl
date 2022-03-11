
{OVERALL_HEADER}
<style>
a.button {
    padding: 5px 10px;
    font-size: 14px; 
}
</style>
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2>{LANG_MY_CONVERSATION}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li>{LANG_MY_CONVERSATION}</li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-4"></div>
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
                    <!-- Headline -->
                    <div class="headline">
                        <div class="dashboard-avatar-box">
                            <img src="{SITE_URL}storage/profile/{WORKER_AVATAR}" alt="{WORKER_NAME}">
                            <div>
                                <h3>{WORKER_NAME}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="content with-padding">
                        <div>
                            <h3>{LANG_MY_CONVERSATION}</h3>
                            <p>Start conversation with a description of the support you are looking for.</p>
                        </div>
                    </div>
                </div>
                <div class="listings-container compact-list-layout margin-top-35">
                    {LOOP: ITEM}
                    <div class="job-listing IF({ITEM.highlight}){ highlight {:IF}">
                        <div class="job-listing-details">
                            <div class="job-listing-company-logo">
                                <img src="{SITE_URL}storage/products/{ITEM.image}" alt="{ITEM.product_name}">
                            </div>
                            <div class="job-listing-description">
                                IF({COMPANY_ENABLE}){
                                <h4 class="job-listing-company">{ITEM.company_name}</h4>
                                {:IF}
                                <h3 class="job-listing-title"><a href="{ITEM.link}">{ITEM.product_name}</a>
                                    IF("{ITEM.featured}"=="1"){ <div class="badge blue"> {LANG_FEATURED}</div> {:IF}
                                    IF("{ITEM.urgent}"=="1"){ <div class="badge yellow"> {LANG_URGENT}</div> {:IF}
                                </h3>
                                <p class="job-listing-text">{ITEM.description}</p>
                            </div>
                           
                            <!-- <span class="job-type">{ITEM.product_type}</span> -->
                        </div>
                        <div class="job-listing-footer with-icon">
                            <ul>
                                <li><i class="la la-map-marker"></i> {ITEM.city}, {ITEM.state}</li>
                                IF("{ITEM.salary_min}"!="0"){
                                <li><i class="la la-credit-card"></i> {ITEM.salary_min} - {ITEM.salary_max} {LANG_PER} {ITEM.salary_type}</li>
                                {:IF}
                                <li><i class="la la-clock-o"></i> {ITEM.created_at}</li>
                            </ul>
                            IF('{USERTYPE}' == 'user'){
                            <span class="fav-icon set-item-fav IF('{ITEM.favorite}'){ added {:IF}" data-item-id="{ITEM.id}" data-userid="{USER_ID}" data-action="setFavAd"></span>
                            {:IF}
                        </div>
                        <div class="">
                             <div class="task-tags">
                                <a href="{LINK_EDIT-JOB}/{ITEM.id}" class="button ripple-effect">Review / Edit</a>
                                <a href=" {ITEM.quickchat_url}" class="button dark ripple-effect">Send to {WORKER_NAME}</a>
                            </div>
                        </div>
                    </div>
                    {/LOOP: ITEM}
                </div>
                <div class="clearfix"></div>
                IF("{ADSFOUND}"!="0"){
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Pagination -->
                            <div class="pagination-container margin-top-20 margin-bottom-60">
                                <nav class="pagination">
                                    <ul>
                                        {LOOP: PAGES}
                                        IF("{PAGES.current}"=="0"){
                                        <li><a href="{PAGES.link}">{PAGES.title}</a></li>
                                        {ELSE}
                                        <li><a href="#" class="current-page">{PAGES.title}</a></li>
                                        {:IF}
                                        {/LOOP: PAGES}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                {:IF}
            </div>
        </div>
    </div>
</div>

<link media="all" rel="stylesheet" type="text/css"
      href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/styles/simditor.css"/>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/mobilecheck.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/module.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/uploader.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/hotkeys.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/simditor.js"></script>
<link href="{SITE_URL}templates/{TPL_NAME}/css/select2.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/{LANG_CODE}.js"></script>

<link href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.{LANG_CODE}.min.js" charset="UTF-8"></script>
{OVERALL_FOOTER}
