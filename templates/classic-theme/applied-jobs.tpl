{OVERALL_HEADER}
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{LANG_APPLIED_JOBS}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li>{LANG_APPLIED_JOBS}</li>
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
                <div class="dashboard-box margin-top-0">
                    <!-- Headline -->
                    <div class="headline">
                        <h3><i class="icon-feather-briefcase"></i> {LANG_APPLIED_JOBS}</h3>
                    </div>
                    IF(!{TOTALITEM}){
                    <div class="content with-padding text-center">
                        {LANG_NO_JOBS_FOUND}
                    </div>
                    {:IF}
                </div>
                <div class="listings-container margin-top-30">
                    {LOOP: ITEM}
                        <div class="job-listing fav-listing">
                            <div class="job-listing-details">
                                <div class="job-listing-company-logo">
                                    <img src="{SITE_URL}storage/products/{ITEM.image}" alt="{ITEM.product_name}">
                                </div>
                                <div class="job-listing-description">
                                    IF({COMPANY_ENABLE}){
                                    <h4 class="job-listing-company">{ITEM.company_name}</h4>
                                    {:IF}
                                    <h3 class="job-listing-title"><a href="{ITEM.link}">{ITEM.product_name}</a></h3>
                                    <p class="job-listing-text">{ITEM.desc}</p>
                                </div>
                                <span class="job-type">{ITEM.product_type}</span>
                            </div>
                            <div class="job-listing-footer with-icon">
                                <ul>
                                    <li><i class="la la-map-marker"></i> {ITEM.location}</li>
                                    IF("{ITEM.salary_min}"!="0"){
                                    <li><i class="la la-credit-card"></i> {ITEM.salary_min}-{ITEM.salary_max} {LANG_PER} {ITEM.salary_type}</li>
                                    {:IF}
                                    <li><i class="la la-clock-o"></i> {ITEM.created_at}</li>
                                </ul>
                                <span class="fav-icon added set-item-fav" data-item-id="{ITEM.id}" data-userid="{USER_ID}" data-action="removeFavAd"></span>
                            </div>
                        </div>
                    {/LOOP: ITEM}

                    <!-- Pagination -->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Pagination -->
                            <div class="pagination-container margin-top-20">
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
                </div>
            </div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}