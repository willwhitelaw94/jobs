<?php

if(checkloggedin())
{
    update_lastactive();
    $user_id =   $_SESSION['user']['id'];
    $jobRequirements = ORM::for_table($config['db']['pre'].'requirements')->find_array();
    foreach ($jobRequirements as $req)
    {
        $items[$req['id']]['id'] = $req['id'];
        $items[$req['id']]['name'] = $req['name'];
        //print_r($items);
    }
    $userRequirements = ORM::for_table($config['db']['pre'].'user')->find_array();
    foreach ($userRequirements as $userreq)
    {
        $user[$userreq['id']]['id'] = $userreq['id'];
        $user[$userreq['id']]['name'] = $userreq['name'];
        //print_r($user);
    }
    //print_r($userRequirements);

    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/user-documents.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['ADD_DOCUMENT']));
    $page->SetLoop ('ITEM', $items);
    $page->SetLoop ('USER', $user);
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('ADD_DOCUMENT'));
    $page->SetParameter ('TITLE', $title);
    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);
}