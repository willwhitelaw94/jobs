<?php
// if resume is disable
if(!$config['resume_enable']){
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
}
if(checkloggedin())
{
	update_lastactive();
	$ses_userdata = get_user_data($_SESSION['user']['username']);
	if($ses_userdata['user_type'] != 'user'){
		headerRedirect($link['DASHBOARD']);
	}
	$id = $name = $error = $resume_file = '';
    global $match;
	if(isset($match['params']['id'])){
        $_GET['id'] = $match['params']['id'];

		$result = ORM::for_table($config['db']['pre'].'resumes')
		->where('user_id' , $_SESSION['user']['id'])
		->where('id' , $_GET['id'])
		->where('active' , '1')
		->find_one();

		$name = $result['name'];
		$id = $_GET['id'];
	}

	if(isset($_POST['submit'])){
		if(empty($_POST['name'])){
			$_POST['name'] = date('Y-m-d-h-i');
		}
		$name = $_POST['name'];

		if(!empty($_FILES['resume'])){
			$file = $_FILES['resume'];
			// Valid formats
            $resume_files = trim(get_option("resume_files"));
            $valid_formats = explode(',', $resume_files);
			$filename = $file['name'];
			$ext = getExtension($filename);
			$ext = strtolower($ext);
			if (!empty($filename)) {
                //File extension check
				if (in_array($ext, $valid_formats)) {
					$main_path = ROOTPATH . "/storage/resumes/";
					if(!file_exists($filename)){
						mkdir($main_path, 0777);	
					}
					$filename = uniqid(time()).'.'.$ext;
					if(move_uploaded_file($file['tmp_name'], $main_path.$filename)){
						$resume_file = $filename;
					}else{
						$error = $lang['ERROR_TRY_AGAIN'];
					}
				} else {
					$error = $lang['RESUME_FILE_TYPE'];
				}
			}
		}else{
			if(empty($_POST['id'])){
				$error = $lang['RESUME_REQ'];
			}
		}

		if($error == ''){
			// save resume in database
			$now = date("Y-m-d H:i:s");
			if(!empty($_POST['id'])){
				$resume_create = ORM::for_table($config['db']['pre'].'resumes')
				->where('id',$_POST['id'])
				->where('user_id',$_SESSION['user']['id'])
				->find_one();

				if($resume_create){
					if(!empty($resume_file)){
						$resume_create->set('filename', $resume_file);
					}
					$resume_create->set('name', $_POST['name']);
					$resume_create->set('updated_at', $now);
					$resume_create->save();
				}
			}else{
				$resume_create = ORM::for_table($config['db']['pre'].'resumes')->create();
				$resume_create->name = $_POST['name'];
				$resume_create->filename = $resume_file;
				$resume_create->user_id = $_SESSION['user']['id'];
				$resume_create->created_at = $now;
				$resume_create->updated_at = $now;
				$resume_create->save();
			}

			transfer($link['RESUMES'],$lang['RESUME_UPLOADED'],$lang['RESUME_UPLOADED']);
			exit;
		}
	}


	$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/resume.tpl');
	$page->SetParameter ('OVERALL_HEADER', create_header($lang['ADD_RESUME']));
	$page->SetParameter ('RESUMES', resumes_count($_SESSION['user']['id']));
	$page->SetParameter ('FAVORITEADS', favorite_ads_count($_SESSION['user']['id']));
	$page->SetParameter('WCHAT', (isset($config['wchat_on_off']))? $config['wchat_on_off']:"");
	$page->SetParameter ('NAME', $name);
	$page->SetParameter ('ID', $id);
	$page->SetParameter ('ERROR', $error);
	$page->SetParameter ('OVERALL_FOOTER', create_footer());
	$page->SetParameter('USER_SIDEBAR', create_user_sidebar());

	$page->CreatePageEcho();
}else{
	headerRedirect($link['LOGIN']);
}
?>
