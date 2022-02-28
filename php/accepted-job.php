<?php

if(checkloggedin())
{
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    if($ses_userdata['user_type'] != 'user'){
        headerRedirect($link['DASHBOARD']);
    }

    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/accepted_job.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['JOB_ALERT']));
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->CreatePageEcho();

}
?>