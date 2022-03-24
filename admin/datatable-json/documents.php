<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;
if($params['draw'] == 1)
    $params['order'][0]['dir'] = "desc";
//define index of column
$columns = array(
    0 =>'id',
    1 =>'file_path',
    2 =>'registration_number',
    3 =>'expiry_date',
    4 =>'status',
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( file_path LIKE '".$params['search']['value']."%' ";
    $where .=" OR registration_number LIKE '".$params['search']['value']."%' ";
    $where .=" OR expiry_date LIKE '".$params['search']['value']."%' ";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."user_documents` ";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}


$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

$queryTot = $pdo->query($sqlTot);
$totalRecords = $queryTot->rowCount();
$queryRecords = $pdo->query($sqlRec);

//iterate on results row and create new index array of data
foreach ($queryRecords as $row) {
    //$data[] = $row;
    $id = $row['id'];
    $file = $row['file_path'];
    $registration = $row['registration_number'];
    $expiry_date = $row['expiry_date'];
    $status = $row['status'];

    if ($status == "requested"){
        $status = '<span class="label label-info">REQUESTED</span>';
    }
    elseif($status == "verified")
    {
        $status = '<span class="label label-success">VERIFIED</span>';
    }
    elseif($status == "submitted")
    {
        $status = '<span class="label label-info">SUBMITTED</span>';
    }
    elseif($status == "pending")
    {
        $status = '<span class="label label-info">PENDING</span>';
    }
    elseif($status == "not verified")
    {
        $status = '<span class="label label-danger">NOT VERIFIED</span>';
    }
    elseif($status == "expired")
    {
        $status = '<span class="label label-danger">EXPIRED</span>';
    }
    elseif($status == "exception")
    {
        $status = '<span class="label label-danger">EXCEPTION</span>';
    }
    else{
        $status = '<span class="label label-warning">BANNED</span>';
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td class="text-center">
                <div class="pull-left m-r"><img class="img-avatar img-avatar-48" src="../storage/documt/'.$file.'"></div>
            </td>';
    $row2 = '<td class="hidden-xs">'.$registration.'</td>';
    $row3 = '<td class="hidden-xs">'.$expiry_date.'</td>';
    $row4 = '<td class="hidden-xs hidden-sm">'.$status.'</td>';
    $row5 = '<td class="text-center">
        <div class="btn-group">
            <a href="#" data-url="panel/documents_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-xs btn-default item-js-delete" data-ajax-action="deleteDocuments"><i class="ion-close"></i></a>  
        </div>
        </td>';
  
    $value = array(
        "DT_RowId" => $id,
        0 => $row0,
        1 => $row1,
        2 => $row2,
        3 => $row3,
        4 => $row4,
        5 => $row5
    );
    $data[] = $value;
}

$json_data = array(
    "draw"            => intval( $params['draw'] ),
    "recordsTotal"    => intval( $totalRecords ),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

