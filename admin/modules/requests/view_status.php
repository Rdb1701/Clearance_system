<?php
include('../../includes/connection.php');

$student_id  = mysqli_real_escape_string($db, trim($_POST['student_id']));
$data        = array();
$status      = array();
$res_success = 0;
$res_message = " ";

$requests = array();

$query="
SELECT rt.*, c.course_name , i.item_name, access_name , s.year_level
FROM request_transaction as rt
LEFT JOIN staff as st ON st.staff_id = rt.staff_id
LEFT JOIN course as c ON c.course_id = st.dean_course_id
LEFT JOIN items as i ON i.item_id = st.item_id
LEFT JOIN students as s ON s.student_id = rt.student_id
LEFT JOIN staff_access_right as str ON str.access_right_id = st.access_right_id
WHERE rt.student_id = '$student_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    $temp_arr = array();
    $res_success = 1; 
    while ($row = mysqli_fetch_assoc($result)) {

    $req_status = "";
    if($row['status'] == 0){
        $req_status = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';

    }
    if($row['status'] == 1){
        $req_status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Approved</span>';

    }
    if($row['status'] == 2){
        $req_status = '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Lacking(s)</span>';
  
      }
 
    $temp_arr['request_id']     = $row['request_id'];
    $temp_arr['item_name']      = $row['item_name']? $row['item_name'] : '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">'.$row['course_name'].' Dean</span>';
    $temp_arr['course_name']    = $row['course_name'];
    $temp_arr['year_level']     = $row['year_level'];
    $temp_arr['status']         =  $req_status;

    $status[] = $temp_arr;

    }
}else{
    $res_message = "QUERY FAILED";
}

foreach ($status as $stat) {
    array_push($requests, $stat);  
} 

$data['requests']     = $requests;
$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);

?>