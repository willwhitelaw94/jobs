<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time',3600);
if (checkloggedin()) {
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $user_id = $ses_userdata['id'];
    $user_skills=ORM::for_table($config['db']['pre'] .'user_skills')->where('user_id',$user_id)->find_array();
    $skills_section='';
    $options='';
    foreach (getLevels() as $key => $value) {
        $options.="<option value=".$value['val'].">".$value['name']."</option>";
    }
  
    // $skills_section =' 
    // <div class="row repeater" >
    //     <div class="col-md-5 col-xl-5">
    //         <div class="submit-field">
    //             <div class="input-with-icon">
    //                 <input class="with-border margin-bottom-0" type="number" placeholder="Add skill"
    //                     name="salary_min" value="{SALARY_MIN}" >
    //             </div>
    //         </div>
    //     </div>
    //     <div class="col-md-5 col-xl-5">
    //         <select class="selectpicker" data-selected-text-format="count > 1" name="level" id="level">
    //                 '.$options.'
    //         </select>
    //     </div>
    //     <div class="col-md-2 col-xl-2">
    //     </div>
    //     <div class="col-md-12 col-xl-12">
    //         <a href="javascript:void(0)">Add New Skill</a>
    //     </div>
    // </div>
    
    // ';
    // <!-- <div class="col-md-12">
    // <div class="repeater form-group">
    // <label for="exampleInputfulltype">Add Cultural Option<code>*</code></label>
    //     <div data-repeater-list="options" class="option_repeat">
    //             <div data-repeater-item class="input-group">
    //                 <div class="input-group-addon"><i class="ion-person"></i></div>
    //                 <input type="text"  class="form-control" name="name" placeholder="Add Cultural Name"/>
    //                 <div class="input-group-addon btn-danger" data-repeater-delete type="button" value="Delete"><i class="fa fa-trash"></i></div>
    //             </div>
    //     </div>
      
    //     <div class="input-group-addon btn-primary rpt_click" data-repeater-create type="button" value="Add"><i class="fa fa-plus"></i></div>
    // </div>
    // </div> -->
   

    if (isset($_POST['submit_details'])) {

        if ($errors == 0) {
        
           
              

        }
        transfer($link['SKILLS'], $lang['SKILLS_UPDATED'], $lang['SKILLS_UPDATED']);
        exit;
    }
    
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/my-skills.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['RATE_AVAILABILITY']));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('SKILL_SECTION', $skills_section);
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('MY_SKILLS'));

    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);  
}