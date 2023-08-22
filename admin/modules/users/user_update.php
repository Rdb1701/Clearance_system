<?php

date_default_timezone_set('Asia/Manila');

include('../../includes/connection.php');;

 
$staff_id        = mysqli_real_escape_string($db, trim($_POST['staff_id']));
$lname           = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname           = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender          = mysqli_real_escape_string($db, trim($_POST['gender']));
$email           = mysqli_real_escape_string($db, trim($_POST['email']));
$access_right_id = mysqli_real_escape_string($db, trim($_POST['access_right_id']));
$course_id       = mysqli_real_escape_string($db, trim($_POST['course_id']));
$item_id         = mysqli_real_escape_string($db, trim($_POST['item_id']));


$data = array();
$res_success = 0;
$res_message = '';

$query = "
SELECT *
FROM staff st
LEFT JOIN staff_access_right sar ON st.access_right_id = sar.access_right_id
ORDER by st.staff_id ASC
 ";
 
 $result = mysqli_query($db,$query);
 if(mysqli_num_rows($result)> 0){

    $query = "
    UPDATE staff
    SET
    lname = '$lname',
    fname =  '$fname',
    gender = '$gender ',
    email = '$email',
    access_right_id = '$access_right_id',
    item_id = '$item_id',
    dean_course_id = '$course_id'
    WHERE staff_id = '$staff_id'
    ";

    if(mysqli_query($db, $query)){
        $res_success = 1;

    }else{
        $res_message = "Query Failed";
    }

 }else{

    $res_message = 'Username does not exists!';
 }

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
