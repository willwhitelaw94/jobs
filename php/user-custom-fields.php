<?php

if (checkloggedin()) {
    update_lastactive();
    $custom_fields = array();
    $custom_data = array();
    $user_id = $_SESSION['user']['id'];
    $customdata = ORM::for_table($config['db']['pre'].'user_custom_data')
        ->select_many('field_id','field_data')
        ->where('user_id',$user_id)
        ->find_many();        
    foreach ($customdata as $array){
        $custom_fields[] = $array['field_id'];
        $custom_data[] = $array['field_data'];
    }

    $custom_fields = get_user_customFields(true,$custom_fields, $custom_data);
    // print_r($custom_fields);die;
    foreach ($custom_fields as $key => $value) {
        if ($value['userent']){
            $custom_db_fields[$value['id']] = $value['title'];
            $custom_db_data[$value['id']] = str_replace(',', '&#44;', $value['default']);
        }
    }  
    // echo "<pre>";  
    // print_r($custom_fields);die;
    if(isset($_POST['submit'])){
      //  dd($_POST);
        add_post_user_customField_data($user_id);
    }
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/user-custom-fields.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($header_text));
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetLoop ('CUSTOMFIELDS',$custom_fields);
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('MY_CULTURAL_BACKGROUNDS'));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->CreatePageEcho();
}
else{
    headerRedirect($link['LOGIN']);  
}    
