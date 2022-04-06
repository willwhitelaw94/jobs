<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;
if ($params['draw'] == 1)
    $params['order'][0]['dir'] = "desc";
//define index of column

$columns = array(
    0 => 'id',
    1 => 'name',
    2 => 'available_to_work',
    3 => 'city',
    4 => 'amount',
    5 => 'user_type',
    6 => 'email',
    7 => 'sex',
    8 => 'status',
    9 => 'created_at'
);
$isWhere = false;
$where = $sqlTot = $sqlRec = "";

// check search value exist
if (!empty($params['search']['value'])) {
    $where .= " WHERE ";
    $where .= " ( username LIKE '" . $params['search']['value'] . "%' ";
    $where .= " OR name LIKE '" . $params['search']['value'] . "%' ";
    $where .= " OR email LIKE '" . $params['search']['value'] . "%' ";
    $where .= " OR sex LIKE '" . $params['search']['value'] . "%' )";
    $isWhere = true;
}

if (isset($_POST['search_type']) && $_POST['search_type'] == "filter") {
    $where .= " WHERE ";
    $flag = "";
    if (!empty($_POST['user_type'])) {
        if (!empty($flag)) {
            $where .= $flag;
        }
        $where .= ' ' . $config['db']['pre'] . 'user.user_type = "' . $_POST['user_type'] . '" ';
        $flag = " AND ";
        $isWhere = true;
    }
    if (!empty($_POST['status'])) {
        if (!empty($flag)) {
            $where .= $flag;
        }
        $where .= ' ' . $config['db']['pre'] . 'user.status = "' . $_POST['status'] . '" ';
        $flag = " AND ";
        $isWhere = true;
    }
    if (!empty($_POST['sex'])) {
        if (!empty($flag)) {
            $where .= $flag;
        }
        $where .= ' ' . $config['db']['pre'] . 'user.sex = "' . $_POST['sex'] . '" ';
        $flag = " AND ";
        $isWhere = true;
    }
    // if (!empty($_POST['date'])) {
    //     if (!empty($flag)) {
    //         $where .= $flag;
    //     }
    //     $date = explode("-", $_POST['date']);
    //     $where .= ' ' . $config['db']['pre'] . 'user.created_at BETWEEN "' . date('Y-m-d', strtotime($date[0])) . '"  AND  "' . date('Y-m-d', strtotime($date[1])) . '" ';
    //     $flag = " AND ";
    //     $isWhere = true;
    // }
    if ($_POST['available_to_work'] == "1" || $_POST['available_to_work'] == "0") {
        if (!empty($flag)) {
            $where .= $flag;
        }
        $where .= ' ' . $config['db']['pre'] . 'user.available_to_work = "' . $_POST['available_to_work'] . '" ';
        $flag = " AND ";
        $isWhere = true;
    }
    if (!empty($_POST['category'])) {
        if (!empty($flag)) {
            $where .= $flag;
        }
        $where .= ' ' . $config['db']['pre'] . 'user.category = "' . $_POST['category'] . '" ';
        $flag = " AND ";
        $isWhere = true;
    }
    if (!empty($_POST['subcategory'])) {
        if (!empty($flag)) {
            $where .= $flag;
        }
        $where .= ' ' . $config['db']['pre'] . 'user.subcategory = "' . $_POST['subcategory'] . '" ';
        $flag = " AND ";
        $isWhere = true;
    }
}

// getting total number records without any search
//$sql = "SELECT * FROM `".$config['db']['pre']."user` ";
$sql = "SELECT " . $config['db']['pre'] . "user.*, " . $config['db']['pre'] . "wallet.amount FROM " . $config['db']['pre'] . "user ";
$sql .=  'LEFT JOIN ' . $config['db']['pre'] . 'wallet ON ' . $config['db']['pre'] . 'user.id = ' . $config['db']['pre'] . 'wallet.userid';

$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if (isset($where) && $where != '' && $isWhere) {

    $sqlTot .= $where;
    $sqlRec .= $where;
}

if (empty($params['order'][0]['column'])) {
    $sqlRec .=  " ORDER BY id asc LIMIT 0, 10";
} else {
    $sqlRec .=  " ORDER BY " . $columns[$params['order'][0]['column']] . "   " . $params['order'][0]['dir'] . "  LIMIT " . $params['start'] . " ," . $params['length'] . " ";
}

