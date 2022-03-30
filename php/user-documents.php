<?php
// if resume is disable

if(checkloggedin())
{
	update_lastactive();
    $user_id = $_SESSION['user']['id'];
	$ses_userdata = get_user_data($_SESSION['user']['username']);
	if($ses_userdata['user_type'] != 'user'){
		headerRedirect($link['DASHBOARD']);
	}
    $user_doc_info = ORM::for_table($config['db']['pre'].'user_documents')->select($config['db']['pre'].'user_documents.*')
    ->select($config['db']['pre'].'requirements.name', 'req_name')
    ->join($config['db']['pre'].'requirements', array(
        $config['db']['pre'].'requirements.id', '=', $config['db']['pre'].'user_documents.requirement_id'
    ))->where($config['db']['pre'].'user_documents.user_id',$user_id)->find_many();
    
    // echo "<pre>";
    // print_r($user_doc_info);
    // die;

    $items = array();
    if ($user_doc_info) {
        foreach ($user_doc_info as $info)
        {
        	$items[$info['id']]['id'] = $info['id'];
        	$items[$info['id']]['file_path'] = $info['file_path'];
            $items[$info['id']]['req_name'] = $info['req_name'];
            $items[$info['id']]['registration_number'] = $info['registration_number'];
            $items[$info['id']]['expiry_date'] = $info['expiry_date'];
            $items[$info['id']]['details'] = $info['details'];
            $items[$info['id']]['status'] = $info['status'];
        }
    }
	$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/user-documents.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['MY_RESUMES']));
    $page->SetLoop ('ITEM', $items);
    $page->SetParameter ('DOCUMENTS', documents_count($user_id));
    $page->SetParameter ('KEYWORDS', $keywords);
    $page->SetParameter('WCHAT', (isset($config['wchat_on_off']))? $config['wchat_on_off']:"");
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->CreatePageEcho();
}else{
	headerRedirect($link['LOGIN']);
}
?>
