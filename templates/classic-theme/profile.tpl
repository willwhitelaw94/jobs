{OVERALL_HEADER}

<style>

.card_box_cl .card-header h3{font-size: 16px;
  font-weight: 600;
  color: #333;
  line-height: 26px;}
.card_box_cl {
    margin-bottom: 15px;
}
.badge-warning-light{

}
.selected_languages{}
.selected_languages li{    width: 29%;     margin-bottom: 5px;}
.selected_languages li span{      background-color: rgb(255 189 54 / 21%);
    border-radius: 31px;
    padding: 6px 13px;
    color: #2e2e2e;
    font-size: 14px;
    font-weight: 500;
    border: 1px solid #ffc14380;}

    .selected_languages li span i{    background-color: #ffbd36;
    color: white;
    height: 20px;
    display: inherit;
    width: 20px;
    border-radius: 50%;
    line-height: 20px;}

</style>

<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-page-section">
                    <div class="single-page-inner">
                        <div class="single-page-image"><img src="{SITE_URL}storage/profile/{USERIMAGE}" alt="{FULLNAME}"></div>
                        <div class="single-page-details">
                            <h3>{FULLNAME}</h3>
                            <li><div class="ml-2 verified-badge-with-title">Verified</div></li>

                            <ul>
                                <li>
                                    <span>
                                    <i class="icon-feather-map-pin"></i>
                                   {CITYNAME}{STATENAME}</span>
                                </li>
                                IF('{CATEGORY}' != ''){
                                <li>
                                    <span>
                                    <i class="icon-feather-folder"></i>
                                    {CATEGORY}
                                    IF('{SUBCATEGORY}' != ''){
                                    / {SUBCATEGORY}
                                        {:IF}
                                </span>
                                </li>
                                {:IF}
                                <li>
                                    <span>
                                    <i class="icon-feather-clock"></i>
                                    {LANG_MEMBER_SINCE} {CREATED}</span>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-xl-8 col-lg-8">
            <div class="row">
                <div class="col-md-6"
                <div class="single-page-section">
                    <h3 class="margin-bottom-25">About Me</h3>

                    {ABOUT}
                </div>

            </div>

            <!-- Boxed List / End -->
            IF({TOTAL_EXPERIENCES}){
            <div class="boxed-list margin-bottom-60" id="all-jobs">
                <div class="boxed-list-headline">
                    <h3><i class="icon-feather-award"></i> {LANG_EXPERIENCES}</h3>
                </div>
                <div class="listings-container compact-list-layout margin-top-30">
                    {LOOP: EXPERIENCES}
                        <div class="job-listing">
                            <div class="job-listing-details">
                                <div class="job-listing-description">
                                    <h4 class="job-listing-company">{EXPERIENCES.company}</h4>
                                    <h3 class="job-listing-title">{EXPERIENCES.title}</h3>
                                    <p class="job-listing-text read-more-toggle" data-read-more="{LANG_READ_MORE}" data-read-less="{LANG_READ_LESS}">{EXPERIENCES.description}</p>
                                </div>
                            </div>
                            <div class="job-listing-footer margin-top-10">
                                <ul>
                                    <li><i class="la la-clock-o"></i> {EXPERIENCES.start_date} - {EXPERIENCES.end_date}</li>
                                    <li><i class="la la-map-marker"></i> {EXPERIENCES.city}</li>
                                </ul>
                            </div>
                        </div>
                    {/LOOP: EXPERIENCES}
                </div>
            </div>
            {:IF}

            IF({TOTALITEM}){
            <div class="boxed-list margin-bottom-60" id="all-jobs">
                <div class="boxed-list-headline">
                    <h3><i class="icon-feather-briefcase"></i> {LANG_ALL_JOBS}</h3>
                </div>
                <div class="listings-container compact-list-layout margin-top-30">
                    {LOOP: ITEM}
                        <a href="{ITEM.link}" class="job-listing">
                            <div class="job-listing-details">
                                <div class="job-listing-description">
                                    <h3 class="job-listing-title">{ITEM.name}
                                        IF("{ITEM.featured}"=="1"){ <div class="badge blue"> {LANG_FEATURED}</div> {:IF}
                                        IF("{ITEM.urgent}"=="1"){ <div class="badge yellow"> {LANG_URGENT}</div> {:IF}
                                        IF("{ITEM.highlight}"=="1"){ <div class="badge red"> {LANG_HIGHLIGHT}</div> {:IF}
                                    </h3>
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="la la-map-marker"></i> {ITEM.city}</li>
                                            IF("{ITEM.salary_min}"!="0"){
                                            <li><i class="la la-credit-card"></i> {ITEM.salary_min}-{ITEM.salary_max}</li>
                                            {:IF}
                                            <li><i class="la la-clock-o"></i> {ITEM.created_at}</li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="job-type">{ITEM.product_type}</span>
                            </div>
                        </a>
                    {/LOOP: ITEM}
                </div>
                IF({SHOW_PAGING}){
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
                {:IF}
            </div>
            {:IF}


            <!-- Boxed List -->
            <div class="row">
                <div class="col-md-6">
                    <h3 class="">Reviews</h3>
                    <div class="boxed-list margin-bottom-60">


                <div class="boxed-list-headline">
                    <h3><i class="icon-material-outline-thumb-up"></i> Ratings</h3>
                </div>
                <ul class="boxed-list-ul">
                    <li>
                        <div class="boxed-list-item m-t-15">
                            <!-- Content -->
                            <div class="item-content">
                                <h4>Web, Database and API Developer <span>Rated as Freelancer</span></h4>
                                <div class="item-details margin-top-10">
                                    <div class="star-rating" data-rating="5.0"></div>
                                    <div class="detail-item"><i class="icon-material-outline-date-range"></i> August 2019</div>
                                </div>
                                <div class="item-description">
                                    <p>Excellent programmer - fully carried out my project in a very professional manner. </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="boxed-list-item">
                            <!-- Content -->
                            <div class="item-content">
                                <h4>WordPress Theme Installation <span>Rated as Freelancer</span></h4>
                                <div class="item-details margin-top-10">
                                    <div class="star-rating" data-rating="5.0"></div>
                                    <div class="detail-item"><i class="icon-material-outline-date-range"></i> June 2019</div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>

                <!-- Pagination -->
                <div class="clearfix"></div>
                <div class="pagination-container margin-top-40 margin-bottom-10">
                    <nav class="pagination">
                        <ul>
                            <li><a href="#" class="ripple-effect current-page">1</a></li>
                            <li><a href="#" class="ripple-effect">2</a></li>
                            <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
                <div class="clearfix"></div>
                <!-- Pagination / End -->

            </div>
                </div>
                <div class="col-md-6">
                <div class="single-page-section margin-bottom-25">
                    <h3 class="">Availability</h3>
                    <table class="basic-table">
                        <tr>
                            <th>Day</th>
                            <th>Times</th>
                        </tr>
                        <tr>
                            <td data-label="Column 1">Monday</td>
                            <td data-label="Column 2">9am - 5pm</td>
                        </tr>

                        <tr>
                            <td data-label="Column 1">Tuesday</td>
                            <td data-label="Column 2">9am - 5pm</td>
                        </tr>

                        <tr>
                            <td data-label="Column 1">Wednesday</td>
                            <td data-label="Column 2 "><i class="fa fa-times-circle text-danger"></i><span class="text-danger"> Not Available </span></td>
                        </tr>
                        <tr>
                            <td data-label="Column 1">Thursday</td>
                            <td data-label="Column 2">9am - 5pm</td>
                        </tr>
                        <tr>
                            <td data-label="Column 1">Friday</td>
                            <td data-label="Column 2">9am - 5pm</td>
                        </tr>
                        <tr>
                            <td data-label="Column 1">Saturday</td>
                            <td data-label="Column 2">9am - 5pm</td>
                        </tr>
                        <tr>
                            <td data-label="Column 1">Sunday</td>
                            <td data-label="Column 2">9am - 5pm</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>

        </div>
        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-4">

            <!-- Profile Overview -->
            <div class="profile-overview">
                <div class="overview-item"><strong>$35</strong><span>Hourly Rate</span></div>
                <div class="overview-item"><strong>53</strong><span>Jobs Done</span></div>
                <div class="overview-item"><strong>22</strong><span>Rehired</span></div>
            </div>
            <a href="#small-dialog" class="apply-now-button popup-with-zoom-anim margin-bottom-50">Chat with #Name<i class="icon-material-outline-arrow-right-alt"></i></a>
            <div class="dashboard-box small-box margin-top-0 margin-bottom-30">
                <!-- Headline -->
                <div class="headline">
                    <h3><i class="icon-feather-alert-circle"></i> {LANG_DETAILS}</h3>
                </div>
                <div class="content with-padding">
                    <table>
                        IF(!{HIDE_CONTACT}){
                        IF('{PHONE}' != ''){
                        <tr>
                            <td>{LANG_PHONE}</td>
                            <td><a href="tel:{PHONE}" rel="nofollow">{PHONE}</a></td>
                        </tr>
                        {:IF}
                        IF('{EMAIL}' != ''){
                        <tr>
                            <td>{LANG_EMAIL}</td>
                            <td><a href="mailto:{EMAIL}" rel="nofollow">{EMAIL}</a></td>
                        </tr>
                        {:IF}
                        {:IF}
                        IF('{WEBSITE}' != ''){
                        <tr>
                            <td>{LANG_WEBSITE}</td>
                            <td><a href="{WEBSITE}" rel="nofollow">{WEBSITE}</a></td>
                        </tr>
                        {:IF}
                        IF('{GENDER}' != ''){
                        <tr>
                            <td>{LANG_GENDER}</td>
                            <td>
                                IF('{GENDER}' == 'Male'){
                                {LANG_GENDER_MALE}
                                ELSEIF('{GENDER}' == 'Female'){
                                {LANG_GENDER_FEMALE}
                                ELSEIF('{ITEM.sex}' == 'Other'){
                                {LANG_GENDER_OTHER}
                                {ELSE}
                                -
                                {:IF}
                            </td>
                        </tr>
                        {:IF}
                        IF('{AGE}' != ''){
                        <tr>
                            <td>{LANG_AGE}</td>
                            <td>{AGE}</td>
                        </tr>
                        {:IF}
                        IF('{SALARY_MIN}' != '0'){
                        <tr>
                            <td>{LANG_SALARY}</td>
                            <td data-tippy-placement="top" title="{LANG_SALARY_PER_MONTH}">{SALARY_MIN}
                                IF('{SALARY_MAX}' != ''){
                                - {SALARY_MAX}
                                {:IF}
                            </td>
                        </tr>
                        {:IF}
                        IF('{ADDRESS}' != ''){
                        <tr>
                            <td>{LANG_ADDRESS}</td>
                            <td>{ADDRESS}</td>
                        </tr>
                        {:IF}
                    </table>
                </div>
            </div>

            <!-- Freelancer Indicators -->
            <div class="sidebar-widget">
                <div class="freelancer-indicators">

                    <!-- Indicator -->
                    <div class="indicator">
                        <strong>88%</strong>
                        <div class="indicator-bar" data-indicator-percentage="88"><span></span></div>
                        <span>Job Success</span>
                    </div>

                    <!-- Indicator -->
                    <div class="indicator">
                        <strong>100%</strong>
                        <div class="indicator-bar" data-indicator-percentage="100"><span></span></div>
                        <span>Recommendation</span>
                    </div>

                    <!-- Indicator -->
                    <div class="indicator">
                        <strong>90%</strong>
                        <div class="indicator-bar" data-indicator-percentage="90"><span></span></div>
                        <span>On Time</span>
                    </div>

                    <!-- Indicator -->
                    <div class="indicator">
                        <strong>80%</strong>
                        <div class="indicator-bar" data-indicator-percentage="80"><span></span></div>
                        <span>On Budget</span>
                    </div>
                </div>
            </div>




            <!-- Widget -->
            <div class="sidebar-widget">
                <h3>Languages</h3>
                <div class="task-tags">
                    <span>English</span>
                    <span>Spanish</span>
                    <span>French</span>

                </div>
            </div>

            <!-- Widget -->
            <div class="sidebar-widget">
                <h3>Skills</h3>
                <div class="task-tags">
                    <span>Android</span>
                    <span>mobile apps</span>
                    <span>design</span>
                </div>
            </div>

            <!-- Widget -->
            <div class="sidebar-widget">
                <h3>Attachments</h3>
                <div class="attachments-container">
                    <a href="#" class="attachment-box ripple-effect"><span>Cover Letter</span><i>PDF</i></a>
                    <a href="#" class="attachment-box ripple-effect"><span>Contract</span><i>DOCX</i></a>
                </div>
            </div>

            <div class="sidebar-container">

                <div class="sidebar-widget">
                    <h3>{LANG_BOOKMARK_SHARE}</h3>
                    IF('{USERTYPE}' == 'employer'){
                    IF('{USER_TYPE}' == 'user'){
                    <button class="fav-button margin-bottom-20 set-user-fav IF('{USER_FAVORITE}' == '1'){ added {:IF}" data-favuser-id="{USERID}" data-userid="{USER_ID}" data-action="setFavUser">
                        <span class="fav-icon"></span>
                        <span class="fav-text">{LANG_ADD_TO_FAV}</span>
                        <span class="added-text">{LANG_ADDED}</span>
                    </button>
                    {:IF}
                    {:IF}

                    <!-- Share Buttons -->
                    <ul class="share-buttons-icons">
                        <li><a href="mailto:?subject={FULLNAME}&body={LINK_PROFILE}/{USERNAME}" data-button-color="#dd4b39" title="{LANG_SHARE_EMAIL}" data-tippy-placement="top" rel="nofollow" target="_blank"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="margin-top-15"></div>


<!-- Make an Offer Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
            <li><a href="#tab">Make an Offer</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Discuss your project with David</h3>
                </div>

                <!-- Form -->
                <form method="post">

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-account-circle"></i>
                        <input type="text" class="input-text with-border" name="name" id="name" placeholder="First and Last Name"/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Email Address"/>
                    </div>

                    <textarea name="textarea" cols="10" placeholder="Message" class="with-border"></textarea>

                    <div class="uploadButton margin-top-25">
                        <input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload" multiple/>
                        <label class="uploadButton-button ripple-effect" for="upload">Add Attachments</label>
                        <span class="uploadButton-file-name">Allowed file types: zip, pdf, png, jpg <br> Max. files size: 50 MB.</span>
                    </div>

                </form>

                <!-- Button -->
                <button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>
            <!-- Login -->
            <div class="popup-tab-content" id="loginn">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Discuss Your Project With Tom</h3>
                </div>

                <!-- Form -->
                <form method="post" id="make-an-offer-form">

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-account-circle"></i>
                        <input type="text" class="input-text with-border" name="name2" id="name2" placeholder="First and Last Name" required/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="emailaddress2" id="emailaddress2" placeholder="Email Address" required/>
                    </div>

                    <textarea name="textarea" cols="10" placeholder="Message" class="with-border"></textarea>

                    <div class="uploadButton margin-top-25">
                        <input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload-cv" multiple/>
                        <label class="uploadButton-button" for="upload-cv">Add Attachments</label>
                        <span class="uploadButton-file-name">Allowed file types: zip, pdf, png, jpg <br> Max. files size: 50 MB.</span>
                    </div>

                </form>

                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="make-an-offer-form">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>


{OVERALL_FOOTER}