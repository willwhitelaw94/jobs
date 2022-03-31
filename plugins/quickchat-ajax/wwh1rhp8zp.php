<?php
/**
 * Quickchat - Fully Responsive PHP AJAX Chat Script
 * @author Bylancer
 * @version 1.0
 * @Date: 14/June/2020
 * @url https://bylancer.com
 * @Copyright (c) 2015-20 Devendra Katariya (bylancer.com)
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../../includes/config.php');
require_once('../../includes/sql_builder/idiorm.php');
require_once('../../includes/db.php');
require_once('../../includes/functions/func.global.php');
require_once('../../includes/functions/func.users.php');
require_once('../../includes/lang/lang_'.$config['lang'].'.php');
require_once('../../includes/seo-url.php');
sec_session_start();

$con = db_connect($config);

if(isset($_SESSION['user']['id'])){
    $sesUsername    = $_SESSION['user']['username'];
    $sesId          = $_SESSION['user']['id'];
}
else{
    exit();
}

if ($_GET['action'] == "get_postdata") {get_postdata();}
if ($_GET['action'] == "updateSeenmsg") { updateSeenmsg();}
if ($_GET['action'] == "checkMsgSeen") {checkMsgSeen();}
if ($_GET['action'] == "lastseen") {lastseen();}
if ($_GET['action'] == "userProfile") {userProfile();}
if ($_GET['action'] == "chatfrindList") {chatfrindList();}
if ($_GET['action'] == "get_all_msg") { get_all_msg(); }
if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); }
if ($_GET['action'] == "sendchat") { sendChat(); }
if ($_GET['action'] == "closechat") { closeChat(); }
if ($_GET['action'] == "startchatsession") { startChatSession(); }
if ($_GET['action'] == "agreementAction") { agreementAction(); }
if ($_GET['action'] == "updateAgreementStatus") { updateAgreementStatus(); }
if ($_GET['action'] == "sendAgreement") { sendAgreement();}
if ($_GET['action'] == "getAgreementRate") { getAgreementRate();}
if ($_GET['action'] == "jobFilledStatus") { jobFilledStatus();}

function get_userdata($id){
    global $con,$config;
    $query1 = "SELECT * FROM `".$config['db']['pre']."user` WHERE id='" .mysqli_real_escape_string($con,$id). "' LIMIT 1";
    $query_result = mysqli_query ($con, $query1);
    $info = mysqli_fetch_array($query_result);

    return $info;
}

function update_chat_lastactive($con,$config){

    $q = "UPDATE `".$config['db']['pre']."user` SET online='1', lastactive = '".$GLOBALS['timenow']."' WHERE id = '".$GLOBALS['sesId']."' ";
    mysqli_query($con, $q);
}

function getlastActiveTime($userid){
    global $con,$config;

     $res = mysqli_query($con, "SELECT * FROM `".$config['db']['pre']."user` WHERE id = '$userid' AND TIMESTAMPDIFF(MINUTE, lastactive, NOW()) > 1");
     if($res === FALSE) {
         die(mysqli_error($con)); // TODO: better error handling
     }
     $num = mysqli_num_rows($res);
     if($num == "0")
         $onofst = "online";
     else
         $onofst = "offline";

    return $onofst;

}

if (!isset($_SESSION['chatHistory'])) {
    $_SESSION['chatHistory'] = array();
}

if (!isset($_SESSION['openChatBoxes'])) {
    $_SESSION['openChatBoxes'] = array();
}

if (!isset($_SESSION['chatpage'])) {
    $_SESSION['chatpage'] = 1;
}

function updateSeenmsg()
{
    global $con, $config;
    $userid = $_POST['userid'];
    $postid = $_POST['postid'];
    $query = "Update `".$config['db']['pre']."messages` set seen='1' where to_id = '".$GLOBALS['sesId']."' AND from_id = '$userid' AND  post_id = '$postid'";
    $con->query($query);
    echo '1';
    die();
}

function checkMsgSeen()
{
    global $con, $config;
    if($_GET['msgid'] == "last"){
        $query1 = "SELECT seen FROM `".$config['db']['pre']."messages` where to_uname = '".$_GET['uname']."' and from_uname = '".$GLOBALS['sesUsername']."' ORDER BY message_id DESC LIMIT 1";
    }
    else{
        $query1 = "SELECT seen FROM `".$config['db']['pre']."messages` where message_id = '".$_GET['msgid']."' LIMIT 1";
    }

    $result1 = $con->query($query1);
    $row1 = mysqli_fetch_assoc($result1);

    if(isset($row1['seen']))
        echo $seen = $row1['seen'];
    else
        echo $seen = "null";
    die();
}

function lastseen() {
    global $con,$config;
    echo $lastseen =  getlastActiveTime($_GET['userid']);
}

function get_postdata() {
    global $con,$config,$link;
    $postid = $_GET['postid'];
    $sql = "SELECT product_name from `".$config['db']['pre']."product` WHERE id = '".$postid."' LIMIT 1";
    $query = $con->query($sql);
    $info = mysqli_fetch_array($query);
    $post_title = $info['product_name'];
    $post_link = $link['POST-DETAIL'].'/'.$postid;
    $item = array();
    $item['post_title'] = $post_title;
    $item['post_link'] = $post_link;

    echo json_encode($item);
    die();
}

function userProfile()
{
    global $con,$config;

    $sql = "SELECT username,name,email,sex,description,image from `".$config['db']['pre']."user` WHERE id = '".mysqli_real_escape_string($con,$_GET['userid'])."' LIMIT 1";
    $query = $con->query($sql);
    $info = mysqli_fetch_array($query);
    $item = array();
    $item['username']   = $info['username'];
    $item['name']       = ($info['name'] != '')? $info['name'] : $info['username'];
    $item['email']      = $info['email'];
    $item['sex']     = $info['sex'];
    $item['about']        = $info['description'];
    $item['image']    = ($info['image'] != "")? $info['image'] : "default_user.png";

    send_json($item);
}

function chatfrindList() {
    global $con,$config;

    $limitStart = $_POST['limitStart'];
    $searchKey = isset($_POST['searchKey'])? $_POST['searchKey'] : '';
    if($searchKey != ''){
        $where = "( u.username like '%$searchKey%' ) AND";
    }else{
        $where = '';
    }

    $limitCount = 20; // Set how much data you have to fetch on each request
    if(isset($limitStart ) || !empty($limitStart)) {
//This query shows user contact list by conversation
        $sql = "select id,username,name,image, message_date, post_id from `".$config['db']['pre']."user` as u
            INNER JOIN
            (
                select max(message_id) as message_id,to_id,from_id,message_date,post_id from `".$config['db']['pre']."messages` where to_id = '".$_SESSION['user']['id']."' or from_id = '".$_SESSION['user']['id']."' GROUP BY post_id
            )
            m ON u.id = m.from_id or u.id = m.to_id  where $where (u.id != '".$_SESSION['user']['id']."') GROUP BY post_id
            ORDER BY message_id DESC ";
        $limit = "limit $limitStart, $limitCount";
        $query = $sql." ".$limit;

        $rowcount = mysqli_num_rows(mysqli_query($con, $sql));

        $result = $con->query($query);
        $results = array();
        $results['contact_count'] = $rowcount;
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $username = $row['username'];
            $fullname = ($row['name'] != '')? $row['name'] : $username;
            $picname = $row['image'];
            $postid = $row['post_id'];
            $chatid = $id."_".$postid;
            if($picname == "")
                $picname = "default_user.png";

            $sql = "SELECT product_name from `".$config['db']['pre']."product` WHERE id = '".$postid."' LIMIT 1";
            $query = $con->query($sql);
            $info = mysqli_fetch_array($query);
            $post_title = $info['product_name'];

            $sql = "SELECT 1 FROM `".$config['db']['pre']."messages` where to_id = '".$_SESSION['user']['id']."' AND from_id = '$id' AND post_id = '".$postid."' and recd = '0'";
            $countrecd = mysqli_num_rows(mysqli_query($con,$sql));

            $onofst =  getlastActiveTime($id);

            $results['data'][] = array(
                "chatid"=> $chatid,
                "postid"=> $postid,
                "userid"=> $id,
                "username"=> $username,
                "fullname"=> $fullname,
                "userimage"=> $picname,
                "userstatus"=> $onofst,
                "post_title"=> $post_title,
                "unread_msg"=> $countrecd
            );

        }
        echo json_encode($results);
    }

    die();
}

function get_all_msg() {
    global $con,$config;
    $perPage = 25;

    $sql = "select * from `".$config['db']['pre']."messages` where  
    ((to_id = '".mysqli_real_escape_string($con, $GLOBALS['sesId'])."' AND from_id = '".mysqli_real_escape_string($con,$_GET['client'])."' AND recd = '1') 
    OR 
    (to_id = '".mysqli_real_escape_string($con,$_GET['client'])."' AND from_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."')) AND post_id = '".mysqli_real_escape_string($con,$_GET['postid'])."' order by message_id DESC ";

    $page = 1;
    if(!empty($_GET["page"])) {
        $_SESSION['chatpage'] = $page = $_GET["page"];
    }

    $start = ($page-1)*$perPage;
    if($start < 0) $start = 0;

    $query =  $sql . " limit " . $start . "," . $perPage;

    $query = $con->query($query);

    if(empty($_GET["rowcount"])) {
        $_GET["rowcount"] = $rowcount = mysqli_num_rows(mysqli_query($con, $sql));
    }

    $pages  = ceil($_GET["rowcount"]/$perPage);

    $items = array();

    while ($chat = mysqli_fetch_array($query)) {

        $from_userdata = get_userdata($chat['from_id']);
        $to_id = $from_userdata['id'];
        $picname = $from_userdata['image'];
        $status = $from_userdata['online'];

        $picname = ($picname == "")? "default_user.png" : $picname;
        $status  = ($status == "0")? "Offline" : "Online";

        $to_userdata = get_userdata($chat['to_id']);
        $picname2 = $to_userdata['image'];

        $picname2 = ($picname2 == "")? "default_user.png" : $picname2;

        
        $chat['message_content'] =  $chat['message_type'] == 'html' ? $chat['message_content'] : escape($chat['message_content'],false);

        if($chat['from_id'] == $GLOBALS['sesId'])
        {
            $position = 'odd';
            $chatid = $chat['to_id'].'_'.$chat['post_id'];
        }
        else{
            $position = 'even';
            $chatid = $chat['from_id'].'_'.$chat['post_id'];
        }

        if (strpos($chat['message_content'], 'file_name') !== false) {

        }
        else{
            // The Regular Expression filter
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

            // Check if there is a url in the text
            if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                // make the urls hyper links
                $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);

            } else {
                // The Regular Expression filter
                $reg_exUrl = "/(www)\.[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

                // Check if there is a url in the text
                if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                    // make the urls hyper links
                    $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);

                }
            }
        }
        $msgtime = date('d M, H:i A', strtotime($chat['message_date']));
        $msgdate = date('F d, Y', strtotime($chat['message_date']));

        $items[] =  array(
            "s"=> '0',
            "chatid"=> $chatid,
            "page"=> $page,
            "pages"=> $pages,
            "mtype"=> $chat['message_type'],
            "message"=> $chat['message_content'],
            "seen"=> $chat['seen'],
            "recd"=> $chat['recd'],
            "time"=> $msgtime,
            "date"=> $msgdate,
            "position"=> $position
        );

    }// End While Loop

    send_json($items);
}

function chatHeartbeat() {
    global $con,$config;
    $sql = "select * from `".$config['db']['pre']."messages` where (to_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."' AND recd = 0) order by message_id ASC";
    $query = $con->query($sql);
    $items = array();
    while ($chat = mysqli_fetch_array($query)) {
        $from_id = $chat['from_id'];
        $from_userdata = get_userdata($from_id);
        $from_name = ($from_userdata['name'] != '')? $from_userdata['name'] : $from_userdata['username'];
        $picname = $from_userdata['image'];
        $picname = ($picname == "")? "default_user.png" : $picname;
        $status = $from_userdata['online'];
        $status  = ($status == "0")? "offline" : "online";
        $postid = $chat['post_id'];
        $chatid = $from_id."_".$postid;
        $chat['message_content'] =  $chat['message_type'] == 'html' ? $chat['message_content'] : escape($chat['message_content'],false);
    
        if (strpos($chat['message_content'], 'file_name') !== false) {

        }
        else{
            // The Regular Expression filter
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

            // Check if there is a url in the text
            if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                // make the urls hyper links
                $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);

            } else {
                // The Regular Expression filter
                $reg_exUrl = "/(www)\.[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

                // Check if there is a url in the text
                if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                    // make the urls hyper links
                    $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);

                }
            }
        }

        $msgtime = date('d M, H:i A',strtotime($chat['message_date']));
        $items[] = array(
            "s"=> 0,
            "postid"=> $postid,
            "chatid"=> $chatid,
            "from_name"=> $from_name,
            "from_id"=> $from_id,
            "picname"=> $picname,
            "status"=> $status,
            "message"=> $chat['message_content'],
            "message_type"=> $chat['message_type'],
            "time"=> $msgtime
        );
        if(!isset($_POST['wchat'])) {
            if (isset($_SESSION['chatHistory'][$chatid])) {
                $_SESSION['chatHistory'][$chatid][] = array(
                    "s" => "1",
                    "chatid" => $chatid,
                    "postid" => $postid,
                    "fullname" => $from_name,
                    "userid" => $from_id,
                    "picname" => $picname,
                    "status" => $status
                );

            } else {

                $_SESSION['chatHistory'][$chatid] = array(
                    "s" => "1",
                    "chatid" => $chatid,
                    "postid" => $postid,
                    "fullname" => $from_name,
                    "userid" => $from_id,
                    "picname" => $picname,
                    "status" => $status
                );

            }

            unset($_SESSION['tsChatBoxes'][$chatid]);
            $_SESSION['openChatBoxes'][$chatid] = $chat['message_date'];
        }
    }

    if (!empty($_SESSION['openChatBoxes']) && !isset($_POST['wchat']))
    {
        foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {

            if (!isset($_SESSION['tsChatBoxes'][$chatbox]))
            {
                $now = time()-strtotime($time);
                $timenow = date('M d, g:i A', strtotime($time));

                $message = $timenow;
                if ($now > 30)
                {
                    $items[] = array(
                        "s"=> 2,
                        "chatid"=> $chatbox,
                        "message"=> $message
                    );

                    if (!isset($_SESSION['chatHistory'][$chatbox])) {
                        $_SESSION['chatHistory'][$chatbox] = array();
                    }

                    $_SESSION['chatHistory'][$chatbox][] = array(
                        "s"=> 2,
                        "chatid"=> $chatbox,
                        "message"=> $message
                    );

                    $_SESSION['tsChatBoxes'][$chatbox] = 1;
                }
            }
        }
    }

    $sql = "update `".$config['db']['pre']."messages` set recd = 1 where to_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."' and recd = 0";
    $con->query($sql);

    send_json($items);
}

function sendChat() {
    global $con,$config;
    if(isset($GLOBALS['sesId'])){
        $from_id = $GLOBALS['sesId'];
        $to_id = $_POST['to'];
        $postid = $_POST['postid'];
        if($_POST['is_first']){
            $message =$_POST['message'];
            $msg_type = 'html';
        }else{
            $message = sanitize_string($_POST['message']);
            $msg_type = 'text';
        }
        $timenow = date('Y-m-d H:i:s');
        $to_userdata = get_userdata($to_id);
        if(count($to_userdata) > 0){
            $to_name = ($to_userdata['name'] != '')? $to_userdata['name'] : $to_userdata['username'];
            $picname = $to_userdata['image'];
            $status = $to_userdata['online'];
            $picname = ($picname == "")? "default_user.png" : $picname;
            $status  = ($status == "0")? "offline" : "online";
            $chatid = $to_id.'_'.$postid;

            if(!isset($_POST['wchat'])) {
                if (isset($_SESSION['chatHistory'][$chatid])) {
                    $_SESSION['chatHistory'][$chatid][] = array(
                        "s" => "1",
                        "chatid" => $chatid,
                        "postid" => $postid,
                        "fullname" => $to_name,
                        "userid" => $to_id,
                        "picname" => $picname,
                        "status" => $status
                    );

                } else {

                    $_SESSION['chatHistory'][$chatid] = array(
                        "s" => "1",
                        "chatid" => $chatid,
                        "postid" => $postid,
                        "fullname" => $to_name,
                        "userid" => $to_id,
                        "picname" => $picname,
                        "status" => $status
                    );
                }

                unset($_SESSION['tsChatBoxes'][$chatid]);

                $_SESSION['openChatBoxes'][$chatid] = date('Y-m-d H:i:s', time());

                if (!isset($_SESSION['chatHistory'][$chatid])) {
                    $_SESSION['chatHistory'][$chatid] = array();
                }
            }
            $sql = "insert into `".$config['db']['pre']."messages` (from_id,to_id,message_content,message_type,message_date,post_id) values ('".mysqli_real_escape_string($con,$from_id)."','".mysqli_real_escape_string($con,$to_id)."','".mysqli_real_escape_string($con,$message)."','".mysqli_real_escape_string($con,$msg_type)."','".$timenow."','".mysqli_real_escape_string($con,$postid)."')";

            $con->query($sql);

            echo "1";
        }
        else{
            echo "0";
        }
        exit(0);

    }
    else{
        echo "0";
    }
    exit(0);
}

function startChatSession() {
    $items = array();
    if (!empty($_SESSION['openChatBoxes'])) {
        foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
            if (isset($_SESSION['chatHistory'][$chatbox])) {
                $items[] = $_SESSION['chatHistory'][$chatbox];
            }
        }
    }

    send_json($items);
}

function closeChat() {
    unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
    echo "1";
    exit(0);
}

function send_json($results = array()){
    echo json_encode($results);
    die();
}

function agreementAction(){
    global $config, $con;
    $resp = [];
    $ses_user_data=ORM::for_table($config['db']['pre'].'user')->find_one($GLOBALS['sesId'])->as_array();
    $chat_user_data=ORM::for_table($config['db']['pre'].'user')->find_one($_POST['chat_user_id'])->as_array();
    $chat_fullname = ($chat_user_data['name'] != '')? $chat_user_data['name'] : $chat_user_data['username'];
    $user_type= $_SESSION['user']['user_type'];
    $post_id = $_POST['post_id'];
    $chatid=$_POST['chatid'];
    
    $job_data=ORM::for_table($config['db']['pre'].'product')->select_many('id','product_name','slug')->find_one($post_id);
   // echo ORM::get_last_query();
   // print_r($job_data);die;
    $initiated_msg= ORM::for_table($config['db']['pre'].'messages')->where(['post_id'=>$post_id,'message_type'=>'html'])->find_one();
    if($initiated_msg['from_id']==$GLOBALS['sesId']){
        $sql = "select * from `".$config['db']['pre']."messages` where (to_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."' AND from_id = '".mysqli_real_escape_string($con,$_POST['chat_user_id'])."' AND post_id = ".$post_id.") order by message_id ASC limit 1";
    }else{
        $sql = "select * from `".$config['db']['pre']."messages` where (from_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."' AND to_id = '".mysqli_real_escape_string($con,$_POST['chat_user_id'])."' AND post_id = ".$post_id.") order by message_id ASC limit 1";
    }
    $resp=['ses_user_data'=>$ses_user_data,'chat_user_data'=>$chat_user_data];
    $query = $con->query($sql);
      
    if($chat_user_data['city']!=null){
        $address = $chat_user_data['city'].','.$chat_user_data['state'];
    }else{
        $address = $chat_user_data['country'];
    }  
    $user_d_tpl = '
    <div class = "agreement_first_sec">
        <p><b>'.$chat_fullname.'<br>'.getAge($chat_user_data['dob']).' Years old '.$chat_user_data['sex'].'<br>'.$address.'</b></p>
        <p>This client is self managed through Trilogy care.</p>
        <p>To schedule care with '.$chat_fullname.', agree your rate and schdule through chat, then offer an agreement.</p>
    </div>
   ';
    $activity_log = ORM::for_table($config['db']['pre'].'activity_log')
    ->where_like('log_name', '%agreement%')
    ->where('post_id',$post_id)
    ->where_raw('( `receiver_id` = '.$GLOBALS['sesId'].' OR `user_id`= '.$GLOBALS['sesId'].')')
    ->limit(5)->order_by_desc('id')->find_many();

  
    if($user_type=='user'){
      $worker_id=$GLOBALS['sesId'];
    }else{
       $worker_id=$chat_user_data['id'];
    }

    $agr_data = ORM::for_table($config['db']['pre'].'user_agreements')->where(['post_id'=>$post_id,'worker_id'=>$worker_id])->find_one();
  //  echo ORM::get_last_query();
    //print_r( $agr_data );die;
    $ac_feed_tpl = ' 
    <div class="activity_feed">
    <h5>Activity Feed</h5>';
    foreach($activity_log as $act_log){
        if($act_log['status']=='accepted'){
            $msg =sprintf(agreement_msg($act_log['status']),$chat_fullname,$agr_data['id']) ;
        }else{
            $msg =sprintf(agreement_msg($act_log['status']),$chat_fullname) ;
        }
        
         $ac_feed_tpl.='<p>'.$msg.'</p> <small>'.timeAgo($act_log['log_time']).'</small><hr>';   
    }
    $ac_feed_tpl.='</div>';
    // echo ORM::get_last_query();
    // print_r($activity_log);die;

    if($query->num_rows > 0){
        $resp['replied']=1;
        if($user_type=='user'){
            if($agr_data){
                switch ($agr_data['status']) {
                    case 'requested':
                        $user_d_tpl.=' 
                        <div class="btn_section">
                            <button class="button ripple-effect" id="offer_agr_btn" data-chatusername='.$chat_fullname.' data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="sent">Offer an agreement</button>
                        </div>';
                        break;
                    case 'sent':
                        $user_d_tpl.=' 
                        <div class="btn_section">
                            <button class="button ripple-effect edit_agreement" id="" data-agreement_id='.$agr_data['id'].'  data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="sent">Edit last sent offer</button>
                        </div>';
                        break;
                    case 'declined': 
                        $user_d_tpl.=' 
                        <div class="btn_section">
                            <button class="button ripple-effect" id="offer_agr_btn" data-chatusername='.$chat_fullname.' data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="sent">Offer an agreement</button>
                        </div>';
                        break; 
                    case 'accepted': 
                    case 'changed':
                        $user_d_tpl.=' 
                        <div class="btn_section">
                            <button class="button ripple-effect edit_agreement" id="" data-agreement_id='.$agr_data['id'].'  data-chatusername='.$chat_fullname.' data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="changed">Amend agreement</button>
                        </div>';

                    default:
                        # code...
                        break;
                }
                $user_d_tpl.=$ac_feed_tpl;
            }else{
                $user_d_tpl.=' 
                <div class="btn_section">
                    <button class="button ripple-effect" id="offer_agr_btn" data-chatusername='.$chat_fullname.' data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="sent">Offer an agreement</button>
                </div>';
              
            }
            $resp['tpl']=$user_d_tpl;
            
        }elseif($user_type=='employer'){
            $emp_tpl='';
            if(!empty($agr_data)){
                if($agr_data['status']=='sent'){
                 $ready_to_book='
                    <div class="ready_to_book">
                        <h5>Ready to Book '.$chat_fullname.' ?</h5>
                        <div class="first_group_wrpa">
                            <strong>'.$chat_fullname.' has offered you an agreement</strong>
                            <p>It must be accepted before any work commences to ensure your worker is covered by <a href="#">insurance</a></p>
                        </div>
                    </div>';
                }elseif ($agr_data['status']=='edited') {
                    $ready_to_book='
                    <div class="ready_to_book">
                        <h5>Accept amendment from '.$chat_fullname.' ?</h5>
                        <div class="first_group_wrpa">
                            <strong>'.$chat_fullname.' has amended your agreement</strong>
                            <p>It must be accepted before any work commences to ensure your worker is covered by <a href="#">insurance</a></p>
                        </div>
                    </div>';
                }
               switch ($agr_data['status']) {
                   case 'sent':
                   case 'changed':
                       $agreed_rate = ORM::for_table($config['db']['pre'].'user_agreements_rates')->where('agreement_id',$agr_data['id'])->order_by_asc('id')->find_array();
                     //  print_r( $agreed_rate);die;
                       $emp_tpl.= $ready_to_book;
                       $emp_tpl.=
                        '<div class="warning_section notification success closeable">
                            <div class="alert_icon_d"><i class="icon-feather-clock"></i></div> 
                            <div>
                                <p class="text-success">The total cost of support is '.get_option('client_commission').'% higher than the agreed rate.</p>
                            </div> 
                        </div> 
                        ';
                        $flat_rate_tpl='<div class="flat_rate">
                        <h5>Flat Rate</h5><hr>';
                        foreach ($agreed_rate as $rate) {
                            $rate_to_pay =$rate['rate']+($rate['rate']*(int)get_option('client_commission')/100);
                            $flat_rate_tpl.='<h5>'.$rate['description'].'<h5>
                            <h4>$'.$rate_to_pay.'<small> '.ucwords(str_replace('-', ' ', $rate['rate_type'])).'</small></h4>
                            <p>Based of on an agreed rate of $'.$rate['rate'].'. Inclusive of all plateform fees.</p>';      
                        }
                       
                        $flat_rate_tpl.='<p><b>Related support description</b></p>
                        <p class="a_tag_btn"><a href="'.$config['site_url'] . 'job/' . $job_data['id'] . '/' . $job_data['slug'].'">'.  $job_data['product_name'].'<i class="icon-feather-chevron-right"></i></a></p></div>'; 

                        $emp_tpl.= $flat_rate_tpl;
                        $agreed_service='
                        <div class="agreed_services">
                         <h4>Agreed Services</h4>
                         <p>'.$agr_data['agreed_services'].'</p>
                         <p>In accepting an offer, you are agreeing to share personal information with the other party and to keep all personal information confidential.</p>
                        <div>
                        <div class="btn_ag_t">
                            <button class="button decline_agreement"  data-agreement_id='.$agr_data['id'].' data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="declined">Decline</button>
                            <a href="#accept-agreement-popup" style="text-decoration:none !important; " class="button accept_agreement open-popup-link"   data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="accepted" data-chatusername='.$chat_fullname.'>Accept  agreement</a>
                            
						</div>
                        <div class="warning_section notification success  closeable">
                            <div class="alert_icon_d"><i class="icon-feather-clock"></i></div> 
                            <div>
                                <p>Detail not correct?<br>Decline the payments,then message to '.$chat_fullname.' to them what details you had like updated</p>
                            </div> 
                        </div> ';
                        $emp_tpl.=$agreed_service;
                       break;
                  
                    case 'declined': 
                        $emp_tpl.=
                        '<div class="agreement_first_sec">
                            <h5>Interested in booking '.$chat_fullname.'?</h5>
                            <p>An agreements sets the rates and describe the services to be provides.<br>It\'s required before support can start to ensure the worker covered by <a href="#">insurance</a>.</p>
                        </div>
                        <div class="btn_section">
                            <button class="button ripple-effect agr_btn" id="" data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="requested">Request an agreement</button>
                        </div>';
                    default:
                       # code...
                       break;
               }
              
               $emp_tpl.= $ac_feed_tpl;
               $resp['tpl']= $emp_tpl;
            }else{
            $resp['tpl']='
            <div class="agreement_first_sec">
                <h5>Interested in booking '.$chat_fullname.'?</h5>
                <p>An agreements sets the rates and describe the services to be provides.<br>It\'s required before support can start to ensure the worker covered by <a href="#">insurance</a>.</p>
            </div>
            <div class="btn_section">
				<button class="button ripple-effect agr_btn" id="" data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].' data-status="requested">Request an agreement</button>
			</div>';
            }
            
        }
    }else{
        $resp['replied']=0;
        if($user_type=='user'){
            $user_d_tpl.=' 
            <div class="warning_section notification error closeable">
                <div class="alert_icon_d"><i class="icon-feather-alert-triangle"></i></div> 
                <div>
                    <p>To send an agreeement to a client you\'ll need to start a conversation and client respond.</p>
                </div> 
            </div>';
            $resp['tpl']=$user_d_tpl;
           
        } elseif($user_type=='employer'){
            $resp['tpl']='
            <div class="agreement_first_sec">
                <h5>Interested in booking '.$chat_fullname.'?</h5>
                <p>An agreements sets the rates and describe the services to be provides.<br>It\'s required before support can start to ensure the worker covered by <a href="#">insurance</a>.</p>
            </div>
            <div class="warning_section notification error closeable">
                <div class="alert_icon_d"><i class="icon-feather-alert-triangle"></i></div> 
                <div>
                    <p>To request an agreement from a worker you\'ll need to start conversation and worker response.</p>
                </div> 
			</div> 
           ';
        }  

    }
    echo json_encode($resp);
    die();  
}

function updateAgreementStatus(){
   global $config;
   $postid=$_POST['postid'];
   $status=$_POST['status'];
   if($_SESSION['user']['user_type']=='employer'){
       $client_id = $_SESSION['user']['id'];
       $worker_id = $_POST['userid'];
   }elseif($_SESSION['user']['user_type']=='user'){
    $client_id = $_POST['userid'];
    $worker_id = $_SESSION['user']['id'];
   }
   $now = date('Y-m-d H:i:s');
   $agr_data = ORM::for_table($config['db']['pre'].'user_agreements')->where(['post_id'=>$postid,'worker_id'=>$worker_id])->find_one();
    if($agr_data){
       $agr_data->status=$status;
       $agr_data->updated_at = $now;
    }else{
        $agr_data=ORM::for_table($config['db']['pre'].'user_agreements')->create();
        $agr_data->post_id=$postid;
        $agr_data->client_id=$client_id;
        $agr_data->worker_id=$worker_id;
        $agr_data->status=$status;
        $agr_data->created_at=$now;
        $agr_data->updated_at=$now;
    }
   if($agr_data->save()){
       $data=['log_name'=>'agreement','status'=> $status,'receiver_id'=> $_POST['userid'],'post_id'=>$postid];
       create_activity_log($data);
       $resp['status']=1;
   }else{
    $resp['status']=0;
   }
   echo json_encode($resp);die;
}

function sendAgreement(){
    global $config;
    $postid=$_POST['post_id'];
    $client_id=$_POST['client_id'];
    $worker_id=$_SESSION['user']['id'];
    $status=$_POST['status'];
    $rates=$_POST['rates'];

    $agr_data = ORM::for_table($config['db']['pre'].'user_agreements')->where(['post_id'=>$postid,'worker_id'=>$worker_id])->find_one();
    if(!empty($agr_data)){
        $agr_data->agreed_services=$_POST['agreed_services'];
        $agr_data->status=$status;
        $agr_data->save();
    }else{
        $agr_data = ORM::for_table($config['db']['pre'].'user_agreements')->create();
        $agr_data->post_id=$postid;
        $agr_data->client_id= $client_id;
        $agr_data->worker_id= $worker_id;
        $agr_data->agreed_services=$_POST['agreed_services'];
        $agr_data->status=$status;
        $agr_data->save();
    }
    $agr_id = $agr_data['id'];
    $rate_arr=[];
    foreach($rates as $rate) {
        array_push($rate_arr,'('.$agr_id.',"'. $rate['description'].'",'.$rate['rate'].',"'.$rate['rate_type'].'")'); 
    }
    $w_rates = implode(',',$rate_arr); 
    $workerAgr = ORM::for_table($config['db']['pre'] . 'user_agreements_rates')->where('agreement_id',  $agr_id)->find_array();
    if(count($workerAgr)) {
        ORM::for_table($config['db']['pre'] . 'user_agreements_rates')->where('agreement_id',  $agr_id)->delete_many();
    }
    $sql ='INSERT INTO '.$config['db']['pre'].'user_agreements_rates (agreement_id,description,rate,rate_type) VALUES'.$w_rates.'';
    //echo $sql;die;
    $inserted = ORM::raw_execute( $sql);
  
    if($inserted){
      $data=['log_name'=>'agreement','status'=>$status,'receiver_id'=> $client_id,'post_id'=>$postid];
      create_activity_log($data);
      $resp['status']=true;
    }else{
        $resp['status']=false; 
    }

    echo json_encode($resp);
    die();

}

function getAgreementRate(){
    global $config;
    $resp=[];
    $rates=[];
    $status=false;
    $agreementid=$_POST['agreementid'];	
    $agr_data= ORM::for_table($config['db']['pre'] . 'user_agreements')->find_one($agreementid)->as_array();
    $agr_rates= ORM::for_table($config['db']['pre'] . 'user_agreements_rates')->where('agreement_id',$agreementid)->find_many();
    $post_data=ORM::for_table($config['db']['pre'] . 'product')->find_one($agr_data['post_id'])->as_array();
    $agreed_services=$agr_data['agreed_services'];
    // $client_data=get_user_data(null, $agr_data['client_id']);
    // $worker_data=get_user_data(null, $agr_data['worker_id']);
    // $client_name=($client_data['name'] != '')? $client_data['name'] : $client_data['username'];
    // $worker_name=($worker_data['name'] != '')? $worker_data['name'] : $worker_data['username'];
    if($_SESSION['user']['user_type']=='employer'){
        $client_data=get_user_data(null, $agr_data['client_id']);
        $chat_user_name=($client_data['name'] != '')? $client_data['name'] : $client_data['username'];
        $chat_user_type='client';
    }else{
        $worker_data=get_user_data(null, $agr_data['worker_id']);
        $chat_user_name=($worker_data['name'] != '')? $worker_data['name'] : $worker_data['username'];
        $chat_user_type='worker';
    }
    if(!empty($agr_rates)){
        foreach ($agr_rates as $rate) {
            $rates[]=['description'=> $rate['description'],'rate'=>$rate['rate'],'rate_type'=>$rate['rate_type']];
         }
         $status=true;
    }
    $resp=['status'=>$status,'rates'=>$rates,'agreed_services'=>$agreed_services,'chat_user_type'=>$chat_user_type,'chat_user_name'=>$chat_user_name,'agreement_data'=>$agr_data,'agreement_title'=>$post_data['product_name']];
    echo json_encode($resp);
    die();
}

function jobFilledStatus(){
    global $config;
    $resp=[];
    $postid=$_POST['postid'];
    $filled=$_POST['value']=='1' ? '1':'0';

    $job = ORM::for_table($config['db']['pre'] . 'product')->find_one($postid);
    $job->filled=$filled;
    if($job->save()){
        $resp['status']=true; 
    }else{
        $resp['status']=false;  
    }
    echo json_encode($resp);
    die;
}


?>