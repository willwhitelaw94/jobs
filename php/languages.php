<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(checkloggedin()){
    update_lastactive();
    $user_id= $_SESSION['user']['id'];
    $main_languages=ORM::for_table($config['db']['pre'] . 'language')->where('type','main')->find_array();
    $other_languages=ORM::for_table($config['db']['pre'] . 'language')->where('type','others')->find_array();
    $user_main_lang=ORM::for_table($config['db']['pre'] . 'user_languages')->where('user_id',$user_id)->where_raw('NOT(language_id <=> NULL)')->find_array();
    $user_main_lang_ids=array_column($user_main_lang,'language_id');
 //   $user_other_lang=ORM::for_table($config['db']['pre'] . 'user_languages')->where('user_id',$user_id)->where_raw('NOT(language_other_id  <=> NULL)')->find_array();
   // $user_other_lang_ids=array_column($user_other_lang,'language_other_id');
    if(isset($_POST['submit_details'])){
        $m_langs=$_POST['main_langs'];
       // $o_langs=$_POST['other_langs'];
        foreach ($user_main_lang_ids as $lang_id) {
            if(!in_array($lang_id,$m_langs)){
                $ml=ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id'=>$user_id,'language_id'=>$lang_id])->find_one();
                $ml->delete();
            }
        }
        foreach ($m_langs as $key => $m_lang) {
            $exist=ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id'=>$user_id,'language_id'=>$m_lang])->find_one();
            if(!$exist){
                $u_m_lang=ORM::for_table($config['db']['pre'] .'user_languages')->create();
                $u_m_lang->user_id=$user_id;
                $u_m_lang->language_id  = $m_lang;
                $u_m_lang->save();
            }
        }

        // foreach ($user_other_lang_ids as $lang_id) {
        //     if(!in_array($lang_id,$m_langs)){
        //         $ol=ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id'=>$user_id,'language_other_id'=>$lang_id])->find_one();
        //         $ol->delete();
        //     }
        // }
        // foreach ($o_langs as $key => $o_langs) {
        //     $exist=ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id'=>$user_id,'language_other_id'=>$o_langs])->find_one();
        //     if(!$exist){
        //         $u_o_lang=ORM::for_table($config['db']['pre'] .'user_languages')->create();
        //         $u_o_lang->user_id=$user_id;
        //         $u_o_lang->language_other_id  = $o_langs;
        //         $u_o_lang->save();
        //     }
        // }
        transfer($link['LANGUAGES'], $lang['LANGUAGE_UPDATED'], $lang['LANGUAGE_UPDATED']);
        exit;
    }

    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/languages.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['RATE_AVAILABILITY']));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetLoop('MAINLANGS',$main_languages);
  //  $page->SetLoop('OTHERLANGS',$other_languages);
    $page->SetParameter('USER_MAIN_LANG',implode(',',$user_main_lang_ids));
    //$page->SetParameter('USER_OTHER_LANG',implode(',',$user_other_lang_ids));
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('MY_LANGUAGES'));
 
    $page->CreatePageEcho();
    
}else{
    headerRedirect($link['LOGIN']);
}