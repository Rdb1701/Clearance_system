<?php date_default_timezone_set('Asia/Manila');

include('../../../includes/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../../libraries/PHPMailer/src/Exception.php';
require '../../../libraries/PHPMailer/src/PHPMailer.php';
require '../../../libraries/PHPMailer/src/SMTP.php';

//qr code library
require '../../../libraries/phpqrcode/qrlib.php';

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
    //UDPATING ALL CLEARED AND DATE CLEARED
    $sql = "
    UPDATE request_transaction
    SET
    after_status = '1',
    date_cleared = '" . date("Y-m-d H:i:s") . "'
    WHERE student_id = '$student_id'
    ";

    if ($db->query($sql)) {

        //GETTING QR CODE
        $reference_no = date("Y-m-d H:i:s");
        $res_success = 1;

        $q   =  substr("$reference_no", 0, 4);
        $w   =  substr("$reference_no", 5, -12);
        $e   =  substr("$reference_no", 8, -9);
        $r   =  substr("$reference_no", 11, -6);
        $t   =  substr("$reference_no", 14, -3);
        $y   =  substr("$reference_no", -2);
        // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
        $concatqr = $q . $w . $e . $r . $t . $y;

        //----------------------------------------------GENERATING QR CODE----------------------------------------------------------->
        $tempDir = 'qr_images/';
        $codeContents =  $concatqr;
        // we need to generate filename somehow, 
        // with md5 or with database ID used to obtains $codeContents...
        $fileName = '005_file_' . md5($codeContents) . '.png';

        $pngAbsoluteFilePath = $tempDir . $fileName;
        $urlRelativeFilePath = $tempDir . $fileName;;

        // generating
        if (!file_exists($pngAbsoluteFilePath)) {

            //UPDATING FILE NAME
            $query = "UPDATE request_transaction 
        SET
        qr_image = '$pngAbsoluteFilePath'
        WHERE student_id = '$student_id'
        ";
            mysqli_query($db, $query);
            QRcode::png($codeContents, $pngAbsoluteFilePath);
            $res_success = 1;
        } else {
            $res_message =  'File already generated! We can use this cached file to speed up site on common codes!';
            $res_message = '<hr />';
        }


        //-------------------------------------------------SENDING EMAIL-------------------------------------------------------------------
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'asscatcampus@gmail.com';
        $mail->Password = 'wcldkcvfucjjeczf';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('asscatcampus@gmail.com', 'asscatcampus@gmail.com');
        $mail->addAddress($email_stud);
        $mail->isHTML(true);
        $mail->Subject = "CLEARANCE APPROVAL";
        $mail->Body = "Hi " . $fname . "!. Your request for clearance has been cleared. Please log in to your account for printing your cleared clearance. Thank you and goodluck!";
        $mail->send();


        $sql_delete = "
        DELETE FROM
        remarks
        WHERE request_id = '$request_id'
        ";  
    
        $db->query($sql_delete);
        
    } else {
        $res_message = "Query Updating cleared Student Failed";
    }
} else {
    $res_message = "Query Updating Failed!";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);
