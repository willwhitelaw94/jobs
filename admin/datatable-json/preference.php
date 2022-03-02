<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $order = $totalRecords = $data = array();
$params = $_REQUEST;
if($params['draw'] == 1)
    $params['order'][0]['dir'] = "desc";
//define index of column
$columns = array(
    0 =>'p.id',
    1 =>'p.question',
    2 =>'p.created_at',  
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ){
    $where .=" WHERE ";
    $where .=" (p.name LIKE '%".$params['search']['value']."%' ";  
}
$sql = "SELECT p.id,p.question,p.created_at
 FROM `".$config['db']['pre']."preferences` as p ";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {
    $sqlTot .= $where;
    $sqlRec .= $where;
}

$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";

//echo $sqlRec;
$queryTot = $pdo->query($sqlTot);
$totalRecords = $queryTot->rowCount();
$queryRecords = $pdo->query($sqlRec);
//die('dbdjfh');
//iterate on results row and create new index array of data
$preferenceOption='';

foreach ($queryRecords as $row) {
    $id = $row['id'];
    $preferenceOptions = ORM::for_table($config['db']['pre'] .'preference_options')->where('preference_id',$row['id'])->find_array();
    //$preferenceOption=implode('<span>',array_column($preferenceOptions,'name'))."</span>";
    $preferenceOption="<span class='label label-info label-rounded'>" . implode("</span>&nbsp;<span class='label label-info label-rounded'>", array_column($preferenceOptions,'name')) . "</span>";
  
    $question = $row['question'];
    $created_at = $row['created_at'];
    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 =  '<td class="hidden-xs">'.$id.'</td>';
    $row2 = '<td class="hidden-xs">'.$question.'</td>';
    $row3 = '<td class="hidden-xs " ><div class="lable_bg_c">'.$preferenceOption.'</div></td>';
    $row4 = '<td class="hidden-xs">'.$created_at.'</td>';
    $row5 = '<td class="text-center">
        <div class="btn-group">
            <a href="#" data-url="panel/preference_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
            <a href="javascript:void(0)" class="btn btn-xs btn-default item-js-delete" data-ajax-action="deletePreference"><i class="ion-close"></i></a>
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
      
    );
    $data[] = $value;
   // print_r($value);

}

$json_data = array(
    "draw"            => intval( $params['draw'] ),
    "recordsTotal"    => intval( $totalRecords ),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

