{OVERALL_HEADER}
{BREADCRUMBS}
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                {USER_SIDEBAR}
            </div>
        <div class="col-lg-9 col-md-12">
            <!-- Row -->
            <div class="row">
                <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" id="shift-form">
                    <!-- Dashboard Box -->
                    <div class="col-xl-12">
                        <div class="dashboard-box margin-top-0">
                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-feather-folder-plus"></i>{TITLE}</h3>
                            </div>

                            <div class="content with-padding padding-bottom-10">
                                
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="submit-field">
                                            <h5>Agreement <span class="required">*</span></h5>
                                            <select class="selectpicker with-border agreement" id="agreement" title="Select a Agreement" name="agreement" >
                                            {LOOP: ITEM}
                                            <option value="{ITEM.id}" data-subtext="{ITEM.client_name}" IF('{AGREEMENT_ID}'=='{ITEM.id}'){ selected {:IF}>{ITEM.product_name}</option>
                                            {/LOOP: ITEM}
                                            </select>
                                            <label id="agreement-error" class="error" for="agreement"></label>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="submit-field">
                                            <h5>Rate  <span class="required">*</span></h5>
                                            <select class="selectpicker with-border" id="agreement_rate" title="Select a Rate" name="agreement_rate" >
                                                <!-- <option>Saturday - $45/hr</option> -->
                                               
                                                IF(AGRRATELIST!=''){
                                                   {LOOP: AGRRATELIST}
                                                   <option value="{AGRRATELIST.id}"  IF('{AGREEMENT_RATE_ID}'=='{AGRRATELIST.id}'){ selected {:IF}>{AGRRATELIST.text}</option>
                                                   {/LOOP: AGRRATELIST}
                                                {:IF}    
                                            </select>
                                            <label id="agreement_rate-error" class="error" for="agreement_rate"></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="submit-field">
                                            <h5>When did you complete your shift? <span class="required">*</span></h5>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="input-with-icon">
                                                        <input class="with-border" type="text" name="start_time" placeholder="Start" id="start_time" value="{START_TIME}">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                    <label id="start_time-error" class="error" for="start_time"></label> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="input-with-icon">
                                                        <input class="with-border" type="text" name="end_time" placeholder="Finish" id="end_time" value="{END_TIME}">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                    <label id="end_time-error" class="error" for="end_time"></label>
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Details of Shift  <span class="required">*</span></h5>
                                            <textarea cols="30" rows="5" class="with-border" name="shift_details">{SHIFT_DETAILS}</textarea>
                                            <div class="uploadButton margin-top-30">
                                                <input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload"  name='attachment'/>
                                                <label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
                                                <span class="uploadButton-file-name">Images or documents that might be helpful in describing your project</span>
                                            </div>
                                           
                                            IF("{ATTACHMENT_ERROR}"!=""){ {ATTACHMENT_ERROR} {:IF}
                                        </div>
                                          
                                        IF("{ATTACHMENT_FILE}"!=""){ 
                                            <a href="{SITE_URL}storage/timeshhet/{ATTACHMENT_FILE}" title="{DOCUMENT_FILE}" style="margin-left:10px;">
                                                <i class="fa fa-download">&nbsp;Download-Certificate</i>
                                            </a>
                                        {:IF}
                                        <div class="feedback-yes-no margin-top-0">
                                            <div class="radio">
                                                <input id="radio-1" name="incidence_occured" type="radio" checked value="0" IF('{INCIDENCE_OCCURED}'=='0' || '{INCIDENCE_OCCURED}'==''){ checked  {:IF}>
                                                <label for="radio-1"><span class="radio-label"></span> No Reportable Incidents</label>
                                            </div>

                                            <div class="radio">
                                                <input id="radio-2" name="incidence_occured" type="radio" value="1" IF('{INCIDENCE_OCCURED}'=='1'){ checked  {:IF}>
                                                <label for="radio-2"><span class="radio-label"></span> An Incident Occured</label>
                                            </div>
                                        </div>
                                       
                                        <input type="hidden" name="id" value="{ID}" name='id'>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <button type="submit" name="submit" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Post Timesheet</button>
                    </div>
                </form>

            </div>
            <!-- Row / End -->
            </div>

        </div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}
<script src="{SITE_URL}templates/{TPL_NAME}/js/jquery.validate.min.js"></script>
<script>

$(function($) {
    $("#agreement").on('change', function(){
        var agrid = $(this).val();
        console.log(agrid);
        var data = { action: "getAgreementRateByid", agrid: agrid};
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function(result){
                $("#agreement_rate ").empty();
                $("#agreement_rate ").html(result).selectpicker('refresh');
            }
        });
    });
    
   $.validator.addMethod('greaterThan', function (value, element, param) {
    var start_time=$(param).val();
    var end_time = value;
    var aDate= new Date(Date.parse('01/01/2011 '+start_time));
    var bDate = new Date(Date.parse('01/01/2011 '+end_time));
    return this.optional(element) || (aDate <= bDate);

    }, 'Invalid value');
   var $shiftForm = $("#shift-form"),$form=
		$shiftForm.validate({
			rules: {
                agreement:{
                    required: true,
                },
				agreement_rate:{
					required: true,
				},
                start_time:{
                    required: true,   
                },
				end_time: {
					required: true,
                    greaterThan:'#start_time',
				},
                shift_details:{
                    required: true,   
                }
			},
			messages: {
                agreement:{
                    required: "Please choose any one agreement" 
                },
                agreement_rate:{
                    required: "Please choose any one agreement rate" 
                },
				start_time: {
					required: "Please enter Start time"
				},
				end_time: {
					required: "Please enter end time",
                    greaterThan: 'Start time would not be in future.'
				},
                shift_details:{
                    required: 'Please provide shift details',   
                }
			},
			submitHandler: function (form,e) {
				submitForm();
				return false;
				//e.preventDefault();
				// $.ajax({
                //    type: $(form).attr('method'),
                //    url: siteurl+plugin_directory+"?action=sendAgreement",
                //    data: $(form).serialize(),
				//    dataType: "json",

                // })
                // .done(function (response) {
				// 	if(response.status){
				// 		$('#agreement-form')[0].reset();
				// 		$('#chat_section').removeClass('d-none');
				// 		$('.agreement_section').removeClass('d-none');
				// 		$('#agreement_form_section').addClass('d-none');
				// 	}else{

				// 	}
				// 	console.log(response)
                // }).error(function(response){
                //    console.log(response)

                // });
			
			}
		});
        // $shiftForm.on("blur", "input,textarea", function(e){
		// 	$shiftForm.validate();
		// 	$form.element(this)
		// });
});

   


</script>