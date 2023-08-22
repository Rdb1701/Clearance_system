<?php date_default_timezone_set('Asia/Manila');

$approved = array();

$query = "
SELECT
req.*,
stud.fname, stud.lname, c.course_name,req.student_id, stud.course_id,
stud.year_level,stud.gender, req.staff_id, stud.username
FROM request_transaction as req
LEFT JOIN students as stud ON stud.student_id = req.student_id
LEFT JOIN course as c ON c.course_id = stud.course_id
WHERE req.staff_id = '".$_SESSION['staff']['staff_id']."'
AND status = '1'
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
    
    $approved[] = $temp_arr;

  }
}


?>