<?php
if(checkloggedin())
{
    $errors = 0;
    $acc_amount_error = "";
    $userdata = get_user_data($_SESSION['user']['username']);
    if(isset($_POST['submit_details'])){
       
        if (empty($_POST["account_amount"])) {
            $errors++;
            $acc_amount_error = $lang['ENTERAMOUNT'];
            $acc_amount_error = "<span class='status-not-available'> " . $acc_amount_error. "</span>";
        }
        
        if ($errors == 0) {
            $now = date("Y-m-d H:i:s");           
            $amount = $_POST["account_amount"];
            $email = $userdata['email'];

            $rows = ORM::for_table($config['db']['pre'].'payments')
                    ->where('payment_install', '1')
                    ->find_many();
            $num_rows = count($rows);
            foreach ($rows as $info)
            {
                $payment_types[$info['payment_id']]['id'] = $info['payment_id'];
                $payment_types[$info['payment_id']]['title'] = $info['payment_title'];
                $payment_types[$info['payment_id']]['folder'] = $info['payment_folder'];
                $payment_types[$info['payment_id']]['desc'] = $info['payment_desc'];
            }  
            $bank_information = nl2br(get_option('company_bank_info'));
            $title = "Wallet";      

            $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/membership_payment.tpl');
            $page->SetParameter ('OVERALL_HEADER', create_header($lang['UPGRADE']));
            $page->SetLoop ('PAYMENT_TYPES', $payment_types);
            $page->SetParameter ('UPGRADE', '');
            $page->SetParameter ('PAYMENT_METHOD_COUNT', $num_rows);
            $page->SetParameter ('SUB_ID', '');
            $page->SetParameter ('BANK_INFO', $bank_information);
            $page->SetParameter ('START_DATE', '');
            $page->SetParameter ('EXPIRY_DATE', '');
            $page->SetParameter ('ORDER_TITLE', $title);
            $page->SetParameter ('AMOUNT', $amount);
            $page->SetParameter ('EMAIL', $email);
            $page->SetParameter('PLAN_TYPE', 'wallet');
            $page->SetParameter ('COUNTRY_CODE', strtoupper(check_user_country()));
            $page->SetParameter ('OVERALL_FOOTER', create_footer());
            $page->CreatePageEcho();

            exit;
        }
    }


    $pagging = pagenav($total,$page,$limit,$link['MYCOMPANIES']);
    // Output to template
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/create-wallet.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['WALLET']));
    $page->SetParameter('AMOUNT_ERROR', $acc_amount_error);
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->CreatePageEcho();
}else{
	headerRedirect($link['LOGIN']);
}
?>