{OVERALL_HEADER}

IF({SHOW_SEARCH_HOME}){
<div class="intro-banner" data-background-image="{SITE_URL}storage/banner/{BANNER_IMAGE}">
    <div class="container">
      
        <div class="row">
            <div class="col-md-12">
                <div class=" mb-5">
                    <h1><strong>{LANG_HOME_BANNER_HEADING}</strong>
                        <br>
                        <span>{LANG_HOME_BANNER_TAGLINE}</span></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form autocomplete="off" method="get" action="{LINK_LISTING}" accept-charset="UTF-8">
                    <div class="intro-banner-search-form margin-top-45">
                        <div class="intro-search-field with-label">
                            <label for="intro-keywords" class="field-title ripple-effect"><a>What job you want?</a></label>
                            
                            <input id="intro-keywords" type="text" class="qucikad-ajaxsearch-input"
                                   placeholder="{LANG_JOBTITLE_KEYWORD}" data-prev-value="0"
                                   data-noresult="{LANG_MORE_RESULTS_FOR}">
                            <i class="qucikad-ajaxsearch-close fa fa-times-circle" aria-hidden="true" style="display: none;"></i>
                            <div id="qucikad-ajaxsearch-dropdown" size="0" tabindex="0">
                                <ul>
                                    {LOOP: CATEGORY}
                                        <li class="qucikad-ajaxsearch-li-cats" data-catid="{CATEGORY.slug}">
                                            IF("{CATEGORY.picture}"==""){
                                            <i class="qucikad-as-caticon {CATEGORY.icon}"></i>
                                            {:IF}
                                            IF("{CATEGORY.picture}"!=""){
                                            <img src="{CATEGORY.picture}"/>
                                            {:IF}
                                            <span class="qucikad-as-cat">{CATEGORY.name}</span>
                                        </li>
                                    {/LOOP: CATEGORY}
                                </ul>

            <!-- Tabs Container -->
            <div class="tabs">
                <div class="tabs-header">
                    <ul>
                        <li class="active"><a href="#tab-1" data-tab-id="1">Find Workers</a></li>
                        <li><a href="#tab-2" data-tab-id="2">Find Jobs</a></li>
                        <li><a href="#tab-3" data-tab-id="3">Find Coordinators</a></li>
                    </ul>
                    <div class="tab-hover"></div>
                    <nav class="tabs-nav">
                        <span class="tab-prev"><i class="fa fa-arrow-left"></i></span>
                        <span class="tab-next"><i class="fa fa-arrow-right"></i></span>
                    </nav>
                </div>
                <!-- Tab Content -->
                <div class="tabs-content">
                    <div class="tab active" data-tab-id="1">
                    [{Insert Worker Search Bar}



                    </div>
                    <div class="tab" data-tab-id="2">

                        <form autocomplete="off" method="get" action="{LINK_LISTING}" accept-charset="UTF-8">
                            <div class="intro-banner-search-form">
                                <div class="intro-search-field with-label">
                                    <input id="intro-keywords" type="text" class="qucikad-ajaxsearch-input"
                                           placeholder="{LANG_JOBTITLE_KEYWORD}" data-prev-value="0"
                                           data-noresult="{LANG_MORE_RESULTS_FOR}">
                                    <i class="qucikad-ajaxsearch-close fa fa-times-circle" aria-hidden="true" style="display: none;"></i>
                                    <div id="qucikad-ajaxsearch-dropdown" size="0" tabindex="0">
                                        <ul>
                                            {LOOP: CATEGORY}
                                                <li class="qucikad-ajaxsearch-li-cats" data-catid="{CATEGORY.slug}">
                                                    IF("{CATEGORY.picture}"==""){
                                                    <i class="qucikad-as-caticon {CATEGORY.icon}"></i>
                                                    {:IF}
                                                    IF("{CATEGORY.picture}"!=""){
                                                    <img src="{CATEGORY.picture}"/>
                                                    {:IF}
                                                    <span class="qucikad-as-cat">{CATEGORY.name}</span>
                                                </li>
                                            {/LOOP: CATEGORY}
                                        </ul>

                                        <div style="display:none" id="def-cats">

                                        </div>
                                    </div>
                                </div>
                                <div class="intro-search-field live-location-search with-autocomplete with-label">

                                    <div class="input-with-icon">
                                        <input type="text" id="searchStateCity" name="location" placeholder="{LANG_WHERE}">
                                        <i class="icon-feather-map-pin"></i>
                                        <div data-option="{AUTO_DETECT_LOCATION}" class="loc-tracking"><i class="la la-crosshairs"></i></div>
                                        <input type="hidden" name="latitude" id="latitude" value="">
                                        <input type="hidden" name="longitude" id="longitude" value="">
                                        <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                        <input type="hidden" name="placeid" id="searchPlaceId" value="">
                                        <input type="hidden" id="input-keywords" name="keywords" value="">
                                        <input type="hidden" id="input-maincat" name="cat" value=""/>
                                        <input type="hidden" id="input-subcat" name="subcat" value=""/>
                                    </div>
                                </div>
                                <div class="intro-search-button">
                                    <button class="button ripple-effect ">{LANG_SEARCH}</button>
                                </div>
                            </div>
                        </div>
                        <div class="intro-search-field live-location-search with-autocomplete with-label">
                            
                        <label for="intro-keywords" class="field-title ripple-effect">What job you want?</label>    
                            <div class="input-with-icon">
                                <input type="text" id="searchStateCity" name="location" placeholder="{LANG_WHERE}">
                                <i class="icon-feather-map-pin"></i>
                                <div data-option="{AUTO_DETECT_LOCATION}" class="loc-tracking"><i class="la la-crosshairs"></i></div>
                                <input type="hidden" name="latitude" id="latitude" value="">
                                <input type="hidden" name="longitude" id="longitude" value="">
                                <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                <input type="hidden" name="placeid" id="searchPlaceId" value="">
                                <input type="hidden" id="input-keywords" name="keywords" value="">
                                <input type="hidden" id="input-maincat" name="cat" value=""/>
                                <input type="hidden" id="input-subcat" name="subcat" value=""/>
                            </div>
                        </div>
                        <div class="intro-search-button">
                            <button class="button ripple-effect ">{LANG_SEARCH}</button>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        <div class="row">
			<div class="text-white col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px ">
					<li>
						<strong class="counter ">1,586</strong>
						<span>Jobs Posted</span>
					</li>
					<li>
						<strong class="counter ">3,543</strong>
						<span>Tasks Posted</span>
					</li>
					<li>
						<strong class="counter ">1,232</strong>
						<span>Freelancers</span>
					</li>
				</ul>
			</div>
		</div>        
        
        
    </div>
</div>

<!-- Modal Cities -->

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
{:IF}


IF({SHOW_CATEGORIES_HOME}){
<!-- Category Boxes -->
<div class="section padding-top-65 padding-bottom-45 IF(!{SHOW_FEATURED_JOBS_HOME}){ gray {:IF}">
    <div class="container">
        <div class="row">
            IF("{LEFT_ADSTATUS}"=="1"){
            <div class="col-lg-2 text-center">
                <div class="advertisement" id="quickad-left">{LEFT_ADSCODE}</div>
            </div>
            {:IF}
            <div class="{CATEGORY_COLUMN}">
                IF("{TOP_ADSTATUS}"=="1"){
                <div class="text-center">
                    <div class="advertisement" id="quickjob-top">{TOP_ADSCODE}</div>
                </div>
                {:IF}
                <div class="section-headline centered margin-bottom-25">
                    <h3>{LANG_JOB_CATEGORIES}</h3>
                </div>
                <div class="categories-container">
                    {LOOP: CAT}
                        <a href="{CAT.catlink}" class="category-box">
                            <div class="category-box-icon">
                                IF("{CAT.picture}"==""){
                                <div class="category-icon"><i class="{CAT.icon}"></i></div>
                                {ELSE}
                                <div class="category-icon"><img src="{CAT.picture}"/></div>
                                {:IF}
                            </div>
                            <div class="category-box-counter">{CAT.main_ads_count}</div>
                            <div class="category-box-content">
                                <h3>{CAT.main_title} <small>({CAT.main_ads_count})</small></h3>
                                <p>Including {SUBCATEGORY}</p>
                            </div>
                            <div class="category-box-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                    {/LOOP: CAT}
                </div>
                IF("{BOTTOM_ADSTATUS}"=="1"){
                <div class="text-center">
                    <div class="advertisement" id="quickjob-bottom">{BOTTOM_ADSCODE}</div>
                </div>
                {:IF}
            </div>
            IF("{RIGHT_ADSTATUS}"=="1"){
            <div class="col-lg-2 text-center">
                <div class="advertisement" id="quickad-right">{RIGHT_ADSCODE}</div>
            </div>
            {:IF}
        </div>
    </div>
</div>
{:IF}


<!-- Features Cities -->
<div class="section margin-top-65 margin-bottom-65">
    <div class="container">
        <div class="row">

            <!-- Section Headline -->
            <div class="col-xl-12">
                <div class="section-headline centered margin-top-0 margin-bottom-45">
                    <h3>Featured Cities</h3>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <!-- Photo Box -->
                <a href="{LINK_JOB_SEEKERS}" class="photo-box" data-background-image="images/featured-city-01.jpg">
                    <div class="photo-box-content">
                        <h3>Sydney</h3>
                        <span>376 Carers</span>
                        <span>376 Jobs</span>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <!-- Photo Box -->
                <a href="{LINK_JOB_SEEKERS}" class="photo-box" data-background-image="images/featured-city-01.jpg">
                    <div class="photo-box-content">
                        <h3>Melbourne</h3>
                        <span>376 Carers</span>
                        <span>376 Jobs</span>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <!-- Photo Box -->
                <a href="{LINK_JOB_SEEKERS}" class="photo-box" data-background-image="images/featured-city-01.jpg">
                    <div class="photo-box-content">
                        <h3>Brisbane</h3>
                        <span>376 Carers</span>
                        <span>376 Jobs</span>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <!-- Photo Box -->
                <a href="{LINK_JOB_SEEKERS}" class="photo-box" data-background-image="images/featured-city-01.jpg">
                    <div class="photo-box-content">
                        <h3>Perth</h3>
                        <span>376 Carers</span>
                        <span>376 Jobs</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
<!-- Features Cities / End -->





IF({SHOW_FEATURED_JOBS_HOME}){
<!-- Features Jobs -->
<div class="section gray padding-top-65 padding-bottom-65">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-headline margin-top-0 margin-bottom-35">
                    <h3>{LANG_FEATURED_JOBS}</h3>
                    <a href="{LINK_LISTING}" class="headline-link">{LANG_BROWSE_ALL_JOBS}</a>
                </div>
                <div class="listings-container grid-layout margin-top-35">
                    {LOOP: ITEM}
                        <div class="job-listing IF({ITEM.highlight}){ highlight {:IF}">
                            <div class="job-listing-details">
                                <div class="job-listing-company-logo">
                                    <img src="{SITE_URL}storage/products/{ITEM.image}"
                                         alt="{ITEM.product_name}">
                                </div>
                                <div class="job-listing-description">
                                    IF({COMPANY_ENABLE}){
                                    <h4 class="job-listing-company">{ITEM.company_name}
                                    </h4>
                                    {:IF}

                                    <h3 class="job-listing-title"><a href="{ITEM.link}">{ITEM.product_name}</a>
                                        IF("{ITEM.featured}"=="1"){
                                        <div class="badge blue"> {LANG_FEATURED}</div> {:IF}
                                        IF("{ITEM.urgent}"=="1"){
                                        <div class="badge yellow"> {LANG_URGENT}</div> {:IF}
                                    </h3>
                                </div>
                                <span class="job-type"></span>
                            </div>
                            <div class="job-listing-footer">
                                <ul>
                                    <li><i class="la la-map-marker"></i> {ITEM.location}</li>
                                    IF("{ITEM.salary_min}"!="0"){
                                    <li><i class="la la-credit-card"></i> {ITEM.salary_min}
                                        -{ITEM.salary_max} {LANG_PER} {ITEM.salary_type}</li>
                                    {:IF}
                                    <li><i class="la la-clock-o"></i> {ITEM.created_at}</li>
                                    <li><i class="la la-clock-o"></i> {ITEM.product_type}</li>

                                </ul>
                            </div>
                        </div>
                           <span class=" job-type"><a href="{ITEM.link}">View Job</a></span>

                    {/LOOP: ITEM}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featured Jobs / End -->
{:IF}



<!-- Photo Section -->
<div class="photo-section" data-background-image="images/section-background.jpg">

    <!-- Infobox -->
    <div class="text-content white-font">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2>Hire experts or be hired. <br> For any job, any time.</h2>
                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation is on the runway towards.</p>
                    <a href="pages-pricing-plans.html" class="button button-sliding-icon ripple-effect big margin-top-20">Get Started <i class="icon-material-outline-arrow-right-alt"></i></a>
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->

</div>
<!-- Photo Section / End -->



IF({SHOW_LATEST_JOBS_HOME}){
<!-- Latest Jobs -->
<div class="section padding-top-65 padding-bottom-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-headline margin-top-0 margin-bottom-35">
                    <h3>{LANG_LATEST_JOBS}</h3>
                    <a href="{LINK_LISTING}" class="headline-link">{LANG_BROWSE_ALL_JOBS}</a>
                </div>
                <div class="listings-container compact-list-layout margin-top-35">
                    {LOOP: ITEM2}
                        <div class="job-listing IF({ITEM2.highlight}){ highlight {:IF}">
                            <div class="job-listing-details">
                                <div class="job-listing-company-logo">
                                    <img src="{SITE_URL}storage/products/{ITEM2.image}"
                                         alt="{ITEM2.product_name}">
                                </div>
                                <div class="job-listing-description">
                                    <h3 class="job-listing-title"><a href="{ITEM2.link}">{ITEM2.product_name}</a>
                                        IF("{ITEM2.featured}"=="1"){
                                        <div class="badge blue"> {LANG_FEATURED}</div> {:IF}
                                        IF("{ITEM2.urgent}"=="1"){
                                        <div class="badge yellow"> {LANG_URGENT}</div> {:IF}
                                    </h3>

                                    <div class="job-listing-footer">
                                        <ul>
                                            IF({COMPANY_ENABLE}){
                                            <li><i class="la la-building"></i> {ITEM2.company_name}</li>
                                            {:IF}
                                            <li><i class="la la-map-marker"></i> {ITEM2.location}</li>
                                            IF("{ITEM2.salary_min}"!="0"){
                                            <li><i class="la la-credit-card"></i> {ITEM2.salary_min}
                                                -{ITEM2.salary_max} {LANG_PER} {ITEM2.salary_type}</li>
                                            {:IF}
                                            <li><i class="la la-clock-o"></i> {ITEM2.created_at}</li>
                                            <li><i class="la la-clock-o"></i> {ITEM2.product_type}</li>

                                        </ul>
                                    </div>
                                </div>
                                <span class=" job-type"><a href="{ITEM2.link}">View Job</a></span>

                            </div>
                        </div>
                    {/LOOP: ITEM2}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest Jobs / End -->
{:IF}

IF({TESTIMONIALS_ENABLE} && {SHOW_TESTIMONIALS_HOME}){
<div class="section gray padding-top-55 padding-bottom-55">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <!-- Section Headline -->
                <div class="section-headline centered margin-top-0 margin-bottom-25">
                    <h3>{LANG_TESTIMONIALS}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="fullwidth-carousel-container margin-top-20">
        <div class="testimonial-carousel testimonials">
            {LOOP: TESTIMONIALS}
            <div class="single-testimonial">
                <div class="single-inner style-2">
                    <div class="testimonial-content">
                        {TESTIMONIALS.content}
                    </div>
                    <div class="author-info">
                        <div class="image"><img src="{SITE_URL}storage/testimonials/{TESTIMONIALS.image}"
                                                alt="{TESTIMONIALS.name}"></div>
                        <h5 class="name">{TESTIMONIALS.name}</h5>
                        <span class="designation">{TESTIMONIALS.designation}</span>
                    </div>
                </div>
            </div>
            {/LOOP: TESTIMONIALS}
        </div>
    </div>
</div>
{:IF}


IF({BLOG_ENABLE} && {SHOW_BLOG_HOME}){
<div class="section padding-top-55 padding-bottom-65">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-headline centered margin-top-0 margin-bottom-45">
                    <h3>{LANG_RECENT_BLOG}</h3>
                </div>
                <div class="listings-container grid-layout grid-layout-3">
                    {LOOP: RECENT_BLOG}
                        <div class="job-listing blog-listing">
                            <div class="job-listing-details">
                                IF({BLOG_BANNER}){
                                <div class="job-listing-company-logo">
                                    <a href="{RECENT_BLOG.link}"><img src="{SITE_URL}storage/blog/{RECENT_BLOG.image}"
                                                                      alt="{RECENT_BLOG.title}"></a>
                                </div>
                                {:IF}
                                <div class="job-listing-description">
                                    <div class="blog-cat">{RECENT_BLOG.categories}</div>
                                    <h3 class="job-listing-title"><a href="{RECENT_BLOG.link}">{RECENT_BLOG.title}</a>
                                    </h3>

                                    <p class="job-listing-text margin-top-10">{RECENT_BLOG.description}</p>
                                </div>
                            </div>
                            <div class="job-listing-footer">
                                <ul>
                                    <li><a href="{RECENT_BLOG.author_link}"><img
                                                    src="{SITE_URL}storage/profile/{RECENT_BLOG.author_pic}"
                                                    class="author-avatar"> {LANG_BY} {RECENT_BLOG.author}</a></li>
                                    <li><i class="la la-clock-o"></i> {RECENT_BLOG.created_at}</li>
                                </ul>
                            </div>
                        </div>
                    {/LOOP: RECENT_BLOG}
                </div>
            </div>
        </div>
    </div>
</div>
{:IF}


<div class="section border-top padding-top-45 padding-bottom-45">
    <!-- Logo Carousel -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <!-- Carousel -->
                <div class="col-md-12">
                    <div class="logo-carousel">
                        <div class="carousel-item">
                            <a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="{SITE_URL}storage/profile/{RECENT_BLOG.author_pic}" alt="Image 1"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="{SITE_URL}storage/profile/{RECENT_BLOG.author_pic}" alt="Image 2"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="{SITE_URL}storage/profile/{RECENT_BLOG.author_pic}" alt="Image 2"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="{SITE_URL}storage/profile/{RECENT_BLOG.author_pic}" alt="Image 2"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="{SITE_URL}storage/profile/{RECENT_BLOG.author_pic}" alt="Image 2"></a>
                        </div>
                    </div>
                </div>
                <!-- Carousel / End -->
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</div>

<script>
    var loginurl = "{LINK_LOGIN}?ref=index.php";
</script>
<script type='text/javascript' src='//maps.google.com/maps/api/js?key={GMAP_API_KEY}&#038;libraries=places%2Cgeometry&#038;ver=2.2.1'></script>

{OVERALL_FOOTER}