<?php
include('../../includes/connection.php');

$course = array();

$query = "
  SELECT * FROM course
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

 
    $temp_arr['course_id']      = $row['course_id'];
    $temp_arr['course_name']    = $row['course_name'];
    $temp_arr['department']     = $row['department'];


    $course[] = $temp_arr;
  }
}

foreach($course as $key => $value){


    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='Edit' class='text-white bg-info'
        onclick='edit_course(".$value['course_id'].")'>
 <i class='bx bx-edit'></i>
      </a>
      <a href='javascript:;' title='Delete' class='text-white bg-danger ms-2'
        onclick='course_delete(".$value['course_id'].")'>
        <i class='bx bx-trash'></i>
      </a>
    </div>
  </td>
    ";
    $data['data'][] = array($value['course_name'],$value['department'],$button);
  }
  
  
  echo json_encode($data);


?>




