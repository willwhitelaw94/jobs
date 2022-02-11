<?php

if(checkloggedin())
{
	update_lastactive();
	$ses_userdata = get_user_data($_SESSION['user']['username']);
	if($ses_userdata['user_type'] != 'user'){
		headerRedirect($link['DASHBOARD']);
	}

	$notify_cat = explode(',', $ses_userdata['notify_cat']);
	$category = get_maincategory($notify_cat,"checked");

	if(!isset($_POST['submit']))
    {
    	$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/job-alert.tpl');
	    $page->SetParameter ('OVERALL_HEADER', create_header($lang['JOB_ALERT']));
	    $page->SetParameter ('RESUMES', resumes_count($_SESSION['user']['id']));
        $page->SetParameter ('APPLIEDJOBS', applied_jobs_count($_SESSION['user']['id']));
	    $page->SetParameter ('FAVORITEADS', favorite_ads_count($_SESSION['user']['id']));
        $page->SetParameter('WCHAT', (isset($config['wchat_on_off']))? $config['wchat_on_off']:"");
	    $page->SetLoop ('CATEGORY',$category);
	    $page->SetParameter ('NOTIFY', $ses_userdata['notify']);
	    $page->SetParameter ('OVERALL_FOOTER', create_footer());
	    $page->CreatePageEcho();
    }else{
    	$notify = isset($_POST['notify']) ? '1' : '0';

        if (isset($_POST['choice']) && is_array($_POST['choice'])) {
            $choice = validate_input(implode(',', $_POST['choice']));
        }else{
            $choice = '';
        }
        $now = date("Y-m-d H:i:s");
        $user_update = ORM::for_table($config['db']['pre'].'user')->find_one($_SESSION['user']['id']);
        $user_update->set('notify', $notify);
        $user_update->set('notify_cat', $choice);
        $user_update->set('updated_at', $now);
        $user_update->save();

        ORM::for_table($config['db']['pre'].'notification')
                ->where_equal('user_id', $_SESSION['user']['id'])
                ->delete_many();

        if($notify)
        {
            if(isset($_POST['choice']))
            {
                foreach ($_POST['choice'] as $key=>$value)
                {
                    $notification = ORM::for_table($config['db']['pre'].'notification')->create();
                    $notification->user_id = $_SESSION['user']['id'];
                    $notification->cat_id = $key;
                    $notification->user_email = $ses_userdata['email'];
                    $notification->save();
                }
            }
        }
        transfer($link['JOBALERT'],$lang['PROFILE_UPDATED'],$lang['PROFILE_UPDATED']);
    }

}else{
	headerRedirect($link['LOGIN']);
}
?>
