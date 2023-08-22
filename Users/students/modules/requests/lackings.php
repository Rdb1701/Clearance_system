<?php
include('../../../includes/connection.php');

$res_success = 0;
$res_message = '';
$data = array();

$remarks = array();
$remark_id = '';

$request_id = mysqli_real_escape_string($db, trim($_POST['request_id']));

$query= "
SELECT * FROM remarks
WHERE request_id = '$request_id'

";
$result = mysqli_query($db,$query);
if (mysqli_num_rows($result) > 0) {
 while($row = mysqli_fetch_assoc($result)){
        $res_success = 1;
      
    $remarks = $row['remark_desc'];
    $remark_id = $row['remark_id'];

}
    }else{
        $res_message = "Query Failed";
    }
  
    $convert = nl2br($remarks);

    $data['remark_desc']  = $convert;
    $data['remark_id']    = $remark_id;
    $data['remarks']      = $remarks;
    $data['res_success']  = $res_success;
    $data['res_message']  = $res_message;

    echo json_encode($data);

?>