{OVERALL_HEADER}
<div class="margin-bottom-0" id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>
                    {LANG_MY_RESUMES}
                </h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li>
                            <a href="{LINK_INDEX}">
                                {LANG_HOME}
                            </a>
                        </li>
                        <li>
                            {LANG_MY_RESUMES}
                        </li>
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
                        <h3>
                            <i class="icon-feather-paperclip">
                            </i>
                            {LANG_MY_RESUMES}
                        </h3>
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
                                <a href="{LINK_ADD-RESUME}" class="button ripple-effect">{LANG_ADD_RESUME}</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="basic-table dashboard-box-list">
                                <tr>
                                    <th>{LANG_FILE}</th>
                                    <th class="big-width">{LANG_NAME}</th>
                                    <th class="small-width">{LANG_ACTIONS}</th>
                                </tr>
                                IF({RESUMES}){
                                {LOOP: ITEM}
                                <tr class="resume-row" data-item-id="{ITEM.id}">
                                    <td>
                                        <a href="{SITE_URL}storage/resumes/{ITEM.filename}" title="{ITEM.filename}" class="button ripple-effect" download>
                                            <i class="icon-feather-download"></i> {LANG_DOWNLOAD}
                                        </a>
                                    </td>
                                    <td>{ITEM.name}</td>
                                    <td>
                                        <a href="{LINK_EDIT-RESUME}/{ITEM.id}" class="button gray ripple-effect ico" data-tippy-placement="top" title="{LANG_EDIT}"><i class="icon-feather-edit"></i></a>
                                        <a href="#" class="button gray ripple-effect ico ajax-delete-resume" data-tippy-placement="top" title="{LANG_DELETE}"><i class="icon-feather-trash-2"></i></a>
                                    </td>
                                </tr>
                                {/LOOP: ITEM}
                                {ELSE}
                                <tr>
                                    <td colspan="3" class="text-center">{LANG_NO_RESULT_FOUND}</td>
                                </tr>
                                {:IF}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}
