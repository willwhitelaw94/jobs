{OVERALL_HEADER}
<style>
    .dashboard-box {
    z-index: 999;
}

.del_btn_cl a {
color: #bd1111;
}

.btn-group.bootstrap-select {
    margin-bottom: 10px;
}

.select_del_cl{display: flex;}

.selct_wrap_cl_m{    width: 90%;}
.del_btn_cl{ width: 10%;     text-align: center;}
.del_btn_cl a{color: white;
    background-color: #bd1111;
    padding: 10px 13px;
    border-radius: 5px;
    margin-left: 8px;}

   

.submit-field {
    margin-bottom: 6px;

}

.wrap_group {
    margin-bottom: 10px;
    border: 1px solid #e5e5e57a;
    background-color: #ebebeb26;
    padding: 8px 10px 0 0px;
}


@media only screen and (max-width: 600px) {
    .input-with-icon {
width: 90%;
}
}

select.bs-select-hidden, select.selectpicker {
    display: block !important;
}

</style>
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
                        <h3><i class="icon-feather-user"></i> {LANG_MY_SKILLS}</h3>
                    </div>
                    <div class="content with-padding js-accordion-body">
                        <div class="py-0">
                            <form method="post" accept-charset="UTF-8">
                                <div class="repeater">
                                    <div data-repeater-list="skills">
                                        <div data-repeater-item  class="row repeater wrap_group" >
                                            <div class="col-md-6">
                                                <div class="submit-field">
                                                    <div class="input-with-icon">
                                                        <input class="with-border margin-bottom-0" type="number" placeholder="Add skill"
                                                            name="name"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="select_del_cl">
                                               <div class="selct_wrap_cl_m">
                                                <select class="selectpicker skill_level" data-selected-text-format="count > 1" name="level" >
                                                    <option>beginner</option>
                                                    <option>intermidiate</option>
                                                    <option>advance</option>
                                                </select>
                                               </div>

                                                <div class="del_btn_cl">
                                                    <a href="javascript:void(0)" data-repeater-delete type="button" value="Delete"><i class="fa fa-trash"></i></a>
                                                   </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                   <div class="row">
                                    <div class="col-md-12 col-xl-12">
                                      <div class="">
                                        <a href="javascript:void(0)" data-repeater-create type="button" value="Add"><i class="fa fa-plus"></i>Add New Skill</a>

                                      </div>
                                      &nbsp;
                                    </div>
                                   </div>
                               </div>
                               <div class="row">
                                <div class="col-md-12 col-xl-12">
                                <button type="submit" name="submit_details" class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
                                </div>
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
<script type="text/javascript">
$(function(){
    $('.repeater').repeater({
        isFirstItemUndeletable: true
    });
    $('.selectpicker').selectpicker({
      });
    
});

</script>
