{OVERALL_HEADER}
{BREADCRUMBS}
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
            {USER_SIDEBAR}
            </div>
            <div class="col-lg-9 col-md-12 js-accordion">
                <div class="dashboard-box mt-0  js-accordion-item active">
                    <!-- Headline -->
                    <div class="headline js-accordion-header">
                        <h3><i class="icon-feather-user"></i> {LANG_CULTURAL_BACKGROUNDS}</h3>
                    </div>
                    <div class="content with-padding js-accordion-body">
                        <div class="py-0">
                            <form method="post" accept-charset="UTF-8">
                                <div class="row">
                                    <div class="col-12" >
                                    <h4>{LANG_CULTURAL_BACKGROUNDS} :</h4>
                                    <p>{LANG_CULTURAL_BACK_MSG}</p>
                                    </div>
                                        IF('{BACKGROUNDS}' != ''){
                                            {LOOP: BACKGROUNDS}
                                            <div class="col-sm-3">
                                                <label class="container_checkbox">
                                                <b>{BACKGROUNDS.name}</b>
                                                    <input type="checkbox" class='background' value="{BACKGROUNDS.id}" name="background[]" IF(in_array('{BACKGROUNDS.id}',explode(",",'{USER_BCK}'))){ checked  {:IF}  id="back{BACKGROUNDS.id}">
                                                    <span class="checkmark_lable"></span>
                                                    <small class="checkmark_list"></small>
                                                </label>
                                            </div>
                                            {/LOOP: BACKGROUNDS} 
                                        {:IF} 
                                </div>
                                <hr><br>
                                {C_BACKGROUNDOPTIONS}
                                
                                <div class="col-sm-12">
                                    <button type="submit" name="submit_details" class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<link media="all" rel="stylesheet" type="text/css"
      href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/styles/simditor.css"/>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.{LANG_CODE}.min.js" charset="UTF-8"></script>
{OVERALL_FOOTER}
<script>
$(function() {
    $(".background").on("change", function() {
        var cl= $(this).val();
        $("#option_section"+cl).toggleClass("d-none");
        
    });
});

</script>