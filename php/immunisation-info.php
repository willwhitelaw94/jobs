<?php
if (checkloggedin()) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    update_lastactive();
    $user_id =   $_SESSION['user']['id'];
    $username_error = $immunisation_date_error = $certificate_error=$is_vaccinated=$immunisation_date=$is_flu_vaccinated='' ;
    $filename='';
    $error = 0;
    $certificate_file=null;

    $user_immu_info=ORM::for_table($config['db']['pre'] . 'user_immunisation_info')->where('user_id',$user_id)->find_one();
   // dd($user_immu_info);
    if (isset($_POST['submit'])) {
    
    $is_vaccinated=$_POST['is_vaccinated'];
    $immunisation_date=$_POST['recent_immunisation_date']??null;
    $is_flu_vaccinated=$_POST['is_flu_vaccinated'];
     //print_r($_POST);die;
//    / print_r($is_vaccinated);die;
        if($is_vaccinated !='0'){
            if(empty($immunisation_date)){
            $error++;
            $immunisation_date_error ="<span class='status-not-available'> " . $lang['IMMUNISATION_DATE_REQ'] . "</span>";
            
            }
            if(!empty($_FILES['covid_certificate'])){
                $file = $_FILES['covid_certificate'];
                // Valid formats
                $resume_files = trim(get_option("resume_files"));
                $valid_formats = explode(',', $resume_files);
                $filename = $file['name'];
                $ext = getExtension($filename);
                $ext = strtolower($ext);
                if (!empty($filename)) {
                    //File extension check
                    if (in_array($ext, $valid_formats)) {
                        $main_path = ROOTPATH . "/storage/covid-certificates/";
                        if(!file_exists($filename)){
                            mkdir($main_path, 0777);	
                        }
                        $filename = uniqid(time()).'.'.$ext;
                        if(move_uploaded_file($file['tmp_name'], $main_path.$filename)){
                            $certificate_file = $filename;
                        }else{
                            $certificate_error = $lang['ERROR_TRY_AGAIN'];
                            $certificate_error ="<span class='status-not-available'> " . $certificate_error . "</span>";
                        }
                    } else {
                        $error++;
                        $certificate_error = 'File type error';
                        $certificate_error ="<span class='status-not-available'> " . $certificate_error . "</span>";
                    }
                }
                else{
                 $error++;
                 $certificate_error= $lang['CERTIFICATE_REQ'];
                 $certificate_error ="<span class='status-not-available'> " .$certificate_error. "</span>";
               }
            }

         }
        // echo $error;
        // echo $immunisation_date_error;
        // echo $certificate_error;
        
        // die;
        if($error==0){
          
            $now=date("Y-m-d H:i:s");
          
            if(!$user_immu_info){
                $user_immu_info=ORM::for_table($config['db']['pre'] .'user_immunisation_info')->create();
                $user_immu_info->user_id=$user_id;
                $user_immu_info->is_vaccinated=$is_vaccinated;
                $user_immu_info->recent_immunisation_date=$immunisation_date;
                if(!empty($filename)){
                    $user_immu_info->certificate_file=$certificate_file;
                }
                $user_immu_info->is_flu_vaccinated=$is_flu_vaccinated; 
                $user_immu_info->created_at  = $now;
                $user_immu_info->updated_at  = $now;
                $user_immu_info->save();
            }else{
                //echo 'xhkxuhd';die;
               //dd($user_immu_info);
                if(!empty($filename)){
                $old_path = $user_immu_info['certificate_file'];
                $file = dirname(__DIR__) . "/storage//" . $old_path;
                if (file_exists($file))
                    unlink($file);
                $user_immu_info->set('certificate_file',$certificate_file); 
                }
                $user_immu_info->set('is_vaccinated',$is_vaccinated);
                $user_immu_info->set('recent_immunisation_date',$immunisation_date);
                $user_immu_info->set('is_flu_vaccinated',$is_flu_vaccinated); 
                $user_immu_info->set('updated_at', $now);
                $user_immu_info->save();
            }
           
        }
       // echo ORM::get_last_query();die;
        transfer($link['IMMUNISATION_INFO'], $lang['IMMUNISATION_INFO_UPDATED'], $lang['IMMUNISATION_INFO_UPDATED']);
        exit;

    }

//echo $certificate_error;die;
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/immunisation-info.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang['IMMUNISATION_INFO']));
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetParameter('IMMUNISATION_DATE_ERROR',$immunisation_date_error);
    $page->SetParameter('CERTIFICATE_ERROR',$certificate_error);
    $page->SetParameter('IMMUNISATION_DATE',$user_immu_info['recent_immunisation_date']);
    $page->SetParameter('IS_VACCINATED',$user_immu_info['is_vaccinated']);
    $page->SetParameter('IS_FLU_VACCINATED',$user_immu_info['is_flu_vaccinated']);
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('IMMUNISATION_INFO'));
    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);  

}