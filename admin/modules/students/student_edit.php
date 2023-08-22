<?php 

include('../../includes/connection.php');

$student_id = mysqli_real_escape_string($db, trim($_POST['student_id']));

$data = array();

$username     = '';
$lname        = '';
$fname        = '';
$gender       = '';
$email       = '';
$course       = '';
$year_level   = '';

$user_types = array();

$query = "
  SELECT *
  FROM students
  WHERE student_id = '$student_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $student_id   = $row['student_id'];
  $username     = $row['username'];
  $lname        = $row['lname'];
  $fname        = $row['fname'];
  $gender       = $row['gender'];
  $email        = $row['email'];
  $course_id    = $row['course_id'];
  $year_level   = $row['year_level'];

}

$data['student_id']   = $student_id;
$data['username']     = $username;
$data['lname']        = $lname;
$data['fname']        = $fname;
$data['gender']       = $gender;
$data['email']        = $email;
$data['course']    = $course_id;
$data['year_level']   = $year_level;



echo json_encode($data);


?>
