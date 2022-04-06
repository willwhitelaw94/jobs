<?php

if(checkloggedin())
{  
    //update_lastactive();

    if (!isset($_GET['page']))
        $_GET['page'] = 1;
    $limit = 10;
    $page = $_GET['page'];
    $offset = ($page - 1) * $limit;

    $user_id=$_SESSION['user']['id'];
    $user_type=$_SESSION['user']['user_type'];
    if($user_type=='employer'){
       $commission=(int)get_option('client_commission');

       $total_item= ORM::for_table($config['db']['pre'].'timesheets')->table_alias('t')
        ->where(array(
            'a.client_id' => $user_id,
        ))
        ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
        ->count();

        $shift_data= ORM::for_table($config['db']['pre'].'timesheets')->table_alias('t')
        ->select_many('t.*','a.*','ar.*','w.name','w.username',['id'=>'t.id'],['status'=>'t.status'])
        ->where(array(
            'a.client_id' => $user_id,
            'a.status'=>'accepted',
        ))
        ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
        ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
        ->right_outer_join($config['db']['pre'] . 'user', array('w.id', '=', 'a.worker_id'), 'w')
        ->limit($limit)->offset($offset)
        ->find_many();

    }else{
        $commission=(int)get_option('worker_commission');

        $total_item= ORM::for_table($config['db']['pre'].'timesheets')->table_alias('t')
        ->where(array(
            't.worker_id' => $user_id,
        ))->count();

        $shift_data= ORM::for_table($config['db']['pre'].'timesheets')->table_alias('t')
        ->select_many('t.*','a.*','ar.*','c.name','c.username',['id'=>'t.id'],['status'=>'t.status'])
        ->where(array(
            't.worker_id' => $user_id,
            'a.status'=>'accepted',
        ))
        ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
        ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
        ->right_outer_join($config['db']['pre'] . 'user', array('c.id', '=', 'a.client_id'), 'c')
        ->limit($limit)->offset($offset)
        ->find_many();
    }
    $item=[];
    foreach ($shift_data as $info) {
        $datetime1 = new DateTime($info['start_time']);
        $datetime2 = new DateTime($info['end_time']);
        $interval = $datetime1->diff($datetime2);

        $iCostPerHour =$info['rate'];
        $h= $interval->format('%H');
        $m= $interval->format('%I');
        $hour_rate=$h*$iCostPerHour+$m/60*$iCostPerHour;
        $total_hour_rate= $hour_rate+ ($hour_rate*$commission/100);
        $total_due=number_format((float)$total_hour_rate, 2, '.', ''); 

        $item[$info['id']]['id'] = $info['id'];
        $item[$info['id']]['hours'] = $interval->format('%h').' Hrs '.$interval->format('%i').' Min';
        $item[$info['id']]['date'] =date('d/m/Y', strtotime($info['created_at']));
      //  $item[$info['id']]['rate'] = $info['rate'];
      //  $item[$info['id']]['hour_rate'] =  $hour_rate;
        $item[$info['id']]['due'] =  $total_due;
        $item[$info['id']]['status'] = $info['status'];
       // $item[$info['id']]['status_arr'] = ;
        $item[$info['id']]['fullname'] = !empty($info['name']) ? ucwords($info['name']) :ucfirst($info['username']) ;
    }
   // echo "<pre>";
   // print_r($item);
   // die;
    $pagging = pagenav($total_item, $_GET['page'], $limit, $link['TIMESHEET']);

    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/timesheet.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['JOB_ALERT']));
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('TIMESHEET'));
    $page->SetLoop('ITEM',$item);
    $page->SetLoop('PAGES', $pagging);
    $page->SetParameter('TOTALITEM', $total_item);
    $page->CreatePageEcho();


}
?>