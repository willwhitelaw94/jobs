{OVERALL_HEADER}
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <h2>{ITEM_TITLE}
                    IF("{ITEM_FEATURED}"=="1"){ <div class="badge blue"> {LANG_FEATURED}</div> {:IF}
                    IF("{ITEM_URGENT}"=="1"){ <div class="badge yellow"> {LANG_URGENT}</div> {:IF}
                    IF("{ITEM_HIGHLIGHT}"=="1"){ <div class="badge red"> {LANG_HIGHLIGHT}</div> {:IF}
                </h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li><a href="{ITEM_CATLINK}">{ITEM_CATEGORY}</a></li>
                        IF('{ITEM_SUB_CATEGORY}'){
                        <li><a href="{ITEM_SUBCATLINK}">{ITEM_SUB_CATEGORY}</a></li>
                        {:IF}
                    </ul>
                </nav>
            </div>
            <div class="col-md-5 col-sm-12">
              <div class="right-side">
                IF({LOGGED_IN}){
                    IF('{USERTYPE}' == 'user'){
                        IF('{ITEM_APPLICATION_URL}' != ''){
                            <a href="{ITEM_APPLICATION_URL}" class="button ripple-effect" target="_blank" rel="nofollow">{LANG_APPLY_NOW} <i class="icon-feather-arrow-right"></i></a>
                        {ELSE}
                            IF('{ALREADY_APPLIED}' == '1'){
                            <button class="button green disabled" disabled><i class="icon-feather-check"></i> {LANG_ALREADY_APPLIED}</button>
                            {ELSE}
                            <a href="#apply-now-dialog" class="button ripple-effect popup-with-zoom-anim">{LANG_APPLY_NOW} <i class="icon-feather-arrow-right"></i></a>
                            {:IF}
                        {:IF}
                    {:IF}
                {ELSE}
                    <a href="#sign-in-dialog" class="button ripple-effect popup-with-zoom-anim">{LANG_APPLY_NOW} <i class="icon-feather-arrow-right"></i></a>
                {:IF}
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
    <div class="row">

        <!-- Content -->
        <div class="col-xl-8 col-lg-8 content-right-offset">
            IF('{ITEM_IMAGE}'){
            <div class="job-header">
                <div class="header-image"><img src="{SITE_URL}storage/products/{ITEM_IMAGE}" alt="{ITEM_TITLE}"></div>
                <div class="header-details">
                    <h3>{ITEM_TITLE}</h3>
                    IF("{ITEM_FEATURED}"=="1"){ <div class="badge blue"> {LANG_FEATURED}</div> {:IF}
                    IF("{ITEM_URGENT}"=="1"){ <div class="badge yellow"> {LANG_URGENT}</div> {:IF}
                    IF("{ITEM_HIGHLIGHT}"=="1"){ <div class="badge red"> {LANG_HIGHLIGHT}</div> {:IF}
                </div>
            </div>
            {:IF}
          <div class="single-page-section">
            <h3>{LANG_JOB_OVERVIEW}</h3>
            <div class="row">
              <div class="col-md-6">
                <div class="job-property">
                    <i class="la la-map-marker"></i>
                    <span>{LANG_LOCATION}</span>
                    <h5>{ITEM_CITY}, {ITEM_STATE}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="job-property">
                  <i class="la la-suitcase"></i>
                  <span>{LANG_JOB_TYPE}</span>
                  <h5>{ITEM_PRODUCT_TYPE}</h5>
              </div>
          </div>
                IF('{ITEM_SALARY_MIN}' != '0'){
                <div class="col-md-6">
                    <div class="job-property">
                        <i class="la la-credit-card"></i>
                        <span>{LANG_SALARY}</span>
                        <h5>{ITEM_SALARY_MIN} - {ITEM_SALARY_MAX} {LANG_PER} {ITEM_SALARY_TYPE}
                            IF('{ITEM_NEGOTIATE}' != ''){
                            <div class="badge green">{ITEM_NEGOTIATE}</div>
                            {:IF}
                        </h5>
                    </div>
                </div>
                {:IF}
            <div class="col-md-6">
                <div class="job-property">
                    <i class="la la-clock-o"></i>
                    <span>{LANG_DATE_POSTED}</span>
                    <h5>{ITEM_CREATED}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="single-page-section">
        <h3>{LANG_ADDITIONAL_DETAILS}</h3>
        <div class="row">
            IF("{ITEM_HIDE_PHONE}"=="no" && '{ITEM_PHONE}'){
            <div class="col-md-6">
                <div class="job-property">
                    <i class="la la-phone"></i>
                    <span>{LANG_PHONE_NUMBER}</span>
                    <h5>{ITEM_PHONE}</h5>
                </div>
            </div>
            {:IF}
            <div class="col-md-6">
                <div class="job-property">
                    <i class="icon-feather-hash"></i>
                    <span>{LANG_JOB_ID}</span>
                    <h5>{ITEM_ID}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="job-property">
                    <i class="icon-feather-eye"></i>
                    <span>{LANG_JOB_VIEWS}</span>
                    <h5>{ITEM_VIEW}</h5>
                </div>
            </div>
            IF("{ITEM_CUSTOMFIELD}"!="0"){

            {LOOP: ITEM_CUSTOM}
            <div class="col-md-6">
                <div class="job-property">
                    <i class="icon-feather-chevron-right"></i>
                    <span>{ITEM_CUSTOM.title}</span>
                    <h5>{ITEM_CUSTOM.value}</h5>
                </div>
            </div>
            {/LOOP: ITEM_CUSTOM}
            {:IF}

            {LOOP: ITEM_CUSTOM_CHECKBOX}
            <div class="col-md-6">
            <div class="job-property">
                <i class="icon-feather-chevron-right"></i>
                <span>{ITEM_CUSTOM_CHECKBOX.title}</span>
                <h5 class="row">{ITEM_CUSTOM_CHECKBOX.value}</h5>
            </div>
            </div>
            {/LOOP: ITEM_CUSTOM_CHECKBOX}
            </div>
            {LOOP: ITEM_CUSTOM_TEXTAREA}
            <div class="job-property">
                <i class="icon-feather-chevron-right"></i>
                <span>{ITEM_CUSTOM_TEXTAREA.title}</span>
                <h5>{ITEM_CUSTOM_TEXTAREA.value}</h5>
            </div>
            {/LOOP: ITEM_CUSTOM_TEXTAREA}
         
    </div>

    <div class="single-page-section">
        <h3>{LANG_JOB_DESCRIPTION}</h3>
        <div class="user-html">{ITEM_DESC}</div>
    </div>
    IF({SHOW_TAG}){
    <div class="single-page-section">
        <h3>{LANG_TAGS}</h3>
        <div class="job-tags">
            {ITEM_TAG}
        </div>
    </div>
    {:IF}
    <div class="single-page-section">
        <h3>{LANG_LOCATION}</h3>
        <div id="single-job-map-container">
            <div class="map-widget map" id="singleListingMap" data-latitude="{ITEM_LAT}" data-longitude="{ITEM_LONG}"></div>
            IF('{ITEM_LOCATION}' != ''){
            <br><span><a href="https://maps.google.com/?q={ITEM_LOCATION}" target="_blank" rel="nofollow">{ITEM_LOCATION}</a></span>
            {:IF}
        </div>
    </div>
</div>
<!-- Sidebar -->
<div class="col-xl-4 col-lg-4">
    <div class="sidebar-container">
        <!-- Sidebar Widget -->
        <div class="sidebar-widget">
            <div class="job-detail-box">
                <div class="job-detail-box-headline text-center">
                    IF({COMPANY_ENABLE}){
                    {LANG_COMPANY_DETAILS}
                    {ELSE}
                    {LANG_EMPLOYER_DETAILS}
                    {:IF}
                </div>
                <div class="job-detail-box-inner">
                  <div class="job-company-logo">
                    <a href="{COMPANY_LINK}">
                      <img src="{COMPANY_IMAGE}" alt="{COMPANY_NAME}">
                  </a>
              </div>
              <h2><a href="{COMPANY_LINK}">{COMPANY_NAME}</a></h2>
              <ul>
                IF('{COMPANY_CITY}' != ''){
                <li>
                  <i class="la la-map-marker"></i>
                  <span>{COMPANY_CITY}, {COMPANY_STATE}</span>
              </li>
              {:IF}
              IF(!{HIDE_CONTACT}){
              IF('{COMPANY_EMAIL}' != ''){
              <li>
                  <i class="la la-envelope"></i>
                  <span><a href="mailto:{COMPANY_EMAIL}" rel="nofollow">{COMPANY_EMAIL}</a></span>
              </li>
              {:IF}
              IF('{COMPANY_PHONE}' != ''){
              <li>
                  <i class="icon-feather-phone-call"></i>
                  <span><a href="tel:{COMPANY_PHONE}" rel="nofollow">{COMPANY_PHONE}</a></span>
              </li>
              {:IF}
              {:IF}
              IF('{COMPANY_WEBSITE}' != ''){
              <li>
                  <i class="icon-feather-link"></i>
                  <span><a href="{COMPANY_WEBSITE}" target="_blank" rel="nofollow">{COMPANY_WEBSITE}</a></span>
              </li>
              {:IF}
          </ul>
          IF({LOGGED_IN}){
                IF('{USERTYPE}' == 'user'){
                    IF('{ITEM_APPLICATION_URL}' != ''){
                        <a href="{ITEM_APPLICATION_URL}" class="button ripple-effect full-width" target="_blank" rel="nofollow">{LANG_APPLY_NOW} <i class="icon-feather-arrow-right"></i></a>
                    {ELSE}
                        IF('{ALREADY_APPLIED}' == '1'){
                            <button class="button full-width green disabled" disabled><i class="icon-feather-check"></i> {LANG_ALREADY_APPLIED}</button>
                        {ELSE}
                            <a href="#apply-now-dialog" class="button ripple-effect popup-with-zoom-anim apply-dialog-button full-width">{LANG_APPLY_NOW} <i class="icon-feather-arrow-right"></i></a>
                        {:IF}
                    {:IF}
                    IF('{ZECHAT_ON_OFF}'=='on' || '{QUICKCHAT_SOCKET_ON_OFF}'=='on' || '{QUICKCHAT_AJAX_ON_OFF}'=='on'){
                    <button type="button" class="button ripple-effect full-width margin-top-10 start_zechat zechat-hide-under-768px"
                            data-chatid="{ITEM_AUTHORID}_{ITEM_ID}"
                            data-postid="{ITEM_ID}"
                            data-userid="{ITEM_AUTHORID}"
                            data-username="{ITEM_AUTHORUNAME}"
                            data-fullname="{ITEM_AUTHORNAME}"
                            data-userimage="{ITEM_AUTHORIMG}"
                            data-userstatus="{ITEM_AUTHORONLINE}"
                            data-posttitle="{ITEM_TITLE}"
                            data-postlink="{ITEM_LINK}">{LANG_CHAT_NOW} <i class="icon-feather-message-circle"></i></button>
                    <a href="{QUICKCHAT_URL}" class="button ripple-effect full-width margin-top-10 zechat-show-under-768px">{LANG_CHAT_NOW} <i class="icon-feather-message-circle"></i></a>
                    {:IF}
                {:IF}
            {ELSE}
                <a href="#sign-in-dialog" class="button ripple-effect popup-with-zoom-anim full-width">{LANG_APPLY_NOW} <i class="icon-feather-arrow-right"></i></a>
                <a href="#sign-in-dialog" class="button ripple-effect popup-with-zoom-anim full-width margin-top-10">{LANG_LOGIN_CHAT} <i class="icon-feather-message-circle"></i></a>
            {:IF}
      </div>
  </div>
</div>

<!-- Sidebar Widget -->
<div class="sidebar-widget">
    <h3>{LANG_BOOKMARK_SHARE}</h3>
    IF('{USERTYPE}' == 'user'){
    <button class="fav-button margin-bottom-20 set-item-fav IF('{ITEM_FAVORITE}' == '1'){ added {:IF}" data-item-id="{ITEM_ID}" data-userid="{USER_ID}" data-action="setFavAd">
        <span class="fav-icon"></span>
        <span class="fav-text">{LANG_SAVE_THIS_JOB}</span>
        <span class="added-text">{LANG_JOB_SAVED}</span>
    </button>
    {:IF}

    <!-- Share Buttons -->
    <ul class="share-buttons-icons">
        <li><a href="mailto:?subject={ITEM_TITLE}&body={ITEM_LINK}" data-button-color="#dd4b39" title="{LANG_SHARE_EMAIL}" data-tippy-placement="top" rel="nofollow" target="_blank"><i class="fa fa-envelope"></i></a></li>
        <li><a href="https://facebook.com/sharer/sharer.php?u={ITEM_LINK}" data-button-color="#3b5998" title="{LANG_SHARE_FACEBOOK}" data-tippy-placement="top" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="https://twitter.com/share?url={ITEM_LINK}&text={ITEM_TITLE}" data-button-color="#1da1f2" title="{LANG_SHARE_TWITTER}" data-tippy-placement="top" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i></a></li>
        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={ITEM_LINK}" data-button-color="#0077b5" title="{LANG_SHARE_LINKEDIN}" data-tippy-placement="top" rel="nofollow" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        <li><a href="https://pinterest.com/pin/create/bookmarklet/?&url={ITEM_LINK}&description={ITEM_TITLE}" data-button-color="#bd081c" title="{LANG_SHARE_PINTEREST}" data-tippy-placement="top" rel="nofollow" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
        <li><a href="https://web.whatsapp.com/send?text={ITEM_LINK}" data-button-color="#25d366" title="{LANG_SHARE_WHATSAPP}" data-tippy-placement="top" rel="nofollow" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
    </ul>
</div>
<div class="sidebar-widget">
  <h3>{LANG_MORE_INFO}</h3>
  <ul class="related-links">
      IF({COMPANY_ENABLE}){
      <li>
          <a href="{COMPANY_LINK}#all-jobs"><i class="la la-suitcase"></i> {LANG_MORE_JOBS_BY} {COMPANY_NAME}</a>
      </li>
      {:IF}
      <li>
          <a href="{USER_LINK}#all-jobs"><i class="fa fa-user-circle-o"></i> {LANG_MORE_JOBS_BY} {USER_NAME}</a>
      </li>
  <li>
      <a href="{LINK_REPORT}"><i class="la la-exclamation-triangle"></i> {LANG_REPORT_THIS_JOB}</a>
  </li>
</ul>
</div>
</div>
</div>
IF({TOTAL_ITEMS}!=0){
<div class="col-md-12 margin-top-30">
  <div class="single-page-section">
    <h3 class="margin-bottom-25">{LANG_SIMILAR_JOBS}</h3>
    <div class="listings-container grid-layout">
        {LOOP: ITEM}
        <div class="job-listing">
            <div class="job-listing-details">
                <div class="job-listing-company-logo">
                    <img src="{SITE_URL}storage/products/{ITEM.image}" alt="{ITEM.company_name}">
                </div>
                <div class="job-listing-description">
                    <h4 class="job-listing-company">{ITEM.company_name}</h4>
                    <h3 class="job-listing-title"><a href="{ITEM.link}">{ITEM.product_name}</a>
                        IF("{ITEM.featured}"=="1"){ <div class="badge blue"> {LANG_FEATURED}</div> {:IF}
                        IF("{ITEM.urgent}"=="1"){ <div class="badge yellow"> {LANG_URGENT}</div> {:IF}
                    </h3>
                </div>
                <span class="job-type">{ITEM.product_type}</span>
            </div>
            <div class="job-listing-footer">
                <ul>
                    <li><i class="la la-map-marker"></i> {ITEM.cityname}</li>
                    IF("{ITEM.salary_min}"!="0"){
                    <li><i class="la la-credit-card"></i> {ITEM.salary_min}-{ITEM.salary_max} {LANG_PER} {ITEM.salary_type}</li>
                    {:IF}
                    <li><i class="la la-clock-o"></i> {ITEM.created_at}</li>
                </ul>
            </div>
        </div>
        {/LOOP: ITEM}
    </div>
</div>
</div>
{:IF}
</div>
</div>

<div id="apply-now-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs popup-dialog">
    <ul class="popup-tabs-nav">
        <li><a href="#tab">{LANG_APPLY_NOW}</a></li>
    </ul>
    <div class="popup-tabs-container">
        <div class="popup-tab-content" id="tab">
            IF({SHOW_APPLY_FORM}){
            <form method="post" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                IF("{ERROR}"!=""){
                <span class="status-not-available">{ERROR}</span>
                {:IF}
                <div class="submit-field">
                    <h5>{LANG_MESSAGE} *</h5>
                    <textarea cols="30" rows="3" class="with-border" name="message" required=""></textarea>
                  </div>
                IF({RESUME_ENABLE}){
              <div class="submit-field">
                <h5>{LANG_RESUMES} *</h5>
                <ul>
                {LOOP: RESUMES}
                <li>
                <div class="radio">
                    <input id="resume-{RESUMES.id}" name="resume" class="resume-file" type="radio" value="{RESUMES.id}">
                    <label for="resume-{RESUMES.id}"><span class="radio-label"></span> {RESUMES.name} - <a href="{SITE_URL}storage/resumes/{RESUMES.filename}" download="">{LANG_DOWNLOAD}</a></label>
                </div>
                </li>
                {/LOOP: RESUMES}
                <li>
                <div class="radio">
                    <input id="resume-0" name="resume" class="new-resume resume-file" type="radio" value="0" checked>
                    <label for="resume-0"><span class="radio-label"></span> {LANG_ADD_RESUME}</label>
                </div>
                </li>
                </ul>
              </div>
                <div class="uploadButton resume-upload-button">
                    <input class="uploadButton-input" type="file" id="resume" name="resume_file"/>
                      <label class="uploadButton-button ripple-effect" for="resume">{LANG_UPLOAD_RESUME}</label>
                      <span class="uploadButton-file-name">{LANG_RESUME_FILE_TYPE}</span>
                </div>
                {:IF}
                <button class="button margin-top-35 full-width button-sliding-icon ripple-effect" name="submit" type="submit">{LANG_APPLY_NOW} <i class="icon-feather-arrow-right"></i></button>
            </form>
            {ELSE}
            <h2 class="margin-bottom-20">{LANG_NOTIFY}</h2>
            <p>{LANG_EMAIL_VERIFY_MSG}</p>
            {:IF}
        </div>
    </div>
</div>
<script async="async">
    $('.resume-file').on('change',function(){
        if($('.new-resume').is(':checked')){
            $('.resume-upload-button').slideDown('fast');
        }else{
            $('.resume-upload-button').slideUp('fast');
        }
    });
    $('.resume-file').trigger('change');

    IF("{ERROR}"!=""){
        $(window).on('load',function () {
            $('.apply-dialog-button').trigger('click');
        });
    {:IF}
</script>

IF("{MAP_TYPE}"=="google"){
<link href="{SITE_URL}templates/{TPL_NAME}/css/map/map-marker.css" type="text/css" rel="stylesheet">
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript' src='//maps.google.com/maps/api/js?key={GMAP_API_KEY}&#038;libraries=places%2Cgeometry&#038;ver=2.2.1'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/richmarker-compiled.js'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/markerclusterer_packed.js'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/gmapAdBox.js'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/maps.js'></script>
<script>
    var _latitude = '{ITEM_LAT}';
    var _longitude = '{ITEM_LONG}';
    var element = "singleListingMap";
    var path = '{SITE_URL}templates/{TPL_NAME}/';
    var getCity = false;
    var color = '{MAP_COLOR}';
    var site_url = '{SITE_URL}';
    simpleMap(_latitude, _longitude, element);
</script>
{ELSE}
<script>
    var openstreet_access_token = '{OPENSTREET_ACCESS_TOKEN}';
</script>
<link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/js/map/openstreet/css/style.css">
<!-- Leaflet // Docs: https://leafletjs.com/ -->
<script src="{SITE_URL}templates/{TPL_NAME}/js/map/openstreet/leaflet.min.js"></script>
<!-- Leaflet Maps Scripts (locations are stored in leaflet-quick.js) -->
<script src="{SITE_URL}templates/{TPL_NAME}/js/map/openstreet/leaflet-markercluster.min.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/js/map/openstreet/leaflet-gesture-handling.min.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/js/map/openstreet/leaflet-quick.js"></script>
<!-- Leaflet Geocoder + Search Autocomplete // Docs: https://github.com/perliedman/leaflet-control-geocoder -->
<script src="{SITE_URL}templates/{TPL_NAME}/js/map/openstreet/leaflet-autocomplete.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/js/map/openstreet/leaflet-control-geocoder.js"></script>
{:IF}
{OVERALL_FOOTER}
