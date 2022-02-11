{OVERALL_HEADER}
<form method="get" action="{LINK_LISTING}" name="locationForm" id="ListingForm">
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{LANG_WE_FOUND} {ADSFOUND} {LANG_JOBS}</h2>
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
                            <div class="dropdown category-dropdown">
                                <a data-toggle="dropdown" href="#">
                                    <span class="change-text">{LANG_SELECT} {LANG_CATEGORY}</span><i class="fa fa-navicon"></i>
                                </a>
                                {CAT_DROPDOWN}
                            </div>
                        </div>
                        <div class="intro-search-field">
                            <input id="keywords" type="text" name="keywords" placeholder="{LANG_JOBTITLE_KEYWORD}" value="{KEYWORDS}">
                        </div>
                        <div class="intro-search-field with-autocomplete">
                            <div class="input-with-icon">
                                <input type="text" id="searchStateCity" name="location" placeholder="{LANG_WHERE}">
                                <i class="icon-feather-map-pin"></i>
                                <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                <input type="hidden" name="placeid" id="searchPlaceId" value="">
                                <input type="hidden" id="input-maincat" name="cat" value="{MAINCAT}"/>
                                <input type="hidden" id="input-subcat" name="subcat" value="{SUBCAT}"/>
                                <input type="hidden" id="input-filter" name="filter" value="{FILTER}"/>
                                <input type="hidden" id="input-sort" name="sort" value="{SORT}"/>
                                <input type="hidden" id="input-order" name="order" value="{ORDER}"/>
                            </div>
                        </div>
                        <div class="intro-search-button">
                            <button class="button ripple-effect">{LANG_SEARCH}</button>
                        </div>
                    </div>
                    <div class="hide-under-768px margin-top-20">
                        <ul class="categories-list">
                            {LOOP: SUBCATLIST}
                            <li>
                                <a href="{SUBCATLIST.link}">
                                    {SUBCATLIST.name}
                                </a>
                            </li>
                            {/LOOP: SUBCATLIST}
                        </ul>
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
                                <input id="inputStateCity" class="with-border" type="text" placeholder="{LANG_TYPE_YOUR_CITY}">
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
                        <span class="flag flag-{USER_COUNTRY}"></span> <a href="#countryModal" class="popup-with-zoom-anim">{LANG_CHANGE_COUNTRY}</a>
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
                    <!-- Job Types -->
                    <div class="sidebar-widget">
                        <h3>{LANG_JOB_TYPE}</h3>
                        <ul>
                            {LOOP: POSTTYPES}
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" id="job_type_{POSTTYPES.id}" name="job-type" value="{POSTTYPES.id}"
                                    IF('{JOB_TYPE}'=='{POSTTYPES.id}'){ checked {:IF}>
                                    <label for="job_type_{POSTTYPES.id}"><span class="checkbox-icon"></span> {POSTTYPES.title}</label>
                                </div>
                            </li>
                            {/LOOP: POSTTYPES}
                        </ul>
                    </div>
                    <div class="sidebar-widget">
                        <h3>{LANG_SALARY_TYPE}</h3>
                        <ul>
                            {LOOP: SALARYTYPES}
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" id="salary_type_{SALARYTYPES.id}" name="salary-type" value="{SALARYTYPES.id}" IF('{SALARY_TYPE}'=='{SALARYTYPES.id}'){ checked {:IF}>
                                    <label for="salary_type_{SALARYTYPES.id}"><span class="checkbox-icon"></span> {SALARYTYPES.title}</label>
                                </div>
                            </li>
                             {/LOOP: SALARYTYPES}
                        </ul>
                    </div>
                    <div class="sidebar-widget">
                        <h3>{LANG_SALARY}</h3>
                        <div class="range-widget">
                            <div class="range-inputs">
                                <input type="text" placeholder="{LANG_MIN}" name="range1" value="{RANGE1}">
                                <input type="text" placeholder="{LANG_MAX}" name="range2" value="{RANGE2}">
                            </div>
                            <button type="submit" class="button"><i class="icon-feather-arrow-right"></i></button>
                        </div>
                    </div>
                    {LOOP: CUSTOMFIELDS}
                        IF("{CUSTOMFIELDS.type}"=="text-field"){
                        <div class="sidebar-widget">
                            <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                            {CUSTOMFIELDS.textbox}
                        </div>
                    {:IF}
                        IF("{CUSTOMFIELDS.type}"=="textarea"){
                        <div class="sidebar-widget">
                            <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                            {CUSTOMFIELDS.textarea}
                        </div>
                    {:IF}
                        IF("{CUSTOMFIELDS.type}"=="drop-down"){
                        <div class="sidebar-widget">
                            <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                            <select class="selectpicker with-border" name="custom[{CUSTOMFIELDS.id}]">
                                <option value="" selected>{LANG_SELECT} {CUSTOMFIELDS.title}</option>
                                {CUSTOMFIELDS.selectbox}
                            </select>
                        </div>
                    {:IF}
                        IF("{CUSTOMFIELDS.type}"=="radio-buttons"){
                        <div class="sidebar-widget">
                            <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                            {CUSTOMFIELDS.radio}
                        </div>
                    {:IF}
                        IF("{CUSTOMFIELDS.type}"=="checkboxes"){
                        <div class="sidebar-widget">
                            <h3 class="label-title">{CUSTOMFIELDS.title}</h3>
                            {CUSTOMFIELDS.checkbox}
                        </div>
                    {:IF}
                    {/LOOP: CUSTOMFIELDS}
                    <div class="sidebar-widget">
                        <button class="button full-width ripple-effect">{LANG_ADVANCED_SEARCH}</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">

                <h3 class="page-title">{LANG_SEARCH_RESULTS}</h3>

                <div class="notify-box margin-top-15">
                   <span class="font-weight-600">{ADSFOUND} {LANG_JOBS_FOUND}</span>

                    <div class="sort-by">
                        <span>{LANG_SORT_BY}</span>
                        <select class="selectpicker hide-tick" id="sort-filter">
                            <option data-filter-type="sort" data-filter-val="id" data-order="desc">{LANG_NEWEST}</option>
                            <option data-filter-type="sort" data-filter-val="title" data-order="desc">{LANG_NAME}</option>
                            <option data-filter-type="sort" data-filter-val="date" data-order="desc">{LANG_DATE}</option>
                            <option data-filter-type="sort" data-filter-val="price" data-order="desc">{LANG_SALARY} ({LANG_HIGH_TO_LOW})</option>
                            <option data-filter-type="sort" data-filter-val="price" data-order="asc">{LANG_SALARY} ({LANG_LOW_TO_HIGH})</option>
                        </select>
                    </div>
                </div>

                <div class="listings-container margin-top-35">
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
                            <span class="job-type">{ITEM.product_type}</span>
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
                    </div>
                    {/LOOP: ITEM}
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
</form>
<script type="text/javascript">

    $('#sort-filter').on('change', function (e) {
        var $item = $(this).find(':selected');

        var filtertype = $item.data('filter-type');
        var filterval = $item.data('filter-val');
        $('#input-' + filtertype).val(filterval);
        $('#input-order').val($item.data('order'));
        $('#ListingForm').submit();
    });

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
{OVERALL_FOOTER}
