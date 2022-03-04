
{OVERALL_HEADER}
{BREADCRUMBS}
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
               {USER_SIDEBAR}
            </div>
            <div class="col-lg-9 col-md-12 js-accordion">
                <div class="dashboard-box  mt-0 js-accordion-item active">
                    <!-- Headline -->
                    <div class="headline js-accordion-header">
                        <h3><i class="icon-feather-user"></i> Profile Overview</h3>
                    </div>
                    <div class="content with-padding js-accordion-body">
                    IF(!'{USERTYPE}'){
                        <form method="post" accept-charset="UTF-8">
                            <div class="row">
                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_USERTYPE} *</h5>
                                        <select name="user-type" class="with-border selectpicker" required="">
                                            <option>{LANG_SELECT}</option>
                                            <option value="1">{LANG_JOB_SEEKER}</option>
                                            <option value="2">{LANG_EMPLOYER}</option>
                                        </select>
                                        <span id="type-availability-status">
                                            IF("{TYPE_ERROR}"!=""){ {TYPE_ERROR} {:IF}</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit_type"
                                    class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
                        </form>
                        {ELSE}
                        <form method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                            <div class="row">
                                    <div class="col-auto">
                                        <div class="submit-field mb-0">
                                            <h5>{LANG_AVATAR}</h5>
                                            <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar-wrapper" data-tippy-placement="bottom" title="{LANG_UPLOAD_AVATAR} - {LANG_AVATAR_HINT}">
                                                    <img class="profile-pic" src="{SITE_URL}storage/profile/{AVATAR}" alt="" />
                                                    <div class="upload-button"></div>
                                                    <input class="file-upload" type="file" accept="image/*" id="avatar"
                                                           name="avatar"/>


                                                </div>
                                                <label class="uploadButton-button ripple-effect"
                                                       for="avatar"></label>
                                                <span class="uploadButton-file-name"></span>
                                                <span id="email-availability-status">
                                                IF("{AVATAR_ERROR}"!=""){ {AVATAR_ERROR} {:IF}
                                            </span>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-xl-6 col-md-12">
                                                    <div class="submit-field mb-0">
                                                        <h5>{LANG_USERNAME} *</h5>
                                                        <div class="input-with-icon-left">
                                                            <i class="la la-user"></i>
                                                            <input type="text" class="with-border" id="username" name="username"
                                                                    value="{USERNAME}" onBlur="checkAvailabilityUsername()">
                                                        </div>
                                                        <span id="user-availability-status">
                                                    IF("{USERNAME_ERROR}"!=""){ {USERNAME_ERROR} {:IF}</span>
                                                    </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                            <div class="submit-field m-b-0">
                                                <h5>{LANG_TAGLINE}</h5>
                                                <input type="text" name="tagline" class="with-border margin-bottom-0"
                                                        value="{TAGLINE}">
                                                <small>{LANG_TAGLINE_HINT}</small>
                                            </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="section-headline margin-bottom-12">
                                        <h5>{LANG_CATEGORY}</h5>
                                    </div>
                                    <select class="selectpicker" multiple data-selected-text-format="values" name="category[]" id="category" data-subcat="{SUBCAT}">
                                        <option>-</option>
                                        {LOOP: CATEGORIES}
                                            <option value="{CATEGORIES.id}" {CATEGORIES.selected}>{CATEGORIES.name}</option>
                                        {/LOOP: CATEGORIES}
                                    </select>
                                    <small>{LANG_USER_CATEGORY_HINT}</small>

                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="section-headline margin-bottom-12">
                                        <h5>{LANG_SUBCATEGORY}</h5>
                                    </div>
                                    <select class="selectpicker with-border" data-selected-text-format="values" multiple name="subcategory[]" id="sub_category" >
                                        <option>-</option>
                                    </select>
                                </div>

                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_DOB}</h5>
                                        <input type="text" class="with-border margin-bottom-0" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-language="{LANG_CODE}" name="dob" value="{DOB}" IF('{LANGUAGE_DIRECTION}'=='rtl'){ data-date-rtl="true" {:IF}>
                                    </div>
                                </div>
                                <div class="col-xl-6 mt-0 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_GENDER}</h5>
                                        <div class="radio margin-right-20">
                                            <input class="with-gap" type="radio" name="gender" id="Male" value="Male" IF('{GENDER}'=='Male'){ checked {:IF} />
                                            <label for="Male"><span class="radio-label"></span>{LANG_GENDER_MALE}</label>
                                        </div>
                                        <div class="radio margin-right-20">
                                            <input class="with-gap" type="radio" name="gender" id="Female" value="Female" IF('{GENDER}'=='Female'){ checked {:IF} />
                                            <label for="Female"><span class="radio-label"></span>{LANG_GENDER_FEMALE}</label>
                                        </div>
                                        <div class="radio margin-right-20">
                                            <input class="with-gap" type="radio" name="gender" id="Other" value="Other" IF('{GENDER}'=='Other'){ checked {:IF} />
                                            <label for="Other"><span class="radio-label"></span>{LANG_GENDER_OTHER}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
                        </form>
                        {:IF}
                    </div>
                </div>
                IF('{USERTYPE}' == "user"){

                <div class="dashboard-box js-accordion-item">
                    <!-- Headline -->
                    <div class="headline js-accordion-header">
                        <h3><i class="icon-feather-lock"></i> Worker Details</h3>
                    </div>
                    <div class="content with-padding js-accordion-body">
                    </div>
                </div>
                {:IF}
                IF('{USERTYPE}' == "employer"){

                <div class="dashboard-box js-accordion-item">
                    <!-- Headline -->
                    <div class="headline js-accordion-header">
                        <h3><i class="icon-feather-lock"></i> Employer Details</h3>
                    </div>
                    <div class="content with-padding js-accordion-body">
                    </div>
                </div>
                {:IF}

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
<script>
    (function() {
        $(function() {
            var $preview, editor, mobileToolbar, toolbar, allowedTags;
            Simditor.locale = 'en-US';
            toolbar = ['title', 'bold','italic','underline','|','ol','ul','blockquote','table','link','|','image','hr','indent','outdent','alignment'];
            mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
            if (mobilecheck()) {
                toolbar = mobileToolbar;
            }
            allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
            editor = new Simditor({
                textarea: $('#pageContent'),
                placeholder: '',
                toolbar: toolbar,
                toolbarFloat: false,
                pasteImage: false,
                defaultImage: '{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/images/image.png',
                upload: false,
                allowedTags: allowedTags
            });
            $preview = $('#preview');
            if ($preview.length > 0) {
                return editor.on('valuechanged', function(e) {
                    return $preview.html(editor.getValue());
                });
            }
        });
    }).call(this);
</script>
<script>
    var error = "";
    function checkAvailabilityUsername() {
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'username=' + $("#username").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $("#user-availability-status").html(data);
                }
                else {
                    error = 0;
                    $("#user-availability-status").html("");
                }
            },
            error: function () {
            }
        });
    }
    function checkAvailabilityEmail() {
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $("#email-availability-status").html(data);
                }
                else {
                    error = 0;
                    $("#email-availability-status").html("");
                }
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }
    function checkAvailabilityPassword() {
        var length = $('#password').val().length;
        if (length != 0) {
            var PASSLENG = "{LANG_PASSLENG}";
            if (length < 5 || length > 21) {
                $("#password-availability-status").html("<span class='status-not-available'>" + PASSLENG + "</span>");
            }
            else {
                $("#password-availability-status").html("");
            }
        }

    }

    function checkRePassword() {
        if ($('#password').val() != $('#re_password').val()) {
            var PASS = "{LANG_PASS_NOT_MATCH}";
            $("#password-availability-status").html("<span class='status-not-available'>" + PASS + "</span>");
        } else {
            $("#password-availability-status").html("");
        }
    }

    jQuery(window).on('load',function (e) {
        jQuery('#password').val("");
    });
    jQuery(function($) {
        $("#category").on('change', function(){
            var catid = $(this).val();
           
            var selectid = $(this).data('subcat');
            console.log(selectid);
            var data = { action: "getsubcatbymultipleid", catid: catid, selectid : selectid };
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: data,
                success: function(result){
                    $("#sub_category").html(result).selectpicker('refresh');
                }
            });
        });
        $("#category").trigger('change');
    });
</script>
<link href="{SITE_URL}templates/{TPL_NAME}/css/select2.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/{LANG_CODE}.js"></script>
<script>
    /* Get and Bind cities */
    $('#jobcity').select2({
        ajax: {
            url: ajaxurl + '?action=searchCityFromCountry',
            dataType: 'json',
            delay: 50,
            data: function (params) {
                return {
                    q: params.term, /* search term */
                    page: params.page
                };
            },
            processResults: function (data, params) {
                /*
                 // parse the results into the format expected by Select2
                 // since we are using custom formatting functions we do not need to
                 // alter the remote JSON data, except to indicate that infinite
                 // scrolling can be used
                 */
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 10) < data.totalEntries
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, /* let our custom formatter work */
        minimumInputLength: 2,
        templateResult: function (data) {
            return data.text;
        },
        templateSelection: function (data, container) {
            return data.text;
        }
    });
</script>
<link href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.{LANG_CODE}.min.js" charset="UTF-8"></script>
{OVERALL_FOOTER}
