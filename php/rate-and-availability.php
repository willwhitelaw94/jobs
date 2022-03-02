<?php
if (checkloggedin()) {
    
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $country_code = !empty($ses_userdata['country_code']) ? $ses_userdata['country_code'] : check_user_country();
    $currency_info = set_user_currency($country_code);
    $currency_sign = $currency_info['html_entity'];
    $day_error=$time_error='';
    $errors = 0;
    $user_id= $_SESSION['user']['id'];
    $user_city=ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id',$user_id)->find_array();
    $city_codes=array_column($user_city,'city_code');

    $user_pr_days=ORM::for_table($config['db']['pre'] . 'user_prefered_days')
    ->select_many('id','user_id','day')
    ->select_many_expr(["start_time"=>"TIME_FORMAT(start_time,'%h:%i %p')"],["end_time"=>"TIME_FORMAT(end_time, '%h:%i %p')"])
    ->where('user_id',$user_id)->find_array();
    $user_days=[];
    foreach($user_pr_days as $val){
        $user_days[$val['day']]=['start_time'=>$val['start_time'],'end_time'=>$val['end_time']];
    }
    $user_pr_days_code=array_keys($user_days);

    foreach(getDays() as $days){
        $cls = 'd-none';
        $start_time= $end_time='';
        if(in_array($days['code'],$user_pr_days_code)){
            $cls=''; 
            $start_time =   $user_days[$days['code']]['start_time'];
            $end_time =     $user_days[$days['code']]['end_time'] ; 
        }
        $day_time_slots.='
        <div class="col-xl-12 time_section '.$cls.'" id="section_'.$days['code'].'" data-day-code="'.$days['code'].'">
                <div class="col-xl-6">
                    <div class="submit-field">
                        <h5>'.$days['day'].'</h5>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="input-with-icon">
                                    <input class="with-border" type="text" placeholder="'.$lang['START_TIME'].'" value="'.$start_time.'" name="time_slot['.$days['code'].'][start_time]">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="input-with-icon">
                                    <input class="with-border" type="text" placeholder="'.$lang['END_TIME'].'"  value="'.$end_time.'" name="time_slot['.$days['code'].'][end_time]">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>';
    }
    
    if (isset($_POST['submit_details'])) {
    //    echo date("H:i:s", strtotime($_POST['time_slot']['MON']['start_time'])); 
    //   dd($_POST['time_slot']['MON']['start_time']);
        $days = $_POST['days'];
        $time_slots =  $_POST['time_slot'];
        if(empty($_POST['days'])){
            $errors++;
            $day_error= "<span class='status-not-available'> " . $lang['DAY_REQ'] . "</span>";   
        } 

        //dd($time_slots);
     
        foreach ($time_slots as $key=>$slot) {
           $st_time=!empty($slot['start_time'])? date('H:i:s',strtotime($slot['start_time'])) :'';
           $en_time =!empty($slot['end_time']) ? date('H:i:s',strtotime($slot['end_time'])) : '';
          
           if(!empty($st_time) || !empty($en_time)){
                if($en_time <= $st_time) {
                    $errors++;
                    $time_error = $lang['INVALID_END_TIME'].' for '.$key.'';
                    break;  
                }
           }else{
               continue;
           }
         
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

          
            
            $day_codes=array_column($user_pr_days,'day');
            foreach ($day_codes as $day) {
                if(!in_array($day,$days)){
                    $c=ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id'=>$user_id,'day'=>$day])->find_one();
                    $c->delete(); 
                }
            }
            foreach ($days as $key => $day) {
                $e_day=ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id'=>$user_id,'day'=>$day])->find_one();
                $d_start_time= !empty($time_slots[$day]['start_time'])? date('H:i:s',strtotime($time_slots[$day]['start_time'])) : null;
                $d_end_time =!empty($time_slots[$day]['end_time'])? date('H:i:s',strtotime($time_slots[$day]['end_time'])) : null;
                if(!$e_day){
                    $u_day=ORM::for_table($config['db']['pre'] .'user_prefered_days')->create();
                    $u_day->user_id=$user_id;
                    $u_day->day = $day;
                    $u_day->start_time=$d_start_time;
                    $u_day->end_time=$d_end_time;
                    $u_day->save();      
                }else{
                   $e_day->set('start_time',$d_start_time);
                   $e_day->set('end_time',$d_end_time);
                   $e_day->save();
                  
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
    $page->SetLoop('DAYSLISTFORTIME', getDays());
    $page->SetParameter('DAYTIMESLOTS',$day_time_slots);
    $page->SetParameter('SALARY_MIN', $ses_userdata['salary_min']);
    $page->SetParameter('SALARY_MAX', $ses_userdata['salary_max']);
    $page->SetParameter('SESSION_WILLING', $ses_userdata['is_session_willing']);
    $page->SetParameter('AVLTOWORK', $ses_userdata['available_to_work']);
    $page->SetLoop('USER_CITY', get_citite($city_codes));
    $page->SetParameter('USER_PRE_DAYS',implode(',',$user_pr_days_code));
    $page->SetParameter('USER_CURRENCY_SIGN', $currency_sign);
    $page->SetParameter('DAY_ERROR', $day_error);
    $page->SetParameter('TIME_ERROR', $time_error);
    $page->SetLoop('USER_TIMESLOTS',$time_slots);
    $page->SetParameter('TIME_SLOTS',$user_time_slots);
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('RATE_AVAILABILITY'));
    $page->SetLoop('USER_CITY', get_citite($city_codes));

    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);  
}