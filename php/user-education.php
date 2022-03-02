<?php

if(checkloggedin())
{
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    if($ses_userdata['user_type'] != 'user'){
        headerRedirect($link['DASHBOARD']);
    }
    $id = $institution = $course = $start_date = $end_date = $currently_working = $error = '';
    $title=$lang['ADD_EDUCATION'];
    global $match;
    if(isset($match['params']['id'])){
        $_GET['id'] = $match['params']['id'];
        $result = ORM::for_table($config['db']['pre'].'educations')
            ->where('user_id' , $_SESSION['user']['id'])
            ->where('id' , $_GET['id'])
            ->find_one();

        $institution = $result['institution'];
        $course = $result['course'];
        $start_date = $result['start_date'];
        $end_date = $result['end_date'];
        $currently_working = $result['currently_working'];
        $id = $_GET['id'];
        $title=$lang['EDIT_EDUCATION'];
    }

    if(isset($_POST['submit'])){
        if(empty($_POST['institution']) || empty($_POST['course']) || empty($_POST['start_date'])){
            $error = $lang['ALL_FIELDS_REQ'];
        }
        $start_date = date("Y-m-d", strtotime($_POST['start_date']));
        $end_date = null;
        if(!empty($_POST['end_date'])){
            $end_date = date("Y-m-d", strtotime($_POST['end_date']));
            if($end_date <= $start_date) {
                $error = $lang['INVALID_END_DATE'];
            }
        }else{
            $_POST['currently_working'] = '1';
        }

        if($error == '') {
            if (!empty($_POST['id'])) {
                $education_update = ORM::for_table($config['db']['pre'].'educations')
                    ->where('id',$_POST['id'])
                    ->where('user_id',$_SESSION['user']['id'])
                    ->find_one();   
                $education_update->set('institution', $_POST['institution']);
                $education_update->set('course', $_POST['course']);
                $education_update->set('start_date', $start_date);
                $education_update->set('end_date', $end_date);
                $education_update->set('currently_working', $_POST['currently_working']);
                $education_update->save();
            } else {
                $education = ORM::for_table($config['db']['pre'].'educations')->create();
                $education->user_id = $_SESSION['user']['id'];
                $education->institution = $_POST['institution'];
                $education->course = $_POST['course'];
                $education->start_date = $start_date;
                $education->end_date = $end_date;
                $education->currently_working = $_POST['currently_working'];
                //dd($education);
                $education->save();
            }
            transfer($link['EDUCATIONS'],$lang['EDUCATION_UPDATED'],$lang['EDUCATION_UPDATED']);
            exit;
        }
    }


    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/user-education.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['ADD_EDUCATION']));
    $page->SetParameter ('INSTITUTION', $institution);
    $page->SetParameter ('COURSE', $course);
    $page->SetParameter ('START_DATE', $start_date);
    $page->SetParameter ('END_DATE', $end_date);
    $page->SetParameter ('CURRENTLY_WORKING', $currently_working);
    $page->SetParameter ('ID', $id);
    $page->SetParameter ('ERROR', $error);
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs('ADD_EDUCATION'));
    $page->SetParameter ('TITLE', $title);
    $page->CreatePageEcho();
}else{
    headerRedirect($link['LOGIN']);
}