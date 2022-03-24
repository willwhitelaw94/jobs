<?php

if(checkloggedin())
{
    update_lastactive();


    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/user-documents.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['ADD_DOCUMENT']));

    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('ADD_DOCUMENT'));
    $page->SetParameter ('TITLE', $title);
    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);
}