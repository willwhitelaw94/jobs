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
    $loop = function($u_level=''){
        $options='';
        foreach(getLevels() as $level){
            $selected = $u_level==$level['val']?'selected':"";
            $options.="<option value=".$level['val']." ".$selected." >".$level['name']."</option>";
        }
        return $options;
    };
    //echo $loop('begginer');
    $user_skill_section='';
    if(!empty($user_skills)){
        foreach ($user_skills as $key => $skill) {
          $user_skill_section.='
            <div data-repeater-item  class="row repeater wrap_group" >
                <div class="col-md-6">
                    <div class="submit-field">
                        <div class="input-with-icon">
                            <input type="hidden" name="id" value="'.$skill['id'].'">
                            <input class="with-border margin-bottom-0" type="text" placeholder="Add skill"
                                name="name"  value="'.$skill['skill'].'" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="select_del_cl">
                        <div class="selct_wrap_cl_m">
                            <select class="skill_level" data-selected-text-format="count > 1" name="level" required>
                            '.$loop($skill['level']).'
                            </select>
                        </div>
                        <div class="del_btn_cl">
                            <a href="javascript:void(0)" data-repeater-delete type="button" value="Delete"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
           ';
        }
    }else{
        $user_skill_section.='
        <div data-repeater-item  class="row repeater wrap_group" >
            <div class="col-md-6">
                <div class="submit-field">
                    <div class="input-with-icon">
                    <input type="hidden" name="id">
                        <input class="with-border margin-bottom-0" type="text" placeholder="Add skill"
                            name="name"  required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="select_del_cl">
                    <div class="selct_wrap_cl_m">
                        <select class="skill_level" data-selected-text-format="count > 1" name="level" required>
                        '.$loop('').'
                        </select>
                    </div>
                    <div class="del_btn_cl">
                        <a href="javascript:void(0)" data-repeater-delete type="button" value="Delete"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>';
    }

    $skills_section ='
    <div class="repeater">
        <div data-repeater-list="skills">
           '.$user_skill_section.'
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
    ';
    $errors=0;

    if (isset($_POST['submit_details'])) {
        if($errors == 0) {            
            $post_data=$_POST['skills'];
            $user_skills_ids=array_column($user_skills,'id');

            $u_posted_ids = array_map(function($skill) { 
                return $skill['id'];
            }, $post_data);
            foreach (array_column($user_skills,'id') as  $id) {
                if(!in_array($id, $u_posted_ids)){
                    $d=ORM::for_table($config['db']['pre'] .'user_skills')->where(['user_id'=>$user_id,'id'=>$id])->find_one(); 
                    $d->delete();
                }
            }
            
           foreach ($post_data as $key => $skill) {
              if(!empty($skill['id'])){
                $u_skill=ORM::for_table($config['db']['pre'] .'user_skills')->where(['user_id'=>$user_id,'id'=>$skill['id']])->find_one();
                $u_skill->set('skill',$skill['name']);
                $u_skill->set('level',$skill['level']);
                $u_skill->save();
              }else{
                $insert_skill=ORM::for_table($config['db']['pre'] .'user_skills')->create();
                $insert_skill->user_id=$user_id;
                $insert_skill->skill=$skill['name'];
                $insert_skill->level=$skill['level'];
                $insert_skill->save();
              }
           }
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