{OVERALL_HEADER}
{BREADCRUMBS}
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                {USER_SIDEBAR}
            </div>
            <div class="col-lg-9 col-md-12 js-accordion">
                <div class="dashboard-box js-accordion-item active">
                    <div class="headline js-accordion-header">
                        <h3><i class="icon-feather-file-text"></i> {LANG_ADD_DOCUMENT}</h3>
                    </div>
                    <div class="content with-padding js-accordion-body">
                        <form method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                            <div class="row">
                                <!-- <div class="col-xl-12 mt-0 col-md-12 immu_info">
                                    <div class="submit-field">
                                        <h5>Select User <span class="required">*<span></h5>
                                        <select name="user_type">
                                            <option></option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-xl-12 mt-0 col-md-12 immu_info">
                                    <div class="submit-field">
                                    
                                        <h5>{LANG_SELECT_DOCUMENT}<span class="required">*<span></h5>
                                        <select name="document_type" class="selectpicker">
                                            {LOOP: REQUIREMENTS}
                                               <option value="{REQUIREMENTS.id}"  IF('{REQUIREMENTS.id}'=='{REQUIREMENT_ID}'){ selected {:IF}>{REQUIREMENTS.name}</option>
                                            {/LOOP: REQUIREMENTS}                              
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-12 mt-0 col-md-12 immu_info">
                                    <div class="submit-field">
                                        <h5>{LANG_EXPIRY_DATE}<span class="required">*<span></h5>
                                        <input type="text" class="with-border margin-bottom-0" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-language="{LANG_CODE}" name="expiry_date" value="{EXPIRY_DATE}" placeholder="{LANG_WRITE_EXPIRY_DATE}">
                                        IF("{EXPIRY_DATE_ERROR}"!=""){ {EXPIRY_DATE_ERROR} {:IF}

                                    </div>
                                </div>
                                <div class="col-xl-12 mt-0 col-md-12 immu_info">
                                    <div class="submit-field">
                                        <h5>{LANG_UPLOAD_DOCUMENT}<span class="required">*</span></h5>
                                        <div class="uploadButton">
                                            <input class="uploadButton-input" type="file" id="covid_certificate" name="file_path">
                                            <label class="uploadButton-button ripple-effect" for="covid_certificate">Upload File</label>
                                            <span class="uploadButton-file-name">{LANG_RESUME_FILE_TYPE}</span>
                                        </div>
                                    </div>
                                    IF("{DOCUMENT_FILE}"!=""){ 
                                    <a href="{SITE_URL}storage/documt/{DOCUMENT_FILE}" title="{DOCUMENT_FILE}" style="margin-left:10px;" download>
                                        <i class="fa fa-download">&nbsp;Download-Certificate</i>
                                    </a>
                                    <a href="{SITE_URL}storage/documt/{DOCUMENT_FILE}" target="_blank"><span style="margin-left:15px;">{DOCUMENT_FILE}</span></a>
                                    IF("{DOCUMENT_ERROR}"!=""){ {DOCUMENT_ERROR} {:IF} 
                                    {:IF}                                 
                                </div> 
                                <div class="col-xl-12 mt-0 col-md-12" style="margin-top:10px;">
                                    <div class="submit-field">
                                        <h5>{LANG_REGISTRATION_NUMBER}</h5>
                                        <input type="text" class="with-border" name="registration_number" placeholder="{LANG_WRITE_REGISTRATION}" value="{REGISTRATION_NUMBER}">
                                    </div>
                                </div>  
                                <div class="col-xl-12 mt-3 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_DESCRIPTION}</h5>
                                        <textarea name="description" class="with-border" placeholder="{LANG_WRITE_DESCRIPTION}">{DETAILS}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        </div>
    </div>
</div>
<link href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.{LANG_CODE}.min.js" charset="UTF-8"></script>
{OVERALL_FOOTER}
