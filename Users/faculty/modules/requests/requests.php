<?php date_default_timezone_set('Asia/Manila');

include('../../../includes/connection.php');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// //PHP MAILER
// require '../../../libraries/PHPMailer/src/Exception.php';
// require '../../../libraries/PHPMailer/src/PHPMailer.php';
// require '../../../libraries/PHPMailer/src/SMTP.php';

$requests = array();

$query = "
SELECT
req.*,
stud.fname, stud.lname, c.course_name,req.student_id, stud.course_id,
stud.year_level,stud.gender, req.staff_id, stud.username
FROM request_transaction as req
LEFT JOIN students as stud ON stud.student_id = req.student_id
LEFT JOIN course as c ON c.course_id = stud.course_id
WHERE req.staff_id = '".$_SESSION['staff']['staff_id']."'
AND (status = '0' or status = '2')
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $req_status = "";
    if($row['status'] == 0){
        $req_status = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';

    }
    if($row['status'] == 1){
        $req_status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Approved</span>';

    }
    if($row['status'] == 2){
        $req_status = '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Lacking(s)</span>';
  
      }

    $temp_arr['student_id']   = $row['student_id'];
    $temp_arr['username']     = $row['username'];
    $temp_arr['request_id']   = $row['request_id'];
    $temp_arr['fname']        = $row['fname'];
    $temp_arr['lname']        = $row['lname'];
    $temp_arr['course_name']  = $row['course_name'];
    $temp_arr['year_level']   = $row['year_level'];
    $temp_arr['status']       = $req_status;
    
    $requests[] = $temp_arr;

  }
}


foreach($requests as $key => $value){
$count_accept = 0;
$count_all    = 0;
$remark_button = '';

//REMARK BUTTON CHANGE
if($value['status'] == '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Lacking(s)</span>'){

  $remark_button = " </a>&nbsp;&nbsp;
  <a href='javascript:;' title='Edit Remark' class='text-white bg-primary' 
      onclick='edit_request(".$value['request_id'].")'>
<i class='bx bx-edit'></i>
  </a>";

}else{
  $remark_button = " </a>&nbsp;&nbsp;
  <a href='javascript:;' title='reject' class='text-white bg-danger' 
      onclick='reject_request(".$value['request_id'].")'>
<i class='bx bx-user-x'></i>
  </a>";

}

    //GET APPROVED ITEMS COUNT
$query_count_accept = "SELECT COUNT(*) FROM request_transaction WHERE student_id = '".$value['student_id']."'
AND status = '1'
";

$result_accept = mysqli_query($db, $query_count_accept) or die(mysqli_error($db));
while ($row = mysqli_fetch_array($result_accept)) {
    $count_accept = $row[0];
    }

//GET COUNT ALL
$query_count_all = "SELECT COUNT(*) FROM request_transaction WHERE student_id = '".$value['student_id']."'
";
$result_all = mysqli_query($db, $query_count_all) or die(mysqli_error($db));
while ($row = mysqli_fetch_array($result_all)) {
    $count_all = $row[0];
  }


if($_SESSION['staff']['sp_name'] == ''){
        if($count_all - 1 == $count_accept){
$button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='approve' class='text-white bg-success'
        onclick='accept_dean_request(".$value['request_id'].",".$value['student_id'].")'>
 <i class='bx bx-user-check'></i>
    </a>
    $remark_button
    </div>
  </td>
    ";
}else{
$button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
        <a href='javascript:;' title='approve' class='text-white bg-success' style='pointer-events: none; opacity: 0.5;'
        onclick='accept_request(".$value['request_id'].")'>
    <i class='bx bx-user-check'></i>
    </a>
    $remark_button
    </div>
    </td>
    ";
}

}else{
$button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='approve' class='text-white bg-success'
        onclick='accept_request(".$value['request_id'].",".$value['student_id'].")'>
 <i class='bx bx-user-check'></i>
    </a>
    $remark_button
    </div>
  </td>
    ";
}

$data['data'][] = array($value['username'], $value['fname'].' '.$value['lname'],$value['course_name'],$value['year_level'],$value['status'],$button);

}

echo json_encode($data);
