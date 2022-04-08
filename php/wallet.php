<?php
if(checkloggedin())
{
	update_lastactive();
    $res_userdata = get_user_data($_SESSION['user']['username']);
    $credit_amount = ORM::for_table($config['db']['pre'].'wallet')
    		->select('amount')
            ->where('userid', $res_userdata['id'])
            ->where('status', '1')
            ->sum('amount');
    $debit_amount = ORM::for_table($config['db']['pre'].'wallet')
    		->select('amount')
            ->where('userid', $res_userdata['id'])
            ->where('status', '0')
            ->sum('amount'); 
      
    if(empty($credit_amount)){
    	$credit_amount = 0;
    }
    if(empty($debit_amount)){
    	$debit_amount = 0;
    }
    $wallet_amount = ($credit_amount - $debit_amount);
    if(empty($credit_amount) ){
    	$wallet_amount = "0.00";
    } 

    $transactions = array();
    $count = 0;
    $rows = ORM::for_table($config['db']['pre'].'wallet')
        ->where('userid',$_SESSION['user']['id'])
        ->order_by_asc('id')
        ->find_many();
    $total_item = count($rows);    
    foreach ($rows as $row)
    {
        $transactions[$count]['id'] = $row['id'];
        $transactions[$count]['description'] = $row['description'];
        $transactions[$count]['date'] = $row['date'];
        $t_status = $row['status'];
        $status = '';
        if ($t_status == "1") {
            $credit = '<span class="badge green">$ '.$row['amount'].'</span>';
            $debit = '--';
        }else{
        	$credit = '--';
            $debit = '<span class="badge red">$ '.$row['amount'].'</span>';
        }

        $remaning_amount = '<span class="badge">$ '.$row['amount'].'</span>';

        $transactions[$count]['debit'] = $debit;
        $transactions[$count]['credit'] = $credit;
        $transactions[$count]['closing_balance'] = $remaning_amount;

        $count++;
    }

    $pagging = pagenav($total,$page,$limit,$link['MYCOMPANIES']);
    // Output to template
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/wallet.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['WALLET']));
    $page->SetLoop ('TRANSACTIONS', $transactions);
    $page->SetParameter ('OVERALL_AMOUNT', $wallet_amount);
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->CreatePageEcho();
}else{
	headerRedirect($link['LOGIN']);
}
?>
