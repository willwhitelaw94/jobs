{OVERALL_HEADER}
{BREADCRUMBS}
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
                    <h3><i class="icon-feather-award"></i> {TITLE}</h3>
                </div>
                <div class="content with-padding">
                    IF('{ERROR}' != ''){
                    <span class="status-not-available">{ERROR}</span>
                    {:IF}
                    <form method="post" accept-charset="UTF-8">
                        <div class="submit-field">
                            <h5>{LANG_INSTITUTION} *</h5>
                            <input type="text" class="with-border" id="title" name="institution" value="{INSTITUTION}" >
                        </div>
                        <div class="submit-field">
                            <h5>{LANG_COURSE} *</h5>
                            <input type="text" class="with-border" id="course" name="course" value="{COURSE}" >
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-12">
                                <div class="submit-field">
                                    <h5>{LANG_START_DATE} *</h5>
                                    <input type="text" class="with-border margin-bottom-0" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-language="{LANG_CODE}" data-date-end-date="0d" name="start_date" value="{START_DATE}" IF('{LANGUAGE_DIRECTION}'=='rtl'){ data-date-rtl="true" {:IF} >
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <div class="submit-field">
                                    <h5>{LANG_END_DATE}</h5>
                                    <input type="text" class="with-border margin-bottom-0" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-language="{LANG_CODE}" data-date-end-date="0d" name="end_date" value="{END_DATE}" IF('{LANGUAGE_DIRECTION}'=='rtl'){ data-date-rtl="true" {:IF}>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                               
                                <div class="submit-field">
                                    <h5>{LANG_CURRENTLY_WORKING}</h5>
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="currently_working" id="1" value="1" IF('{CURRENTLY_WORKING}'=='1' || '{CURRENTLY_WORKING}'==''){ checked  {:IF} />
                                        <label for="1"><span class="radio-label"></span>{LANG_YES}</label>
                                    </div>
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="currently_working" id="0" value="0" IF('{CURRENTLY_WORKING}'=='0'){ checked{:IF}/>
                                        <label for="0"><span class="radio-label"></span>{LANG_NO}</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                     
                        IF('{ID}' != ''){
                        <input type="hidden" name="id" value="{ID}">
                        {:IF}
                        <button type="submit" name="submit" class="button ripple-effect">{LANG_SAVE}</button>
                    </form>
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
