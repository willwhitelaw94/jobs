
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
                {USER_DASHBOARD_CARD}
                
                <div class="dashboard-box js-accordion-item active">
                    <!-- Headline -->
                    <div class="headline js-accordion-header">
                        <h3><i class="icon-feather-user"></i> {LANG_PROFILE_DETAILS}</h3>
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
                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_NAME} *</h5>

                                        <div class="input-with-icon-left">
                                            <i class="la la-user"></i>
                                            <input type="text" class="with-border" name="name" value="{AUTHORNAME}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
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
                                    <div class="submit-field">
                                        <h5>{LANG_EMAIL} *</h5>

                                        <div class="input-with-icon-left">
                                            <i class="la la-envelope"></i>
                                            <input type="text" class="with-border" id="email" name="email"
                                                value="{EMAIL}" onBlur="checkAvailabilityEmail()">
                                        </div>
                                        <span id="email-availability-status">
                                            IF("{EMAIL_ERROR}"!=""){ {EMAIL_ERROR} {:IF}</span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_PHONE_NUMBER} *</h5>

                                        <div class="input-with-icon-left">
                                            <i class="la la-phone"></i>
                                            <input type="text" name="phone" class="with-border margin-bottom-0"
                                                value="{PHONE}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_AVATAR}</h5>

                                        <div class="uploadButton">
                                            <input class="uploadButton-input" type="file" accept="images/*" id="avatar"
                                                name="avatar"/>
                                            <label class="uploadButton-button ripple-effect"
                                                for="avatar">{LANG_UPLOAD_AVATAR}</label>
                                            <span class="uploadButton-file-name">{LANG_AVATAR_HINT}</span>
                                        </div>
                                        <span id="email-availability-status">
                                            IF("{AVATAR_ERROR}"!=""){ {AVATAR_ERROR} {:IF}
                                        </span>
                                    </div>
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
                                    
                                    <div class="submit-field">
                                        <h5>{LANG_CITY}</h5>
                                        <select id="jobcity" class="with-border" name="city" data-size="7" title="{LANG_SELECT} {LANG_CITY}" >
                                            <option value="0" selected="selected">{LANG_SELECT} {LANG_CITY}</option>
                                            IF('{CITY}' != ''){
                                            <option value="{CITY}" selected="selected">{CITYNAME}</option>
                                            {:IF}
                                        </select>
                                    </div>
                                    <div class="submit-field">
                                        <h5>{LANG_ADDRESS} *</h5>
                                        <textarea class="with-border" name="address" required="">{ADDRESS}</textarea>
                                    </div>
                                IF('{USERTYPE}' == "user"){
                                    <div class="submit-field">
                                        <h5>{LANG_TAGLINE}</h5>
                                        <input type="text" name="tagline" class="with-border margin-bottom-0"
                                            value="{TAGLINE}">
                                        <small>{LANG_TAGLINE_HINT}</small>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_CATEGORY}</h5>
                                        <select class="selectpicker with-border" name="category" id="category" data-subcat="{SUBCAT}">
                                            <option>-</option>
                                            {LOOP: CATEGORIES}
                                            <option value="{CATEGORIES.id}" {CATEGORIES.selected}>{CATEGORIES.name}</option>
                                            {/LOOP: CATEGORIES}
                                        </select>
                                        <small>{LANG_USER_CATEGORY_HINT}</small>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_SUBCATEGORY}</h5>
                                        <select class="selectpicker with-border" name="subcategory" id="sub_category">
                                            <option>-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="submit-field">
                                        <h5>{LANG_DOB}</h5>
                                        <input type="text" class="with-border margin-bottom-0" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-language="{LANG_CODE}" name="dob" value="{DOB}" IF('{LANGUAGE_DIRECTION}'=='rtl'){ data-date-rtl="true" {:IF}>
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-12">
                                    {:IF}
                                    <div class="submit-field">
                                        <h5>{LANG_DESCRIPTION}</h5>
                                        <textarea class="with-border" id="pageContent" name="aboutme" >{ABOUTME}</textarea>
                                    </div>
                                    <div class="submit-field">
                                        <h5>{LANG_WEBSITE}</h5>
                                        <div class="input-with-icon-left">
                                            <i class="la la-link"></i>
                                            <input type="url" name="website" class="with-border margin-bottom-0"
                                                value="{WEBSITE}">
                                        </div>
                                    </div>
                                    <div class="submit-field">
                                        <h5>{LANG_FACEBOOK}</h5>
                                        <div class="input-with-icon-left">
                                            <i class="fa fa-facebook"></i>
                                            <input type="url" name="facebook" class="with-border margin-bottom-0"
                                                value="{FACEBOOK}">
                                        </div>
                                    </div>
                                    <div class="submit-field">
                                        <h5>{LANG_TWITTER}</h5>
                                        <div class="input-with-icon-left">
                                            <i class="fa fa-twitter"></i>
                                            <input type="url" name="twitter" class="with-border margin-bottom-0"
                                                value="{TWITTER}">
                                        </div>
                                    </div>
                                    <div class="submit-field">
                                        <h5>{LANG_INSTAGRAM}</h5>
                                        <div class="input-with-icon-left">
                                            <i class="fa fa-instagram"></i>
                                            <input type="url" name="instagram" class="with-border margin-bottom-0"
                                                value="{INSTAGRAM}">
                                        </div>
                                    </div>
                                    <div class="submit-field">
                                        <h5>{LANG_LINKEDIN}</h5>
                                        <div class="input-with-icon-left">
                                            <i class="fa fa-linkedin"></i>
                                            <input type="url" name="linkedin" class="with-border margin-bottom-0"
                                                value="{LINKEDIN}">
                                        </div>
                                    </div>
                                    <div class="submit-field">
                                        <h5>{LANG_YOUTUBE}</h5>
                                        <div class="input-with-icon-left">
                                            <i class="fa fa-youtube-play"></i>
                                            <input type="url" name="youtube" class="with-border margin-bottom-0"
                                                value="{YOUTUBE}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit"
                                    class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
                        </form>
                        {:IF}
                    </div>
                </div>

                <div class="dashboard-box js-accordion-item">
                    <!-- Headline -->
                    <div class="headline js-accordion-header">
                        <h3><i class="icon-feather-lock"></i> {LANG_PASSWORD}</h3>
                    </div>

                    <div class="content with-padding js-accordion-body">
                        <form method="post" accept-charset="UTF-8">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>{LANG_NEW_PASSWORD}</h5>
                                        <input type="password" id="password" name="password" class="with-border"
                                            onkeyup="checkAvailabilityPassword()">
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>{LANG_RE_NEW_PASSWORD}</h5>
                                        <input type="password" id="re_password" name="re_password" class="with-border"
                                            onkeyup="checkRePassword()">
                                    </div>
                                </div>
                            </div>
                            <span id="password-availability-status">IF("{PASSWORD_ERROR}
                                "!=""){ {PASSWORD_ERROR} {:IF}</span>
                            <button type="submit" name="password-submit"
                                    class="button ripple-effect">{LANG_UPDATE}</button>
                        </form>
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
            var data = { action: "getsubcatbyid", catid: catid, selectid : selectid };
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
