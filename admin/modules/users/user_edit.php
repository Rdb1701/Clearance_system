<?php 
include('../../includes/connection.php');

$staff_id = mysqli_real_escape_string($db, trim($_POST['staff_id']));

$data = array();

$username     = '';
$lname        = '';
$fname        = '';
$gender       = '';
$email        = '';
$access_right_id = '';


$user_types = array();

$query = "
  SELECT *
  FROM staff
  WHERE staff_id = '$staff_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $username     = $row['username'];
  $lname        = $row['lname'];
  $fname        = $row['fname'];
  $gender       = $row['gender'];
  $email        = $row['email'];
  $access_right_id= $row['access_right_id'];


}

$data['staff_id']      = $staff_id;
$data['username']     = $username;
$data['lname']        = $lname;
$data['fname']        = $fname;
$data['gender']       = $gender;
$data['email']        = $email;
$data['access_right_id'] = $access_right_id;



echo json_encode($data);


?>
