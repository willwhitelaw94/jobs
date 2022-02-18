<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if (checkloggedin()) {
    
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $country_code = !empty($ses_userdata['country_code']) ? $ses_userdata['country_code'] : check_user_country();
    $currency_info = set_user_currency($country_code);
    $currency_sign = $currency_info['html_entity'];
    $day_error='';
    $errors = 0;
    $user_id= $_SESSION['user']['id'];
    $user_city=(array)$user_city=ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id',$user_id)->find_many()->as_array();
    if (isset($_POST['submit_details'])) {
       
        //dd($_POST['city']);
        if(empty($_POST['days'])){
            $errors++;
            $day_error= "<span class='status-not-available'> " . $lang['DAY_REQ'] . "</span>";   
        }
        if ($errors == 0) {
            $salary_min = $salary_max = 0;
            if (!empty($_POST['salary_min']) or !empty($_POST['salary_max'])) {
                $salary_min = is_numeric($_POST['salary_min']) ? $_POST['salary_min'] : 0;
                $salary_max = is_numeric($_POST['salary_max']) ? $_POST['salary_max'] : 0;
            }
          
            $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
            $user_update->set('salary_min', $salary_min);
            $user_update->set('salary_max', $salary_max);
            $user_update->set('available_to_work',$_POST['available_to_work']??"0");
            $user_update->set('is_session_willing',$_POST['session_willing']??"0");
            $user_update->save();
            $cities = $_POST['city'];
            $city_arr=[];
            ////dd(get_cityDetail_by_id());die;
            $city_codes=array_column($user_city,'city_code');
            //dd($city_codes);
            foreach ($city_code as $c_code) {
                if(!in_array($c_code,$cities)){
                    ORM::for_table($config['db']['pre'] . 'user_cities')->where(['user_id'=>$user_id,'city_code'=>$c_code])->delete_one();
                }
            }
            foreach ($cities as $key => $city) {
                $citydata = get_cityDetail_by_id($city);
                $country = $citydata['country_code'];
                $state = $citydata['subadmin1_code'];
                $exist=ORM::for_table($config['db']['pre'] . 'user_cities')->where(['user_id'=>$user_id,'city_code'=>$city])->find_one();
                if(!$exist){
                    $u_city=ORM::for_table($config['db']['pre'] .'user_cities')->create();
                    $u_city->user_id=$user_id;
                    $u_city->city_code = $city;
                    $u_city->state_code= $state;
                    $u_city->country_code= $country;
                    $u_city->save();
                }
               
                //array_push($city_arr,['user_id'=>$_SESSION['user']['id'],'city_code'=>$city,'state_code'=>$state, 'country_code'=>$country]); 
            }
           // ORM::for_table($config['db']['pre'] . 'user')->find_one($_SESSION['user']['id']);
          
           // print_r($user_city);
            // if($user_city->count()>0){
            //     ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id',$_SESSION['user']['id'])->delete_many();
            // } 
            transfer($link['RATE_AVAILABILITY'], $lang['DETAILS_UPDATED'], $lang['DETAILS_UPDATED']);
            exit;
        }
    }
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/rate-and-availability.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['RATE_AVAILABILITY']));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetLoop('DAYSLIST', getDays());
    $page->SetParameter('SALARY_MIN', $ses_userdata['salary_min']);
    $page->SetParameter('SALARY_MAX', $ses_userdata['salary_max']);
    $page->SetParameter('SESSION_WILLING', $ses_userdata['is_session_willing']);
    $page->SetParameter('AVLTOWORK', $ses_userdata['available_to_work']);
    $page->SetLoop('USER_CITY',$user_city);
    $page->SetParameter('USER_CURRENCY_SIGN', $currency_sign);
    $page->SetParameter('DAY_ERROR', $day_error);
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);  
}
?>