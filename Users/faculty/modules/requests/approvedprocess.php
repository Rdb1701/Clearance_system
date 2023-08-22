<?php date_default_timezone_set('Asia/Manila');

include('../../../includes/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../../libraries/PHPMailer/src/Exception.php';
require '../../../libraries/PHPMailer/src/PHPMailer.php';
require '../../../libraries/PHPMailer/src/SMTP.php';


$data = array();
$res_success = 0;
$res_message = '';
$student_id = mysqli_real_escape_string($db, trim($_POST['stud_id']));
$request_id = mysqli_real_escape_string($db, trim($_POST['request_id']));

$email_stud = '';
$fname = '';


//GETTING EMAIL AND NAME OF THE STUDENT
$query = "
SELECT req.*, stud.email, stud.student_id, stud.fname, stud.course_id,stud.lname, stud.year_level, stud.gender
from request_transaction as req
LEFT JOIN students as stud ON stud.student_id = req.student_id
LEFT JOIN course as c ON c.course_id = stud.course_id
WHERE stud.student_id = '" . $student_id . "'";

$result = $db->query($query);
$numRows = $result->num_rows;

if ($numRows > 0) {

    $row = $result->fetch_assoc();

    $email_stud = $row['email'];
    $fname = strtoupper($row['fname']);
}

//GETING ITEM ID PER STAFF USER

$item_name = '';
$query_staff = "
SELECT
st.*, c.course_name, i.item_name
FROM staff as st
LEFT JOIN course as c ON c.course_id = st.dean_course_id
LEFT JOIN items as i ON i.item_id = st.item_id
WHERE st.staff_id = '" . $_SESSION['staff']['staff_id'] . "'

";

$result_staff = $db->query($query_staff);
$numRows = $result_staff->num_rows;

if ($numRows > 0) {
    $row = $result_staff->fetch_array();
    $item_name = $row['item_name'] ? $row['item_name'] : '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">' . $row['course_name'] . ' Dean</span>';;
}


//UPDATE FOR APPROVE
$query = "
UPDATE request_transaction
SET 
status = '1'
WHERE request_id = '$request_id'
";

if ($db->query($query)) {

    $res_success = 1;

    $sql_delete = "
    DELETE FROM
    remarks
    WHERE request_id = '$request_id'
    ";  

    $db->query($sql_delete);


} else {
    $res_message = "Query Updating Failed!";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);
