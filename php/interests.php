<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(checkloggedin()){
    update_lastactive();
    $user_id= $_SESSION['user']['id'];
    $userInterest = ORM::for_table($config['db']['pre'] . 'user_interests')->select('interest_id')->where('user_id', $user_id)->find_array();
    $userInterestIds=array_column($userInterest,'interest_id');
    // $backgroundOptions = ORM::for_table($config['db']['pre'] .'cultural_background_options')->find_array();
    $interests = ORM::for_table($config['db']['pre'] .'interests')->select_many('id','name')->find_array();
    $error=0;
    $inte_error='';
    if(isset($_POST['submit_details'])){
       
        $rel=$_POST['interest'];
        if(empty($rel)){
           $error++; 
           $inte_error = "<span class='status-not-available'> " . $lang['INTERESTREQ'] . "</span>";
        }
       if($error==0){
        foreach ($userInterestIds as $inte_id) {
            if(!in_array($inte_id,$rel)){
                $rl=ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id'=>$user_id,'interest_id'=>$inte_id])->find_one();
                $rl->delete();
            }
        }
        foreach ($rel as $key => $r) {
            $exist=ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id'=>$user_id,'interest_id'=>$r])->find_one();
            if(!$exist){
                $u_inte=ORM::for_table($config['db']['pre'] .'user_interests')->create();
                $u_inte->user_id=$user_id;
                $u_inte->interest_id= $r;
                $u_inte->save();
            }
        }
        transfer($link['INTERESTS'], $lang['INTEREST_UPDATED'], $lang['INTEREST_UPDATED']);
        exit;
       }
       
    } 
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/interests.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['INTERESTS']));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetLoop('INTEREST',$interests);
    $page->SetParameter('USER_INTEREST',implode(',',$userInterestIds));
    $page->SetParameter('INTERROR',$inte_error);
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('MY_INTERESTS'));
    $page->CreatePageEcho();
    
}else{
    headerRedirect($link['LOGIN']);
}