<?php
if(checkloggedin())
{
	update_lastactive();
    $user_id = $_SESSION['user']['id'];
	$ses_userdata = get_user_data($_SESSION['user']['username']);
	if($ses_userdata['user_type'] != 'user'){
		headerRedirect($link['DASHBOARD']);
	}
    
    $user_about = ORM::for_table($config['db']['pre'] . 'user_about_mes')->select_many('about_me_id','about_me_option_id')->where('user_id', $user_id)->where_raw('NOT(about_me_id <=> NULL)')->find_array();
    $user_about_option_ids=array_column($user_about,'about_me_option_id');
    $about_me = ORM::for_table($config['db']['pre'] .'about_mes')->table_alias('about_me')
    ->select_many('about_me.id','about_me.name',array('about_me_opt_id'=>'about_me_opt.id','about_me_opt_name'=>'about_me_opt.name'))
	->select_expr('(SELECT COUNT(about_me_id) FROM '.$config['db']['pre'].'about_me_options WHERE about_me_id=about_me.id)','total_options')
    ->left_outer_join($config['db']['pre'] . 'about_me_options','about_me.id=about_me_opt.about_me_id','about_me_opt')
    ->order_by_asc('about_me.id')
    ->find_array();

    $old_id=NULL;
    $aboutWithOptions=array();
    foreach ($about_me as $key => $about) {
        if($about['id']!=$old_id){
           $aboutWithOptions[$about['id']]['id']=$about['id']; 
           $aboutWithOptions[$about['id']]['name']=$about['name']; 
           $aboutWithOptions[$about['id']]['total_options']=$about['total_options']; 
           $old_id=$about['id'];
        }
        if($about['total_options'] > 0){
            $aboutWithOptions[$about['id']]['options'][]= ['id'=>$about['about_me_opt_id'],'name'=>$about['about_me_opt_name']];
        }else{
            $aboutWithOptions[$about['id']]['options']=[];
        }    
    }
    $about_tpl='';
	$items = array();
    if ($about_me) {
        foreach ($aboutWithOptions as $info)
        {   
			$options='';
			foreach ($info['options'] as $key => $value) {
                $chk=in_array($value['id'],$user_about_option_ids)?'checked':'';
               
				$options.='				
                    <div class="col-md-12">
                        <div class="r_wrpa_cl">
                            <input type="radio" id="opt_'.$value['id'].'" name="option['.$info['id'].']" value="'.$value['id'].'" '.$chk.' style="margin-left:5px;">
                            <label for="opt_'.$value['id'].'">'.$value['name'].'</label>
                        </div>
                    </div>';
			}
			$about_tpl.='
			<div class="col-xl-12 mt-0 col-md-12 immu_info">
			    <div class="submit-field">
				<h5 style="margin-left:10px;">'.$info['name'].'</h5>
				'.$options.'
			</div>
		</div>';
        }
    }
    if (isset($_POST['submit'])) {
        $option_data=$_POST['option'];
        $now=date("Y-m-d H:i:s");
        foreach ($option_data as $key => $value) {
            $user_about_v=ORM::for_table($config['db']['pre'] .'user_about_mes')->where(['user_id'=>$user_id,'about_me_id'=>$key])->find_one();
            if($user_about_v){
            
                $user_about_v->about_me_option_id=$value;
                $user_about_v->save();
            }else{
                $user_about_v=ORM::for_table($config['db']['pre'] .'user_about_mes')->create();
                $user_about_v->user_id=$user_id;
                $user_about_v->about_me_id=$key;
                $user_about_v->about_me_option_id=$value;
                $user_about_v->save();
            }
        }
        transfer($link['ABOUT_ME'], $lang['ABOUT_ME_UPDATED'], $lang['ABOUT_ME_UPDATED']);
        exit;
    }
	$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/about-me.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['ABOUT_ME']));
    $page->SetLoop ('ITEM', $items);
    $page->SetParameter('ABOUT',$about_tpl);
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->CreatePageEcho();
}else{
	headerRedirect($link['LOGIN']);
}
?>
<style>
    .r_wrpa_cl {
    display: flex;
}
</style>