$queryTot = $pdo->query($sqlTot);
$totalRecords = $queryTot->rowCount();
$totalRecords = "10";
$queryRecords = $pdo->query($sqlRec);


//iterate on results row and create new index array of data
foreach ($queryRecords as $row) {

    $id = $row['id'];
    $amount = $row['amount'];
    if (empty($amount)) {
        $amount = "0.00";
    }
    $username = $row['username'];
    $name = $row['name'];
    $work_status = $row['available_to_work'];

    $city = $row['city'];
    $address = $row['address'];
    if (empty($city) && empty($address)) {
        $address_city = "--";
    } else {
        if (empty($city)) {
            $address_city = $address;
        } else if (empty($address)) {
            $address_city = $city;
        } else {
            $address_city = $row['address'] . ' , ' . $row['city'];
        }
    }
    $type = $row['user_type'] == 'user' ? 'Job Seeker' : 'Employer';
    $email = strlimiter($row['email'], 12) . "...";
    //$email = $row['email'];
    $sex = $row['sex'];
    $image = $row['image'];
    $status = $row['status'];
    $joined  = date('d M, y', strtotime($row['created_at']));
    if ($image == "")
        $image = "default_user.png";

    if ($status == "0") {
        $status = '<span class="label label-info">ACTIVE</span>';
    } elseif ($status == "1") {
        $status = '<span class="label label-success">VERIFIED</span>';
    } else {
        $status = '<span class="label label-warning">BANNED</span>';
    }
    if ($work_status == 1) {
        $status_work = '<i class="fa fa-circle" style="color:#5cb85c;margin-left: 40px;" aria-hidden="true"></i>';
    } else {
        $status_work = '<i class="fa fa-circle" style="color:#eb2a2acc;margin-left: 40px;" aria-hidden="true"></i>';
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="' . $id . '" id="row_' . $id . '" name="row_' . $id . '"><span></span>
                </label>
            </td>';
    $row1 = '<td class="text-center">
                <div class="pull-left m-r"><img class="img-avatar img-avatar-48" src="../storage/profile/small_' . $image . '"></div><p class="font-500 m-b-0"><a href="#" data-url="panel/user_profile.php?id=' . $id . '" data-toggle="slidePanel"">' . $name . '</a></p>
                <p class="text-muted m-b-0">#' . $username . '</p>
            </td>';
    $row2 = '<td class="hidden-xs text-center"> ' . $status_work . ' </td>';
    $row3 = '<td class="hidden-xs"> ' . $address_city . ' </td>';
    $row4 = '<td class="hidden-xs">' . $amount . ' $</td>';
    $row5 = '<td class="hidden-xs">' . $type . '</td>';
    $row6 = '<td class="hidden-xs">' . $email . '</td>';
    $row7 = '<td class="hidden-xs hidden-sm">' . $sex . '</td>';
    $row8 = '<td class="hidden-xs hidden-sm">' . $status . '</td>';
    $row9 = '<td class="hidden-xs hidden-sm">' . $joined . '</td>';
    if ($row['user_type'] == 'user') {
        $row10 = '<td class="text-center">
        <div class="btn-group">
            <a href="#" data-url="panel/user_profile.php?id=' . $id . '" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-eye"></i></a>
            <a href="#" data-url="panel/users_edit.php?id=' . $id . '" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-xs btn-default item-js-delete" data-ajax-action="deleteusers"><i class="ion-close"></i></a>  
            <a href="users_edit_profile.php?id=' . $id . '" class="btn btn-xs btn-default"> <i class="ion-person"></i></a>
        </div>
        </td>';
    } else {
        $row10 = '<td class="text-center">
        <div class="btn-group">
            <a href="#" data-url="panel/user_profile.php?id=' . $id . '" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-eye"></i></a>
            <a href="#" data-url="panel/users_edit.php?id=' . $id . '" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-xs btn-default item-js-delete" data-ajax-action="deleteusers"><i class="ion-close"></i></a>  
        </div>
        </td>';
    }

    $value = array(
        "DT_RowId" => $id,
        0 => $row0,
        1 => $row1,
        2 => $row2,
        3 => $row3,
        4 => $row4,
        5 => $row5,
        6 => $row6,
        7 => $row7,
        8 => $row8,
        9 => $row9,
        10 => $row10
    );
    $data[] = $value;
}

$json_data = array(
    "draw"            => intval($params['draw']),
    "recordsTotal"    => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
