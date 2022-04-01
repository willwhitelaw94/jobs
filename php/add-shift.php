<?php
if(checkloggedin()){
   // update_lastactive();
    $user_id=$_SESSION['user']['id'];
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    
    $agr_data =  ORM::for_table($config['db']['pre'].'user_agreements')->table_alias('a')
        ->select_many('a.*','p.product_name',['client_name'=>'c.name'])
        ->where(array(
                    'p.status' => 'active',
                    'p.hide' => '0',
                    'a.worker_id' => $user_id,
                    'a.status' => 'accepted'
        ))
        ->join($config['db']['pre'] . 'product', array('a.post_id', '=', 'p.id'), 'p')
        ->join($config['db']['pre'] . 'user', array('a.client_id', '=', 'c.id'), 'c')
        ->find_many();
      
    $item = [];
    foreach($agr_data as $data){
        $item[$data['id']]['id'] = $data['id'];
        $item[$data['id']]['product_name'] = $data['product_name'];
        $item[$data['id']]['client_name'] = $data['client_name'];
    }
   // print_r( $_POST);die;
    if (isset($_POST['submit'])) {
        $data = $_POST;
        $start_time=!empty($_POST['start_time'])? date('H:i:s',strtotime($_POST['start_time'])) :'';
        $end_time =!empty($_POST['end_time']) ? date('H:i:s',strtotime($_POST['end_time'])) : '';
        $create_shift =  ORM::for_table($config['db']['pre'].'timesheets')->create();
        $create_shift->worker_id=$user_id;
        $create_shift->agreement_id=$_POST['agreement'];
        $create_shift->agreement_rate_id=$_POST['agreement_rate'];
        $create_shift->start_time=$start_time;
        $create_shift->end_time = $end_time;
        $create_shift->status	= 'submitted';
        $create_shift->shift_details=$_POST['shift_details'];
        $create_shift->incidence_occured=$_POST['incidence_occured'] ? $_POST['incidence_occured']:'0';
        $create_shift->save();
        transfer($link['TIMESHEET'], $lang['SHIFT_ADDED'], $lang['SHIFT_ADDED']);
        exit;
    }

    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/add-shift.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['NEW_SHIFT']));
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetLoop('ITEM',$item);
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('TIMESHEET'));
    $page->CreatePageEcho();

}else{
    headerRedirect($link['LOGIN']);  
}