<?php
global $mysqli;
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(checkloggedin()) {
    $client_comm=get_option('client_commission');
    $worker_comm=get_option('worker_commission');
    $post_data=[];
    if(isset($_GET['postid'])){
        $postid = base64_url_decode($_GET['postid']);
        $post_data=ORM::for_table($config['db']['pre'].'product')->find_one($postid);
    }else{
        $postid = '';
    }

    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $userid = '';
    $chatid = '';
    $chat_username = '';
    $chat_fullname = '';
    $chat_userimg = '';
    $chat_userstatus = '';
    $is_first_chat=0;
    $session_user_id = $ses_userdata['id'];
    $userdata=[];
    if(isset($_GET['userid'])){
        $userid = base64_url_decode($_GET['userid']);
        $userdata = get_user_data(null,$userid);
        if($userdata){
            $chatid = $userid.'_'.$postid;
            $chat_username = $userdata['username'];
            $chat_fullname = ($userdata['name'] != '')? $userdata['name'] : $userdata['username'];
            $chat_userimg = ($userdata['image'] == "")? "default_user.png" : $userdata['image'];
            $chat_userstatus  = ($userdata['online'] == "0")? "offline" : "online";
        }
        $sql = "select * from `".$config['db']['pre']."messages` where  
        ((to_id = $userid AND from_id = $session_user_id  ) 
        OR 
        (to_id = $session_user_id AND from_id = $userid)) AND post_id = $postid order by message_id ASC LIMIT 1 ";
        $result=$mysqli->query($sql);
        
        $is_first_chat = ($result->num_rows > 0) ? 0 : 1;
    }
 
   $msg='';
   if(isset($_GET['postid'])){
    if($ses_userdata['user_type']=='employer'){
        $pro_url = create_slug($post_data['product_name']);
        $job_link = $config['site_url'].'job/' . $post_data['id'] . '/'.$pro_url;
        $salary_min = price_format($post_data['salary_min'],$post_data['country']);
        $salary_max = price_format($post_data['salary_max'],$post_data['country']);
        $created_at= timeAgo($post_data['created_at']);
        $age = getAge($ses_userdata['dob']);
        $cityname = get_cityName_by_id($post_data['city']);
        $statename = get_stateName_by_id($post_data['state']);
        $msg='<div class="chat_box_inner">';
        $msg.='<div class="card">';
        $msg.='<div class="card-header">';
        $msg.='<p class="s_ms"><i class="fa fa-check-circle"></i> Privataly Shared</p>';
        $msg.='<div class="user_date_cl"><p>'.$ses_userdata['name'].'</p><p>'.$age.' Year old</p><p>'.$ses_userdata['sex'].'</p>';            
        $msg.='</div></div>'; 
        $msg.='<div class="card-body">';
        $msg.='<div class="address_details">';            
        $msg.='<p><i class="la la-map-marker"></i> '.$cityname.', '.$statename.' </p> '; 
        $msg.='<p><i class="la la-credit-card"></i> '.$salary_min.' -  '. $salary_max.' '.$lang['PER'].' '.get_salaryType_title_by_id($post_data['salary_type']).'</p>';
        $msg.='<p><i class="la la-clock-o"></i> '.$created_at.'</p>';
        $msg.='<p>'.$post_data['description'].'</p>';
        $msg.='</div>';
        $msg.='<div class="card-footer"><a href="'.$job_link.'">View Full Job Details</a></div>';
        $msg.='</div></div>';
    }else{
        $profile_link = $config['site_url'].'profile/' . $ses_userdata['username'];
        $salary_min = price_format($ses_userdata['salary_min'],$ses_userdata['country']);
        $salary_max = price_format($ses_userdata['salary_max'],$ses_userdata['country']);
        $created = date('d M Y', strtotime($ses_userdata['created_at']));
        $discription = ($ses_userdata['description'] != '')? $ses_userdata['description'] : 'Looking For Job';
        $fullname = ($ses_userdata['name'] != '')? $ses_userdata['name'] : $ses_userdata['username'];
        if(!empty($ses_userdata['city'])){
            $address = $ses_userdata['city'].','.$ses_userdata['country'];
        }else{
            $address = $ses_userdata['country'];
        }
        $msg='<div class="chat_box_inner">';
        $msg.='<div class="card">';
        $msg.='<div class="card-header">';
        $msg.='<p class="s_ms"><i class="fa fa-check-circle"></i> Privataly Shared</p>';
        $msg.='<div class="user_date_cl"><p>'.$fullname.'</p><p>'. getAge($ses_userdata['dob']).' Year old</p><p>'.$ses_userdata['sex'].'</p>';            
        $msg.='</div></div>'; 
        $msg.='<div class="card-body">';
        $msg.='<div class="address_details">';            
        $msg.='<p><i class="la la-map-marker"></i> '.$address.' </p> '; 
        $msg.='<p><i class="la la-credit-card"></i> '.$salary_min.' -  '. $salary_max.'</p>';
        $msg.='<p><i class="la la-clock-o"></i> '.$lang['MEMBER_SINCE'].','.$created.'</p>';
        $msg.='<p>'.$discription.'</p>';
        $msg.='</div>';
        $msg.='<div class="card-footer"><a href="'.$profile_link.'">View Full Profile</a></div>';
        $msg.='</div></div>'; 
    }
   }

  
   
     
    $author_image = $ses_userdata['image'];
    if($config['quickchat_ajax_on_off'] == 'on' || $config['quickchat_socket_on_off'] == 'on') {
    //$page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/quickchat.tpl");
        $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/quickchat_new.tpl");
        $page->SetParameter ('OVERALL_HEADER', create_header($lang['MESSAGE']));
        $page->SetParameter('PAGE_TITLE', $lang['MESSAGE']);
        $page->SetParameter('PAGE_META_KEYWORDS', $config['meta_keywords']);
        $page->SetParameter('LANGUAGE_DIRECTION', get_current_lang_direction());
        $page->SetParameter('PAGE_META_DESCRIPTION', $config['meta_description']);
        $page->SetParameter('USERIMG', $author_image);
        $page->SetParameter('CHATID',$chatid);
        $page->SetParameter('POSTID',$postid);
        $page->SetParameter('CHAT_USERID',$userid);
        $page->SetParameter('CHAT_FULLNAME',$chat_fullname);
        $page->SetParameter('CHAT_USERIMG',$chat_userimg);
        $page->SetParameter('CHAT_USERSTATUS',$chat_userstatus);
        $page->SetParameter('FIRST_CHAT',$is_first_chat);
        $page->SetParameter('FIRST_MSG',$msg);
        $page->SetParameter('USER_SIDEBAR',create_user_sidebar());
        $page->SetParameter('OVERALL_FOOTER', create_footer());
        $page->SetParameter('COPYRIGHT_TEXT', $config['copyright_text']);
   
        $page->SetParameter('WORKER_COMMISSION',$worker_comm);
        $page->SetParameter('CLIENT_COMMISSION',$client_comm);
        $page->CreatePageEcho();
    }
    elseif($config['wchat_on_off'] == 'on') {

        $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/wchat.tpl");
        $page->SetParameter('OVERALL_HEADER', create_header($lang['MESSAGE']));
        $page->SetParameter('PAGE_TITLE', $lang['MESSAGE']);
        $page->SetParameter('PAGE_META_KEYWORDS', $config['meta_keywords']);
        $page->SetParameter('LANGUAGE_DIRECTION', get_current_lang_direction());
        $page->SetParameter('PAGE_META_DESCRIPTION', $config['meta_description']);
        $page->SetParameter('USERIMG', $author_image);
        $page->SetParameter('CHATID',$chatid);
        $page->SetParameter('POSTID',$postid);
        $page->SetParameter('CHAT_USERNAME',$chat_username);
        $page->SetParameter('CHAT_USERID',$userid);
        $page->SetParameter('CHAT_FULLNAME',$chat_fullname);
        $page->SetParameter('CHAT_USERIMG',$chat_userimg);
        $page->SetParameter('CHAT_USERSTATUS',$chat_userstatus);
        $page->SetParameter('FISRT_CHAT',$is_first_chat);
        $page->SetParameter('USER_SIDEBAR',create_user_sidebar());
        $page->SetParameter('WORKER_COMMISSION',$worker_comm);
        $page->SetParameter('CLIENT_COMMISSION',$client_comm);
        $page->SetParameter('COPYRIGHT_TEXT', $config['copyright_text']);
        $page->CreatePageEcho();
    }else
        error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
}else
    headerRedirect($link['LOGIN']);
