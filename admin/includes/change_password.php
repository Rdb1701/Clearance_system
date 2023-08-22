<?php

require_once 'connection.php';

$data = array();

$password = mysqli_real_escape_string($db, trim($_POST['password']));

$query  = "
  UPDATE staff
  SET password = '".md5($password)."' 
  WHERE staff_id = '".$_SESSION['admin']['staff_id']."'
";
mysqli_query($db, $query);

echo json_encode($data);

?>
