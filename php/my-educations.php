<?php
if(checkloggedin())
{   
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    if($ses_userdata['user_type'] != 'user'){
        headerRedirect($link['DASHBOARD']);
    }


    $result = ORM::for_table($config['db']['pre'].'educations')
        ->where('user_id' , $_SESSION['user']['id'])->find_many();
    //dd($result);
    $items = array();
    if ($result) {
        foreach ($result as $info)
        {
            $items[$info['id']]['id'] = $info['id'];
            $items[$info['id']]['institution'] = $info['institution'];
            $items[$info['id']]['course'] = $info['course'];
            $items[$info['id']]['start_date'] = $info['start_date'];
            $items[$info['id']]['end_date'] = date('d M, Y', strtotime($info['end_date']));
            $items[$info['id']]['end_date'] = $info['currently_working']?$lang['CURRENTLY_WORKING']:date('d M, Y', strtotime($info['end_date']));
          
        }
    }

    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/my-educations.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['MY_EDUCATIONS']));
    $page->SetLoop ('ITEM', $items);
    $page->SetParameter ('TOTALITEM',count($result));
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter ('BREADCRUMBS', create_front_breadcrumbs('MY_EDUCATIONS'));
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());

    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);
}