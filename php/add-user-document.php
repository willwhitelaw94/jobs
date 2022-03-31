<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(checkloggedin())
{
    update_lastactive();
    $user_id = $_SESSION['user']['id'];
    global $match;
    if(isset($match['params']['id'])){
        $_GET['id'] = $match['params']['id'];
        $user_doc_info = ORM::for_table($config['db']['pre'].'user_documents')->where('id',$_GET['id'])->find_one();
        $title='EDIT_DOCUMENT';
        $sql_con1= 'r.id NOT IN (SELECT requirement_id FROM '.$config['db']['pre'].'user_documents WHERE user_id='.$user_id.'  EXCEPT  SELECT requirement_id FROM '.$config['db']['pre'].'user_documents WHERE user_id='.$user_id.' AND requirement_id='.$user_doc_info['requirement_id'].')';
    }else{
        $title='ADD_DOCUMENT';
        $sql_con1= 'r.id NOT IN (SELECT requirement_id FROM '.$config['db']['pre'].'user_documents WHERE user_id='.$user_id.')';

    }
    $jobRequirements = ORM::for_table($config['db']['pre'].'requirements')->table_alias('r')
     ->where_raw($sql_con1)
     ->find_array();
 
   
    $username_error = $expiry_date_error = $document_error=$expiry_date='';
   //$filename='';
    $error = 0;
    $certificate_file=null;
    
   
   // echo ORM::get_last_query();die;
    
    if (isset($_POST['submit'])) {
        $expiry_date=$_POST['expiry_date']??null;
        if(empty($expiry_date)){
            $error++;
            $expiry_date_error ="<span class='status-not-available'> " . $lang['EXPIRY_DATE_REQ'] . "</span>";
        }
        if(!empty($_FILES['file_path'])){
            $file = $_FILES['file_path'];
            // Valid formats
            $resume_files = trim(get_option("resume_files"));
            $valid_formats = explode(',', $resume_files);
            $filename = $file['name'];
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    $main_path = ROOTPATH . "/storage/documt/";
                    if(!file_exists($filename)){
                        mkdir($main_path, 0777);	
                    }
                    $filename = uniqid(time()).'.'.$ext;
                    
                    if(move_uploaded_file($file['tmp_name'], $main_path.$filename)){
                        $certificate_file = $filename;
                    }else{
                        $document_error = $lang['ERROR_TRY_AGAIN'];
                        $document_error ="<span class='status-not-available'> " . $document_error . "</span>";
                    }
                } else {
                    $error++;
                    $document_error = 'File type error';
                    $document_error ="<span class='status-not-available'> " . $document_error . "</span>";
                }
            }
            else{
                $error++;
                $document_error= $lang['CERTIFICATE_REQ'];
                $document_error ="<span class='status-not-available'> " .$document_error. "</span>";
           }
        }
        if($error==0){
            $now=date("Y-m-d H:i:s");
          
            if(!$user_doc_info){
                $user_doc_info=ORM::for_table($config['db']['pre'] .'user_documents')->create();
                $user_doc_info->user_id=$user_id;
                $user_doc_info->requirement_id = $_POST['document_type'];
                $user_doc_info->extension = $ext;
                $user_doc_info->details = $_POST['description'];
                $user_doc_info->registration_number = $_POST['registration_number'];
                $user_doc_info->expiry_date = $expiry_date;
                $user_doc_info->status = 'submitted';
                if(!empty($filename)){
                    $user_doc_info->file_path=$certificate_file;
                }
                $user_doc_info->created_at  = $now;
                $user_doc_info->updated_at  = $now;
                $user_doc_info->save();
            }else{             
                if(!empty($filename)){
                    $old_path = $user_doc_info['file_path'];
                    $file = dirname(__DIR__) . "/storage/documt/" . $old_path;
                    if (file_exists($file))
                        unlink($file);
                    $user_doc_info->set('file_path',$certificate_file); 
                }
                $user_doc_info->set('user_id',$user_id);
                $user_doc_info->set('expiry_date',$expiry_date);
                $user_doc_info->set('extension',$ext); 
                $user_doc_info->set('requirement_id',$_POST['document_type']); 
                $user_doc_info->set('details',$_POST['description']); 
                $user_doc_info->set('registration_number',$_POST['registration_number']); 
                $user_doc_info->set('status','submitted'); 
                $user_doc_info->set('updated_at', $now);
                $user_doc_info->save();
            }
            transfer($link['MY_DOCUMENTS'], $lang['DOCUMENT_UPDATED'], $lang['DOCUMENT_UPDATED']);
            exit;
        }
    }
  
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/add-user-document.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang[$title]));
    // $page->SetLoop ('USER', $user);
    $page->SetParameter('EXPIRY_DATE_ERROR',$expiry_date_error);
    $page->SetParameter('DOCUMENT_ERROR',$document_error);
    $page->SetParameter('EXPIRY_DATE',$user_doc_info['expiry_date']??'');
    $page->SetParameter('DOCUMENT_FILE',$user_doc_info['file_path']??'');
    $page->SetParameter('REQUIREMENT_ID',$user_doc_info['requirement_id']??'');
    $page->SetParameter('REGISTRATION_NUMBER',$user_doc_info['registration_number']??'');
    $page->SetParameter('DETAILS',$user_doc_info['details']??'');
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs($title));
    $page->SetParameter ('TITLE', $title);
   // print_r($jobRequirements);die;
    $page->SetLoop('REQUIREMENTS', $jobRequirements);
    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);
}