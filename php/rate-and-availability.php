<?php
if (checkloggedin()) {
    
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $country_code = !empty($ses_userdata['country_code']) ? $ses_userdata['country_code'] : check_user_country();
    $currency_info = set_user_currency($country_code);
    $currency_sign = $currency_info['html_entity'];
    $day_error='';
    $errors = 0;
    $user_id= $_SESSION['user']['id'];
    $user_city=ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id',$user_id)->find_array();
    $city_codes=array_column($user_city,'city_code');
    $user_pr_days=ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where('user_id',$user_id)->find_array();
    
    if (isset($_POST['submit_details'])) {
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
           
            foreach ($city_codes as $c_code) {
                if(!in_array($c_code,$cities)){
                    $c=ORM::for_table($config['db']['pre'] . 'user_cities')->where(['user_id'=>$user_id,'city_code'=>$c_code])->find_one();
                    $c->delete();
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
            }

            $days = $_POST['days'];
            $day_codes=array_column($user_pr_days,'day');
            foreach ($day_codes as $day) {
                if(!in_array($day,$days)){
                    $c=ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id'=>$user_id,'day'=>$day])->find_one();
                    $c->delete();
                }
            }
            foreach ($days as $key => $day) {
                $exist=ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id'=>$user_id,'day'=>$day])->find_one();
                if(!$exist){
                    $u_day=ORM::for_table($config['db']['pre'] .'user_prefered_days')->create();
                    $u_day->user_id=$user_id;
                    $u_day->day = $day;
                    $u_day->save();
                }
            }
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
    $page->SetLoop('USER_CITY', get_citite($city_codes));
    $page->SetParameter('USER_PRE_DAYS',implode(',',array_column($user_pr_days,'day')));
    $page->SetParameter('USER_CURRENCY_SIGN', $currency_sign);
    $page->SetParameter('DAY_ERROR', $day_error);
    $page->SetParameter('OVERALL_FOOTER', create_footer());


    $page->SetLoop('USER_CITY', get_citite($city_codes));

    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);  
}