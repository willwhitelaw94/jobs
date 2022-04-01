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
                                <h3><i class="icon-feather-folder-plus"></i>{LANG_ADD_SHIFT}</h3>
                            </div>

                            <div class="content with-padding padding-bottom-10">
                                
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="submit-field">
                                            <h5>Agreement <span class="required">*</span></h5>
                                            <select class="selectpicker with-border agreement" id="agreement" title="Select a Agreement" name="agreement" >
                                            {LOOP: ITEM}
                                            <option value="{ITEM.id}" data-subtext="{ITEM.client_name}">{ITEM.product_name}</option>
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
                                                        <input class="with-border" type="text" name="start_time" placeholder="Start" id="start_time">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                    <label id="start_time-error" class="error" for="start_time"></label> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="input-with-icon">
                                                        <input class="with-border" type="text" name="end_time" placeholder="Finish" id="end_time">
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
                                            <textarea cols="30" rows="5" class="with-border" name="shift_details"></textarea>
                                            <div class="uploadButton margin-top-30">
                                                <input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload" multiple/>
                                                <label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
                                                <span class="uploadButton-file-name">Images or documents that might be helpful in describing your project</span>
                                            </div>
                                        </div>
                                        <div class="feedback-yes-no margin-top-0">
                                            <div class="radio">
                                                <input id="radio-1" name="incidence_occured" type="radio" checked value="0">
                                                <label for="radio-1"><span class="radio-label"></span> No Reportable Incidents</label>
                                            </div>

                                            <div class="radio">
                                                <input id="radio-2" name="incidence_occured" type="radio" value="1">
                                                <label for="radio-2"><span class="radio-label"></span> An Incident Occured</label>
                                            </div>
                                        </div>
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
                $("#agreement_rate").html(result).selectpicker('refresh');
            }
        });
    });
    
// $("#agreements").trigger('change');
//   function formatAMPM(date) {
//   var hours = date.getHours();
//   var minutes = date.getMinutes();
//   var ampm = hours >= 12 ? 'pm' : 'am';
//   hours = hours % 12;
//   hours = hours ? hours : 12; // the hour '0' should be '12'
//   minutes = minutes < 10 ? '0'+minutes : minutes;
//   var strTime = hours + ':' + minutes + ' ' + ampm;
//   return strTime;
// }
//console.log(formatAMPM(new Date));

    $.validator.addMethod('greaterThan', function (value, element, param) {
        //var timefrom = new Date();
      //  timefrom.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
    //     temp = $(param).val().split(":");
    //     timefrom.setHours((parseInt(temp[0]) - 1 + 24) % 24);
    //     timefrom.setMinutes(parseInt(temp[1]));
    //     var timeto = new Date();
    //     temp = value.split(":");
    //     timeto.setHours((parseInt(temp[0]) - 1 + 24) % 24);
    //   //  timefrom.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
    //     timeto.setMinutes(parseInt(temp[1]));

    //     console.log(formatAMPM(timefrom))
    //     console.log(formatAMPM(timeto))
    var start_time=$(param).val();
    var end_time = value;
    var aDate= new Date(Date.parse('01/01/2011 '+start_time));
    var bDate = new Date(Date.parse('01/01/2011 '+end_time));
    return this.optional(element) || (aDate <= bDate);

    }, 'Invalid value');
   var $shiftForm = $("#shift-form"),$form=
		$shiftForm.validate({
			// ignore: [':not(checkbox:hidden)'],
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