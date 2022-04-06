{OVERALL_HEADER}
{BREADCRUMBS}
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
                        <h3><i class="icon-feather-users"></i> {LANG_MYCLIENTS}</h3>
                    </div>
                    IF(!{TOTALITEM}){
                    <div class="content with-padding text-center">
                        {LANG_NO_USERS_FOUND}
                    </div>
                    {:IF}
                </div>
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
                                    <span class="gender-badge male" title="{LANG_GENDER_MALE}"
                                          data-tippy-placement="top"><i class="la la-mars"></i></span>
                                    ELSEIF('{ITEM.sex}' == 'Female'){
                                    <span class="gender-badge female" title="{LANG_GENDER_FEMALE}"
                                          data-tippy-placement="top"><i class="la la-venus"></i></span>
                                    ELSEIF('{ITEM.sex}' == 'Other'){
                                    <span class="gender-badge other" title="{LANG_GENDER_OTHER}"
                                          data-tippy-placement="top"><i class="la la-transgender"></i></span>
                                    {:IF}
                                </h3>
                              
                                <p class="job-listing-text read-more-toggle" data-read-more="{LANG_READ_MORE}" data-read-less="{LANG_READ_LESS}">{ITEM.description}</p>
                            </div>
                          
                        </div>
                        <div class="job-listing-footer with-icon">
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
                                IF('{ITEM.phone}' != ''){
                                    <li><i class="icon-feather-phone"></i>  {ITEM.phone}<li>
                                {:IF}
                                <!-- IF('{ITEM.phone}' != ''){
                                    <li><i class="icon-feather-message-square"></i> Request a review<li>
                                {:IF}
                                -->
                            </ul>
                            
                            <span class="fav-icon set-user-fav IF('{ITEM.favorite}' == '1'){ added {:IF}"
                                  data-favuser-id="{ITEM.client_id}" data-userid="{USER_ID}"
                                  data-action="setFavUser"></span>

                                  

                        </div>
                    </div>
                    {/LOOP: ITEM}
                    <div class="clearfix"></div>
                    IF("{TOTALITEM}"!="0"){
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
</div>
{OVERALL_FOOTER}
