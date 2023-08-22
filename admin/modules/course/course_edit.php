<?php
include('../../includes/connection.php');


$data = array();

extract($_POST);


$department = '';
$course = '';


$query = "
SELECT * FROM course
WHERE course_id = '$course_id'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    $row = $result->fetch_assoc();

    $department = $row['department'];
    $course     = $row['course_name'];
}

$data['course'] = $course;
$data['department'] = $department;
$data['course_id']  = $course_id;


echo json_encode($data);


?>