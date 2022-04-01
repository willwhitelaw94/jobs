<?php

if(checkloggedin())
{
    update_lastactive();
    $user_id=$_SESSION['user']['id'];

    ORM::for_table($config['db']['pre'].'timesheets')->table_alias('t')
    ->where(array(
        't.worker_id' => $user_id,
    ))
    ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
    ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
    ->find_many();

    // $agr_data =  ORM::for_table($config['db']['pre'].'user_agreements')->table_alias('a')
    // ->select_many('a.*','p.product_name',['client_name'=>'c.name'])
    // ->where(array(
    //             'p.status' => 'active',
    //             'p.hide' => '0',
    //             'a.worker_id' => $user_id,
    //             'a.status' => 'accepted'
    // ))
    // ->join($config['db']['pre'] . 'product', array('a.post_id', '=', 'p.id'), 'p')
    // ->join($config['db']['pre'] . 'user', array('a.client_id', '=', 'c.id'), 'c')
    // ->find_many();
  



    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/timesheet.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['JOB_ALERT']));
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('TIMESHEET'));
    $page->CreatePageEcho();


}
?>