{OVERALL_HEADER}
<div class="margin-bottom-0" id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>
                    {LANG_MY_DOCUMENT}
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
                            {LANG_MY_DOCUMENT}
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
                            <i class="icon-feather-file-text">
                            </i>
                            {LANG_MY_DOCUMENT}
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
                                <a href="{LINK_ADD_USER_DOCUMENT}" class="button ripple-effect">{LANG_ADD_DOCUMENT}</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="basic-table dashboard-box-list">
                                <tr>
                                    <th>{LANG_DOCUMENT}</th>
                                    <th class="big-width">{LANG_DOCUMENT_TYPE}</th>
                                    <th class="big-width">{LANG_REG_NUMBER}</th>
                                    <th class="big-width">{LANG_EXP_DATE}</th>
                                    <th class="big-width">{LANG_STATUS}</th>
                                    <th class="small-width">{LANG_ACTIONS}</th>
                                </tr>
                                IF({DOCUMENTS}){
                                {LOOP: ITEM}
                                <tr class="document-row" data-item-id="{ITEM.id}">
                                    <td>
                                        <a href="{SITE_URL}storage/documt/{ITEM.file_path}" title="{ITEM.file_path}" target="blank">
                                            <i class="icon-feather-eye"></i> {LANG_VIEW_DOCUMENT}
                                        </a>
                                    </td>
                                    <td>{ITEM.req_name}</td>
                                    <td><a href="javascript:void(0)" title="{ITEM.details}" style="text-decoration:none; color: inherit; ">{ITEM.registration_number}</a></td>
                                    <td>{ITEM.expiry_date}</td>
                                    <td>
                                        IF("{ITEM.status}"=="submitted"){<span class="label label-info">{ITEM.status}</span>{:IF}
                                        IF("{ITEM.status}"=="verified"){<span class="label label-success">{ITEM.status}</span>{:IF}
                                        IF("{ITEM.status}"=="requested"){<span class="label label-info">{ITEM.status}</span>{:IF}
                                        IF("{ITEM.status}"=="pending"){<span class="label label-warning">{ITEM.status}</span>{:IF}
                                        IF("{ITEM.status}"=="not verified"){<span class="label label-danger">{ITEM.status}</span>{:IF}
                                        IF("{ITEM.status}"=="expired"){<span class="label label-danger">{ITEM.status}</span>{:IF}
                                        IF("{ITEM.status}"=="exception"){<span class="label label-danger">{ITEM.status}</span>{:IF}
                                    </td>
                                    <td>
                                        <a href="{LINK_EDIT_DOCUMENT}/{ITEM.id}" class="button gray ripple-effect ico" data-tippy-placement="top" title="{LANG_EDIT}"><i class="icon-feather-edit"></i></a>
                                        <a href="#" class="button gray ripple-effect ico ajax-delete-document" data-tippy-placement="top" title="{LANG_DELETE}"><i class="icon-feather-trash-2"></i></a>
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
