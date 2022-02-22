IF('{CL_OPTIONS}' != ''){
<div class="{DIS_CLASS}"  id="option_section{CL_ID}">
    <div class="row">
        <div class="col-12" style="margin-bottom: 10px;">
        <h4>{CL_NAME} :</h4>
        </div>
            {LOOP: CL_OPTIONS}
            <div class="col-sm-3">
                <label class="container_checkbox">
                <b>{CL_OPTIONS.name}</b>
                    <input type="checkbox" class='background_opt' value="{CL_OPTIONS.id}" name="back_options[]" IF(in_array('{CL_OPTIONS.id}',explode(",",'{USER_BCK_OPTIONS}'))){ checked  {:IF}  id="backopt{CL_OPTIONS.id}">
                    <span class="checkmark_lable"></span>
                    <small class="checkmark_list"></small>
                </label>
            </div>
            {/LOOP: CL_OPTIONS} 
    </div>
    <hr><br>
</div>
{:IF} 
