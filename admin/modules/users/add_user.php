<?php date_default_timezone_set('Asia/Manila');

include('../../includes/connection.php');


$username   = mysqli_real_escape_string($db, trim($_POST['username']));
$lname      = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname      = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender     = mysqli_real_escape_string($db, trim($_POST['gender']));
$email      = mysqli_real_escape_string($db, trim($_POST['email']));
$access_right_id = mysqli_real_escape_string($db, trim($_POST['access_right_id']));
$item_id   = mysqli_real_escape_string($db, trim($_POST['item_id']));
$course_id   = mysqli_real_escape_string($db, trim($_POST['course_id']));

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM staff
WHERE username = '$username' OR email = '$email'
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO staff(username,
        password,
        fname,
        lname,
        gender,
        email,
        access_right_id,
        item_id,
        dean_course_id) VALUES('$username',
        '".md5($username)."',
        '$fname',
        '$lname',
        '$gender',
        '$email',
        '$access_right_id',
        '$item_id',
        '$course_id'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed";
    }

} else {
    $res_message = "Username or Email already Exists ";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);





?>