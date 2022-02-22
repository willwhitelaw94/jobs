
{OVERALL_HEADER}
<style>

</style>

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
                        <h3><i class="icon-feather-user"></i> {LANG_RATE_AVAILABILITY}</h3>
                    </div>
                    <div class="content with-padding js-accordion-body"> 
                        <div class="py-0">
                            <form method="post" accept-charset="UTF-8">
                                <div class="abl_cl">
                                    <div class="d_f_cl">
                                            <div class="right_sec_cl">
                                                <div class="text-right">
                                                    <label class="switch_avb">
                                                        <input type="checkbox"  name="available_to_work" value="1" IF({AVLTOWORK}){ checked {:IF}>
                                                        <span class="slider_avb round_avb"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="fw-bold">
                                                    <h3 class="ps-4">Not available for work</h3>
                                                    <div class="fs-6 text-gray-700">
                                                        <p class="">
                                                            {LANG_IS_AVAILABLE_MSG}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <h3>Addresses:</h3>
                                        <p>Enter the adresses you will be available to work in.</p>
                                        <div class="submit-field">
                                            <h4 style="font-weight: 700;">Type in a city</h4>
                                            <select id="jobcity" class="with-border" name="city[]" data-size="7" title="{LANG_SELECT} {LANG_CITY}" multiple>    
                                                IF('{USER_CITY}' != ''){
                                                    {LOOP: USER_CITY}
                                                    <option value="{USER_CITY.id}" selected="selected">{USER_CITY.text}</option>
        
                                                    {/LOOP: USER_CITY} 
                                             
                                                {:IF}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                        <h3>Prefered Days:</h3>
                                        <p>Make sure your available days are accurate and up-to-date so you get inquiries that suit you and your availability.</p>
                                            <div class="submit-field"  id="prefered_days">
                                                <select id="days" class="with-border" name="days[]" data-size="7" title="{LANG_SELECT} {LANG_DAY}" multiple>   
                                                {LOOP: DAYSLIST}
                                                <option value="{DAYSLIST.code}">{DAYSLIST.day}</option>
                                                {/LOOP: DAYSLIST} 
                                                </select>
                                                IF("{DAY_ERROR}"!=""){ {DAY_ERROR} {:IF}
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-xl-12 ">
                                        <h3 class="md-5"  style="margin-bottom: 10px;">{LANG_EXPECTED_SALARY} :</h3>
                                         <p>
                                       
                                         </p>
                                        <div class="abl_cl">
                                            <div class="d_f_cl">
                                                    <div class="">
                                                        <div class="fw-bold">
                                                            <h3 class="ps-4">$ How much to charge?</h3>
                                                        
                                                                <div class="fs-6 text-gray-700">
                                                                    <p class="ps-4">
                                                                        Indicative rates provide a guide to your potential clients to help them make an informed decision about who
                                                                        supports them. Consider your rates based on:
                                                                    </p>
                                                                    <div class="ps-4">
                                                                        <ul class="ms-4">
                                                                            <li class="pb-3 ">Your experience, qualifications, other skills (such as languages) and services</li>
                                                                            <li class="pb-3 ">Your ratings and reviews from clients</li>
                                                                            <li class="pb-3 ">Your holiday pay, taxes and contributions to superannuation</li>
                                                                        </ul>
                                                                    </div>

                                                                       
                                                                
                                                                    <p class="ps-4">
                                                                        Don't forget that the actual rate you receive will be 10% less than the agreed rate while your clients will
                                                                        pay 5% more, for the support and services Trilogy Contractor Facilitates.
                        
                                                                    </p>
                                                                    <p class="ps-4">
                                                                        <a href="#">Learn more on how much to charge for the service you offer</a>
                                                                    </p>
                        
                                                                </div>
                                                                
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-xl-6 col-md-12">
                                        <div class="submit-field">
                                            <div class="input-with-icon">
                                                <input class="with-border margin-bottom-0" type="number" placeholder="{LANG_MIN}"
                                                    name="salary_min" value="{SALARY_MIN}" >
                                                <i class="currency">{USER_CURRENCY_SIGN}</i>
                                              
                                            </div>
                                            <small>{LANG_MIN_SALARY_PER_HOUR}</small>
                                           
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="submit-field">
                                            
                                            <div class="input-with-icon">
                                                <input class="with-border margin-bottom-0" type="number" placeholder="{LANG_MAX}"
                                                    name="salary_max" value="{SALARY_MAX}">
                                                <i class="currency">{USER_CURRENCY_SIGN}</i>
                                            </div>
                                            <small>{LANG_MAX_SALARY_PER_HOUR}</small>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                        <div class="checkbox submit-field">
                                            <input type="checkbox" id="session_willing" name="session_willing" value="1" IF({SESSION_WILLING}){ checked {:IF}>
                                            <label for="session_willing"><span class="checkbox-icon"></span>{LANG_WILLING_MSG}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" name="submit_details" class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
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
 
    /* Get and Bind cities */

    $('#jobcity').select2({
        multiple:true,
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
 
 
let string = '{USER_PRE_DAYS}';
let arr = string.split(',');
    
$("#days").select2({
    placeholder:'Select Days'
    // tags: true,
    // tokenSeparators: [',', ' '],
    // minimumResultsForSearch: Infinity,
   
}).val(arr).trigger('change');
// .on('select2:open', function (e) {
//    $('.select2-container--open .select2-dropdown--below').css('display','none');;

// });



</script>