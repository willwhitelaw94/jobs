<?php
if(checkloggedin()){
    update_lastactive();
    $user_id= $_SESSION['user']['id'];
    $userBackgrounds = ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->select('cultural_background_id')->where('user_id', $user_id)->where_raw('NOT(cultural_background_id <=> NULL)')->find_array();
    $userBackgroundIds=array_column($userBackgrounds,'cultural_background_id');
    //$backgroundOptions = ORM::for_table($config['db']['pre'] .'cultural_background_options')->find_array();
    $backgrounds = ORM::for_table($config['db']['pre'] .'cultural_backgrounds')->table_alias('c_back')
    ->select_many('c_back.id','c_back.name',array('bck_opt_id'=>'bck_opt.id','bck_opt_name'=>'bck_opt.name'))
    ->select_expr('(SELECT COUNT(cultural_background_id) FROM '.$config['db']['pre'].'cultural_background_options WHERE cultural_background_id=c_back.id)','total_options')
    ->left_outer_join($config['db']['pre'] . 'cultural_background_options','c_back.id=bck_opt.cultural_background_id','bck_opt')
    ->order_by_asc('c_back.id')
    ->find_array();
    
    $old_id=NULL;
    $backgroundWithOptions=array();
    foreach ($backgrounds as $key => $back) {
        if($back['id']!=$old_id){
           $backgroundWithOptions[$back['id']]['id']=$back['id']; 
           $backgroundWithOptions[$back['id']]['name']=$back['name']; 
           $backgroundWithOptions[$back['id']]['total_options']=$back['total_options']; 
           $old_id=$back['id'];
        }
        if($back['total_options'] > 0){
            $backgroundWithOptions[$back['id']]['options'][]= ['id'=>$back['bck_opt_id'],'name'=>$back['bck_opt_name']];
        }else{
            $backgroundWithOptions[$back['id']]['options']=[];
        }    
    }
 
    if(isset($_POST['submit_details'])){

        $backs =$_POST['background']??[];
        $background_options = $_POST['back_options']??[];

        $backgrounds =[];
        $backgroundOptions = [];
        $c_backg= ORM::for_table('person')->create();
        foreach($backs as $main) {
            array_push($backgrounds,'('.$user_id.','.$main.')'); #(1,2),(1,3)
        }
        $u_c_back = implode(',',$backgrounds);
        foreach($background_options as $background_option) {
            if(in_array(parent_culture($background_option), $backs)){
                array_push($backgroundOptions,'('.$user_id.','.parent_culture($background_option).','.$background_option.')'); #(1,2,23)
            }  
        }
        $u_c_backopt = implode(',',$backgroundOptions);  #(1,2,23), (1,2,24)
        $userBackg = ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where('user_id', $user_id)->find_array();
        if(count($userBackg)) {
            ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where_equal('user_id', $user_id)->delete_many();
        }
        ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'user_cultural_backgrounds (user_id,cultural_background_id) VALUES'.$u_c_back.'');
        ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'user_cultural_backgrounds (user_id,cultural_background_id,cultural_background_option_id) VALUES'.$u_c_backopt.''); 
        transfer($link['CULTURAL_BACKGROUNDS'], $lang['CULTURAL_BACKGROUNDS_UPDATED'], $lang['CULTURAL_BACKGROUNDS_UPDATED']);
        exit;
    }
 
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/cultural-backgrounds.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['RATE_AVAILABILITY']));
    $page->SetParameter('USER_DASHBOARD_CARD', create_user_dashboard_card());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('USER_BCK',implode(',',$userBackgroundIds));
    $page->SetLoop('BACKGROUNDS',$backgroundWithOptions);
    $page->SetParameter('C_BACKGROUNDOPTIONS',create_culture_background_options($backgroundWithOptions,$userBackgroundIds));
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('MY_CULTURAL_BACKGROUNDS'));
    
    $page->CreatePageEcho();   
}else{
    headerRedirect($link['LOGIN']);
}
