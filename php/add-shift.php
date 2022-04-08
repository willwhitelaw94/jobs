<?php
if (checkloggedin()) {
    // update_lastactive();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    update_lastactive();
    $user_id = $_SESSION['user']['id'];
    $ses_userdata = get_user_data($_SESSION['user']['username']);

    $attachment = $attachment_type = $attachment_error = $incidence_occured = $shift_details = $end_time = $start_time = $agreement_rate_id = $agreement_id = $attachment_file = '';
    $title = 'NEW_SHIFT';
    $errors = 0;
    $rate_item = [];

    if (isset($match['params']['id'])) {
        $_GET['id'] = $match['params']['id'];
        $result = ORM::for_table($config['db']['pre'] . 'timesheets')
            ->select_many('id', 'agreement_id', 'agreement_rate_id', 'shift_details', 'attachment', 'incidence_occured')
            ->select_many_expr(["start_time" => "TIME_FORMAT(start_time,'%h:%i %p')"], ["end_time" => "TIME_FORMAT(end_time, '%h:%i %p')"])
            ->where('worker_id', $_SESSION['user']['id'])
            ->where('id', $_GET['id'])
            ->find_one();



        $title = 'EDIT_SHIFT';
        $agreement_id = $result['agreement_id'];
        $agreement_rate_id = $result['agreement_rate_id'];
        $start_time = $result['start_time'];
        $end_time = $result['end_time'];
        $incidence_occured = $result['incidence_occured'];
        $shift_details = $result['shift_details'];
        $attachment_file = $result['attachment'];
        // dd($result);  

        $agreement_rate_data = ORM::for_table($config['db']['pre'] . 'user_agreements_rates')
            ->where('agreement_id', $agreement_id)
            ->find_many();


        foreach ($agreement_rate_data as $data) {
            $text = ucwords($data['description']) . '- $' . $data['rate'] . ' ' . ucwords(str_replace('-', ' ', $data['rate_type']));
            $rate_item[$data['id']]['id'] = $data['id'];
            $rate_item[$data['id']]['text'] = $text;
        }
    }

    $agr_data =  ORM::for_table($config['db']['pre'] . 'user_agreements')->table_alias('a')
        ->select_many('a.*', 'p.product_name', ['client_name' => 'c.name'])
        ->where(array(
            'p.status' => 'active',
            'p.hide' => '0',
            'a.worker_id' => $user_id,
            'a.status' => 'accepted'
        ))
        ->join($config['db']['pre'] . 'product', array('a.post_id', '=', 'p.id'), 'p')
        ->join($config['db']['pre'] . 'user', array('a.client_id', '=', 'c.id'), 'c')
        ->find_many();

    $item = [];
    foreach ($agr_data as $data) {
        $item[$data['id']]['id'] = $data['id'];
        $item[$data['id']]['product_name'] = $data['product_name'];
        $item[$data['id']]['client_name'] = $data['client_name'];
    }
    // print_r( $_POST);die;

    if (isset($_POST['submit'])) {

        if (!empty($_FILES['attachment'])) {
            // print_r($_FILES);die;
            $file = $_FILES['attachment'];
            // Valid formats
            $attc_files = trim(get_option("resume_files"));
            $valid_formats = explode(',', $attc_files);
            $filename = $file['name'];
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    $attachment_type = $ext;
                    $main_path = ROOTPATH . "/storage/timesheet/";
                    if (!file_exists($filename)) {
                        mkdir($main_path, 0777);
                    }
                    $filename = uniqid(time()) . '.' . $ext;
                    if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                        $attachment = $filename;
                    } else {
                        $attachment_error = "<span class='status-not-available'>" . $lang['ERROR_TRY_AGAIN'] . "</span>";
                        $errors++;
                    }
                } else {
                    $attachment_error = "<span class='status-not-available'>" .  $lang['RESUME_FILE_TYPE'] . "</span>";
                    $errors++;
                }
            }
        }
        if ($errors == 0) {
            $start_time = !empty($_POST['start_time']) ? date('H:i:s', strtotime($_POST['start_time'])) : '';
            $end_time = !empty($_POST['end_time']) ? date('H:i:s', strtotime($_POST['end_time'])) : '';
            if (!empty($_POST['id'])) {
                $update_shift = ORM::for_table($config['db']['pre'] . 'timesheets')->find_one($_POST['id']);
                $update_shift->worker_id = $user_id;
                $update_shift->agreement_id = $_POST['agreement'];
                $update_shift->agreement_rate_id = $_POST['agreement_rate'];
                $update_shift->start_time = $start_time;
                $update_shift->end_time = $end_time;
                $update_shift->attachment = $attachment;
                $update_shift->attachment_type = $attachment_type;
                $update_shift->status    = 'submitted';
                $update_shift->shift_details = $_POST['shift_details'];
                $update_shift->incidence_occured = $_POST['incidence_occured'] ? $_POST['incidence_occured'] : '0';
                $update_shift->save();
            } else {
                $create_shift =  ORM::for_table($config['db']['pre'] . 'timesheets')->create();
                $create_shift->worker_id = $user_id;
                $create_shift->agreement_id = $_POST['agreement'];
                $create_shift->agreement_rate_id = $_POST['agreement_rate'];
                $create_shift->start_time = $start_time;
                $create_shift->end_time = $end_time;
                $create_shift->attachment = $attachment;
                $create_shift->attachment_type = $attachment_type;
                $create_shift->status    = 'submitted';
                $create_shift->shift_details = $_POST['shift_details'];
                $create_shift->incidence_occured = $_POST['incidence_occured'] ? $_POST['incidence_occured'] : '0';
                $create_shift->save();
            }
            transfer($link['TIMESHEET'], $lang['SHIFT_ADDED'], $lang['SHIFT_ADDED']);
            exit;
        }
    }

    $page = new HtmlTemplate('templates/' . $config['tpl_name'] . '/add-shift.tpl');
    $page->SetParameter('OVERALL_HEADER', create_header($lang[$title]));
    $page->SetParameter('OVERALL_FOOTER', create_footer());
    $page->SetLoop('ITEM', $item);
    $page->SetParameter('ATTACHMENT_ERROR', $attachment_error);
    $page->SetParameter('AGREEMENT_ID', $agreement_id);
    $page->SetParameter('AGREEMENT_RATE_ID', $agreement_rate_id);
    $page->SetParameter('END_TIME', $end_time);
    $page->SetParameter('START_TIME', $start_time);
    $page->SetParameter('SHIFT_DETAILS', $shift_details);
    $page->SetParameter('INCIDENCE_OCCURED', $incidence_occured);
    $page->SetParameter('ATTACHMENT_FILE', $attachment_file);
    $page->SetParameter('ID', $_GET['id'] ?? '');
    $page->SetLoop('AGRRATELIST', $rate_item);
    $page->SetParameter('TITLE', $lang[$title]);
    $page->SetParameter('USER_SIDEBAR', create_user_sidebar());
    $page->SetParameter('BREADCRUMBS', create_front_breadcrumbs($title));
    $page->CreatePageEcho();
} else {
    headerRedirect($link['LOGIN']);
}
