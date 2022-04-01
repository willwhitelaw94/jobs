<?php
if(checkloggedin())
{    
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $user_id=$_SESSION['user']['id'];

    if (!isset($_GET['page']))
            $_GET['page'] = 1;

    $limit = 10;
    $page = $_GET['page'];
    $offset = ($page - 1) * $limit;
    $item = array();

    $total_item = ORM::for_table($config['db']['pre'].'user_applied')
    ->table_alias('a')
    ->select_expr('COUNT(DISTINCT(p.user_id)) AS count')
    ->where(array(
        'p.status' => 'active',
        'p.hide' => '0',
        'a.user_id' => $user_id
    ))
    ->join($config['db']['pre'] . 'product', array('a.job_id', '=', 'p.id'), 'p')
    ->find_one()['count'];
    

    $result = ORM::for_table($config['db']['pre'] . 'user_applied')
            ->table_alias('ua')
            ->select_many('ua.*',['client_id'=>'c.id'], 'c.username', 'c.name', 'c.sex', 'c.image','c.category','c.subcategory','c.country_code','c.city_code',['description'=>'c.description'],'c.phone')
          
            ->where(array(
                'p.status' => 'active',
                'p.hide' => '0',
                'ua.user_id' => $user_id,
                'c.user_type' => 'employer',
            ))
            
            ->join($config['db']['pre'] . 'product', array('ua.job_id', '=', 'p.id'), 'p')
            ->join($config['db']['pre'] . 'user', array('p.user_id', '=', 'c.id'), 'c')
            ->group_by('client_id')
            ->limit($limit)->offset($offset)
            ->find_many();

          
    foreach($result as $info){
        $item[$info['id']]['client_id'] = $info['client_id'];
        $item[$info['id']]['username'] = $info['username'];
        $item[$info['id']]['name'] = !empty($info['name'])?$info['name']:$info['username'];
        $item[$info['id']]['description'] = nl2br(stripcslashes($info['description']));
        $item[$info['id']]['sex'] = $info['sex'];
        $item[$info['id']]['image'] = !empty($info['image'])?$info['image']:'default_user.png';
        $item[$info['id']]['phone'] =$info['phone'];

        $item[$info['id']]['category'] = $item[$info['id']]['subcategory'] = null;
        if(!empty($info['category'])){
            $get_cat = get_maincat_by_id($info['category']);
            $item[$info['id']]['category'] = $get_cat['cat_name'];
        }
        if(!empty($info['subcategory'])){
            $get_cat = get_subcat_by_id($info['subcategory']);
            $item[$info['id']]['subcategory'] = $get_cat['sub_cat_name'];
        }

        $country_code = $info['country_code'];
        $item[$info['id']]['city'] = $info['city'];
        if(!empty($info['city_code'])) {
            $city_detail = get_cityDetail_by_id($info['city_code']);
            $item[$info['id']]['city'] = $city_detail['asciiname'];
            $item[$info['id']]['city'] .= ', '.get_stateName_by_id($city_detail['subadmin1_code']);
        }

        $item[$info['id']]['user_id'] =$user_id;
        $item[$info['id']]['favorite'] = check_user_favorite($info['client_id']);

    }
   

    $pagging = pagenav($total_item, $_GET['page'], $limit, $link['MYCLIENTS'].'/'.$_GET['id']);

    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/my-clients.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['MYCLIENTS']));
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('MYCLIENTS'));
    $page->SetLoop('ITEM', $item);
    $page->SetLoop('PAGES', $pagging);
    $page->SetParameter('TOTALITEM', $total_item);
    $page->CreatePageEcho();

}else{

}