{OVERALL_HEADER}
<style>
    p{
       padding-bottom: 0px !important;
    }
</style>
{BREADCRUMBS}
"{CERTIFICATE_ERROR}"
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
                        <h3><i class="icon-feather-user"></i> Immunisation</h3>
                    </div>
                    <div class="content with-padding js-accordion-body">
                        <form method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                    <h4>COVID-19 vaccine declaration :</h4>
                                    <p>The federal Government mandated COVID-19 vaccination for all aged-care and disability support workers.You must declare your vaccination satus to provide in-person support.
                                    <br><br>
                                     Find the latest Government guidlines on the <a href="#">Department of Health Website</a>
                                    </p>
                                    <hr>
                            </div>   
                             
                            <div class="col-xl-12 mt-0 col-md-12">
                                <div class="submit-field">
                                    <h5>Have you had your COVID-19 Vaccination?</h5>
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="is_vaccinated" id="no" value="0" IF('{IS_VACCINATED}'=='0'){ checked {:IF} checked/>
                                        <label for="no"><span class="radio-label"></span>{LANG_NO}</label>
                                    </div>
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="is_vaccinated" id="yes_one_dose" value="1" IF('{IS_VACCINATED}'=='1'){ checked {:IF}  />
                                        <label for="yes_one_dose"><span class="radio-label"></span>{LANG_YES_ONE_DOSE}</label>
                                    </div>
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="is_vaccinated" id="yes_two_dose" value="2" IF('{IS_VACCINATED}'=='2'){ checked {:IF}/>
                                        <label for="yes_two_dose"><span class="radio-label"></span>{LANG_YES_TWO_DOSE}</label>
                                    </div>
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="is_vaccinated" id="yes_one_booster" value="3" IF('{IS_VACCINATED}'=='3'){ checked {:IF}/>
                                        <label for="yes_one_booster"><span class="radio-label"></span>{LANG_YES_ONE_BOOSTER}</label>
                                    </div>
                                    <p>If you have a medical exemption, please email aus at <a href = "mailto: abc@example.com">abc@example.com</a> with th subject line "COVID vaccination- Medical excemption" or call us on <a href="tel:+6494461709">12345673</a></p>
                                </div>
                            </div>
                            <div class="col-xl-6 mt-0 col-md-12 immu_info">
                                <div class="submit-field">
                                    <h5>Most recent immunisation date <span class="required">*<span></h5>
                                    <input type="text" class="with-border margin-bottom-0" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-language="{LANG_CODE}" name="recent_immunisation_date" value="{IMMUNISATION_DATE}" >
                                    IF("{IMMUNISATION_DATE_ERROR}"!=""){ {IMMUNISATION_DATE_ERROR} {:IF}
                                </div>
                            </div>    
                            <div class="col-xl-12 mt-0 col-md-12 immu_info">
                                <div class="submit-field">
                                    <h5>Upload COVID-19 digital certificate *</h5>
                                    <p>Once we have check your certificate, it'll show "Verified" on your profile.</p>
                                    <div class="uploadButton">
                                        <input class="uploadButton-input" type="file" id="covid_certificate" name="covid_certificate">
                                        <label class="uploadButton-button ripple-effect" for="covid_certificate">Upload File</label>
                                        <span class="uploadButton-file-name">Only pdf, doc, docx, rtf, rtx, ppt, pptx, jpeg, jpg, bmp, png file types allowed.</span>
                                        </div>
                                    </div>
                                    
                                    IF("{CERTIFICATE_ERROR}"!=""){ "{CERTIFICATE_ERROR}" {:IF}
                            </div>
                        </div>
                        <hr>
                        <div class="row">   
                            <div class="col-xl-12 mt-0 col-md-12">
                                <h4>Flu Vaccine</h4>
                                <p> A flu vacccine is mandatory requirement for anyone who works in on enters in residential aged care facility.
                                    For those who works in a home care setting, the flu vaccination is highly recommended.
                                </p>
                                <p>Clients or providers can asked if you've been vaccinated for flu this year.Make sure you have prepared evidence to show them you have.</p>
                            </div>
                            <div class=" col-xl-12 mt-0 col-md-12 pb-5">
                                <h4>It's optional to answer. You can update your response at anytime.</h4>
                                <p>If you anser yes, a flu vaccine badge will appear on your profile this season that can be viewed by clients.Clients can filter for worker with a flu caccine badge.</p>
                                <p>If you answer no, your profile will remain same without a badge.</p>
                            </div>
                            <div class="col-xl-12 mt-0 col-md-12">
                                <div class="submit-field">
                                    <h5>Have you had flu vaccine this season?</h5>
                                    <h5>It's important to answer truthfully.</h5> 
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="is_flu_vaccinated" id="No" value="0" IF('{IS_FLU_VACCINATED}'=='0'){ checked {:IF} />
                                        <label for="No"><span class="radio-label"></span>{LANG_NO}</label>
                                    </div>
                                    <div class="radio margin-right-20">
                                        <input class="with-gap" type="radio" name="is_flu_vaccinated" id="yes" value="1"  IF('{IS_FLU_VACCINATED}'=='1'){ checked {:IF}/>
                                        <label for="yes"><span class="radio-label"></span>{LANG_YES}</label>
                                    </div>
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

{OVERALL_FOOTER}
<link href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="{SITE_URL}templates/{TPL_NAME}/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.{LANG_CODE}.min.js" charset="UTF-8"></script>
<script>
    // $('input[type=radio][name=is_vaccinated]').change(function() {
    //     console.log(this.value);
    //     if (this.value == '0'){
    //       $('.immu_info').addClass('d-none')
    //     }else{
    //         $('.immu_info').removeClass('d-none')
    //     }

    // });
</script>