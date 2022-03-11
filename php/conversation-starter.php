<?php

if (checkloggedin()) {
   
global $match;
if (!isset($match['params']['id'])) {
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
    exit;
}

$worker_id = $match['params']['id'];
$worker_data = ORM::for_table($config['db']['pre'].'user')->find_one($worker_id)->as_array();
//dd($worker_data);
$worker_image = !empty($worker_data['image'])?$worker_data['image']:'default_user.png';
//Query for jobs
$user_id=$_SESSION['user']['id'];
$sort = "id";
if(!isset($_GET['page']))
    $page_number = 1;
else{
    $page_number = $_GET['page'];
}
$limit = isset($_GET['limit']) ? $_GET['limit'] : 1;
$where='';

$order_by = "
      (CASE
        WHEN g.top_search_result = 'yes' and p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 1
        WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.featured = '1' THEN 2
        WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.highlight = '1' THEN 3
        WHEN g.top_search_result = 'yes' and p.featured = '1' and p.highlight = '1' THEN 4
        WHEN g.top_search_result = 'yes' and p.urgent = '1' THEN 5
        WHEN g.top_search_result = 'yes' and p.featured = '1' THEN 6
        WHEN g.top_search_result = 'yes' and p.highlight = '1' THEN 7
        WHEN g.top_search_result = 'yes' THEN 8
        WHEN p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 9
        WHEN p.urgent = '1' and p.featured = '1' THEN 10
        WHEN p.urgent = '1' and p.highlight = '1' THEN 11
        WHEN p.featured = '1' and p.highlight = '1' THEN 12
        WHEN p.urgent = '1' THEN 13
        WHEN p.featured = '1' THEN 14
        WHEN p.highlight = '1' THEN 15
        ELSE 16
      END),$sort $order";

$query = "SELECT p.*,u.group_id,g.top_search_result, c.name company_name, c.logo company_image FROM `".$config['db']['pre']."product` as p
LEFT JOIN `".$config['db']['pre']."companies` c on p.company_id = c.id 
LEFT JOIN `".$config['db']['pre']."user` as u ON u.id = p.user_id
LEFT JOIN `".$config['db']['pre']."usergroups` as g ON g.group_id = u.group_id
 where p.status = 'active' AND p.hide = '0' AND p.user_id = $user_id AND NOT EXISTS (SELECT j.id FROM job_user_applied j WHERE j.user_id =$worker_id and j.job_id=p.id) $where ORDER BY $order_by LIMIT ".($page_number-1)*$limit.",$limit";

$total = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM ".$config['db']['pre']."product as p where p.status = 'active' AND p.hide = '0' AND p.user_id=$user_id AND NOT EXISTS (SELECT j.id FROM job_user_applied j WHERE j.user_id =$worker_id and j.job_id=p.id) $where"));

$item = array();
$result = $mysqli->query($query);
mysqli_num_rows($result);
if (mysqli_num_rows($result) > 0) {
     // output data of each row
     while($info = mysqli_fetch_assoc($result)) {
         $item[$info['id']]['id'] = $info['id'];
         $item[$info['id']]['featured'] = $info['featured'];
         $item[$info['id']]['urgent'] = $info['urgent'];
         $item[$info['id']]['highlight'] = $info['highlight'];
         $item[$info['id']]['product_name'] = $info['product_name'];
         $item[$info['id']]['company_id'] = $info['company_id'];
         $item[$info['id']]['company_name'] = $info['company_name'];
         $item[$info['id']]['company_image'] = !empty($info['company_image'])?$info['company_image']:'default.png';
         $item[$info['id']]['product_type'] = get_productType_title_by_id($info['product_type']);
         $item[$info['id']]['salary_type'] = get_salaryType_title_by_id($info['salary_type']);
         $item[$info['id']]['description'] = strlimiter(strip_tags($info['description']),80);
         $item[$info['id']]['category'] = $info['category'];
         $item[$info['id']]['phone'] = $info['phone'];
         $item[$info['id']]['address'] = strlimiter($info['location'],20);
         $cityname = get_cityName_by_id($info['city']);
         $item[$info['id']]['location'] = $cityname;
         $item[$info['id']]['city'] = $cityname;
         $item[$info['id']]['state'] = get_stateName_by_id($info['state']);
         $item[$info['id']]['country'] = get_countryName_by_id($info['country']);
         $item[$info['id']]['latlong'] = $info['latlong'];
 
         $salary_min = price_format($info['salary_min'],$info['country']);
         $item[$info['id']]['salary_min'] = $salary_min;
         $salary_max = price_format($info['salary_max'],$info['country']);
         $item[$info['id']]['salary_max'] = $salary_max;
 
         $item[$info['id']]['tag'] = $info['tag'];
         $item[$info['id']]['status'] = $info['status'];
         $item[$info['id']]['view'] = $info['view'];
         $item[$info['id']]['created_at'] = timeAgo($info['created_at']);
         //$item[$info['id']]['updated_at'] = date('d M Y', $info['updated_at']);
 
         $item[$info['id']]['cat_id'] = $info['category'];
         $item[$info['id']]['sub_cat_id'] = $info['sub_category'];
         $get_main = get_maincat_by_id($info['category']);
         $get_sub = get_subcat_by_id($info['sub_category']);
         $item[$info['id']]['category'] = $get_main['cat_name'];
         $item[$info['id']]['sub_category'] = $get_sub['sub_cat_name'];
 
         $item[$info['id']]['image'] = !empty($info['screen_shot'])?$info['screen_shot']:$item[$info['id']]['company_image'];
 
         $item[$info['id']]['favorite'] = check_product_favorite($info['id']);
 
         if($info['tag'] != ''){
             $item[$info['id']]['showtag'] = "1";
             $tag = explode(',', $info['tag']);
             $tag2 = array();
             foreach ($tag as $val)
             {
                 //REMOVE SPACE FROM $VALUE ----
                 $val = preg_replace("/[\s_]/","-", trim($val));
                 $tag2[] = '<li><a href="'.$config['site_url'].'/listing?keywords='.$val.'">'.$val.'</a> </li>';
             }
             $item[$info['id']]['tag'] = implode('  ', $tag2);
         }else{
             $item[$info['id']]['tag'] = "";
             $item[$info['id']]['showtag'] = "0";
         }
 
 
 
         $user = "SELECT username FROM ".$config['db']['pre']."user where id='".$info['user_id']."'";
         $userresult = mysqli_query($mysqli, $user);
         $userinfo = mysqli_fetch_assoc($userresult);
 
         $item[$info['id']]['username'] = $userinfo['username'];
 
 
         if(check_user_upgrades($info['user_id']))
         {
             $sub_info = get_user_membership_detail($info['user_id']);
             $item[$info['id']]['sub_title'] = $sub_info['sub_title'];
             $item[$info['id']]['sub_image'] = $sub_info['sub_image'];
         }else{
             $item[$info['id']]['sub_title'] = '';
             $item[$info['id']]['sub_image'] = '';
         }
 
         $item[$info['id']]['highlight_bg'] = ($info['highlight'] == 1)? "highlight-premium-ad" : "";
 
         $author_url = create_slug($userinfo['username']);
 
         $item[$info['id']]['author_link'] = $config['site_url'].'profile/'.$author_url;
 
         $pro_url = create_slug($info['product_name']);
 
         $item[$info['id']]['link'] = $config['site_url'].'job/' . $info['id'] . '/'.$pro_url;
 
         $item[$info['id']]['catlink'] = $config['site_url'].'category/'.$get_main['slug'];
 
         $item[$info['id']]['subcatlink'] = $config['site_url'].'category/'.$get_main['slug'].'/'.$get_sub['slug'];
 
         $city = create_slug($item[$info['id']]['city']);
         $item[$info['id']]['citylink'] = $config['site_url'].'city/'.$info['city'].'/'.$city;
         $postid = base64_url_encode($info['id']);
         $qcuserid = base64_url_encode($worker_id);
         $item[$info['id']]['quickchat_url'] =  $link['MESSAGE']."/?postid=$postid&userid=$qcuserid";
 
     }
 }
 else
 {
 
     //echo "0 results";
 }
 //dd($item);


$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/conversation-starter.tpl');
$page->SetParameter('OVERALL_HEADER', create_header($lang['EDITPROFILE']));
$page->SetParameter('USER_SIDEBAR', create_user_sidebar());
$page->SetParameter('WORKER_AVATAR',$worker_image);
$page->SetParameter('WORKER_NAME',ucfirst($worker_data['name']));
$page->SetParameter('WORKER_AVATAR',$worker_image);
$page->SetLoop ('ITEM', $item);
$page->SetParameter ('ADSFOUND', $total);
$page->SetParameter ('LIMIT', $limit);
$Pagelink = "";
//dd($_GET);
if(count($_GET['page']) >= 1){
    unset($_GET['id']);
    $get = http_build_query($_GET);
    $Pagelink .= "?".$get;

    $page->SetLoop ('PAGES', pagenav($total,$page_number,$limit,$link['CONVERSATION_STARTER'].'/'.$worker_id.$Pagelink,1));
}else{
    $page->SetLoop ('PAGES', pagenav($total,$page_number,$limit,$link['CONVERSATION_STARTER'].'/'.$worker_id));
}
$page->SetParameter('OVERALL_FOOTER', create_footer());
$page->CreatePageEcho();
}else{
headerRedirect($link['LOGIN']);  
}