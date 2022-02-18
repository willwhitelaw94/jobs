<?php
if (checkloggedin()) {
    update_lastactive();
    
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $user_bankdata=ORM::for_table($config['db']['pre'].'user_bank_details')->where('user_id', $_SESSION['user']['id'])->find_one();
    

    $author_image = $ses_userdata['image'];
    $username_error = $email_error = $password_error = $type_error = $avatar_error = '';
    $avatarName = null;
    $errors = 0;
    $author_lastactive = date('d M Y H:i', strtotime($ses_userdata['lastactive']));
    $acc_name_error="";
    $bank_name_error="";
    $bsb_error="";
    $acc_number_error="";
    if(isset($_POST['submit_details'])){
       
        if (empty($_POST["account_name"])) {
            $errors++;
            $acc_name_error = $lang['ENTERACCOUNTNAME'];
            $acc_name_error = "<span class='status-not-available'> " . $acc_name_error. "</span>";
        }
        if (empty($_POST["bank_name"])) {
            $errors++;
            $bank_name_error = $lang['ENTERBANKNAME'];
            $bank_name_error ="<span class='status-not-available'> " . $bank_name_error. "</span>";
        }
        if (empty($_POST["bsb"])) {
            $errors++;
            $bsb_error = $lang['ENTERBSBNAME'];
            $bsb_error ="<span class='status-not-available'> " . $bsb_error. "</span>";
        }
       if (empty($_POST["account_number"])) {
            $errors++;
            $acc_number_error = $lang['ENTERACCOUNTNUMBER'];
            $acc_number_error ="<span class='status-not-available'> " . $acc_number_error. "</span>";
        }
      
        if ($errors == 0) {
            $now = date("Y-m-d H:i:s");
          
          
            if($user_bankdata){
                $user_bankdata->set(['account_name'=>$_POST['account_name'],
                                     'bank_name'=>$_POST['bank_name'],
                                     'bsb'=>$_POST['bsb'],
                                     'account_number'=>$_POST['account_number'],
                                     'updated_at'=>$now]
                                    );
                $user_bankdata->save();
            }else{
                
                $insert_bankdata = ORM::for_table($config['db']['pre'].'user_bank_details')->create();
               
                $insert_bankdata->user_id=$_SESSION['user']['id'];
                $insert_bankdata->account_name=$_POST['account_name'];
                $insert_bankdata->bank_name=$_POST['bank_name'];
                $insert_bankdata->bsb=$_POST['bsb'];
                $insert_bankdata->account_number=$_POST['account_number'];
                $insert_bankdata->created_at=$now;
                $insert_bankdata->updated_at=$now;
                 //dd($insert_bankdata);
                 $insert_bankdata->save();
            }
           
            transfer($link['BANK_DETAILS'], $lang['PROFILE_UPDATED'], $lang['PROFILE_UPDATED']);
            exit;
        }
    }
    $country_code = !empty($ses_userdata['country_code']) ? $ses_userdata['country_code'] : check_user_country();
    $currency_info = set_user_currency($country_code);
    $currency_sign = $currency_info['html_entity'];
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/bank-account-details.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['Bank Account Datails']));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('ACCOUNTNAME',  $user_bankdata['account_name']??"");
    $page->SetParameter('BANKNAME', $user_bankdata['bank_name']??"");
    $page->SetParameter('BSB', $user_bankdata['bsb']??""); 
    $page->SetParameter('ACCOUNTNUMBER', $user_bankdata['account_number']??""); 
    $page->SetParameter('ACCOUNTNAME_ERROR', $acc_name_error);
    $page->SetParameter('BANKNAME_ERROR', $bank_name_error);
    $page->SetParameter('BSB_ERROR', $bsb_error);
    $page->SetParameter('ACCOUNTNUMBER_ERROR', $acc_number_error);
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);  
}