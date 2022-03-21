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
    $user_type= $_SESSION['user']['user_type'];
    $post_id = $_POST['post_id'];
    $chatid=$_POST['chatid'];
    $initiated_msg= ORM::for_table($config['db']['pre'].'messages')->where(['post_id'=>$post_id,'message_type'=>'html'])->find_one();
    if($initiated_msg['from_id']==$GLOBALS['sesId']){
        $started_by_me=true;
        $sql = "select * from `".$config['db']['pre']."messages` where (to_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."' AND from_id = '".mysqli_real_escape_string($con,$_POST['chat_user_id'])."' AND post_id = ".$post_id.") order by message_id ASC limit 1";
    }else{
        $started_by_me = false;
       // $con1="from_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."'";
        $sql = "select * from `".$config['db']['pre']."messages` where (from_id = '".mysqli_real_escape_string($con,$GLOBALS['sesId'])."' AND to_id = '".mysqli_real_escape_string($con,$_POST['chat_user_id'])."' AND post_id = ".$post_id.") order by message_id ASC limit 1";
    }
    $resp=['ses_user_data'=>$ses_user_data,'chat_user_data'=>$chat_user_data];
    $query = $con->query($sql);
    if($query->num_rows > 0){
        $resp['replied']=1;
        if($user_type=='user'){
            $agr_data = ORM::for_table($config['db']['pre'].'user_agreements')->where(['post_id'=>$post_id,'user_id'=>$GLOBALS['sesId']])->find_one();
            if($chat_user_data['city']!=null){
                $address = $chat_user_data['city'].','.$chat_user_data['state'];
            }else{
                $address = $chat_user_data['country'];
            }
            $activity_tpl='';
            if(!empty($agr_data)){
               $activity_tpl.='
                   <div class="card activity_feed" id="'.$chatid.'activity_feed">
                        <div class="card-body">
                            <h5 class="card-title">Activity Feed</h5>
                            <p class="card-text">
                            '.$chat_user_data['username'].' has requested that you send them an agreement. <a href="#">Click here</a> for instruction on how to send an agreement.
                            </p>
                            <small>'.date('d M, H:i A',strtotime($agr_data['updated_at'])).'</small>
                        </div>
                    </div>
                '; 
            }
            $resp['tpl']='
            <div id="'.$chatid.'_section">
                <div class = "section1">
                    <div class="detail_cl">
                        <p>'.$chat_user_data['name'].'<br>'.getAge($chat_user_data['dob']).' Years old '.$chat_user_data['sex'].'<br>'.$address.'</p>
                    </div>
                    <p>To schedule care with '.$chat_user_data['username'].', agree your rate and schdule through chat, then offer an agreement.</p>
                    <div class="" id="'.$chatid.'_agr_btn_section">
                        <div class="agr_btn_section">
                            <button class="button ripple-effect" id="offer_agr_btn" data-chat_id='.$chatid.'>Offer an agreement</button>
                        </div>
                    </div>
                </div>
                '.$activity_tpl.'
            </div>';  

        }elseif($user_type=='employer'){
            $agr_data = ORM::for_table($config['db']['pre'].'user_agreements')->where(['post_id'=>$post_id,'user_id'=>$_POST['chat_user_id']])->find_one();
            if(!empty($agr_data) && $agr_data['agr_status']=='requested'){
                $resp['tpl']='
                <div id="'.$chatid.'_section">
                    <div class="card  activity_feed" id="'.$chatid.'activity_feed">
                        <div class="card-body">
                            <h5 class="card-title">Activity Feed</h5>
                            <p class="card-text">
                               You have requested an offer on '.$chat_user_data['username'].'
                            </p>
                            <small>'.date('d M, H:i A',strtotime($agr_data['updated_at'])).'</small>
                        </div>
                    </div>
                </div>
               ';  
            }else{
                $resp['tpl']='
                <div id="'.$chatid.'_section">
                    <div class = "section1">
                        <h5>Interested in booking '.$chat_user_data['username'].'?</h5>
                        <p>An agreements sets the rates and describe the services to be provides.<br>It\'s required before support can start to ensure the worker covered by <a href="#">insurance</a>.</p>
                        <div class="agr_btn_section" id="'.$chatid.'_agr_btn_section">
                            <div class="agr_btn_section">
                            <button class="button ripple-effect req_agr_btn" id="" data-chatid='.$chatid.' data-postid='.$post_id.' data-userid='.$_POST['chat_user_id'].'>Request an agreement</button>
                            </div>
                        </div>
                    </div>
                    <div class="card d-none activity_feed" id="'.$chatid.'activity_feed">
                        <div class="card-body">
                            <h5 class="card-title">Activity Feed</h5>
                            <p class="card-text">
                               You have requested an offer on '.$chat_user_data['username'].'
                            </p>
                            <small>a few second ago</small>
                        </div>
                    </div>
                </div>
               ';  
            }  
        }   
    }else{
        $resp['replied']=0;
        if($user_type=='user'){
            if($chat_user_data['city']!=null){
                $address = $chat_user_data['city'].','.$chat_user_data['state'];
            }else{
                $address = $chat_user_data['country'];
            }  
            $resp['tpl']= 
            '<div class = "section1">
                <div class="detail_cl">
                <p>'.$chat_user_data['name'].'<br>'.getAge($chat_user_data['dob']).' Years old '.$chat_user_data['sex'].'<br>'.$address.'</p>
                </div>
                <p>To schedule care with '.$chat_user_data['username'].', agree your rate and schdule through chat, then offer an agreement.</p>
            </div>
            <div class="" id="'.$ses_user_data['user_type'].'agr_btn_section">
                <div class="notification error closeable alert_section">
                    <i class="icon-feather-alert-triangle"></i>
                    <span>To send an agreeement to a client you\'ll need to start a conversation and client respond.</span>
                </div>
            </div>';
        }
        elseif($user_type=='employer'){
            $resp['tpl']='
            <div class = "section1">
                <h5>Interested in booking '.$chat_user_data['username'].'?</h5>
               <p>An agreements sets the rates and describe the services to be provides.<br>It\'s required before support can start to ensure the worker covered by <a href="#">insurance</a>.</p>
            </div>
            <div class="" id="'.$ses_user_data['user_type'].'agr_btn_section">
                <div class="notification error closeable alert_section ">
                    <i class="icon-feather-alert-triangle "></i>
                    <span>To request an agreement from a worker you\'ll need to start conversation and worker response.</span>
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
   $userid=$_POST['userid'];
   $status=$_POST['status'];
   $now = date('Y-m-d H:i:s');
   $agr_data = ORM::for_table($config['db']['pre'].'user_agreements')->where(['post_id'=>$postid,'user_id'=>$userid])->find_one();
    if($agr_data){
       $agr_data->agr_status=$status;
       $agr_data->updated_at = $now;
     
    }else{
        $agr_data=ORM::for_table($config['db']['pre'].'user_agreements')->create();
        $agr_data->post_id=$postid;
        $agr_data->employer_id=$_SESSION['user']['id'];
        $agr_data->user_id=$userid;
        $agr_data->agr_status=$status;
        $agr_data->created_at=$now;
        $agr_data->updated_at=$now;
    
    }
   if($agr_data->save()){
       $resp['status']=1;
   }else{
    $resp['status']=0;
   }
   echo json_encode($resp);die;
}

?>