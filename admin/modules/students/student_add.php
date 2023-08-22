<?php date_default_timezone_set('Asia/Manila');

include('../../includes/connection.php');


$username    = mysqli_real_escape_string($db, trim($_POST['username']));
$lname       = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname       = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender      = mysqli_real_escape_string($db, trim($_POST['gender']));
$email      = mysqli_real_escape_string($db, trim($_POST['email']));
$year_level  = mysqli_real_escape_string($db, trim($_POST['year_level']));
$course      = mysqli_real_escape_string($db, trim($_POST['course']));

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM students as stud
LEFT JOIN course as c ON stud.course_id = c.course_id
 WHERE username = '$username' OR email = '$email'
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO students(username,
        password,
        fname,
        lname,
        gender,
        year_level,
        email,
        course_id) VALUES('$username',
        '".md5($username)."',
        '$fname',
        '$lname',
        '$gender',
        '$year_level',
        '$email',
        '$course'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed";
    }

} else {
    $res_message = "Username OR Email already Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);





?>