<?php date_default_timezone_set('Asia/Manila');

include('../../../includes/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../../libraries/PHPMailer/src/Exception.php';
require '../../../libraries/PHPMailer/src/PHPMailer.php';
require '../../../libraries/PHPMailer/src/SMTP.php';

$data = array();
$res_success   = 0;
$res_message   = '';
$request_id    = mysqli_real_escape_string($db, trim($_POST['request_id']));
$remarks       = mysqli_real_escape_string($db, trim($_POST['remarks']));

$email = '';
$name = '';


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


//CHECKING IF REMARKS EXISTS
$query = "
SELECT * FROM remarks
WHERE request_id = '$request_id'
";
$result = mysqli_query($db, $query);
if (!mysqli_num_rows($result)) {

    //GETTING Email NUMBER OF STUDENT
    $query = "
    SELECT req.*, stud.email, stud.student_id, stud.fname
    from request_transaction as req
    LEFT JOIN students as stud ON stud.student_id = req.student_id
    WHERE req.request_id = '" . $request_id . "'";

    $result = mysqli_query($db, $query) or die('Error in Inserting users in ' . $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $email     = $row['email'];
        $name       = strtoupper($row['fname']);
    } else {
        $res_message = "Error query in getting student email";
    }

    //PUTTING A REMARK
    $query = "
    UPDATE request_transaction
    SET 
    status = '2'
    WHERE request_id = '" . $request_id . "'
    ";

    if (mysqli_query($db, $query)) {
        //INSERTING REMARKS
        $sql = "
        INSERT INTO remarks(
         remark_desc,
         request_id)VALUES(
         '$remarks',
         '$request_id'
         )
         ";
        if (mysqli_query($db, $sql)) {
            $res_success = 1; // SUCCESS INDICATOR
            //SENDING EMAIL UPON PUTTING REMARKs
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'asscatcampus@gmail.com';
            $mail->Password = 'wcldkcvfucjjeczf';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('asscatcampus@gmail.com', 'asscatcampus@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "CLEARANCE APPROVAL";
            $mail->Body = "Hi " . $name . "!. Your have lacking requirements on $item_name. Please Log in your account to view. Thank you and goodluck!";
            $mail->send();
        } else {
            $res_message = "Failed";
        }
    } else {
        $res_message = "Query Failed";
    }
} else {

    $res_message = "You Already Putted a Remark";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);
