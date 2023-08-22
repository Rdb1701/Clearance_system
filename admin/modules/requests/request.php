<?php
include('../../includes/connection.php');

$requests = array();

$query = "
  SELECT DISTINCT s.fname, s.lname, rt.student_id, rt.sem, rt.school_year, s.username
  FROM request_transaction as rt
  LEFT JOIN staff as st ON st.staff_id = rt.staff_id
  LEFT JOIN course as c ON c.course_id = st.dean_course_id
  LEFT JOIN items as i ON i.item_id = st.item_id
  LEFT JOIN students as s ON s.student_id = rt.student_id
  LEFT JOIN staff_access_right as str ON str.access_right_id = st.access_right_id
  WHERE clear_status = '0'
 ORDER BY s.lname
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $sem = "";
    if($row['sem'] == 1){
      $sem = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">1st Semester</span>';
    }
    if($row['sem'] == 2){
      $sem = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">2nd Semester</span>';
    }
    if($row['sem'] == 3){
        $sem = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Summer</span>';
    }

    $temp_arr['student_id']     = $row['student_id'];
    $temp_arr['username']     = $row['username'];
    $temp_arr['fname']          = $row['fname'];
    $temp_arr['lname']          = $row['lname'];
    $temp_arr['sem']            = $sem;
    $temp_arr['school_year']    = $row['school_year'];

    $requests[] = $temp_arr;
  }
}

foreach($requests as $key => $value){
  

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='clear' class='text-white bg-success'
        onclick='clear_request(".$value['student_id'].")'>
 <i class='fa fa-clipboard-check'></i>
      </a>
    </div>
  </td>
    ";

    $status= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='View Status' class='text-white bg-warning'
        onclick='view_status(".$value['student_id'].")'>
 <i class='fa fa-eye'></i>
      </a>
    </div>
  </td>
    ";
    
    $data['data'][] = array($value['username'], $value['fname'].' '.$value['lname'],$value['sem'],$status,$button);
  }
  
  echo json_encode($data);

?>