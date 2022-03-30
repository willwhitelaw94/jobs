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
    1 =>'name',
    2 =>'expiry_date',
    3 =>'upload',
    4 =>'registration_number',
    5 =>'created_at',
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( name LIKE '".$params['search']['value']."%' ";
    $where .=" OR expiry_date LIKE '".$params['search']['value']."%' ";
    $where .=" OR upload LIKE '".$params['search']['value']."%' ";
    $where .=" OR registration_number LIKE '".$params['search']['value']."%' ";
    $where .=" OR created_at LIKE '".$params['search']['value']."%' ";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."requirements` ";
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
    $name = $row['name'];
    $expiry_date = $row['expiry_date'];
        if ($expiry_date == "1"){
            $expiry_date = '<i class="fa fa-check" aria-hidden="true" style="color:green"></i>';
        }
        elseif($expiry_date == "0")
        {
            $expiry_date = '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
        }
        else
        {
            $expiry_date = '<span class="label label-danger">NULL</span>';
        }
    $upload = $row['upload'];
        if ($upload == "1"){
            $upload = '<i class="fa fa-check" aria-hidden="true" style="color:green"></i>';
        }
        elseif($upload == "0")
        {
            $upload = '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
        }
        else
        {
            $upload = '<span class="label label-danger">NULL</span>';
        }
    $registration = $row['registration_number'];
        if ($registration == "1"){
            $registration = '<i class="fa fa-check" aria-hidden="true" style="color:green"></i>';
        }
        elseif($registration == "0")
        {
            $registration = '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
        }
        else
        {
            $registration = '<span class="label label-danger">NULL</span>';
        }
    $creat = $row['created_at'];

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td class="hidden-xs">'.$name.'</td>';
    $row2 = '<td class="hidden-xs">'.$expiry_date.'</td>';
    $row3 = '<td class="hidden-xs">'.$upload.'</td>';
    $row4 = '<td class="hidden-xs">'.$registration.'</td>';
    $row5 = '<td class="hidden-xs hidden-sm">'.$creat.'</td>';
    $row6 = '<td class="text-center">
        <div class="btn-group">
            <a href="#" data-url="panel/requirement_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-xs btn-default item-js-delete" data-ajax-action="deleteRequirement"><i class="ion-close"></i></a>  
        </div>
        </td>';
    
    $value = array(
        "DT_RowId" => $id,
        0 => $row0,
        1 => $row1,
        2 => $row2,
        3 => $row3,
        4 => $row4,
        5 => $row5,
        6 => $row6
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

