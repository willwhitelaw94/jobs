<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(checkloggedin()){
    update_lastactive();
    $user_id= $_SESSION['user']['id'];
    $userReligion = ORM::for_table($config['db']['pre'] . 'user_religions')->select('religion_id')->where('user_id', $user_id)->find_array();
    $userReligionIds=array_column($userReligion,'religion_id');
    // $backgroundOptions = ORM::for_table($config['db']['pre'] .'cultural_background_options')->find_array();
    $religions = ORM::for_table($config['db']['pre'] .'religions')->select_many('id','name')->find_array();
    $error=0;
    $rel_error='';
    if(isset($_POST['submit_details'])){
       
        $rel=$_POST['religion'];
        if(empty($rel)){
           $error++; 
           $rel_error = "<span class='status-not-available'> " . $lang['RELIGIONREQ'] . "</span>";
        }
       if($error==0){
        foreach ($userReligionIds as $rel_id) {
            if(!in_array($rel_id,$rel)){
                $rl=ORM::for_table($config['db']['pre'] . 'user_religions')->where(['user_id'=>$user_id,'religion_id'=>$rel_id])->find_one();
                $rl->delete();
            }
        }
        foreach ($rel as $key => $r) {
            $exist=ORM::for_table($config['db']['pre'] . 'user_religions')->where(['user_id'=>$user_id,'religion_id'=>$r])->find_one();
            if(!$exist){
                $u_rel=ORM::for_table($config['db']['pre'] .'user_religions')->create();
                $u_rel->user_id=$user_id;
                $u_rel->religion_id  = $r;
                $u_rel->save();
            }
        }
        transfer($link['RELIGION'], $lang['RELIGION_UPDATED'], $lang['RELIGION_UPDATED']);
        exit;
       }
       
    }
 
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/religion.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['RELIGION']));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetLoop('RELIGIONS',$religions);
    $page->SetParameter('USER_RELIGIONS',implode(',',$userReligionIds));
    $page->SetParameter('RELERROR',$rel_error);
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->CreatePageEcho();
    
}else{
    headerRedirect($link['LOGIN']);
}
?>