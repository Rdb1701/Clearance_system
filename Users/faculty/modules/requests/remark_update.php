<?php
include('../../../includes/connection.php');

$data = array();
$res_success = 0;
$res_message = '';

$remark_id = mysqli_real_escape_string($db, trim($_POST['remark_id']));
$remarks = mysqli_real_escape_string($db, trim($_POST['remarks']));

$query = "
UPDATE remarks
set
remark_desc = '$remarks'
WHERE remark_id = '$remark_id'
";
if(mysqli_query($db, $query)){
    $res_success = 1;

}else{
    $res_message = "Query Failed";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>