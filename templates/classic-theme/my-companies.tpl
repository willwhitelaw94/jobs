{OVERALL_HEADER}
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{LANG_MY_COMPANIES}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li>{LANG_MY_COMPANIES}</li>
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
                        <h3><i class="icon-feather-box"></i> {LANG_MY_COMPANIES}</h3>
                    </div>
                    <div class="content with-padding">
                        <div class="row">
                            <div class="col-xl-4">
                                <form method="get" action="">
                                <div class="input-with-icon">
                                    <input class="with-border" type="text" name="keywords" value="{KEYWORDS}" placeholder="{LANG_SEARCH}...">
                                    <i class="icon-feather-search"></i>
                                </div>
                                </form>
                            </div>
                            <div class="col-xl-8 text-right">
                                <a href="{LINK_CREATE-COMPANY}" class="button ripple-effect">{LANG_CREATE_COMPANY}</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="js-table-list" class="basic-table dashboard-box-list">
                                <tr>
                                    <th class="big-width">{LANG_NAME}</th>
                                    <th class="small-width">{LANG_JOBS}</th>
                                    <th class="small-width">{LANG_ACTIONS}</th>
                                </tr>
                                IF({TOTALITEM}){
                                {LOOP: ITEM}
                                <tr class="company-row" data-item-id="{ITEM.id}">
                                    <td>
                                        <div class="job-listing">
                                            <div class="job-listing-details">
                                                <div class="job-listing-company-logo">
                                                    <img src="{SITE_URL}storage/products/{ITEM.image}" alt="">
                                                </div>
                                                <div class="job-listing-description">
                                                    <a href="{ITEM.link}"><h3 class="job-listing-title">{ITEM.name}</h3></a>
                                                    <p class="job-listing-text">{ITEM.description}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="{ITEM.link}#all-jobs"><strong>{ITEM.jobs}</strong></a></td>
                                    <td>
                                        <a href="{LINK_EDIT-COMPANY}/{ITEM.id}" class="button gray ripple-effect ico" data-tippy-placement="top" title="{LANG_EDIT}"><i class="icon-feather-edit"></i></a>
                                        <a href="#" class="button gray ripple-effect ico ajax-delete-company" data-tippy-placement="top" title="{LANG_DELETE}"><i class="icon-feather-trash-2"></i></a>
                                    </td>
                                </tr>
                                {/LOOP: ITEM}
                                {ELSE}
                                <tr>
                                    <td colspan="3" class="text-center">{LANG_NO_EXPIRE_JOB}</td>
                                </tr>
                                {:IF}
                            </table>
                        </div>
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
</div>

{OVERALL_FOOTER}
