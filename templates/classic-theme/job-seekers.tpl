{OVERALL_HEADER}
<form method="get" action="{LINK_JOB_SEEKERS}" name="locationForm" id="ListingForm">
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{LANG_WE_FOUND} {USERSFOUND} {LANG_USERS}</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                            IF("{MAINCATEGORY}"!=""){
                            <li>{MAINCATEGORY}</li>
                            {:IF}
                            IF("{SUBCATEGORY}"!=""){
                            <li>{SUBCATEGORY}</li>
                            {:IF}
                            IF("{MAINCATEGORY}{SUBCATEGORY}"==""){
                            <li>{LANG_ALL_CATEGORIES}</li>
                            {:IF}
                        </ul>
                    </nav>
                    <div class="intro-banner-search-form listing-page margin-top-30">
                        <!-- Search Field -->
                        <div class="intro-search-field">
                            <div class="dropudown category-dropdown">
                                <a data-toggle="dropdown" href="#">
                                    <span class="change-text">{LANG_SELECT} {LANG_CATEGORY}</span><i
                                            class="fa fa-navicon"></i>
                                </a>
                                {CAT_DROPDOWN}
                            </div>
                        </div>
                        <div class="intro-search-field">
                            <input id="keywords" type="text" name="keywords" placeholder="{LANG_USERNAME_KEYWORD}"
                                   value="{KEYWORDS}">
                        </div>
                        <div class="intro-search-field with-autocomplete">
                            <div class="input-with-icon">
                                <input type="text" id="searchStateCity" name="location" placeholder="{LANG_WHERE}">
                                <i class="la la-map-marker"></i>
                                <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                <input type="hidden" name="placeid" id="searchPlaceId" value="">
                                <input type="hidden" id="input-maincat" name="cat" value="{MAINCAT}"/>
                                <input type="hidden" id="input-subcat" name="subcat" value="{SUBCAT}"/>
                            </div>
                        </div>
                        <div class="intro-search-button">
                            <button class="button ripple-effect">{LANG_SEARCH}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="popup-with-zoom-anim hidden" href="#citiesModal" id="change-city">city</a>
    <div class="zoom-anim-dialog mfp-hide popup-dialog big-dialog" id="citiesModal">
        <div class="popup-tab-content padding-0">
            <div class="quick-states" id="country-popup" data-country-id="{DEFAULT_COUNTRY_ID}" style="display: block;">
                <div id="regionSearchBox" class="title clr">
                    <div class="clr">
                        <div class="locationrequest smallBox br5 col-sm-4">
                            <div class="rel input-container">
                                <div class="input-with-icon">
                                    <input id="inputStateCity" class="with-border" type="text"
                                           placeholder="{LANG_TYPE_YOUR_CITY}">
                                    <i class="la la-map-marker"></i>
                                </div>
                                <div id="searchDisplay"></div>
                                <div class="suggest bottom abs small br3 error hidden"><span
                                            class="target abs icon"></span>

                                    <p></p>
                                </div>
                            </div>
                            <div id="lastUsedCities" class="last-used binded" style="display: none;">{LANG_LAST_VISITED}
                                <ul id="last-locations-ul">
                                </ul>
                            </div>
                        </div>
                        IF("{COUNTRY_TYPE}"=="multi"){
                    <span style="line-height: 30px;">
                        <span class="flag flag-{USER_COUNTRY}"></span> <a href="#countryModal"
                                                                          class="popup-with-zoom-anim">{LANG_CHANGE_COUNTRY}</a>
                    </span>
                        {:IF}
                    </div>
                </div>
                <div class="popular-cities clr">
                    <p>{LANG_POPULAR_CITIES}</p>

                    <div class="list row">

                        <ul class="col-lg-12 col-md-12 popularcity">
                            {LOOP: POPULARCITY}
                            {POPULARCITY.tpl}
                            {/LOOP: POPULARCITY}
                        </ul>
                    </div>
                </div>
                <div class="viewport">
                    <div class="full" id="getCities">
                        <div class="col-sm-12 col-md-12 loader" style="display: none"></div>
                        <div id="results" class="animate-bottom">
                            <ul class="column cities">
                                {LOOP: STATELIST}
                                {STATELIST.tpl}
                                {/LOOP: STATELIST}
                            </ul>
                        </div>
                    </div>
                    <div class="table full subregionslinks hidden" id="subregionslinks"></div>
                </div>
            </div>
        </div>
    </div>
<!--More Filter Searches-->
    <div class="zoom-anim-dialog mfp-hide popup-dialog big-dialog" id="moreFilter">
        <div class="popup-tab-content padding-0">
            <div class="popup_model_header_cl">
                <h3>More Filter</h3>
            </div>
            <main class="l-index">                
                <div class="l-container">
                    <div class="accordion">
                        <ul class="accordion-list">
                            <li class="accordion-item">
                                <div class="accordion-container">
                                    <div class="js-accordion-header">
                                        <h2 class="accordion-title"><span>{LANG_LANGUAGES}</span></h2>
                                    </div>
                                    <div class="accordion-contents" style="display: none;">
                                        <div class="row">
                                            
                                            {LOOP: LANGS}
                                            <div class="col-md-3">
                                                <div class="check_box_group">
                                                    <input type="checkbox" class="languages_input" id="lang{LANGS.id}" value="{LANGS.id}" IF(in_array('{LANGS.id}',explode(", ",'{LANG_CHECKED}'))){ checked  {:IF}>                                
                                                    <label>{LANGS.name}</label>
                                                </div>
                                            </div>
                                            {/LOOP: LANGS} 
                                                
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion-item">
                                <div class="accordion-container">
                                    <div class="js-accordion-header">
                                        <h2 class="accordion-title"><span>{LANG_INTERESTS}</span></h2>
                                    </div>
                                    <div class="accordion-contents" style="display: none;">
                                        <div class="row">
                                            {LOOP: INTEREST}
                                            <div class="col-md-3">
                                                <div class="check_box_group">
                                                    <input type="checkbox" class="interests_input" id="inte{INTEREST.id}" value="{INTEREST.id}" IF(in_array('{INTEREST.id}',explode(", ",'{INTE_CHECKED}'))){ checked  {:IF}>
                                                    <label>{INTEREST.name}</label>
                                                </div>
                                            </div>
                                            {/LOOP: INTEREST}
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion-item">
                                <div class="accordion-container">
                                    <div class="js-accordion-header">
                                        <h2 class="accordion-title"><span>{LANG_RELIGION}</span></h2>
                                    </div>
                                    <div class="accordion-contents" style="display: none;">
                                        <div class="row">
                                            {LOOP: RELIGION}
                                            <div class="col-md-3">
                                                <div class="check_box_group">
                                                    <input type="checkbox" class="religions_input" id="reli{RELIGION.id}" value="{RELIGION.id}" IF(in_array('{RELIGION.id}',explode(", ",'{RELI_CHECKED}'))){ checked  {:IF}>
                                                    <label>{RELIGION.name}</label>
                                                </div>
                                            </div>
                                            {/LOOP: RELIGION}
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion-item">
                                <div class="accordion-container">
                                    <div class="js-accordion-header">
                                        <h2 class="accordion-title"><span>{LANG_CULTURAL_BACKGROUNDS}</span></h2>
                                    </div>
                                    <div class="accordion-contents" style="display: none;">
                                        <div class="row">
                                            {LOOP: CULTURAL_BACKGROUND}
                                            <div class="col-md-4">
                                                <div class="check_box_group">
                                                    <input type="checkbox" class="cultural_backgrounds_input" id="cult_back{CULTURAL_BACKGROUND.id}" value="{CULTURAL_BACKGROUND.id}" IF(in_array('{CULTURAL_BACKGROUND.id}',explode(", ",'{CULT_BACK_CHECKED}'))){ checked  {:IF}>
                                                    <label>{CULTURAL_BACKGROUND.name}</label>
                                                </div>
                                            </div>
                                            {/LOOP: CULTURAL_BACKGROUND}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                  <input type="button" class="button ripple-effect first" style="margin-top:10px; width:20%; margin-left: 4%;" value="Search Filter">
                </div>
            </main>
        </div>
    </div>
<!-- End More Filter Searches-->
<!--Modal More Filter--> 
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="filter-button-container">
                    <a href="javascript:void(0);" class="enable-filters-button">
                        <i class="enable-filters-button-icon"></i>
                        <span class="show-text">{LANG_ADVANCED_SEARCH}</span>
                        <span class="hide-text">{LANG_ADVANCED_SEARCH}</span>
                    </a>
                </div>
                <div class="sidebar-container search-sidebar">
                    <div class="sidebar-widget">
                        <h3>{LANG_AGE}</h3>
                        <div class="range-widget">
                            <input type="hidden" name="languages" id="lang_data" value="" >
                            <input type="hidden" name="interests" id="inte_data" value="">
                            <input type="hidden" name="religions" id="reli_data" value="">
                            <input type="hidden" name="cultural_backgrounds" id="cult_back" value="">
                            
                            <div class="range-inputs">
                                <input type="text" placeholder="{LANG_MIN}" name="age_range1" value="{AGE_RANGE1}">
                                <input type="text" placeholder="{LANG_MAX}" name="age_range2" value="{AGE_RANGE2}">
                            </div>
                            <button type="submit" class="button"><i class="icon-feather-arrow-right"></i></button>
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <h3>{LANG_EXPECTED_SALARY}</h3>
                        <div class="range-widget">
                            <div class="range-inputs">
                                <input type="text" placeholder="{LANG_MIN}" name="range1" value="{RANGE1}">
                                <input type="text" placeholder="{LANG_MAX}" name="range2" value="{RANGE2}">
                            </div>
                            <button type="submit" class="button"><i class="icon-feather-arrow-right"></i></button>
                        </div>
                        <small>{LANG_SALARY_PER_MONTH}</small>
                    </div>
                    <div class="sidebar-widget">
                        <h3>{LANG_GENDER}</h3>
                        <div class="radio margin-right-20">
                            <input class="with-gap" type="radio" name="gender" id="All" value="" IF('{GENDER}'==''){ checked {:IF} />
                            <label for="All"><span class="radio-label"></span>{LANG_ALL}</label>
                        </div><br>
                        <div class="radio margin-right-20">
                            <input class="with-gap" type="radio" name="gender" id="Male" value="Male" IF('{GENDER}'=='Male'){ checked {:IF} />
                            <label for="Male"><span class="radio-label"></span>{LANG_GENDER_MALE}</label>
                        </div><br>
                        <div class="radio margin-right-20">
                            <input class="with-gap" type="radio" name="gender" id="Female" value="Female" IF('{GENDER}'=='Female'){ checked {:IF} />
                            <label for="Female"><span class="radio-label"></span>{LANG_GENDER_FEMALE}</label>
                        </div><br>
                        <div class="radio margin-right-20">
                            <input class="with-gap" type="radio" name="gender" id="Other" value="Other" IF('{GENDER}'=='Other'){ checked {:IF} />
                            <label for="Other"><span class="radio-label"></span>{LANG_GENDER_OTHER}</label>
                        </div>
                    </div>
                    {LOOP: CUSTOMFIELDS}
                        IF("{CUSTOMFIELDS.type}"=="text-field" && "{CUSTOMFIELDS.custom_filter}"=="1"){
                            <div class="sidebar-widget">
                                <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                                {CUSTOMFIELDS.textbox}
                            </div>
                        {:IF}
                        IF("{CUSTOMFIELDS.type}"=="textarea" && "{CUSTOMFIELDS.custom_filter}"=="1"){
                            <div class="sidebar-widget">
                                <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                                {CUSTOMFIELDS.textarea}
                            </div>
                        {:IF}
                        IF("{CUSTOMFIELDS.type}"=="drop-down" && "{CUSTOMFIELDS.custom_filter}"=="1"){
                            <div class="sidebar-widget">
                                <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                                <select class="selectpicker with-border" name="custom[{CUSTOMFIELDS.id}]">
                                    <option value="" selected>{LANG_SELECT} {CUSTOMFIELDS.title}</option>
                                    {CUSTOMFIELDS.selectbox}
                                </select>
                            </div>
                        {:IF} 
                        IF("{CUSTOMFIELDS.type}"=="radio-buttons" && "{CUSTOMFIELDS.custom_filter}"=="1"){
                            <div class="sidebar-widget">
                                <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                                {CUSTOMFIELDS.radio}
                            </div>
                        {:IF}
                        IF("{CUSTOMFIELDS.type}"=="checkboxes" && "{CUSTOMFIELDS.custom_filter}"=="1"){
                            <div class="sidebar-widget">
                                <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                                {CUSTOMFIELDS.checkbox}
                            </div>
                        {:IF}
                    {/LOOP: CUSTOMFIELDS}
                    <div class="sidebar-widget">
                        <a class="popup-with-zoom-anim  button full-width ripple-effect" href="#moreFilter">More Filter search</a>
                        <!-- <button class="button full-width ripple-effect">{LANG_ADVANCED_SEARCH}</button> -->    
                    </div>
                    <div class="sidebar-widget">
                        <button class="button full-width ripple-effect second">{LANG_ADVANCED_SEARCH}</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <h3 class="page-title">{LANG_SEARCH_RESULTS}</h3>
                <div class="notify-box margin-top-15">
                    <span class="font-weight-600">{USERSFOUND} {LANG_USERS_FOUND} </span>.

                        IF("{USERSFOUND}"== 0){ <span> Try Posting a <b><a href="#">Job</a></b> or fill the form below and we will find workers for you. </span> {:IF}
                </div>
                IF("{USERSFOUND}"== 0){
                <div id="zf_div_ns8vUFATpUI0fnUHuNR1COcn6zVBuevaxaoaMQhU7Vw"></div><script type="text/javascript">(function() {
                        try{
                            var f = document.createElement("iframe");
                            f.src = 'https://forms.zohopublic.com/trilogycare/form/ServiceReferralForm/formperma/ns8vUFATpUI0fnUHuNR1COcn6zVBuevaxaoaMQhU7Vw?zf_rszfm=1';
                            f.style.border="none";
                            f.style.height="1260px";
                            f.style.width="100%";
                            f.style.transition="all 0.5s ease";
                            var d = document.getElementById("zf_div_ns8vUFATpUI0fnUHuNR1COcn6zVBuevaxaoaMQhU7Vw");
                            d.appendChild(f);
                            window.addEventListener('message', function (){
                                var evntData = event.data;
                                if( evntData && evntData.constructor == String ){
                                    var zf_ifrm_data = evntData.split("|");
                                    if ( zf_ifrm_data.length == 2 ) {
                                        var zf_perma = zf_ifrm_data[0];
                                        var zf_ifrm_ht_nw = ( parseInt(zf_ifrm_data[1], 10) + 15 ) + "px";
                                        var iframe = document.getElementById("zf_div_ns8vUFATpUI0fnUHuNR1COcn6zVBuevaxaoaMQhU7Vw").getElementsByTagName("iframe")[0];
                                        if ( (iframe.src).indexOf('formperma') > 0 && (iframe.src).indexOf(zf_perma) > 0 ) {
                                            var prevIframeHeight = iframe.style.height;
                                            if ( prevIframeHeight != zf_ifrm_ht_nw ) {
                                                iframe.style.height = zf_ifrm_ht_nw;
                                            }
                                        }
                                    }
                                }
                            }, false);
                        }catch(e){}
                    })();</script>
                {:IF}

                <div class="listings-container margin-top-35">
                    {LOOP: ITEM}
                        <div class="job-listing">
                            <div class="job-listing-details">
                                <div class="job-listing-company-logo">
                                    <a href="{LINK_PROFILE}/{ITEM.username}">
                                        <img src="{SITE_URL}storage/profile/{ITEM.image}" alt="{ITEM.name}">
                                    </a>
                                </div>
                                <div class="job-listing-description">
                                    <h3 class="job-listing-title"><a href="{LINK_PROFILE}/{ITEM.username}">{ITEM.name}</a>
                                        IF('{ITEM.sex}' == 'Male'){
                                        <span class="gender-badge male" title="{LANG_GENDER_MALE}" data-tippy-placement="top"><i class="la la-mars"></i></span>
                                        ELSEIF('{ITEM.sex}' == 'Female'){
                                        <span class="gender-badge female" title="{LANG_GENDER_FEMALE}" data-tippy-placement="top"><i class="la la-venus"></i></span>
                                        ELSEIF('{ITEM.sex}' == 'Other'){
                                        <span class="gender-badge other" title="{LANG_GENDER_OTHER}" data-tippy-placement="top"><i class="la la-transgender"></i></span>
                                        {:IF}
                                    </h3>
                                    <p class="job-listing-text">{ITEM.description}</p>
                                </div>
                                IF('{USERTYPE}' == 'employer'){
                                <span class="fav-icon set-user-fav IF('{ITEM.favorite}' == '1'){ added {:IF}" data-favuser-id="{ITEM.id}" data-userid="{USER_ID}" data-action="setFavUser"></span>
                                {:IF}
                            </div>
                            <div class="job-listing-footer">
                                <ul>
                                    IF('{ITEM.city}' != ''){
                                    <li><i class="la la-map-marker"></i> {ITEM.city}</li>
                                    {:IF}
                                    IF('{ITEM.category}' != ''){
                                    <li><i class="icon-feather-folder"></i> {ITEM.category}
                                        IF('{ITEM.subcategory}' != ''){
                                        / {ITEM.subcategory}
                                        {:IF}</li>
                                    {:IF}
                                    IF("{ITEM.salary_min}"!="0"){
                                    <li data-tippy-placement="top" title="{LANG_SALARY_PER_MONTH}"><i class="la la-credit-card"></i> {ITEM.salary_min}
                                        IF('{ITEM.salary_max}' != ''){
                                        - {ITEM.salary_max}
                                        {:IF}</li>
                                    {:IF}
                                </ul>
                            </div>
                        </div>
                    {/LOOP: ITEM}
                    <div class="clearfix"></div>
                    IF("{USERSFOUND}"!="0"){
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
</form>

<div class="gray section padding-top-65 padding-bottom-65">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <!-- Section Headline -->
                <div class="section-headline centered margin-top-0 margin-bottom-5">
                    <h3>How It Works?</h3>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <!-- Icon Box -->
                <div class="icon-box with-line">
                    <!-- Icon -->
                    <div class="icon-box-circle">
                        <div class="icon-box-circle-inner">
                            <i class="fa fa-home"></i>
                            <div class="icon-box-check">1</div>
                        </div>
                    </div>
                    <h3>Register as a Carer</h3>
                    <p>Build your Carer profile and add your locations, availability and rate range.</p>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <!-- Icon Box -->
                <div class="icon-box with-line">
                    <!-- Icon -->
                    <div class="icon-box-circle">
                        <div class="icon-box-circle-inner">
                            <i class="fa fa-home"></i>
                            <div class="icon-box-check">2</div>
                        </div>
                    </div>
                    <h3>Search Jobs</h3>
                    <p>Browse Jobs in your region..</p>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <!-- Icon Box -->
                <div class="icon-box">
                    <!-- Icon -->
                    <div class="icon-box-circle">
                        <div class="icon-box-circle-inner">
                            <i class="fa fa-home"></i>
                            <div class="icon-box-check">3</div>
                        </div>
                    </div>
                    <h3>Message and Agree</h3>
                    <p>Nanotechnology immersion along the information highway will close the loop on focusing solely.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counters -->
<div class="section  padding-bottom-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="counters-container">
                    <!-- Counter -->
                    <div class="single-counter">
                        <i class="icon-line-awesome-suitcase"></i>
                        <div class="counter-inner">
                            <h3><span class="counter">1,586</span></h3>
                            <span class="counter-title">Jobs Posted</span>
                        </div>
                    </div>
                    <!-- Counter -->
                    <div class="single-counter">
                        <i class="icon-line-awesome-legal"></i>
                        <div class="counter-inner">
                            <h3><span class="counter">3,543</span></h3>
                            <span class="counter-title">Tasks Posted</span>
                        </div>
                    </div>
                    <!-- Counter -->
                    <div class="single-counter">
                        <i class="icon-line-awesome-user"></i>
                        <div class="counter-inner">
                            <h3><span class="counter">2,413</span></h3>
                            <span class="counter-title">Active Members</span>
                        </div>
                    </div>
                    <!-- Counter -->
                    <div class="single-counter">
                        <i class="icon-line-awesome-trophy"></i>
                        <div class="counter-inner">
                            <h3><span class="counter">99</span>%</h3>
                            <span class="counter-title">Satisfaction Rate</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Counters / End -->

<script type="text/javascript">
    var getMaincatId = '{MAINCAT}';
    var getSubcatId = '{SUBCAT}';

    $(window).bind("load", function () {
        if (getMaincatId != "") {
            $('li a[data-cat-type="maincat"][data-ajax-id="' + getMaincatId + '"]').trigger('click');
        } else if (getSubcatId != "") {
            $('li ul li a[data-cat-type="subcat"][data-ajax-id="' + getSubcatId + '"]').trigger('click');
        } else {
            $('li a[data-cat-type="all"]').trigger('click');
        }
    });
</script>

<script>
const $target = $('.js-accordion-header');
const ACTIVE_CLASS = 'is-active';
const visible = $('.accordion-contents:visible');

$target.on('click', function () {
  const $this = $(this);

  $this.toggleClass(ACTIVE_CLASS);
  $this.siblings('.accordion-contents').stop().slideToggle();

  if ($this.hasClass(ACTIVE_CLASS)) {
    // $target.removeClass(ACTIVE_CLASS);
    // $this.addClass(ACTIVE_CLASS);
    // visible.stop().slideUp(); comment this out if you want to close an accordion item if you open other items
  }
});
</script>
<script>
    jQuery("input.first[type=button]").click(function(){
    jQuery("#ListingForm").submit();
    return false;
});

</script>
<script>
    //Languages Function
    $(".languages_input").on('click', function() {
    // console.log($(this).val());/
    let languagesInputs = $(".languages_input:checked");
    let languages = '';
    if(languagesInputs.length) {
        languagesInputs.each( (ind, el) => {
            languages += $(el).val() + ", ";
        });
    }
    $("#lang_data").val(languages.slice(0, -2));
    console.log(languages.slice(0, -2));
    // console.log(languagesInputs);
    });
    
    // Interests Function
    $(".interests_input").on('click', function() {
    // console.log($(this).val());/
    let interestsInputs = $(".interests_input:checked");
    let interests = '';
    if(interestsInputs.length) {
        interestsInputs.each( (ind, el) => {
            interests += $(el).val() + ", ";
        });
    }
    $("#inte_data").val(interests.slice(0, -2));
    console.log(interests.slice(0, -2));
    // console.log(interestsInputs);
    });

    //Religion Function
    $(".religions_input").on('click', function() {
    // console.log($(this).val());/
    let religionsInputs = $(".religions_input:checked");
    let religions = '';
    if(religionsInputs.length) {
        religionsInputs.each( (ind, el) => {
            religions += $(el).val() + ", ";
        });
    }
    $("#reli_data").val(religions.slice(0, -2));
    console.log(religions.slice(0, -2));
    // console.log(religionsInputs);
    });

    //Cultural-Background Function
    $(".cultural_backgrounds_input").on('click', function() {
    // console.log($(this).val());/
    let cultural_backgroundsInputs = $(".cultural_backgrounds_input:checked");
    let cultural_backgrounds = '';
    if(cultural_backgroundsInputs.length) {
        cultural_backgroundsInputs.each( (ind, el) => {
            cultural_backgrounds += $(el).val() + ", ";
        });
    }
    $("#cult_back").val(cultural_backgrounds.slice(0, -2));
    console.log(cultural_backgrounds.slice(0, -2));
    // console.log(cultural_backgroundsInputs);
    });
</script>
{OVERALL_FOOTER}

<style>

    .accordion {
 
    box-shadow: inherit !important;
}
    
    .accordion-header.is-active:hover {
      transform: scale(1);
    }
    
    .accordion-title {
      font-size: 28px;
      letter-spacing: 0.08em;
    }
    
    .accordion-contents {
      padding: 5px 0px;
    }
    
    .js-accordion-header .accordion-title {
        font-size: 16px;
    margin-bottom: 2px;

    padding: 15px;
    border-radius: 0px;
    cursor: pointer;
    background-color: white;
    position: relative;
}

.js-accordion-header .accordion-title 

.js-accordion-header .accordion-title:hover{    background-color: lightgrey;}

main.l-index {
    padding: 6px;
    padding-top: 5px;
    background-color: #f3f3f36b;
}

.accordion-container{border-radius: 0px !important;}

#moreFilter .mfp-close {
    position: absolute;
    top: 0px !important;
    right: 0;
}

.l-index .accordion-contents {
    background-color: #e7e7e7;
    margin-bottom: 2px;
    padding: 10px 25px;
}

.is-active .accordion-title:before {
    content: "";
    position: absolute;
    background-color: #e7e7e7;
    height: 15px;
    width: 15px;
    bottom: -12px;
    transform: rotate(45deg);
}

.popup_model_header_cl {
    padding: 15px 15px;
    border-bottom: 1px solid #e3e3e3;
}
/* .popup_model_header_cl h3{} */

.check_box_group input {
    background-color: transparent !important;
    box-shadow: inherit !important;
    height: auto !important;
    width: auto;
}

.check_box_group label{width: auto;
    display: inline;}


    .check_box_group {
    margin-bottom: 4px;
}

.check_box_group label{    font-size: 14px;
    margin-left: 5px;}
    
</style>