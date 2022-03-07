
{OVERALL_HEADER}
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{LANG_EDITPROFILE}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li>{LANG_EDITPROFILE}</li>
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
        <div class="col-lg-9 col-md-12 js-accordion">
            <div class="dashboard-box js-accordion-item active">
                <!-- Headline -->
                <div class="headline js-accordion-header">
                    <h3><i class="icon-feather-user"></i> {LANG_CUSTOM_FIELDS}</h3>
                </div>
                <div class="content with-padding js-accordion-body"> 
                        <form id="post_job_form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">   
                            <div id="ResponseCustomFields">
                                {LOOP: CUSTOMFIELDS}
                                IF('{CUSTOMFIELDS.type}'=="text-field"){
                                <div class="submit-field">
                                    <h5>{CUSTOMFIELDS.title}</h5>
                                    {CUSTOMFIELDS.textbox}
                                </div>
                                {:IF}
                                IF('{CUSTOMFIELDS.type}'=="textarea"){
                                <div class="submit-field">
                                    <h5>{CUSTOMFIELDS.title}</h5>
                                    {CUSTOMFIELDS.textarea}
                                </div>
                                {:IF}
                                IF('{CUSTOMFIELDS.type}'=="drop-down"){
                                <div class="submit-field">
                                    <h5>{CUSTOMFIELDS.title}</h5>
                                    <select class="selectpicker with-border quick-custom-field"
                                            name="custom[{CUSTOMFIELDS.id}]" data-name="{CUSTOMFIELDS.id}"
                                            data-req="{CUSTOMFIELDS.required}">
                                        <option value="" selected>{LANG_SELECT} {CUSTOMFIELDS.title}</option>
                                        {CUSTOMFIELDS.selectbox}
                                    </select>
                                    <div class="quick-error">{LANG_FIELD_REQUIRED}</div>
                                </div>
                                {:IF}
                                IF('{CUSTOMFIELDS.type}'=="radio-buttons"){
                                <div class="submit-field">
                                    <h5>{CUSTOMFIELDS.title}</h5>
                                    {CUSTOMFIELDS.radio}
                                </div>
                                {:IF}
                                IF('{CUSTOMFIELDS.type}'=="checkboxes"){
                                <div class="submit-field">
                                    <h5>{CUSTOMFIELDS.title}</h5>
                                    {CUSTOMFIELDS.checkbox}
                                </div>
                                {:IF}
                                {/LOOP: CUSTOMFIELDS}
                            </div>
                                <div class="row margin-top-30 margin-bottom-80" style="align-items: center;">
                                    <div class="col-6">
                                        <button type="submit" id="submit_job_button" name="submit" class="button ripple-effect big"><i
                                            class="icon-feather-plus"></i> {LANG_SAVE_FIELDS}</button>
                                    </div>
                                </div>
                        </form>
                </div>
            </div>        
        </div> 
    </div>
</div>
</div>

<link media="all" rel="stylesheet" type="text/css" href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/styles/simditor.css"/>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/mobilecheck.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/module.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/uploader.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/hotkeys.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/simditor.js"></script>

<link href="{SITE_URL}templates/{TPL_NAME}/css/select2.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/{LANG_CODE}.js"></script>

<link href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/bootstrap-datepicker.min.js"></script>
{OVERALL_FOOTER}
