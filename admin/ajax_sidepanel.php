<?php
/*
Copyright (c) 2020 Bylancer.com
*/
require_once('../includes/config.php');
require_once('../includes/sql_builder/idiorm.php');
require_once('../includes/db.php');
require_once('../includes/classes/class.template_engine.php');
require_once('../includes/classes/class.country.php');
require_once('../includes/functions/func.global.php');
require_once('../includes/functions/func.admin.php');
require_once('../includes/functions/func.sqlquery.php');
require_once('../includes/functions/func.users.php');
require_once('../includes/classes/GoogleTranslate.php');
require_once('../includes/lang/lang_'.$config['lang'].'.php');
require_once('../includes/seo-url.php');

admin_session_start();
checkloggedadmin();

if (!isset($_SESSION['admin']['id'])) {
    exit('Access Denied.');
}

require_once('../includes/seo-url.php');


//SidePanel Ajax Function
if(isset($_GET['action'])){
    if(!check_allow()){
        $status = "Sorry:";
        $message = "permission denied for demo.";
        echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
        die();
    }

    if ($_GET['action'] == "addAdmin") { addAdmin(); }
    if ($_GET['action'] == "editAdmin") { editAdmin(); }
    if ($_GET['action'] == "addUser") { addUser(); }
    if ($_GET['action'] == "editUser") { editUser(); }

    if ($_GET['action'] == "addCountry") { addCountry(); }
    if ($_GET['action'] == "editCountry") { editCountry(); }
    if ($_GET['action'] == "addState") { addState(); }
    if ($_GET['action'] == "editState") { editState(); }
    if ($_GET['action'] == "addDistrict") { addDistrict(); }
    if ($_GET['action'] == "editDistrict") { editDistrict(); }
    if ($_GET['action'] == "addCity") { addCity(); }
    if ($_GET['action'] == "editCity") { editCity(); }

    if ($_GET['action'] == "addCurrency") { addCurrency(); }
    if ($_GET['action'] == "editCurrency") { editCurrency(); }
    if ($_GET['action'] == "addTimezone") { addTimezone(); }
    if ($_GET['action'] == "editTimezone") { editTimezone(); }
    if ($_GET['action'] == "addLanguage") { addLanguage(); }
    if ($_GET['action'] == "editLanguage") { editLanguage(); }

    if ($_GET['action'] == "addMembershipPlan") { addMembershipPlan(); }
    if ($_GET['action'] == "editMembershipPlan") { editMembershipPlan(); }
    if ($_GET['action'] == "addMembershipPackage") { addMembershipPackage(); }
    if ($_GET['action'] == "editMembershipPackage") { editMembershipPackage(); }

    if ($_GET['action'] == "addStaticPage") { addStaticPage(); }
    if ($_GET['action'] == "editStaticPage") { editStaticPage(); }
    if ($_GET['action'] == "addFAQentry") { addFAQentry(); }
    if ($_GET['action'] == "editFAQentry") { editFAQentry(); }

    if ($_GET['action'] == "expirePostRenew") { expirePostRenew(); }
    if ($_GET['action'] == "postEdit") { postEdit(); }
    if ($_GET['action'] == "transactionEdit") { transactionEdit(); }
    if ($_GET['action'] == "editAdvertise") { editAdvertise(); }
    if ($_GET['action'] == "paymentEdit") { paymentEdit(); }

    if ($_GET['action'] == "SaveSettings") { SaveSettings(); }
    if ($_GET['action'] == "saveEmailTemplate") { saveEmailTemplate(); }
    if ($_GET['action'] == "testEmailTemplate") { testEmailTemplate(); }

    if ($_GET['action'] == "companyEdit") { companyEdit(); }

    if ($_GET['action'] == "addTestimonial") { addTestimonial(); }
    if ($_GET['action'] == "editTestimonial") { editTestimonial(); }

    if ($_GET['action'] == "addReligion") { addReligion(); }
    if ($_GET['action'] == "editReligion") { editReligion(); }

    if ($_GET['action'] == "addUserLanguage") { addUserLanguage(); }
    if ($_GET['action'] == "editUserLanguage") { editUserLanguage(); }

    if ($_GET['action'] == "addCulturalBackground") { addCulturalBackground(); }
    if ($_GET['action'] == "editCulturalBackground") { editCulturalBackground(); }

    if ($_GET['action'] == "addAboutMe") { addAboutMe(); }
    if ($_GET['action'] == "editAboutMe") { editAboutMe(); }

    if ($_GET['action'] == "addPreference") { addPreference(); }
    if ($_GET['action'] == "editPreference") { editPreference(); }

    if ($_GET['action'] == "addInterest") { addInterest(); }
    if ($_GET['action'] == "editInterest") { editInterest(); }

    if ($_GET['action'] == "addCareExperience") { addCareExperience(); }
    if ($_GET['action'] == "editCareExperience") { editCareExperience(); }

    if ($_GET['action'] == "editUserProfileRate") { editUserProfileRate(); }
    if ($_GET['action'] == "editUserReligion") { editUserReligion(); }
    if ($_GET['action'] == "editUserLanguages") { editUserLanguages(); }
    if ($_GET['action'] == "editUserCulturalBackground") { editUserCulturalBackground(); }

    if ($_GET['action'] == "editStripeSetting") { editStripeSetting(); }
}
function companyEdit(){
    global $config,$lang;
    $errors = array();
    $response = array();

    if (isset($_POST['id'])) {

        if (empty($_POST['title'])) {
            $errors[]['message'] = $lang['COMPANY_NAME_REQ'];
        }
        if (empty($_POST['content'])) {
            $errors[]['message'] = $lang['COMPANY_DESC_REQ'];
        }

        if (!count($errors) > 0) {

            if($config['post_desc_editor'] == 1)
                $description = addslashes($_POST['content']);
            else
                $description = validate_input($_POST['content']);

            $now = date("Y-m-d H:i:s");

            $item_edit = ORM::for_table($config['db']['pre'].'companies')->find_one($_POST['id']);
            $item_edit->set('name', $_POST['title']);
            $item_edit->set('city', $_POST['city']);
            $item_edit->set('state', $_POST['state']);
            $item_edit->set('country', $_POST['country']);
            $item_edit->set('description', $description);
            $item_edit->set('phone', $_POST['phone']);
            $item_edit->set('fax', $_POST['fax']);
            $item_edit->set('email', $_POST['email']);
            $item_edit->set('website', $_POST['website']);
            $item_edit->set('facebook', $_POST['facebook']);
            $item_edit->set('twitter', $_POST['twitter']);
            $item_edit->set('linkedin', $_POST['linkedin']);
            $item_edit->set('pinterest', $_POST['pinterest']);
            $item_edit->set('youtube', $_POST['youtube']);
            $item_edit->set('instagram', $_POST['instagram']);
            $item_edit->set('updated_at', $now);
            $item_edit->save();

            $status = "success";
            $message = $lang['SAVED_SUCCESS'];

            echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
            die();
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($errors, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function addTestimonial(){
    global $lang,$config;

    $title = validate_input($_POST['name']);
    $designation = validate_input($_POST['designation']);
    $image = null;
    $description = validate_input($_POST['content']);
    $error = array();

    if(empty($title)){
        $error[] = "Name is required.";
    }
    if(empty($designation)){
        $error[] = "Designation is required.";
    }
    if(empty($description)){
        $error[] = "Content is required.";
    }

    if(empty($error)){
        if(!empty($_FILES['image'])){
            $file = $_FILES['image'];
            // Valid formats
            $valid_formats = array("jpeg", "jpg", "png");
            $filename = $file['name'];
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    $main_path = "../storage/testimonials/";
                    $filename = uniqid(time()).'.'.$ext;
                    if(move_uploaded_file($file['tmp_name'], $main_path.$filename)){
                        $image = $filename;
                        resizeImage(100,$main_path.$filename,$main_path.$filename);
                    }else{
                        $error[] = 'Unexpected error, please try again.';
                    }
                } else {
                    $error[] = 'Only jpeg, jpg & png files allowed.';
                }
            }
        }
    }

    if (empty($error)) {
        $test = ORM::for_table($config['db']['pre'].'testimonials')->create();
        $test->name = $title;
        $test->designation = $designation;
        $test->image = $image;
        $test->content = $description;
        $test->save();

        $status = "success";
        $message = $lang['SAVED_SUCCESS'];

        echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
        die();
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function editTestimonial(){
    global $lang,$config;

    $title = validate_input($_POST['name']);
    $designation = validate_input($_POST['designation']);
    $image = null;
    $description = validate_input($_POST['content']);
    $error = array();

    if(empty($title)){
        $error[] = "Name is required.";
    }
    if(empty($designation)){
        $error[] = "Designation is required.";
    }
    if(empty($description)){
        $error[] = "Content is required.";
    }

    if(empty($error)){
        if(!empty($_FILES['image'])){
            $file = $_FILES['image'];
            // Valid formats
            $valid_formats = array("jpeg", "jpg", "png");
            $filename = $file['name'];
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    $main_path = "../storage/testimonials/";
                    $filename = uniqid(time()).'.'.$ext;
                    if(move_uploaded_file($file['tmp_name'], $main_path.$filename)){
                        $image = $filename;
                        resizeImage(100,$main_path.$filename,$main_path.$filename);

                        // remove old image
                        $info = ORM::for_table($config['db']['pre'].'testimonials')
                            ->select('image')
                            ->find_one($_POST['id']);

                        if($info['image'] != "default.png"){
                            if(file_exists($main_path.$info['image'])){
                                unlink($main_path.$info['image']);
                            }
                        }
                    }else{
                        $error[] = 'Unexpected error, please try again.';
                    }
                } else {
                    $error[] = 'Only jpeg, jpg & png files allowed.';
                }
            }
        }
    }

    if (empty($error)) {
        $test = ORM::for_table($config['db']['pre'].'testimonials')->find_one($_POST['id']);
        $test->name = $title;
        $test->designation = $designation;
        if($image){
            $test->image = $image;
        }
        $test->content = $description;
        $test->save();

        $status = "success";
        $message = $lang['SAVED_SUCCESS'];

        echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
        die();
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function change_config_file_settings($filePath, $newSettings,$lang)
{
    // Update $fileSettings with any new values
    $fileSettings = array_merge($lang, $newSettings);
    // Build the new file as a string
    $newFileStr = "<?php\n";
    foreach ($fileSettings as $name => $val) {
        // Using var_export() allows you to set complex values such as arrays and also
        // ensures types will be correct
        $newFileStr .= "\$lang['$name'] = " . var_export($val, true) . ";\n";
    }
    // Closing tag intentionally omitted, you can add one if you want

    // Write it back to the file
    file_put_contents($filePath, $newFileStr);

}

function addAdmin(){
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $valid_formats = array("jpg","jpeg","png"); // Valid image formats

        if ($_FILES['file']['name'] != "") {

            $filename = stripslashes($_FILES['file']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = '../storage/profile/';
                $original_filename = $_FILES['file']['name'];
                $random1 = rand(9999, 100000);
                $random2 = rand(9999, 200000);
                $random3 = $random1 . $random2;
                $extensions = explode(".", $original_filename);
                $extension = $extensions[count($extensions) - 1];
                $uniqueName = $random3 . "." . $extension;
                $uploadfile = $uploaddir . $uniqueName;

                $file_type = "file";

                if ($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png") {
                    $file_type = "image";

                    $size = filesize($_FILES['file']['tmp_name']);

                    $image = $_FILES["file"]["name"];
                    $uploadedfile = $_FILES['file']['tmp_name'];

                    if ($image) {
                        if ($extension == "jpg" || $extension == "jpeg") {
                            $uploadedfile = $_FILES['file']['tmp_name'];
                            $src = imagecreatefromjpeg($uploadedfile);
                        } else if ($extension == "png") {
                            $uploadedfile = $_FILES['file']['tmp_name'];
                            $src = imagecreatefrompng($uploadedfile);
                        } else {
                            $src = imagecreatefromgif($uploadedfile);
                        }

                        list($width, $height) = getimagesize($uploadedfile);

                        $newwidth = 225;
                        $newheight = 225;
                        //$newheight = ($height / $width) * $newwidth;
                        $tmp = imagecreatetruecolor($newwidth, $newheight);

                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                        $filename = $uploaddir . "small" . $uniqueName;

                        imagejpeg($tmp, $filename, 100);

                        imagedestroy($src);
                        imagedestroy($tmp);
                    }


                }
                //else if it's not bigger then 0, then it's available '
                //and we send 1 to the ajax request
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                    //$time = date('Y-m-d H:i:s', time());
                    $password = $_POST["password"];
                    $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);

                    $admins = ORM::for_table($config['db']['pre'].'admins')->create();
                    $admins->username = $_POST['username'];
                    $admins->password_hash = $pass_hash;
                    $admins->name = $_POST['name'];
                    $admins->email = $_POST['email'];
                    $admins->image = $uniqueName;
                    $admins->save();

                    if ($admins->id()) {
                        $status = "success";
                        $message = $lang['SAVED_SUCCESS'];
                    } else{
                        $status = "error";
                        $message = $lang['ERROR_TRY_AGAIN'];
                    }
                }
            }
            else {
                $error = "Only allowed jpg, jpeg png";
                $status = "error";
                $message = $error;
            }

        } else {
            $error = "Profile Picture Required";
            $status = "error";
            $message = $error;
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}
function editAdmin(){
    global $config,$lang;

    if (isset($_POST['id'])) {
        $password = $_POST["newPassword"];

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {
            $valid_formats = array("jpg","jpeg","png"); // Valid image formats
            $filename = stripslashes($_FILES['file']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = '../storage/profile/';
                $original_filename = $_FILES['file']['name'];
                $random1 = rand(9999,100000);
                $random2 = rand(9999,200000);
                $random3 = $random1.$random2;
                $extensions = explode(".", $original_filename);
                $extension = $extensions[count($extensions) - 1];
                $uniqueName =  $random3 . "." . $extension;
                $uploadfile = $uploaddir . $uniqueName;

                $file_type = "file";

                if ($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png") {
                    $file_type = "image";

                    $size = filesize($_FILES['file']['tmp_name']);

                    $image = $_FILES["file"]["name"];
                    $uploadedfile = $_FILES['file']['tmp_name'];

                    if ($image) {
                        if ($extension == "jpg" || $extension == "jpeg") {
                            $uploadedfile = $_FILES['file']['tmp_name'];
                            $src = imagecreatefromjpeg($uploadedfile);
                        } else if ($extension == "png") {
                            $uploadedfile = $_FILES['file']['tmp_name'];
                            $src = imagecreatefrompng($uploadedfile);
                        } else {
                            $src = imagecreatefromgif($uploadedfile);
                        }

                        list($width, $height) = getimagesize($uploadedfile);

                        $newwidth = 225;
                        $newheight = 225;
                        //$newheight = ($height / $width) * $newwidth;
                        $tmp = imagecreatetruecolor($newwidth, $newheight);

                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                        $filename = $uploaddir . "small" . $uniqueName;

                        imagejpeg($tmp, $filename, 100);

                        imagedestroy($src);
                        imagedestroy($tmp);
                    }


                }
                //else if it's not bigger then 0, then it's available '
                //and we send 1 to the ajax request
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

                    $info = ORM::for_table($config['db']['pre'].'admins')
                        ->select('image')
                        ->find_one($_POST['id']);

                    if($info['image'] != "default_user.png"){
                        if(file_exists($uploaddir.$info['image'])){
                            unlink($uploaddir.$info['image']);
                            unlink($uploaddir."small".$info['image']);
                        }
                    }
                    if(!empty($password)){
                        $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);

                        $admins = ORM::for_table($config['db']['pre'].'admins')->find_one($_POST['id']);
                        $admins->name = $_POST['name'];
                        $admins->password_hash = $pass_hash;
                        $admins->image = $uniqueName;
                        $admins->save();
                    }else{
                        $admins = ORM::for_table($config['db']['pre'].'admins')->find_one($_POST['id']);
                        $admins->name = $_POST['name'];
                        $admins->image = $uniqueName;
                        $admins->save();
                    }

                    if (!$admins) {
                        $status = "error";
                        $message = $lang['ERROR_TRY_AGAIN'];
                    } else{
                        $status = "success";
                        $message = $lang['SAVED_SUCCESS'];
                    }
                }
            }
            else {
                $error = "Only allowed jpg, jpeg png";
                $status = "error";
                $message = $error;
            }

        }
        else{
            if(!empty($password)){
                $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);

                $admins = ORM::for_table($config['db']['pre'].'admins')->find_one($_POST['id']);
                $admins->name = $_POST['name'];
                $admins->password_hash = $pass_hash;
                $admins->username = $_POST["username"];
                $admins->save();

            }else{

                $admins = ORM::for_table($config['db']['pre'].'admins')->find_one($_POST['id']);
                $admins->name = $_POST['name'];
                $admins->username = $_POST["username"];
                $admins->save();
            }


            if (!$admins) {
                $status = "error";
                $message = $lang['ERROR_TRY_AGAIN'];
            } else{
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            }
        }


    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addUser(){
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $valid_formats = array("jpg","jpeg","png"); // Valid image formats

        if(isset($_FILES['file']['name']))
        {
            $valid_formats = array("jpg","jpeg","png"); // Valid image formats
            $filename = stripslashes($_FILES['file']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = '../storage/profile/';
                $original_filename = $_FILES['file']['name'];
                $random1 = rand(9999,100000);
                $random2 = rand(9999,200000);
                $random3 = $random1.$random2;
                $username = $_POST['username'];
                $image_name = $username.'_'.$random1.$random2.'.'.$ext;
                $image_name1 = 'small_'.$username.'_'.$random1.$random2.'.'.$ext;

                $filename = $uploaddir . $image_name;
                $filename1 = $uploaddir . $image_name1;

                $uploadedfile = $_FILES['file']['tmp_name'];

                //else if it's not bigger then 0, then it's available '
                //and we send 1 to the ajax request
                if (resizeImage(500, $filename, $uploadedfile)) {
                    resize_crop_image(200, 200, $filename1, $uploadedfile);
                    //$time = date('Y-m-d H:i:s', time());
                    $password = $_POST["password"];
                    $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
                    $now = date("Y-m-d H:i:s");

                    $insert_user = ORM::for_table($config['db']['pre'].'user')->create();
                    $insert_user->status = '0';
                    $insert_user->name = $_POST['name'];
                    $insert_user->username = $_POST['username'];
                    $insert_user->user_type = $_POST['user_type'];
                    $insert_user->password_hash = $pass_hash;
                    $insert_user->email = $_POST['email'];
                    $insert_user->sex = $_POST['sex'];
                    $insert_user->description = $_POST['sex'];
                    $insert_user->country = $_POST['country'];
                    $insert_user->image = $image_name;
                    $insert_user->created_at = $now;
                    $insert_user->updated_at = $now;
                    $insert_user->save();

                    if ($insert_user->id()) {
                        $status = "success";
                        $message = $lang['SAVED_SUCCESS'];
                    } else{
                        $status = "error";
                        $message = $lang['ERROR_TRY_AGAIN'];
                    }
                }
            }
            else {
                $error = "Only allowed jpg, jpeg png";
                $status = "error";
                $message = $error;
            }

        } else {
            $error = "Profile Picture Required";
            $status = "error";
            $message = $error;
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}
function editUser(){
    global $config,$lang;

    if (isset($_POST['id'])) {
        $password = $_POST["password"];

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {
            $valid_formats = array("jpg","jpeg","png"); // Valid image formats
            $filename = stripslashes($_FILES['file']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = '../storage/profile/';
                $original_filename = $_FILES['file']['name'];
                $random1 = rand(9999,100000);
                $random2 = rand(9999,200000);

                $image_name = $random1.$random2.'.'.$ext;
                $image_name1 = 'small_'.$random1.$random2.'.'.$ext;

                $filename = $uploaddir . $image_name;
                $filename1 = $uploaddir . $image_name1;

                $uploadedfile = $_FILES['file']['tmp_name'];

                //else if it's not bigger then 0, then it's available '
                //and we send 1 to the ajax request
                if (resizeImage(500, $filename, $uploadedfile)) {
                    resize_crop_image(200, 200, $filename1, $uploadedfile);

                    $info = ORM::for_table($config['db']['pre'].'user')
                        ->select('image')
                        ->find_one($_POST['id']);

                    if($info['image'] != "default_user.png"){
                        if(file_exists($uploaddir.$info['image'])){
                            unlink($uploaddir.$info['image']);
                            unlink($uploaddir."small_".$info['image']);
                        }
                    }

                    if(!empty($password)){
                        $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);

                        $now = date("Y-m-d H:i:s");
                        $user_update = ORM::for_table($config['db']['pre'].'user')->find_one($_POST['id']);
                        $user_update->set('name', $_POST['name']);
                        $user_update->set('username', $_POST['username']);
                        $user_update->set('email', $_POST['email']);
                        $user_update->set('status', $_POST['status']);
                        $user_update->set('description', $_POST['about']);
                        $user_update->set('sex', $_POST['sex']);
                        $user_update->set('country', $_POST['country']);
                        $user_update->set('password_hash', $pass_hash);
                        $user_update->set('image', $image_name);
                        $user_update->set('updated_at', $now);
                        $user_update->save();

                    }else{
                        $now = date("Y-m-d H:i:s");
                        $user_update = ORM::for_table($config['db']['pre'].'user')->find_one($_POST['id']);
                        $user_update->set('name', $_POST['name']);
                        $user_update->set('username', $_POST['username']);
                        $user_update->set('email', $_POST['email']);
                        $user_update->set('status', $_POST['status']);
                        $user_update->set('description', $_POST['about']);
                        $user_update->set('sex', $_POST['sex']);
                        $user_update->set('country', $_POST['country']);
                        $user_update->set('image', $image_name);
                        $user_update->set('updated_at', $now);
                        $user_update->save();
                    }

                    if ($user_update) {
                        $status = "success";
                        $message = $lang['SAVED_SUCCESS'];
                    } else{
                        $status = "error";
                        $message = $lang['ERROR_TRY_AGAIN'];
                    }
                }
            }
            else {
                $error = "Only allowed jpg, jpeg png";
                $status = "error";
                $message = $error;
            }

        }
        else{
            if(!empty($password)){
                $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
                $now = date("Y-m-d H:i:s");

                $user_update = ORM::for_table($config['db']['pre'].'user')->find_one($_POST['id']);
                $user_update->set('name', $_POST['name']);
                $user_update->set('username', $_POST['username']);
                $user_update->set('email', $_POST['email']);
                $user_update->set('status', $_POST['status']);
                $user_update->set('description', $_POST['about']);
                $user_update->set('sex', $_POST['sex']);
                $user_update->set('country', $_POST['country']);
                $user_update->set('password_hash', $pass_hash);
                $user_update->set('updated_at', $now);
                $user_update->save();

            }else{
                $now = date("Y-m-d H:i:s");

                $user_update = ORM::for_table($config['db']['pre'].'user')->find_one($_POST['id']);
                $user_update->set('name', $_POST['name']);
                $user_update->set('username', $_POST['username']);
                $user_update->set('email', $_POST['email']);
                $user_update->set('status', $_POST['status']);
                $user_update->set('description', $_POST['about']);
                $user_update->set('sex', $_POST['sex']);
                $user_update->set('country', $_POST['country']);
                $user_update->set('updated_at', $now);
                $user_update->save();
            }


            if ($user_update) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } else{
                $status = "error";
                $message = $lang['ERROR_TRY_AGAIN'];
            }
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addCountry(){
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $insert_country = ORM::for_table($config['db']['pre'].'countries')->create();
        $insert_country->code = $_POST['code'];
        $insert_country->name = $_POST['name'];
        $insert_country->asciiname = $_POST['asciiname'];
        $insert_country->currency_code = $_POST['currency_code'];
        $insert_country->phone = $_POST['phone'];
        $insert_country->languages = $_POST['languages'];
        $insert_country->save();

        if ($insert_country->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}
function editCountry(){
    global $config,$lang;

    if (isset($_POST['code'])) {

        $info = ORM::for_table($config['db']['pre'].'countries')
            ->select('id')
            ->where('code', $_POST['code'])
            ->find_one();

        $update_country = ORM::for_table($config['db']['pre'].'countries')->find_one($info['id']);
        $update_country->set('name', $_POST['name']);
        $update_country->set('code', $_POST['code']);
        $update_country->set('asciiname', $_POST['asciiname']);
        $update_country->set('currency_code', $_POST['currency_code']);
        $update_country->set('phone', $_POST['phone']);
        $update_country->set('languages', $_POST['languages']);
        $update_country->save();

        if ($update_country) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addState(){
    global $config,$lang;

    if (isset($_POST['code'])) {
        $info = ORM::for_table($config['db']['pre'].'subadmin1')
            ->select('code')
            ->where('country_code', $_POST['code'])
            ->order_by_desc('code')
            ->find_one();

        $count = count($info);
        if($count > 0 && $info){
            $check = substr($info['code'],3);
            $code = $_POST['code'].".".((int)$check+1);
        }else{
            $code = $_POST['code'].".1";
        }

        $active = isset($_POST['active']) ? '1' : '0';

        $insert_subadmin1 = ORM::for_table($config['db']['pre'].'subadmin1')->create();
        $insert_subadmin1->code = $code;
        $insert_subadmin1->country_code = $_POST['code'];
        $insert_subadmin1->name = $_POST['name'];
        $insert_subadmin1->asciiname = $_POST['asciiname'];
        $insert_subadmin1->active = $active;
        $insert_subadmin1->save();

        if ($insert_subadmin1->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}
function editState(){
    global $config,$lang;

    if (isset($_POST['code'])) {
        $active = isset($_POST['active']) ? '1' : '0';

        $info = ORM::for_table($config['db']['pre'].'subadmin1')
            ->select('id')
            ->where('code', $_POST['code'])
            ->find_one();

        $update_subadmin1 = ORM::for_table($config['db']['pre'].'subadmin1')->find_one($info['id']);
        $update_subadmin1->set('name', $_POST['name']);
        $update_subadmin1->set('asciiname', $_POST['asciiname']);
        $update_subadmin1->set('active', $active);
        $update_subadmin1->save();

        if ($update_subadmin1) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addDistrict(){
    global $config,$lang;

    if (isset($_POST['code'])) {
        $info = ORM::for_table($config['db']['pre'].'subadmin2')
            ->select_many('code','country_code','subadmin1_code')
            ->where('subadmin1_code', $_POST['code'])
            ->order_by_desc('code')
            ->find_one();

        $count = count($info);
        if($count > 0 && $info){
            $country = $info['country_code'];
            $subadmin1 = $info['subadmin1_code'];

            $code = $info['code'];
            $pieces = explode(".", $code);
            $code_count = count($pieces);
            if($code_count == 3){
                $subadmin2 = $pieces[2]+1;
            }
            $code = $_POST['code'].".".$subadmin2;


        }else{
            $code = $_POST['code'].".1";

            $subadmin1 = $_POST['code'];
            $pieces = explode(".", $subadmin1);
            $country = $pieces[0];
        }

        $active = isset($_POST['active']) ? '1' : '0';

        $insert_subadmin2 = ORM::for_table($config['db']['pre'].'subadmin2')->create();
        $insert_subadmin2->name = $_POST['name'];
        $insert_subadmin2->asciiname = $_POST['asciiname'];
        $insert_subadmin2->code = $code;
        $insert_subadmin2->country_code = $country;
        $insert_subadmin2->subadmin1_code = $subadmin1;
        $insert_subadmin2->active = $active;
        $insert_subadmin2->save();

        if ($insert_subadmin2->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}
function editDistrict(){
    global $config,$lang;

    if (isset($_POST['code'])) {
        $active = isset($_POST['active']) ? '1' : '0';

        $info = ORM::for_table($config['db']['pre'].'subadmin2')
            ->select('id')
            ->where('code', $_POST['code'])
            ->find_one();

        $update_subadmin2 = ORM::for_table($config['db']['pre'].'subadmin2')->find_one($info['id']);
        $update_subadmin2->set('name', $_POST['name']);
        $update_subadmin2->set('asciiname', $_POST['asciiname']);
        $update_subadmin2->set('active', $active);
        $update_subadmin2->save();

        if ($update_subadmin2) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addCity(){
    global $config,$lang;

    if (isset($_POST['submit'])) {
        $active = isset($_POST['active']) ? '1' : '0';

        $insert_city = ORM::for_table($config['db']['pre'].'cities')->create();
        $insert_city->name = $_POST['name'];
        $insert_city->asciiname = $_POST['asciiname'];
        $insert_city->country_code = $_POST['country_code'];
        $insert_city->subadmin1_code = $_POST['subadmin1_code'];
        $insert_city->subadmin2_code = $_POST['subadmin2_code'];
        $insert_city->longitude = $_POST['longitude'];
        $insert_city->latitude = $_POST['latitude'];
        $insert_city->population = $_POST['population'];
        $insert_city->time_zone = $_POST['time_zone'];
        $insert_city->active = $active;
        $insert_city->save();

        if ($insert_city->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}
function editCity(){
    global $config,$lang;

    if (isset($_POST['id'])) {
        $active = isset($_POST['active']) ? '1' : '0';

        $update_city = ORM::for_table($config['db']['pre'].'cities')->find_one($_POST['id']);
        $update_city->set('name', $_POST['name']);
        $update_city->set('asciiname', $_POST['asciiname']);
        $update_city->set('country_code', $_POST['country_code']);
        $update_city->set('subadmin1_code', $_POST['subadmin1_code']);
        $update_city->set('subadmin2_code', $_POST['subadmin2_code']);
        $update_city->set('longitude', $_POST['longitude']);
        $update_city->set('latitude', $_POST['latitude']);
        $update_city->set('population', $_POST['population']);
        $update_city->set('time_zone', $_POST['time_zone']);
        $update_city->set('active', $active);
        $update_city->save();

        if ($update_city) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addCurrency()
{
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $in_left = isset($_POST['in_left']) ? '1' : '0';

        $insert_currency = ORM::for_table($config['db']['pre'].'currencies')->create();
        $insert_currency->name = $_POST['name'];
        $insert_currency->code = $_POST['code'];
        $insert_currency->html_entity = $_POST['html_entity'];
        $insert_currency->font_arial = $_POST['font_arial'];
        $insert_currency->font_code2000 = $_POST['font_code2000'];
        $insert_currency->unicode_decimal = $_POST['unicode_decimal'];
        $insert_currency->unicode_hex = $_POST['unicode_hex'];
        $insert_currency->decimal_places = $_POST['decimal_places'];
        $insert_currency->decimal_separator = $_POST['decimal_separator'];
        $insert_currency->thousand_separator = $_POST['thousand_separator'];
        $insert_currency->in_left = $in_left;
        $insert_currency->save();

        if ($insert_currency->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function editCurrency()
{
    global $config,$lang;

    if (isset($_POST['id'])) {
        $in_left = isset($_POST['in_left']) ? '1' : '0';

        $update_currency = ORM::for_table($config['db']['pre'].'currencies')->find_one($_POST['id']);
        $update_currency->set('name', $_POST['name']);
        $update_currency->set('code', $_POST['code']);
        $update_currency->set('html_entity', $_POST['html_entity']);
        $update_currency->set('font_arial', $_POST['font_arial']);
        $update_currency->set('font_code2000', $_POST['font_code2000']);
        $update_currency->set('unicode_decimal', $_POST['unicode_decimal']);
        $update_currency->set('unicode_hex', $_POST['unicode_hex']);
        $update_currency->set('decimal_places', $_POST['decimal_places']);
        $update_currency->set('decimal_separator', $_POST['decimal_separator']);
        $update_currency->set('thousand_separator', $_POST['thousand_separator']);
        $update_currency->set('in_left', $in_left);
        $update_currency->save();

        if ($update_currency) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addTimezone()
{
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $insert_timezone = ORM::for_table($config['db']['pre'].'time_zones')->create();
        $insert_timezone->country_code = $_POST['country_code'];
        $insert_timezone->time_zone_id = $_POST['time_zone_id'];
        $insert_timezone->gmt = $_POST['gmt'];
        $insert_timezone->dst = $_POST['dst'];
        $insert_timezone->raw = $_POST['raw'];
        $insert_timezone->save();

        if ($insert_timezone->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function editTimezone()
{
    global $config,$lang;

    if (isset($_POST['id'])) {

        $update_timezone = ORM::for_table($config['db']['pre'].'time_zones')->find_one($_POST['id']);
        $update_timezone->set('country_code', $_POST['country_code']);
        $update_timezone->set('time_zone_id', $_POST['time_zone_id']);
        $update_timezone->set('gmt', $_POST['gmt']);
        $update_timezone->set('dst', $_POST['dst']);
        $update_timezone->set('raw', $_POST['raw']);
        $update_timezone->save();

        if ($update_timezone) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addMembershipPlan()
{
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $recommended = isset($_POST['recommended']) ? "yes" : "no";
        $pay_mode = isset($_POST['pay_mode']) ? $_POST['pay_mode'] : "one_time";
        $active = isset($_POST['active']) ? "1" : "0";

        $insert_subscription = ORM::for_table($config['db']['pre'].'subscriptions')->create();
        $insert_subscription->sub_title = $_POST['sub_title'];
        $insert_subscription->sub_term = $_POST['sub_term'];
        $insert_subscription->sub_amount = $_POST['sub_amount'];
        $insert_subscription->sub_image = $_POST['sub_image'];
        $insert_subscription->group_id = $_POST['group_id'];
        $insert_subscription->pay_mode = $pay_mode;
        $insert_subscription->active = $active;
        $insert_subscription->discount_badge = $_POST['discount_badge'];
        $insert_subscription->recommended = $recommended;
        $insert_subscription->save();

        if ($insert_subscription->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function editMembershipPlan()
{
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $recommended = isset($_POST['recommended']) ? "yes" : "no";
        $pay_mode = isset($_POST['pay_mode']) ? $_POST['pay_mode'] : "one_time";
        $active = isset($_POST['active']) ? "1" : "0";

        $pdo = ORM::get_db();
        $query = "UPDATE `".$config['db']['pre']."subscriptions` SET
        `sub_title` = '" . validate_input($_POST['sub_title']) . "',
        `sub_term` = '" . validate_input($_POST['sub_term']) . "',
		`sub_amount` = '" . validate_input($_POST['sub_amount']) . "',
        `sub_image` = '" . validate_input($_POST['sub_image']) . "',
        `pay_mode` = '" . validate_input($pay_mode) . "',
        `active` = '" . $active . "',
        `group_id` = '" . validate_input($_POST['group_id']) . "',
        `recommended` = '" . validate_input($recommended) . "',
        `discount_badge` = '" . validate_input($_POST['discount_badge']) . "'
        WHERE `sub_id` = '".$_POST['id']."' LIMIT 1 ";
        $query_result = $pdo->query($query);

        if ($query_result) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addMembershipPackage()
{
    global $config,$lang;

    if (isset($_POST['submit'])) {

        $removable = isset($_POST['group_removable']) ? $_POST['group_removable'] : 0;

        $featured = isset($_POST['featured_project_fee']) ? $_POST['featured_project_fee'] : 0;
        $urgent = isset($_POST['urgent_project_fee']) ? $_POST['urgent_project_fee'] : 0;
        $highlight = isset($_POST['highlight_project_fee']) ? $_POST['highlight_project_fee'] : 0;

        $featured_duration = isset($_POST['featured_duration']) ? $_POST['featured_duration'] : 0;
        $urgent_duration = isset($_POST['urgent_duration']) ? $_POST['urgent_duration'] : 0;
        $highlight_duration = isset($_POST['highlight_duration']) ? $_POST['highlight_duration'] : 0;

        $top_search_result = isset($_POST['top_search_result']) ? "yes" : "no";
        $show_on_home = isset($_POST['show_on_home']) ? "yes" : "no";
        $show_in_home_search = isset($_POST['show_in_home_search']) ? "yes" : "no";

        $insert_usergroup = ORM::for_table($config['db']['pre'].'usergroups')->create();
        $insert_usergroup->group_name = $_POST['group_name'];
        $insert_usergroup->group_removable = $removable;
        $insert_usergroup->ad_limit = $_POST['ad_limit'];
        $insert_usergroup->ad_duration = $_POST['ad_duration'];
        $insert_usergroup->featured_project_fee = $featured;
        $insert_usergroup->urgent_project_fee = $urgent;
        $insert_usergroup->highlight_project_fee = $highlight;
        $insert_usergroup->featured_duration = $featured_duration;
        $insert_usergroup->urgent_duration = $urgent_duration;
        $insert_usergroup->highlight_duration = $highlight_duration;
        $insert_usergroup->top_search_result = $top_search_result;
        $insert_usergroup->show_on_home = $show_on_home;
        $insert_usergroup->show_in_home_search = $show_in_home_search;
        $insert_usergroup->save();

        if ($insert_usergroup->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function editMembershipPackage()
{
    global $config,$lang;

    if (isset($_POST['id'])) {
        $removable = isset($_POST['group_removable']) ? $_POST['group_removable'] : 0;
        $featured = isset($_POST['featured_project_fee']) ? $_POST['featured_project_fee'] : 0;
        $urgent = isset($_POST['urgent_project_fee']) ? $_POST['urgent_project_fee'] : 0;
        $highlight = isset($_POST['highlight_project_fee']) ? $_POST['highlight_project_fee'] : 0;

        $featured_duration = isset($_POST['featured_duration']) ? $_POST['featured_duration'] : 0;
        $urgent_duration = isset($_POST['urgent_duration']) ? $_POST['urgent_duration'] : 0;
        $highlight_duration = isset($_POST['highlight_duration']) ? $_POST['highlight_duration'] : 0;

        $top_search_result = isset($_POST['top_search_result']) ? "yes" : "no";
        $show_on_home = isset($_POST['show_on_home']) ? "yes" : "no";
        $show_in_home_search = isset($_POST['show_in_home_search']) ? "yes" : "no";

        $pdo = ORM::get_db();
        $query = "UPDATE `".$config['db']['pre']."usergroups` SET
        `group_name` = '" . validate_input($_POST['group_name']) . "',
        `group_removable` = '" . validate_input($removable) . "',
        `ad_limit` = '" . validate_input($_POST['ad_limit']) . "',
        `ad_duration` = '" . validate_input($_POST['ad_duration']) . "',
        `featured_project_fee` = '" . validate_input($featured) . "',
        `urgent_project_fee` = '" . validate_input($urgent) . "',
        `highlight_project_fee` = '" . validate_input($highlight) . "',
        `featured_duration` = '" . validate_input($featured_duration) . "',
        `urgent_duration` = '" . validate_input($urgent_duration) . "',
        `highlight_duration` = '" . validate_input($highlight_duration) . "',
        `top_search_result` = '" . validate_input($top_search_result) . "',
        `show_on_home` = '" . validate_input($show_on_home) . "',
        `show_in_home_search` = '" . validate_input($show_in_home_search) . "'
        WHERE `group_id` = '".$_POST['id']."' LIMIT 1 ";

        $query_result = $pdo->query($query);

        if ($query_result) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addLanguage()
{
    global $config,$lang;
    if (isset($_POST['submit'])) {
        if(isset($_POST['name']) && $_POST['name'] != ""){

            $post_langname = str_replace(' ', '', strtolower($_POST['name']));

            $filePath = '../includes/lang/lang_'.$post_langname.'.php';
            if (!file_exists($filePath)) {
                $source = 'en';
                $target = $_POST['code'];
                $auto_translate = isset($_POST['auto_tran']) ? '1' : '0';
                $active = isset($_POST['active']) ? '1' : '0';

                $trans = new GoogleTranslate();
                $newLangArray = array();
                foreach ($lang as $key => $value)
                {
                    if($auto_translate == 1){
                        $result = $trans->translate($source, $target, $value);
                    }else{
                        $result = $value;
                    }

                    $newLangArray[$key] = $result;
                }
                fopen($filePath, "w");
                change_config_file_settings($filePath, $newLangArray,$lang);

                $lang_filename = $post_langname;

                $insert_language = ORM::for_table($config['db']['pre'].'languages')->create();
                $insert_language->code = $_POST['code'];
                $insert_language->name = $post_langname;
                $insert_language->direction = $_POST['direction'];
                $insert_language->file_name = $lang_filename;
                $insert_language->active = $active;
                $insert_language->save();

                if ($insert_language->id()) {
                    $status = "success";
                    $message = $lang['SAVED_SUCCESS'];
                } else{
                    $status = "error";
                    $message = $lang['ERROR_TRY_AGAIN'];
                }


            } else {
                $message = "Same language file is exist. Change language name.";
                echo $json = '{"status" : "error","message" : "' . $message . '"}';
                die();
            }
        }else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function editLanguage()
{
    global $config,$lang;

    if (isset($_POST['id'])) {

        $active = isset($_POST['active']) ? '1' : '0';
        $lang_filename = strtolower($_POST['name']);

        $update_language = ORM::for_table($config['db']['pre'].'languages')->find_one($_POST['id']);
        $update_language->set('code', $_POST['code']);
        $update_language->set('name', $_POST['name']);
        $update_language->set('direction', $_POST['direction']);
        $update_language->set('file_name', $lang_filename);
        $update_language->set('active', $active);
        $update_language->save();

        if ($update_language) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }


    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addStaticPage()
{
    global $config,$lang;
    $errors = array();
    $response = array();

    if (isset($_POST['submit'])) {

        if (empty($_POST['name'])) {
            $errors[]['message'] = $lang['PAGENAME_REQ'];
        }
        if (empty($_POST['title'])) {
            $errors[]['message'] = $lang['PAGETITLE_REQ'];
        }
        if (empty($_POST['content'])) {
            $errors[]['message'] = $lang['PAGECONTENT_REQ'];
        }
        if (!count($errors) > 0) {
            if (empty($_POST['slug']))
                $slug = create_slug($_POST['name']);
            else
                $slug = create_slug($_POST['slug']);
                $active = isset($_POST['active']) ? '1' : '0';

            $insert_page = ORM::for_table($config['db']['pre'].'pages')->create();
            $insert_page->translation_lang = 'en';
            $insert_page->name = $_POST['name'];
            $insert_page->title = $_POST['title'];
            $insert_page->content = $_POST['content'];
            $insert_page->slug = $slug;
            $insert_page->type = $_POST['type'];
            $insert_page->active = $active;
            $insert_page->save();

            $id = $insert_page->id();

            $update_page = ORM::for_table($config['db']['pre'].'pages')->find_one($id);
            $update_page->set('translation_of', $id);
            $update_page->set('parent_id', $id);
            $update_page->save();

            $rows = ORM::for_table($config['db']['pre'].'languages')
                ->select_many('code','name')
                ->where('active', '1')
                ->where_not_equal('code', 'en')
                ->find_many();

            foreach ($rows as $fetch){
                $insert_page = ORM::for_table($config['db']['pre'].'pages')->create();
                $insert_page->translation_lang = $fetch['code'];
                $insert_page->translation_of = $id;
                $insert_page->parent_id = $id;
                $insert_page->name = $_POST['name'];
                $insert_page->title = $_POST['title'];
                $insert_page->content = $_POST['content'];
                $insert_page->slug = $slug;
                $insert_page->type = $_POST['type'];
                $insert_page->active = $active;
                $insert_page->save();

            }

            $status = "success";
            $message = 'Page added successfully.';

            echo $json = '{"id" : "' . $id . '","status" : "' . $status . '","message" : "' . $message . '"}';
            die();
        }else {
            $status = "error";
            $message = $lang['ERROR'];
        }
    } else {
        $status = "error";
        $message = $lang['UNKNOWN_ERROR'];
    }

    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($errors, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function editStaticPage()
{
    global $config,$lang;
    $errors = array();
    $response = array();

    if (isset($_POST['id'])) {

        if (empty($_POST['name'])) {
            $errors[]['message'] = $lang['PAGENAME_REQ'];
        }
        if (empty($_POST['title'])) {
            $errors[]['message'] = $lang['PAGETITLE_REQ'];
        }
        if (empty($_POST['content'])) {
            $errors[]['message'] = $lang['PAGECONTENT_REQ'];
        }
        if (!count($errors) > 0) {
            if (empty($_POST['slug']))
                $slug = create_slug($_POST['name']);
            else
                $slug = create_slug($_POST['slug']);
            $active = isset($_POST['active']) ? '1' : '0';

            $update_page = ORM::for_table($config['db']['pre'].'pages')->find_one($_POST['id']);
            $update_page->set('name', $_POST['name']);
            $update_page->set('title', $_POST['title']);
            $update_page->set('content', $_POST['content']);
            $update_page->set('slug', $slug);
            $update_page->set('type', $_POST['type']);
            $update_page->set('active', $active);
            $update_page->save();

            $status = "success";
            $message = 'Page edited successfully.';

            echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
            die();
        }else {
            $status = "error";
            $message = $lang['ERROR'];
        }
    } else {
        $status = "error";
        $message = $lang['UNKNOWN_ERROR'];
    }

    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($errors, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function addFAQentry()
{
    global $config,$lang;
    $errors = array();

    if (isset($_POST['submit'])) {

        if (empty($_POST['title'])) {
            $errors[]['message'] = $lang['FAQTITLE_REQ'];
        }
        if (empty($_POST['content'])) {
            $errors[]['message'] = $lang['FAQCONTENT_REQ'];
        }
        if (!count($errors) > 0) {
            $active = isset($_POST['active']) ? '1' : '0';

            $insert_faq = ORM::for_table($config['db']['pre'].'faq_entries')->create();
            $insert_faq->translation_lang = 'en';
            $insert_faq->faq_title = $_POST['title'];
            $insert_faq->faq_content = $_POST['content'];
            $insert_faq->active = $active;
            $insert_faq->save();

            $id = $insert_faq->id();

            $pdo = ORM::get_db();
            $query = "UPDATE `".$config['db']['pre']."faq_entries` SET
                `translation_of` = '".validate_input($id)."',
                `parent_id` = '".validate_input($id)."'
                 WHERE `faq_id` = '".validate_input($id)."' LIMIT 1 ";
            $query_result = $pdo->query($query);

            $rows = ORM::for_table($config['db']['pre'].'languages')
                ->select_many('code','name')
                ->where('active', '1')
                ->where_not_equal('code', 'en')
                ->find_many();

            foreach ($rows as $fetch){
                $insert_faq = ORM::for_table($config['db']['pre'].'faq_entries')->create();
                $insert_faq->translation_lang = $fetch['code'];
                $insert_faq->translation_of = $id;
                $insert_faq->parent_id = $id;
                $insert_faq->faq_title = $_POST['title'];
                $insert_faq->faq_content = $_POST['content'];
                $insert_faq->active = $active;
                $insert_faq->save();
            }

            $status = "success";
            $message = $lang['SAVED_SUCCESS'];

            echo $json = '{"id" : "' . $id . '","status" : "' . $status . '","message" : "' . $message . '"}';
            die();
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($errors, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function editFAQentry()
{
    global $config,$lang;
    $errors = array();
    $response = array();

    if (isset($_POST['id'])) {

        if (empty($_POST['title'])) {
            $errors[]['message'] = $lang['FAQTITLE_REQ'];
        }
        if (empty($_POST['content'])) {
            $errors[]['message'] = $lang['FAQCONTENT_REQ'];
        }
        if (!count($errors) > 0) {
            $active = isset($_POST['active']) ? '1' : '0';

            $pdo = ORM::get_db();
            $query = "UPDATE `".$config['db']['pre']."faq_entries` SET
                `faq_title` = '" . validate_input($_POST['title']) . "',
                `faq_content` = '" . addslashes($_POST['content']) . "',
                 `active` = '" . validate_input($active) . "'
                 WHERE `faq_id` = '".$_POST['id']."' LIMIT 1 ";
            $query_result = $pdo->query($query);

            $status = "success";
            $message = $lang['SP_PAGE_EDITED'];

            echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
            die();
        }else {
            $status = "error";
            $message = $lang['ERROR'];
        }
    } else {
        $status = "error";
        $message = $lang['UNKNOWN_ERROR'];
    }

    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($errors, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function expirePostRenew(){
    global $config,$lang;
    $pdo = ORM::get_db();
    $timenow = date('Y-m-d H:i:s');

    $ad_duration = isset($_REQUEST['duration']) ? $_REQUEST['duration'] : '7';

    $expire_time = date('Y-m-d H:i:s', strtotime($timenow . ' +'.$ad_duration.' day'));
    $expire_timestamp = strtotime($expire_time);

    $query = "UPDATE `".$config['db']['pre']."product` SET
    `status` = 'active', `expire_date` = '" . $expire_timestamp . "'
    WHERE  status='expire'";
    $pdo->query($query);

    $status = "success";
    $message = $lang['SAVED_SUCCESS'];

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function approve_all_pending_post()
{
    global $config,$lang,$link;
    if(check_allow()){
        $items = ORM::for_table($config['db']['pre'].'product')
            ->select_many('id','product_name','user_id')
            ->where('status','pending')
            ->find_many();

        if (count($items) > 0) {
            foreach($items as $info){
                //Ad approve Email to seller
                $product_id = $info['id'];
                $item_title = $info['product_name'];
                $item_author_id = $info['user_id'];

                $product = ORM::for_table($config['db']['pre'].'product')->find_one($product_id);
                $product->set('status', 'active');
                $product->save();

                /*SEND RESUBMISSION AD APPROVE EMAIL*/
                email_template("ad_approve",$item_author_id,null,$product_id,$item_title);
            }
        }
    }
    $status = "success";
    $message = $lang['SAVED_SUCCESS'];
    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function postEdit()
{
    global $config,$lang;
    $errors = array();
    $response = array();
    // echo "<pre>";
    // print_r($_POST);
    // print_r($_REQUEST['custom']);
    
    // die;

    if (isset($_POST['id'])) {

        if (empty($_POST['category'])) {
            $errors[]['message'] = $lang['CAT_REQ'];
        }
        if (empty($_POST['title'])) {
            $errors[]['message'] = $lang['ADTITLE_REQ'];
        }
        if (empty($_POST['content'])) {
            $errors[]['message'] = $lang['DESC_REQ'];
        }
        if (empty($_POST['city'])) {
            $errors[]['message'] = $lang['CITY_REQ'];
        }
        if (!empty($_POST['price'])) {
            if (!is_numeric($_POST['price'])) {
                $errors[]['message'] = $lang['PRICE_MUST_NO'];
            }
        }

        if (!count($errors) > 0) {

            $urgent = isset($_POST['urgent']) ? '1' : '0';
            $featured = isset($_POST['featured']) ? '1' : '0';
            $highlight = isset($_POST['highlight']) ? '1' : '0';

            if($config['post_desc_editor'] == 1)
                $description = addslashes($_POST['content']);
            else
                $description = validate_input($_POST['content']);

            $start_date = validate_input($_POST['start_date']);
            $expire_date = validate_input($_POST['expire_date']);

            $start_time = date('Y-m-d H:i:s', strtotime($_POST['start_date']));
            $expire_time = date('Y-m-d H:i:s', strtotime($_POST['expire_date']));
            $expire_timestamp = strtotime($expire_date);
            $now = date("Y-m-d H:i:s");

            $item_edit = ORM::for_table($config['db']['pre'].'product')->find_one($_POST['id']);
            $item_edit->set('product_name', $_POST['title']);
            $item_edit->set('status', $_POST['status']);
            $item_edit->set('category', $_POST['category']);
            $item_edit->set('sub_category', !empty($_POST['sub_category'])?$_POST['sub_category']:0);
            $item_edit->set('featured', $featured);
            $item_edit->set('urgent', $urgent);
            $item_edit->set('highlight', $highlight);
            $item_edit->set('city', $_POST['city']);
            $item_edit->set('state', $_POST['state']);
            $item_edit->set('country', $_POST['country']);
            $item_edit->set('description', $description);
            $item_edit->set('created_at', $start_time);
            $item_edit->set('expire_date', $expire_timestamp);
            $item_edit->set('updated_at', $now);
            $item_edit->save();
            add_post_customField_data($_POST['category'],$_POST['sub_category'],$_POST['id']);
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];

            echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
            die();
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($errors, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

function transactionEdit()
{
    global $config,$lang;
    $errors = array();
    $response = array();

    if (isset($_POST['id'])) {

        if (isset($_POST['status'])) {

            if($_POST['status'] == "success"){
                $transaction_id = $_POST['id'];
                transaction_success($transaction_id);
            }else{
                $transaction = ORM::for_table($config['db']['pre'].'transaction')->find_one($_POST['id']);
                $transaction->status = $_POST['status'];
                $transaction->save();
            }
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];


        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function editAdvertise()
{
    global $config,$lang;

    if (isset($_POST['id'])) {

        $status = isset($_POST['status']) ? '1' : '0';

        $update_adsense = ORM::for_table($config['db']['pre'].'adsense')->find_one($_POST['id']);
        $update_adsense->set('provider_name', $_POST['provider_name']);
        $update_adsense->set('status', $status);
        $update_adsense->set('large_track_code', $_POST['large_track_code']);
        $update_adsense->set('tablet_track_code', $_POST['tablet_track_code']);
        $update_adsense->set('phone_track_code', $_POST['phone_track_code']);
        $update_adsense->save();

        $status = "success";
        $message = $lang['SAVED_SUCCESS'];

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function paymentEdit()
{
    global $config,$lang;

    if (isset($_POST['id'])) {

        $pdo = ORM::get_db();
        $query = "UPDATE `".$config['db']['pre']."payments` SET
            `payment_title` = '" . validate_input($_POST['title']) . "',
            `payment_install` = '" . validate_input($_POST['install']) . "'
            WHERE `payment_id` = '".$_POST['id']."' LIMIT 1 ";
        $query_result = $pdo->query($query);

        if(isset($_POST['paypal_sandbox_mode'])){
            update_option("paypal_sandbox_mode",isset($_POST['paypal_sandbox_mode'])? $_POST['paypal_sandbox_mode'] : "");
            update_option("paypal_api_username",isset($_POST['paypal_api_username'])? $_POST['paypal_api_username'] : "");
            update_option("paypal_api_password",isset($_POST['paypal_api_password'])? $_POST['paypal_api_password'] : "");
            update_option("paypal_api_signature",isset($_POST['paypal_api_signature'])? $_POST['paypal_api_signature'] : "");
            update_option("paypal_client_id",isset($_POST['paypal_client_id'])? $_POST['paypal_client_id'] : "");
        }

        if(isset($_POST['stripe_secret_key'])){
            update_option("stripe_publishable_key",$_POST['stripe_publishable_key']);
            update_option("stripe_secret_key",$_POST['stripe_secret_key']);
        }

        if(isset($_POST['paystack_public_key'])){
            update_option("paystack_public_key",$_POST['paystack_public_key']);
            update_option("paystack_secret_key",$_POST['paystack_secret_key']);
        }

        if(isset($_POST['payumoney_merchant_key'])){
            update_option("payumoney_sandbox_mode",$_POST['payumoney_sandbox_mode']);
            update_option("payumoney_merchant_key",$_POST['payumoney_merchant_key']);
            update_option("payumoney_merchant_salt",$_POST['payumoney_merchant_salt']);
            update_option("payumoney_merchant_id",$_POST['payumoney_merchant_id']);
        }

        if(isset($_POST['checkout_account_number'])){
            update_option("2checkout_sandbox_mode",$_POST['2checkout_sandbox_mode']);
            update_option("checkout_account_number",$_POST['checkout_account_number']);
            update_option("checkout_public_key",$_POST['checkout_public_key']);
            update_option("checkout_private_key",$_POST['checkout_private_key']);
        }

        if(isset($_POST['company_bank_info'])){
            update_option("company_bank_info",$_POST['company_bank_info']);
        }

        if(isset($_POST['company_cheque_info'])){
            update_option("company_cheque_info",$_POST['company_cheque_info']);
            update_option("cheque_payable_to",$_POST['cheque_payable_to']);
        }

        if(isset($_POST['skrill_merchant_id'])){
            update_option("skrill_merchant_id",$_POST['skrill_merchant_id']);
        }

        if(isset($_POST['nochex_merchant_id'])){
            update_option("nochex_merchant_id",$_POST['nochex_merchant_id']);
        }

        if(isset($_POST['CCAVENUE_MERCHANT_KEY'])){
            update_option("CCAVENUE_MERCHANT_KEY",$_POST['CCAVENUE_MERCHANT_KEY']);
            update_option("CCAVENUE_ACCESS_CODE",$_POST['CCAVENUE_ACCESS_CODE']);
            update_option("CCAVENUE_WORKING_KEY",$_POST['CCAVENUE_WORKING_KEY']);
        }

        if(isset($_POST['PAYTM_ENVIRONMENT'])){
            update_option("PAYTM_ENVIRONMENT",$_POST['PAYTM_ENVIRONMENT']);
            update_option("PAYTM_MERCHANT_KEY",$_POST['PAYTM_MERCHANT_KEY']);
            update_option("PAYTM_MERCHANT_MID",$_POST['PAYTM_MERCHANT_MID']);
            update_option("PAYTM_MERCHANT_WEBSITE",$_POST['PAYTM_MERCHANT_WEBSITE']);
        }
        $status = "success";
        $message = $lang['SAVED_SUCCESS'];

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function SaveSettings(){

    global $config,$lang,$link;
    $status = "";
    if (isset($_POST['logo_watermark'])) {
        $valid_formats = array("jpg","jpeg","png"); // Valid image formats
        if (isset($_FILES['banner']) && $_FILES['banner']['tmp_name'] != "") {
            $filename = stripslashes($_FILES['banner']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = "../storage/banner/"; //Image upload directory
                $bannername = stripslashes($_FILES['banner']['name']);
                $size = filesize($_FILES['banner']['tmp_name']);
                //Convert extension into a lower case format

                $ext = getExtension($bannername);
                $ext = strtolower($ext);
                $banner_name = "bg" . '.' . $ext;
                $newBgname = $uploaddir . $banner_name;
                //Moving file to uploads folder
                if(file_exists($newBgname)){
                    unlink($newBgname);
                }
                if (move_uploaded_file($_FILES['banner']['tmp_name'], $newBgname)) {

                    update_option("home_banner",$banner_name);
                    $status = "success";
                    $message = ' Banner updated Successfully ';

                } else {
                    $status = "error";
                    $message = 'Error in uploading Banner';
                }
            }
            else {
                $status = "error";
                $message = 'Only allowed jpg, jpeg png';
            }

        }

        if (isset($_FILES['favicon']) && $_FILES['favicon']['tmp_name'] != "") {
            $filename = stripslashes($_FILES['favicon']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = "../storage/logo/"; //Image upload directory
                $filename = stripslashes($_FILES['favicon']['name']);
                $size = filesize($_FILES['favicon']['tmp_name']);
                //Convert extension into a lower case format

                $ext = getExtension($filename);
                $ext = strtolower($ext);
                $image_name = "favicon" . '.' . $ext;
                $newLogo = $uploaddir . $image_name;
                if(file_exists($newLogo)){
                    unlink($newLogo);
                }
                //Moving file to uploads folder
                if (move_uploaded_file($_FILES['favicon']['tmp_name'], $newLogo)) {

                    update_option("site_favicon",$image_name);
                    $status = "success";
                    $message = ' Site Favicon icon updated Successfully ';
                } else {
                    $status = "error";
                    $message = 'Error in uploading Favicon';
                }
            }
            else {
                $status = "error";
                $message = 'Only allowed jpg, jpeg png';
            }

        }

        if (isset($_FILES['file']) && $_FILES['file']['tmp_name'] != "") {
            $filename = stripslashes($_FILES['file']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = "../storage/logo/"; //Image upload directory
                $filename = stripslashes($_FILES['file']['name']);
                $size = filesize($_FILES['file']['tmp_name']);
                //Convert extension into a lower case format

                $ext = getExtension($filename);
                $ext = strtolower($ext);
                $image_name = $config['tpl_name']."_logo" . '.' . $ext;
                $newLogo = $uploaddir . $image_name;
                if(file_exists($newLogo)){
                    unlink($newLogo);
                }
                //Moving file to uploads folder
                if (move_uploaded_file($_FILES['file']['tmp_name'], $newLogo)) {

                    update_option("site_logo",$image_name);
                    $status = "success";
                    $message = ' Site Logo updated Successfully ';
                } else {
                    $status = "error";
                    $message = 'Error in uploading Logo';
                }
            }
            else {
                $status = "error";
                $message = 'Only allowed jpg, jpeg png';
            }

        }

        if (isset($_FILES['footer_logo']) && $_FILES['footer_logo']['tmp_name'] != "") {
            $filename = stripslashes($_FILES['footer_logo']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = "../storage/logo/"; //Image upload directory
                $filename = stripslashes($_FILES['footer_logo']['name']);
                $size = filesize($_FILES['footer_logo']['tmp_name']);
                //Convert extension into a lower case format

                $ext = getExtension($filename);
                $ext = strtolower($ext);
                $image_name = $config['tpl_name']."_footer_logo" . '.' . $ext;
                $newLogo = $uploaddir . $image_name;
                if(file_exists($newLogo)){
                    unlink($newLogo);
                }
                //Moving file to uploads folder
                if (move_uploaded_file($_FILES['footer_logo']['tmp_name'], $newLogo)) {

                    update_option("site_logo_footer",$image_name);
                    $status = "success";
                    $message = ' Site Logo updated Successfully ';
                } else {
                    $status = "error";
                    $message = 'Error in uploading Logo';
                }
            }
            else {
                $status = "error";
                $message = 'Only allowed jpg, jpeg png';
            }

        }

        if (isset($_FILES['watermark']) && $_FILES['watermark']['tmp_name'] != "") {
            $filename = stripslashes($_FILES['watermark']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = "../storage/logo/"; //Image upload directory
                $filename = stripslashes($_FILES['watermark']['name']);
                $size = filesize($_FILES['watermark']['tmp_name']);
                //Convert extension into a lower case format

                $ext = getExtension($filename);
                $ext = strtolower($ext);
                $mark_name = "watermark" . '.' . $ext;
                $watermark = $uploaddir . $mark_name;
                if(file_exists($watermark)){
                    unlink($watermark);
                }
                //Moving file to uploads folder
                if (move_uploaded_file($_FILES['watermark']['tmp_name'], $watermark)) {
                    $status = "success";
                    $message = ' Watermark Logo updated Successfully ';
                } else {
                    $status = "error";
                    $message = 'Error in uploading Watermark';
                }
            }
            else {
                $status = "error";
                $message = 'Only allowed jpg, jpeg png';
            }

        }

        if (isset($_FILES['adminlogo']) && $_FILES['adminlogo']['tmp_name'] != "") {
            $filename = stripslashes($_FILES['adminlogo']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $uploaddir = "../storage/logo/"; //Image upload directory
                $filename = stripslashes($_FILES['adminlogo']['name']);
                $size = filesize($_FILES['adminlogo']['tmp_name']);
                //Convert extension into a lower case format

                $ext = getExtension($filename);
                $ext = strtolower($ext);
                $adminlogo_name = "adminlogo" . '.' . $ext;
                $adminlogo = $uploaddir . $adminlogo_name;
                if(file_exists($adminlogo)){
                    unlink($adminlogo);
                }
                //Moving file to uploads folder
                if (move_uploaded_file($_FILES['adminlogo']['tmp_name'], $adminlogo)) {
                    update_option("site_admin_logo",$adminlogo_name);
                    $status = "success";
                    $message = ' Adminlogo Logo updated Successfully ';
                } else {
                    $status = "error";
                    $message = 'Error in uploading adminlogo';
                }
            }
            else {
                $status = "error";
                $message = 'Only allowed jpg, jpeg png';
            }

        }

        if($status == ""){
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }
    }

    if (isset($_POST['general_setting'])) {
        update_option("site_url",$_POST['site_url']);
        update_option("site_title",$_POST['site_title']);
        update_option("show_search_home",$_POST['show_search_home']);
        update_option("show_categories_home",$_POST['show_categories_home']);
        update_option("show_featured_jobs_home",$_POST['show_featured_jobs_home']);
        update_option("show_latest_jobs_home",$_POST['show_latest_jobs_home']);
        update_option("non_active_msg",$_POST['non_active_msg']);
        update_option("non_active_allow",$_POST['non_active_allow']);
        update_option("job_seeker_enable",$_POST['job_seeker_enable']);
        update_option("resume_enable",$_POST['resume_enable']);
        update_option("resume_files",$_POST['resume_files']);
        update_option("company_enable",$_POST['company_enable']);
        update_option("featured_fee",$_POST['featured_fee']);
        update_option("urgent_fee",$_POST['urgent_fee']);
        update_option("highlight_fee",$_POST['highlight_fee']);
        update_option("cron_exec_time",validate_input($_POST['cron_exec_time']));
        update_option("delete_expired",validate_input($_POST['delete_expired']));
        update_option("userlangsel",$_POST['userlangsel']);
        update_option("userthemesel",$_POST['userthemesel']);
        update_option("color_switcher",$_POST['color_switcher']);
        update_option("termcondition_link",validate_input($_POST['termcondition_link']));
        update_option("privacy_link",validate_input($_POST['privacy_link']));
        update_option("cookie_link",validate_input($_POST['cookie_link']));
        update_option("cookie_consent",$_POST['cookie_consent']);
        update_option("transfer_filter",$_POST['transfer_filter']);
        update_option("temp_php",$_POST['temp_php']);
        update_option("quickad_debug",$_POST['quickad_debug']);
        $status = "success";
        $message = 'General setting updated Successfully';
    }

    if (isset($_POST['quick_map'])) {
        update_option("map_type",validate_input($_POST['map_type']));
        update_option("openstreet_access_token",validate_input($_POST['openstreet_access_token']));
        update_option("gmap_api_key",validate_input($_POST['gmap_api_key']));
        update_option("map_color",validate_input($_POST['map_color']));
        update_option("home_map_latitude",validate_input($_POST['home_map_latitude']));
        update_option("home_map_longitude",validate_input($_POST['home_map_longitude']));
        update_option("contact_latitude",validate_input($_POST['contact_latitude']));
        update_option("contact_longitude",validate_input($_POST['contact_longitude']));
        $status = "success";
        $message = 'Setting updated Successfully';
    }

    if (isset($_POST['live_location_track'])) {
        update_option("location_track_icon",validate_input($_POST['location_track_icon']));
        update_option("auto_detect_location",validate_input($_POST['auto_detect_location']));
        update_option("live_location_api",validate_input($_POST['live_location_api']));
        $status = "success";
        $message = 'Live Location setting updated Successfully';
    }

    if (isset($_POST['international'])) {

        if(isset($_POST['currency']))
        {
            $info = ORM::for_table($config['db']['pre'].'currencies')->find_one($_POST['currency']);

            $currency_sign = $info['html_entity'];
            $currency_code = $info['code'];
            $currency_pos = $info['in_left'];
        }
        update_option("country_type",$_POST['country_type']);
        update_option("specific_country",$_POST['specific_country']);
        update_option("lang",$_POST['lang']);
        update_option("timezone",$_POST['timezone']);
        update_option("currency_sign",$currency_sign);
        update_option("currency_code",$currency_code);
        update_option("currency_pos",$currency_pos);
        $status = "success";
        $message = 'International setting updated Successfully';
    }

    if (isset($_POST['email_setting'])) {

        update_option("admin_email",$_POST['admin_email']);
        update_option("email_template",$_POST['email_template']);
        update_option("email_engine",$_POST['email_engine']);
        update_option("email_type",$_POST['email_type']);

        update_option("smtp_host",$_POST['smtp_host']);
        update_option("smtp_port",$_POST['smtp_port']);
        update_option("smtp_username",$_POST['smtp_username']);
        update_option("smtp_password",$_POST['smtp_password']);
        update_option("smtp_secure",$_POST['smtp_secure']);
        update_option("smtp_auth",$_POST['smtp_auth']);

        update_option("aws_host",$_POST['aws_host']);
        update_option("aws_access_key",$_POST['aws_access_key']);
        update_option("aws_secret_key",$_POST['aws_secret_key']);

        update_option("mandrill_user",$_POST['mandrill_user']);
        update_option("mandrill_key",$_POST['mandrill_key']);

        update_option("sendgrid_user",$_POST['sendgrid_user']);
        update_option("sendgrid_pass",$_POST['sendgrid_pass']);



        $status = "success";
        $message = 'Email setting updated Successfully';
    }

    if (isset($_POST['theme_setting'])) {
        update_option("contact_validation",validate_input($_POST['contact_validation']));

        update_option("theme_color",validate_input($_POST['theme_color']));

        update_option("meta_keywords",validate_input($_POST['meta_keywords']));
        update_option("meta_description",validate_input($_POST['meta_description']));

        update_option("contact_address",validate_input($_POST['contact_address']));
        update_option("contact_phone",validate_input($_POST['contact_phone']));
        update_option("contact_email",validate_input($_POST['contact_email']));

        update_option("footer_text",validate_input($_POST['footer_text']));
        update_option("copyright_text",validate_input($_POST['copyright_text']));

        update_option("facebook_link",validate_input($_POST['facebook_link']));
        update_option("twitter_link",validate_input($_POST['twitter_link']));
        update_option("instagram_link",validate_input($_POST['instagram_link']));
        update_option("linkedin_link",validate_input($_POST['linkedin_link']));
        update_option("pinterest_link",validate_input($_POST['pinterest_link']));
        update_option("youtube_link",validate_input($_POST['youtube_link']));
        update_option("external_code",$_POST['external_code']);
        $status = "success";
        $message = ' Theme Setting updated Successfully';
    }

    if (isset($_POST['frontend_submission'])) {
        update_option("post_without_login",validate_input($_POST['post_without_login']));
        update_option("post_auto_approve",validate_input($_POST['post_auto_approve']));
        update_option("post_desc_editor",validate_input($_POST['post_desc_editor']));
        update_option("job_image_field",validate_input($_POST['job_image_field']));
        update_option("post_address_mode",validate_input($_POST['post_address_mode']));
        update_option("post_tags_mode",validate_input($_POST['post_tags_mode']));
        update_option("post_premium_listing",validate_input($_POST['post_premium_listing']));
        $status = "success";
        $message = 'Frontend submission form setting updated Successfully';
    }

    if (isset($_POST['social_login_setting'])) {
        update_option("facebook_app_id",validate_input($_POST['facebook_app_id']));
        update_option("facebook_app_secret",validate_input($_POST['facebook_app_secret']));
        update_option("google_app_id",validate_input($_POST['google_app_id']));
        update_option("google_app_secret",validate_input($_POST['google_app_secret']));
        $status = "success";
        $message = ' Social Login setting updated Successfully';
    }

    if (isset($_POST['recaptcha_setting'])) {

        update_option("recaptcha_mode",validate_input($_POST['recaptcha_mode']));
        update_option("recaptcha_public_key",validate_input($_POST['recaptcha_public_key']));
        update_option("recaptcha_private_key",validate_input($_POST['recaptcha_private_key']));
        $status = "success";
        $message = 'reCAPTCHA setting updated Successfully';
    }

    if (isset($_POST['blog_setting'])) {

        update_option("blog_enable",validate_input($_POST['blog_enable']));
        update_option("blog_banner",validate_input($_POST['blog_banner']));
        update_option("show_blog_home",validate_input($_POST['show_blog_home']));
        update_option("blog_comment_enable",validate_input($_POST['blog_comment_enable']));
        update_option("blog_comment_approval",validate_input($_POST['blog_comment_approval']));
        update_option("blog_comment_user",validate_input($_POST['blog_comment_user']));
        $status = "success";
        $message = 'Blog setting updated Successfully';
    }

    if (isset($_POST['testimonials_setting'])) {

        update_option("testimonials_enable",validate_input($_POST['testimonials_enable']));
        update_option("show_testimonials_blog",validate_input($_POST['show_testimonials_blog']));
        update_option("show_testimonials_home",validate_input($_POST['show_testimonials_home']));
        $status = "success";
        $message = 'Testimonials setting updated Successfully';
    }

    if (isset($_POST['valid_purchase_setting'])) {

        // Set API Key
        $code = $_POST['purchase_key'];
        $buyer_email = (isset($_POST['buyer_email']))? validate_input($_POST['buyer_email']) : "";
        $installing_version = 'pro';

        $url = "https://bylancer.com/api/api.php?verify-purchase=" . $code . "&version=" . $installing_version . "&site_url=". $config['site_url']."&email=" . $buyer_email;
        // Open cURL channel
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Set the user agent
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        // Decode returned JSON
        $output = json_decode(curl_exec($ch), true);
        // Close Channel
        curl_close($ch);

        if ($output['success']) {
            if(isset($config['quickad_secret_file']) && $config['quickad_secret_file'] != ""){
                $fileName = $config['quickad_secret_file'];
            }else{
                $fileName = get_random_string();
            }
            file_put_contents( $fileName . '.php', $output['data']);
            $success = true;
            update_option("quickad_secret_file",$fileName);
            update_option("purchase_key",$_POST['purchase_key']);
            $status = "success";
            $message = 'Purchase code verified successfully';
        } else {
            $status = "error";
            $message = $output['error'];
        }

    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function saveEmailTemplate(){

    global $config,$lang,$link;

    if (isset($_POST['email_setting'])) {
        $email_template = $_POST['email_template'];
        update_option("email_template",$email_template);
        if($email_template == 0){
            update_option("email_message_signup_details",stripslashes($_POST['email_message_editor_signup_details']));
            update_option("email_message_signup_confirm",stripslashes($_POST['email_message_editor_signup_confirm']));
            update_option("email_message_forgot_pass",stripslashes($_POST['email_message_editor_forgot_pass']));
            update_option("email_message_contact",stripslashes($_POST['email_message_editor_contact']));
            update_option("email_message_feedback",stripslashes($_POST['email_message_editor_feedback']));
            update_option("email_message_report",stripslashes($_POST['email_message_editor_report']));

            update_option("email_message_ad_approve",stripslashes($_POST['email_message_editor_ad_approve']));
            update_option("email_message_re_ad_approve",stripslashes($_POST['email_message_editor_re_ad_approve']));
            update_option("email_message_contact_seller",stripslashes($_POST['email_message_editor_contact_seller']));

            update_option("email_message_post_notification",stripslashes($_POST['email_message_editor_post_notification']));
        }else{
            update_option("email_message_signup_details",validate_input($_POST['email_message_textarea_signup_details']));
            update_option("email_message_signup_confirm",validate_input($_POST['email_message_textarea_signup_confirm']));
            update_option("email_message_forgot_pass",validate_input($_POST['email_message_textarea_forgot_pass']));
            update_option("email_message_contact",validate_input($_POST['email_message_textarea_contact']));
            update_option("email_message_feedback",validate_input($_POST['email_message_textarea_feedback']));
            update_option("email_message_report",validate_input($_POST['email_message_textarea_report']));

            update_option("email_message_ad_approve",validate_input($_POST['email_message_textarea_ad_approve']));
            update_option("email_message_re_ad_approve",validate_input($_POST['email_message_textarea_re_ad_approve']));
            update_option("email_message_contact_seller",validate_input($_POST['email_message_textarea_contact_seller']));
            update_option("email_message_post_notification",validate_input($_POST['email_message_textarea_post_notification']));
        }
        update_option("email_sub_signup_details",validate_input($_POST['email_sub_signup_details']));
        update_option("email_sub_signup_confirm",validate_input($_POST['email_sub_signup_confirm']));
        update_option("email_sub_forgot_pass",validate_input($_POST['email_sub_forgot_pass']));
        update_option("email_sub_contact",validate_input($_POST['email_sub_contact']));
        update_option("email_sub_feedback",validate_input($_POST['email_sub_feedback']));
        update_option("email_sub_report",validate_input($_POST['email_sub_report']));

        update_option("email_sub_ad_approve",validate_input($_POST['email_sub_ad_approve']));
        update_option("email_sub_re_ad_approve",validate_input($_POST['email_sub_re_ad_approve']));
        update_option("email_sub_contact_seller",validate_input($_POST['email_sub_contact_seller']));

        update_option("email_sub_post_notification",validate_input($_POST['email_sub_post_notification']));

        $status = "success";
        $message = 'Email setting updated Successfully';
    }else{
        $status = "Error";
        $message = 'Problem in save setting.';
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function testEmailTemplate(){

    global $config,$lang,$link;

    if (isset($_POST['test-email-notification'])) {
        $test_to_email =  $_POST['test_to_email'];
        $test_to_name = $_POST['test_to_name'];

        if (isset($_POST['signup-details'])) {

            $page = new HtmlTemplate();
            $page->html = $config['email_sub_signup_details'];
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('USER_FULLNAME', $test_to_name);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_signup_details'];
            $page->SetParameter ('USERNAME', "demo");
            $page->SetParameter ('PASSWORD', "demo");
            $page->SetParameter ('USER_ID', "1");
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('USER_FULLNAME', $test_to_name);
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['create-account'])) {

            $page = new HtmlTemplate();
            $page->html = $config['email_sub_signup_confirm'];
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('USER_FULLNAME', $test_to_name);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $confirmation_link = $link['SIGNUP']."?confirm=123456&user=1";
            $page = new HtmlTemplate();
            $page->html = $config['email_message_signup_confirm'];
            $page->SetParameter ('CONFIRMATION_LINK', $confirmation_link);
            $page->SetParameter ('USERNAME', "demo");
            $page->SetParameter ('USER_ID', "1");
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('USER_FULLNAME', $test_to_name);
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['forgot-pass'])) {
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_forgot_pass'];
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('USER_FULLNAME', $test_to_name);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $forget_password_link = $config['site_url']."login?forgot=sd1213f1x1&r=21d1d2d12&e=12&t=1213231";
            $page = new HtmlTemplate();
            $page->html = $config['email_message_forgot_pass'];
            $page->SetParameter ('FORGET_PASSWORD_LINK', $forget_password_link);
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('USER_FULLNAME', $test_to_name);
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['contact_us'])) {
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_contact'];
            $page->SetParameter ('CONTACT_SUBJECT', "Contact Email");
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('NAME', $test_to_name);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_contact'];
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('NAME', $test_to_name);
            $page->SetParameter ('CONTACT_SUBJECT', "Contact Email");
            $page->SetParameter ('MESSAGE', "Test Message");
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['feedback'])) {
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_feedback'];
            $page->SetParameter ('FEEDBACK_SUBJECT', "Feedback Email");
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('NAME', $test_to_name);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_feedback'];
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('NAME', $test_to_name);
            $page->SetParameter ('PHONE', "1234567890");
            $page->SetParameter ('FEEDBACK_SUBJECT', "Feedback Email");
            $page->SetParameter ('MESSAGE', "Test Message");
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['report'])) {
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_report'];
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('NAME', $test_to_name);
            $page->SetParameter ('USERNAME', $test_to_name);
            $page->SetParameter ('VIOLATION', $lang['ADVWEBSITE']);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_report'];
            $page->SetParameter ('EMAIL', $test_to_email);
            $page->SetParameter ('NAME', $test_to_name);
            $page->SetParameter ('USERNAME', $test_to_name);
            $page->SetParameter ('USERNAME2', "Violator Username");
            $page->SetParameter ('VIOLATION', $lang['ADVWEBSITE']);
            $page->SetParameter ('URL', $link['POST-DETAIL']."/1");
            $page->SetParameter ('DETAILS', "Violator Message details here");
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        $item_title = "Advertise Title";
        $ad_link = $link['POST-DETAIL']."/1";
        if (isset($_POST['ad_approve'])) {
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_ad_approve'];
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('SELLER_NAME', $test_to_name);
            $page->SetParameter ('SELLER_EMAIL', $test_to_email);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_ad_approve'];;
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('SELLER_NAME', $test_to_name);
            $page->SetParameter ('SELLER_EMAIL', $test_to_email);
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['re_ad_approve'])) {
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_re_ad_approve'];
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('SELLER_NAME', $test_to_name);
            $page->SetParameter ('SELLER_EMAIL', $test_to_email);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_re_ad_approve'];;
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('SELLER_NAME', $test_to_name);
            $page->SetParameter ('SELLER_EMAIL', $test_to_email);
            $email_body = $page->CreatePageReturn($lang,$config,$link);
            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['contact_to_seller'])) {
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_contact_seller'];
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('SELLER_NAME', $test_to_name);
            $page->SetParameter ('SELLER_EMAIL', $test_to_email);
            $page->SetParameter('SENDER_NAME', "Sender Name");
            $page->SetParameter('SENDER_EMAIL', "sender@gmail.com");
            $page->SetParameter('SENDER_PHONE', "1234567890");
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_contact_seller'];;
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('SELLER_NAME', $test_to_name);
            $page->SetParameter ('SELLER_EMAIL', $test_to_email);
            $page->SetParameter('SENDER_NAME', "Sender Name");
            $page->SetParameter('SENDER_EMAIL', "sender@gmail.com");
            $page->SetParameter('SENDER_PHONE', "1234567890");
            $page->SetParameter('MESSAGE', "Test Message : I want to inquiry about your classified.");
            $email_body = $page->CreatePageReturn($lang,$config,$link);
            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        if (isset($_POST['ad_newsletter'])) {
            $ad_id = 1;
            $page = new HtmlTemplate();
            $page->html = $config['email_sub_post_notification'];
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('ADID', $ad_id);
            $email_subject = $page->CreatePageReturn($lang,$config,$link);

            $page = new HtmlTemplate();
            $page->html = $config['email_message_post_notification'];;
            $page->SetParameter ('ADTITLE', $item_title);
            $page->SetParameter ('ADLINK', $ad_link);
            $page->SetParameter ('ADID', $ad_id);
            $email_body = $page->CreatePageReturn($lang,$config,$link);

            email($test_to_email,$test_to_name,$email_subject,$email_body);
        }

        $status = "success";
        $message = 'Email Sent Successfully';
    }else{
        $status = "Error";
        $message = 'Problem in sent e-mail.';
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}

function addReligion(){
    global $config,$lang;
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Religion Name Required";
            $status = "error";
            $message = $error;
        }
        if(empty($error)) {
            $now=date("Y-m-d");
            $insert_religion = ORM::for_table($config['db']['pre'].'religions')->create();
            $insert_religion->name = $_POST['name'];
            $insert_religion->created_at = $now;
            $insert_religion->updated_at = $now;
            $insert_religion->save();
            if ($insert_religion->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } 
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();

    
}

function editReligion(){
    global $config,$lang;
    
    if (isset($_POST['id'])) {
  
        // $info = ORM::for_table($config['db']['pre'].'religions')
        //     ->select('id')
        //     ->where('id', $_POST['id'])
        //     ->find_one();

        $update_rel = ORM::for_table($config['db']['pre'].'religions')->find_one($_POST['id']);
        $update_rel->set('name', $_POST['name']);
        $update_rel->set('updated_at',date('Y-m-d'));
        $update_rel->save();

        if ($update_rel) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        } else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }

    } else {
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }

    echo $json = '{"status" : "' . $status . '","message" : "' . $message . '"}';
    die();
}
function addUserLanguage(){
    global $config,$lang;
   // print_r($_POST);die;
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }
        if ($_POST['type'] == "") {
            $error = "Language type Required";
            $status = "error";
            $message = $error;
        }
        if(empty($error)) {
            $now=date("Y-m-d");
            $insert_lang = ORM::for_table($config['db']['pre'].'language')->create();
            $insert_lang->name = $_POST['name'];
            $insert_lang->type = $_POST['type'];
            $insert_lang->created_at = $now;
            $insert_lang->updated_at = $now;
            $insert_lang->save();
            if ($insert_lang->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } 
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();

    
}
function editUserLanguage(){
    global $config,$lang;
   
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }
        if ($_POST['type'] == "") {
            $error = "Language type Required";
            $status = "error";
            $message = $error;
        }
        if(empty($error)) {
           
            $update_lang = ORM::for_table($config['db']['pre'].'language')->find_one($_POST['id']);
          
            $update_lang->set('name', $_POST['name']);
            $update_lang->set('type', $_POST['type']);
            $update_lang->set('updated_at',date('Y-m-d'));
            $update_lang->save();
    
            if ($update_lang) {
               
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } else{
                $status = "error";
                $message = $lang['ERROR_TRY_AGAIN'];
            }
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();

    
}

function addCulturalBackground(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }

        if(empty($error)) {
            $now=date('Y-m-d H:i:s');
            $insert_cl = ORM::for_table($config['db']['pre'].'cultural_backgrounds')->create();
            $insert_cl->name = $_POST['name'];
            $insert_cl->created_at = $now;
            $insert_cl->updated_at = $now;
            $insert_cl->save();
            
            $cl_id = $insert_cl->id();
            $background_options= $_POST['options'];
            $backgroundOptions=[];
            foreach($background_options as $background_option) {
              
                array_push($backgroundOptions,'('.$cl_id.',"'.$background_option['name'].'","'.date('Y-m-d H:i:s').'")');
               
            }
            $u_c_backopt = implode(',',$backgroundOptions); 
            ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'cultural_background_options (cultural_background_id,name,created_at) VALUES'.$u_c_backopt.'');
           // echo ORM::get_last_query();die;
            if ($insert_cl->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } 
            
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();

    
}

function editCulturalBackground(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
   // echo date('Y-m-d H:i:s');die;
    $clId=$_POST['id'];
    $error=[];
    if(empty($error)) {
        $now=date('Y-m-d H:i:s');
        $update_cl = ORM::for_table($config['db']['pre'].'cultural_backgrounds')->find_one($clId);
        $update_cl->name = $_POST['name'];
        $update_cl->updated_at = $now;
        $update_cl->save();
        $background_options= $_POST['options'];
        $backgroundOptions=[];
        foreach($background_options as $background_option) {
            array_push($backgroundOptions,'('.$clId.',"'.$background_option['name'].'","'.date('Y-m-d H:i:s').'")');  
        }
        
        $u_c_backopt = implode(',',$backgroundOptions); 
      
        $userBackg = ORM::for_table($config['db']['pre'] . 'cultural_background_options')->where('cultural_background_id', $clId)->find_array();
        if(count($userBackg)) {
            ORM::for_table($config['db']['pre'] . 'cultural_background_options')->where_equal('cultural_background_id', $clId)->delete_many();
        }
        ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'cultural_background_options (cultural_background_id,name,created_at) VALUES'.$u_c_backopt.'');
       // echo ORM::get_last_query();die;
        if ($update_cl->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
    
}

function addAboutMe(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }

        if(empty($error)) {
            $now=date('Y-m-d H:i:s');
            $insert_ab = ORM::for_table($config['db']['pre'].'about_mes')->create();
            $insert_ab->name = $_POST['name'];
            $insert_ab->created_at = $now;
            $insert_ab->updated_at = $now;
            $insert_ab->save();
            
            $ab_id = $insert_ab->id();
            $aboutme_options= $_POST['options'];
            $aboutmeOptions=[];
            foreach($aboutme_options as $aboutme_option) {
              
                array_push($aboutmeOptions,'('.$ab_id.',"'.$aboutme_option['name'].'")');
               
            }
            $u_c_backopt = implode(',',$aboutmeOptions); 
            ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'about_me_options (about_me_id,name) VALUES'.$u_c_backopt.'');
           // echo ORM::get_last_query();die;
            if ($insert_ab->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } 
            
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();   
}

function editAboutMe(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
   // echo date('Y-m-d H:i:s');die;
    $abId=$_POST['id'];
    $error=[];
    if(empty($error)) {
        $now=date('Y-m-d H:i:s');
        $update_ab = ORM::for_table($config['db']['pre'].'about_mes')->find_one($abId);
        $update_ab->name = $_POST['name'];
        $update_ab->updated_at = $now;
        $update_ab->save();
        $background_options= $_POST['options'];
        $backgroundOptions=[];
        foreach($background_options as $background_option) {
            array_push($backgroundOptions,'('.$abId.',"'.$background_option['name'].'")');  
        }
        
        $u_c_backopt = implode(',',$backgroundOptions); 
      
        $userBackg = ORM::for_table($config['db']['pre'] . 'about_me_options')->where('about_me_id', $abId)->find_array();
        if(count($userBackg)) {
            ORM::for_table($config['db']['pre'] . 'about_me_options')->where_equal('about_me_id', $abId)->delete_many();
        }
        ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'about_me_options (about_me_id,name) VALUES'.$u_c_backopt.'');
       // echo ORM::get_last_query();die;
        if ($update_ab->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();   
}

function addPreference(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }

        if(empty($error)) {
            $now=date('Y-m-d H:i:s');
            $insert_pr = ORM::for_table($config['db']['pre'].'preferences')->create();
            $insert_pr->question = $_POST['name'];
            $insert_pr->created_at = $now;
            $insert_pr->updated_at = $now;
            $insert_pr->save();
            
            $ab_id = $insert_pr->id();
            $pre_options= $_POST['options'];
            $preOptions=[];
            foreach($pre_options as $pre_option) {
              
                array_push($preOptions,'('.$ab_id.',"'.$pre_option['name'].'","'.date('Y-m-d H:i:s').'")');
               
            }
            $pre_opt = implode(',',$preOptions); 
            ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'preference_options (preference_id,name,created_at) VALUES'.$pre_opt.'');
           // echo ORM::get_last_query();die;
            if ($insert_pr->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } 
            
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();    
}

function editPreference(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
   // echo date('Y-m-d H:i:s');die;
    $prId=$_POST['id'];
    $error=[];
    if(empty($error)) {
        $now=date('Y-m-d H:i:s');
        $update_pr = ORM::for_table($config['db']['pre'].'preferences')->find_one($prId);
        $update_pr->question = $_POST['name'];
        $update_pr->updated_at = $now;
        $update_pr->save();
        $pre_options= $_POST['options'];
        $preOptions=[];
        foreach($pre_options as $pre_option) {
            array_push($preOptions,'('.$prId.',"'.$pre_option['name'].'","'.date('Y-m-d H:i:s').'")');  
        }
        
        $pr_opt = implode(',',$preOptions); 
      
        $userBackg = ORM::for_table($config['db']['pre'] . 'preference_options')->where('preference_id', $prId)->find_array();
        if(count($userBackg)) {
            ORM::for_table($config['db']['pre'] . 'preference_options')->where_equal('preference_id', $prId)->delete_many();
        }
        ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'preference_options (preference_id,name,updated_at) VALUES'.$pr_opt.'');
       // echo ORM::get_last_query();die;
        if ($update_pr->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();    
}

function addInterest(){
    global $config,$lang;
   // print_r($_POST);die;
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }
        if(empty($error)) {
            $now=date('Y-m-d H:i:s');
            $insert_int = ORM::for_table($config['db']['pre'].'interests')->create();
            $insert_int->name = $_POST['name'];
            $insert_int->icon = $_POST['icon'];
            $insert_int->created_at = $now;
            $insert_int->updated_at = $now;
            $insert_int->save();
            if ($insert_int->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } 
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();  
}

function editInterest(){
    global $config,$lang;
   
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }
        if(empty($error)) {
           
            $update_int = ORM::for_table($config['db']['pre'].'interests')->find_one($_POST['id']);
          
            $update_int->set('name', $_POST['name']);
            $update_int->set('icon', $_POST['icon']);
            $update_int->set('updated_at',date('Y-m-d'));
            $update_int->save();
    
            if ($update_int) {
               
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } else{
                $status = "error";
                $message = $lang['ERROR_TRY_AGAIN'];
            }
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();    
}

function addCareExperience(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
    $error=[];
    if (isset($_POST['submit'])) {
        if ($_POST['name'] == "") {
            $error = "Language Name Required";
            $status = "error";
            $message = $error;
        }

        if(empty($error)) {
            $now=date('Y-m-d H:i:s');
            $insert_ce = ORM::for_table($config['db']['pre'].'care_experiences')->create();
            $insert_ce->name = $_POST['name'];
            $insert_ce->created_at = $now;
            $insert_ce->updated_at = $now;
            $insert_ce->save();
            
            $ab_id = $insert_ce->id();
            $careexp_options= $_POST['options'];
            $CareExpOptions=[];
            foreach($careexp_options as $careexp_option) {
              
                array_push($CareExpOptions,'('.$ab_id.',"'.$careexp_option['name'].'","'.date('Y-m-d H:i:s').'")');
               
            }
            $c_e_opt = implode(',',$CareExpOptions); 
            ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'care_experience_options (care_experience_id,name,created_at) VALUES'.$c_e_opt.'');
           // echo ORM::get_last_query();die;
            if ($insert_ce->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            } 
            
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();   
}

function editCareExperience(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;
   // echo date('Y-m-d H:i:s');die;
    $ceId=$_POST['id'];
    $error=[];
    if(empty($error)) {
        $now=date('Y-m-d H:i:s');
        $update_ce = ORM::for_table($config['db']['pre'].'care_experiences')->find_one($ceId);
        $update_ce->name = $_POST['name'];
        $update_ce->updated_at = $now;
        $update_ce->save();
        $careexp_options= $_POST['options'];
        $careexpOptions=[];
        foreach($careexp_options as $careexp_option) {
            array_push($careexpOptions,'('.$ceId.',"'.$careexp_option['name'].'","'.date('Y-m-d H:i:s').'")');  
        }
        
        $c_e_kopt = implode(',',$careexpOptions); 
      
        $careexp = ORM::for_table($config['db']['pre'] . 'care_experience_options')->where('care_experience_id', $ceId)->find_array();
        if(count($careexp)) {
            ORM::for_table($config['db']['pre'] . 'care_experience_options')->where_equal('care_experience_id', $ceId)->delete_many();
        }
        ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'care_experience_options (care_experience_id,name,updated_at) VALUES'.$c_e_kopt.'');
       // echo ORM::get_last_query();die;
        if ($update_ce->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();   
}

function editUserProfileRate(){
    global $config,$lang;
    $user_id=$_POST['id'];
    $errors='';
    $error=[];
    $days = $_POST['days'];
    $time_slots =  $_POST['time_slot'];
    $user_city=ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id',$user_id)->find_array();
    $city_codes=array_column($user_city,'city_code');

    $user_pr_days=ORM::for_table($config['db']['pre'] . 'user_prefered_days')
    ->select_many('id','user_id','day')
    ->select_many_expr(["start_time"=>"TIME_FORMAT(start_time,'%h:%i %p')"],["end_time"=>"TIME_FORMAT(end_time, '%h:%i %p')"])
    ->where('user_id',$user_id)->find_array();
    $user_days=[];
    foreach($user_pr_days as $val){
        $user_days[$val['day']]=['start_time'=>$val['start_time'],'end_time'=>$val['end_time']];
    }
    //$user_pr_days_code=array_keys($user_days);
    // echo "<pre>";
    // print_r($_POST);die;
    if(empty($error)) {
        foreach ($time_slots as $key=>$slot) {
            $st_time=!empty($slot['start_time'])? date('H:i:s',strtotime($slot['start_time'])) :'';
            $en_time =!empty($slot['end_time']) ? date('H:i:s',strtotime($slot['end_time'])) : '';
           
            if(!empty($st_time) || !empty($en_time)){
                 if($en_time <= $st_time) {
                     $errors++;
                     $time_error = $lang['INVALID_END_TIME'].' for '.$key.'';
                     break;  
                 }
            }else{
                continue;
            }
          
        }

        if ($errors == 0) {
            $salary_min = $salary_max = 0;
            if (!empty($_POST['salary_min']) or !empty($_POST['salary_max'])) {
                $salary_min = is_numeric($_POST['salary_min']) ? $_POST['salary_min'] : 0;
                $salary_max = is_numeric($_POST['salary_max']) ? $_POST['salary_max'] : 0;
            }
          
            $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
            $user_update->set('salary_min', $salary_min);
            $user_update->set('salary_max', $salary_max);
            $user_update->set('available_to_work',$_POST['available_to_work']??"0");
            $user_update->set('is_session_willing',$_POST['session_willing']??"0");
            $user_update->save();
            
            $cities = $_POST['city'];
           
            foreach ($city_codes as $c_code) {
                if(!in_array($c_code,$cities)){
                    $c=ORM::for_table($config['db']['pre'] . 'user_cities')->where(['user_id'=>$user_id,'city_code'=>$c_code])->find_one();
                    $c->delete();
                }
            }
            foreach ($cities as $key => $city) {
                $citydata = get_cityDetail_by_id($city);
                $country = $citydata['country_code'];
                $state = $citydata['subadmin1_code'];
                $exist=ORM::for_table($config['db']['pre'] . 'user_cities')->where(['user_id'=>$user_id,'city_code'=>$city])->find_one();
                if(!$exist){
                    $u_city=ORM::for_table($config['db']['pre'] .'user_cities')->create();
                    $u_city->user_id=$user_id;
                    $u_city->city_code = $city;
                    $u_city->state_code= $state;
                    $u_city->country_code= $country;
                    $u_city->save();
                }
            }            
            $day_codes=array_column($user_pr_days,'day');
            foreach ($day_codes as $day) {
                if(!in_array($day,$days)){
                    $c=ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id'=>$user_id,'day'=>$day])->find_one();
                    $c->delete(); 
                }
            }
            foreach ($days as $key => $day) {
                $e_day=ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id'=>$user_id,'day'=>$day])->find_one();
                $d_start_time= !empty($time_slots[$day]['start_time'])? date('H:i:s',strtotime($time_slots[$day]['start_time'])) : null;
                $d_end_time =!empty($time_slots[$day]['end_time'])? date('H:i:s',strtotime($time_slots[$day]['end_time'])) : null;
                if(!$e_day){
                    $u_day=ORM::for_table($config['db']['pre'] .'user_prefered_days')->create();
                    $u_day->user_id=$user_id;
                    $u_day->day = $day;
                    $u_day->start_time=$d_start_time;
                    $u_day->end_time=$d_end_time;
                    $u_day->save();      
                }else{
                   $e_day->set('start_time',$d_start_time);
                   $e_day->set('end_time',$d_end_time);
                   $e_day->save();  
                }
            }
            if ($user_update->id()) {
                $status = "success";
                $message = $lang['SAVED_SUCCESS'];
            }else {
                $status = "error";
                $message = $lang['ERROR_TRY_AGAIN'];
            }
        }
        }else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
        $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
        echo $json;
        die();   
}
function editUserReligion(){
    global $config,$lang;
    $user_id=$_POST['id'];
    $rel=$_POST['religion'];
    $userReligion = ORM::for_table($config['db']['pre'] . 'user_religions')->select('religion_id')->where('user_id', $user_id)->find_array();
    $userReligionIds=array_column($userReligion,'religion_id');
    // $religions = ORM::for_table($config['db']['pre'] .'religions')->select_many('id','name')->find_array();
    $error=[];   
    // echo "<pre>";
    // print_r($_POST);die;    
    if(empty($error)) {
        foreach ($userReligionIds as $rel_id) {
            if(!in_array($rel_id,$rel)){
                $rl=ORM::for_table($config['db']['pre'] . 'user_religions')->where(['user_id'=>$user_id,'religion_id'=>$rel_id])->find_one();
                $rl->delete();
            }

        }
        foreach ($rel as $key => $r) {
            $exist=ORM::for_table($config['db']['pre'] . 'user_religions')->where(['user_id'=>$user_id,'religion_id'=>$r])->find_one();
            if(!$exist){
                $u_rel=ORM::for_table($config['db']['pre'] .'user_religions')->create();
                $u_rel->user_id=$user_id;
                $u_rel->religion_id  = $r;
                $u_rel->save();
            }
        }
        if ($u_rel->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
        $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
        echo $json;
        die();  
}
function editUserLanguages(){
    global $config,$lang;
    $user_id=$_POST['id'];
    $error=[];
    $m_langs=$_POST['main_langs'];
    // echo "<pre>";
    // print_r($_POST);die;
    $user_main_lang=ORM::for_table($config['db']['pre'] . 'user_languages')->where('user_id',$user_id)->where_raw('NOT(language_id <=> NULL)')->find_array();
    $user_main_lang_ids=array_column($user_main_lang,'language_id');
    //print_r($user_main_lang_ids);
    if(empty($error)) {
        foreach ($user_main_lang_ids as $lang_id) {
            if(!in_array($lang_id,$m_langs)){
                $ml=ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id'=>$user_id,'language_id'=>$lang_id])->find_one();
                $ml->delete();
            }
        }
        foreach ($m_langs as $key => $m_lang) {
            $exist=ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id'=>$user_id,'language_id'=>$m_lang])->find_one();
            if(!$exist){
                $u_m_lang=ORM::for_table($config['db']['pre'] .'user_languages')->create();
                $u_m_lang->user_id=$user_id;
                $u_m_lang->language_id  = $m_lang;
                $u_m_lang->save();
            }
        }
        if ($u_m_lang->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }        
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();  
}
function editUserCulturalBackground(){
    global $config,$lang;
    $error=[];
    $user_id = $_POST['id'];
    $backs = $_POST['background'];
    $background_options = $_POST['back_options'];
    
    $backgroundOptions = [];
    foreach($background_options as $key => $val) {
        if(in_array($key, $backs)) {
            $backgroundOptions = array_merge($backgroundOptions, $val);
        }
    }    
    $backgrounds =[];
    $back_Options = [];
    //$c_backg= ORM::for_table('person')->create();
        foreach($backs as $main) {
            array_push($backgrounds,'('.$user_id.','.$main.')');
        }
    $u_c_back = implode(',',$backgrounds);
        foreach($backgroundOptions as $background_option) {
            if(in_array(parent_culture($background_option), $backs)){
                array_push($back_Options,'('.$user_id.','.parent_culture($background_option).','.$background_option.')');
            }  
        }
    $u_c_backopt = implode(',',$back_Options);
    // echo "<pre>";
    // var_dump($u_c_backopt);die;
    $userBackg = ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where('user_id', $user_id)->find_array(); 
    if(count($userBackg)) {
        ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where_equal('user_id', $user_id)->delete_many();
    }
    ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'user_cultural_backgrounds (user_id,cultural_background_id) VALUES'.$u_c_back.'');
    ORM::raw_execute('INSERT INTO '.$config['db']['pre'].'user_cultural_backgrounds (user_id,cultural_background_id,cultural_background_option_id) VALUES'.$u_c_backopt.'');
    
    echo json_encode(['status' => 'success', 'message' => 'updated successfully']);   
    // echo "<pre>";
    // var_dump($_POST, $backs, $background_options, $backgroundOptions);die;    
}
function editStripeSetting(){
    global $config,$lang;
    // echo "<pre>";
    // print_r($_POST);die;

    //$abId=$_POST['id'];
    //$type=$_POST['type'];
    $error=[];
    if(empty($error)) {
        
        $update_li = ORM::for_table($config['db']['pre'].'payment_settings')->where('type','live')->find_one();
        $update_li->stripe_key = $_POST['live_stripe_key'];
        $update_li->stripe_secret  = $_POST['live_stripe_secret'];
        $update_li->status  = $_POST['live_status'];
        $update_li->save();

        $update_te = ORM::for_table($config['db']['pre'].'payment_settings')->where('type','test')->find_one();
        $update_te->stripe_key = $_POST['test_stripe_key'];
        $update_te->stripe_secret  = $_POST['test_stripe_secret'];
        $update_te->status  = $_POST['test_status'];
        $update_te->save();
       // echo ORM::get_last_query();die;
        if ($update_li->id()) {
            $status = "success";
            $message = $lang['SAVED_SUCCESS'];
        }else {
            $status = "error";
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    }else{
        $status = "error";
        $message = $lang['ERROR_TRY_AGAIN'];
    }
    
    $json = '{"status" : "' . $status . '","message" : "' . $message . '","errors" : ' . json_encode($error, JSON_UNESCAPED_SLASHES) . '}';
    echo $json;
    die();
}

?>
