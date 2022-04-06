<?php
define("ROOTPATH", dirname(dirname(__FILE__)));
// Path to app folder.
define("APPPATH", ROOTPATH . "/php/");

// Path to root directory of app.
require_once('../includes/config.php');
require_once('../includes/sql_builder/idiorm.php');
require_once('../includes/db.php');
require_once('../includes/functions/func.global.php');
require_once('../includes/functions/func.admin.php');

$mysqli = db_connect();

if (isset($_POST['id']) && $_POST['id'] != "") {
    $sub_category = ORM::for_table($config['db']['pre'] . 'catagory_sub')->where('main_cat_id', $_POST['id'])->find_array();
    $subcategory = '<label>Subcategory</label>';
    $subcategory .= '<select class="form-control" name="subcategory">';
    $subcategory .= '<option value="">Select Sub category</option>';
    foreach ($sub_category as $sub) {
        $subcategory .= '<option value="' . $sub['sub_cat_id'] . '">' . $sub['sub_cat_name'] . '</option>';
    }
    $subcategory .= '</select>';
    echo $subcategory;
}
