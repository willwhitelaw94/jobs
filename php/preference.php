<?php

if(checkloggedin())
{
	update_lastactive();
    $user_id = $_SESSION['user']['id'];
	$ses_userdata = get_user_data($_SESSION['user']['username']);
	if($ses_userdata['user_type'] != 'user'){
		headerRedirect($link['DASHBOARD']);
	}
	$user_preference = ORM::for_table($config['db']['pre'] . 'user_preferences')->select_many('preference_id','preference_option_id')->where('user_id', $user_id)->where_raw('NOT(preference_id <=> NULL)')->find_array();
	
	$user_preference_option_ids=array_column($user_preference,'preference_option_id');
	$preference = ORM::for_table($config['db']['pre'] .'preferences')->table_alias('pre')
    ->select_many('pre.id','pre.question',array('pre_opt_id'=>'pre_opt.id','pre_opt_name'=>'pre_opt.name'))
	->select_expr('(SELECT COUNT(preference_id) FROM '.$config['db']['pre'].'preference_options WHERE preference_id=pre.id)','total_options')
    ->left_outer_join($config['db']['pre'] . 'preference_options','pre.id=pre_opt.preference_id','pre_opt')
    ->order_by_asc('pre.id')
    ->find_array();
	

	$old_id=NULL;
    $preferenceWithOptions=array();
    foreach ($preference as $key => $pre) {
        if($pre['id']!=$old_id){
           $preferenceWithOptions[$pre['id']]['id']=$pre['id']; 
           $preferenceWithOptions[$pre['id']]['question']=$pre['question']; 
           $preferenceWithOptions[$pre['id']]['total_options']=$pre['total_options']; 
           $old_id=$pre['id'];
        }
        if($pre['total_options'] > 0){
            $preferenceWithOptions[$pre['id']]['options'][]= ['id'=>$pre['pre_opt_id'],'name'=>$pre['pre_opt_name']];
        }else{
            $preferenceWithOptions[$pre['id']]['options']=[];
        }    
    }

	$pre_tpl='';
	$pre_item = array();
    if ($preference) {
        foreach ($preferenceWithOptions as $info)
        {   
			$options='';
			foreach ($info['options'] as $key => $value) {

				$chk=in_array($value['id'],$user_preference_option_ids)?'checked':'';
				$options.='
				<ul style="margin-top: 10px;margin-left:10px;">
					<li>
						<div class="checkbox">
							<input type="checkbox" id="'.$value['id'].'" name="option['.$info['id'].'][]" value="'.$value['id'].'" '.$chk.'>
							<label for="'.$value['id'].'"><span class="checkbox-icon"></span> '.$value['name'].'</label>
						</div>
					</li>
		        </ul>';
			}
			$pre_tpl.='
			<div class="col-xl-12 mt-0 col-md-12 immu_info">
			    <div class="submit-field">
				<h5 style="margin-left:5px;">'.$info['question'].'</h5>
				'.$options.'
			</div>
		</div>';

        }
    }
	if (isset($_POST['submit'])) {
		$preference_options=$_POST['option']??[];
		foreach ($preference_options as $key => $options) {
			foreach($user_preference_option_ids as $pre_opt_id){
				if(!in_array($pre_opt_id,$options)){
					 $data = ORM::for_table($config['db']['pre'] . 'user_preferences')->where(['user_id'=>$user_id,'preference_option_id'=>$pre_opt_id])->find_one();	
					 $data->delete();
				}
			}
		    foreach ($options as  $value) {
				$pre_data = ORM::for_table($config['db']['pre'] . 'user_preferences')->where(['user_id'=>$user_id,'preference_option_id'=>$value])->find_one();
				if(!$pre_data){
					$pre_insert=ORM::for_table($config['db']['pre'] . 'user_preferences')->create();
					$pre_insert->user_id=$user_id;
					$pre_insert->preference_id=$key;
					$pre_insert->preference_option_id=$value;
					$pre_insert->created_at=date('Y-m-d H:i:s');
					$pre_insert->save();
				}	
			}
		}
        transfer($link['PREFERENCE'], $lang['PREFERENCE_UPDATED'], $lang['PREFERENCE_UPDATED']);
        exit;
	}


	$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/preference.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['PREFERENCE']));
	$page->SetLoop ('PRE_ITEM', $pre_item);
	$page->SetParameter('PRE',$pre_tpl);
    $page->SetParameter('WCHAT', (isset($config['wchat_on_off']))? $config['wchat_on_off']:"");
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->CreatePageEcho();
}else{
	headerRedirect($link['LOGIN']);
}
?>
