<?php
include('../../includes/connection.php');

$students = array();

$query = "
  SELECT
    stud.*,
    c.course_name
  FROM students AS stud
  LEFT JOIN course AS c ON c.course_id = stud.course_id
  ORDER BY stud.lname, stud.fname ASC
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();


    $gender_status = "";
    if($row['gender'] == 0){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Female</span>';

    }
    if($row['gender'] == 1){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Male</span>';

    }

    $temp_arr['student_id']  = $row['student_id'];
    $temp_arr['username']    = $row['username'];
    $temp_arr['lname']       = $row['lname'];
    $temp_arr['fname']       = $row['fname'];
    $temp_arr['gender']      = $gender_status;
    $temp_arr['email']       = $row['email'];
    $temp_arr['year_level']  = $row['year_level'];
    $temp_arr['course']      =  $row['course_name'];

    $students[] = $temp_arr;
  }
}

foreach($students as $key => $value){

     $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='Edit User' class='text-white bg-info'
        onclick='edit_student(".$value['student_id'].")'>
 <i class='bx bx-edit'></i>
      </a>
      <a href='javascript:;' title='Change Password User' class='text-white bg-warning ms-2'
        onclick='list_changepassword(".$value['student_id'].",\"".$value['username']."\")'>
        <i class='bx bx-key'></i>
      </a>
    </div>
  </td>
  ";

  $data['data'][] =  array($value['username'], $value['fname'], $value['lname'], $value['gender'],$value['course'], $value['year_level'], $value['email'],$button);

}

echo json_encode($data);


?>




