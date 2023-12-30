<?php
include('../../includes/connection.php');

$users = array();

$query = "
  SELECT
    st.*,
    sar.access_name as sar_access_name, st.staff_id
  FROM staff AS st
  LEFT JOIN staff_access_right AS sar ON st.access_right_id = sar.access_right_id
  ORDER BY st.lname, st.fname ASC
";
// $query = "
//   SELECT
//     u.*,
//     ut.name as ut_name
//   FROM users AS u
//   LEFT JOIN user_types AS ut ON u.user_type_id = ut.user_type_id
//   WHERE u.user_type_id != '1'
//   ORDER BY u.lname, u.fname ASC
// ";

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


    $temp_arr['staff_id']  = $row['staff_id'];
    $temp_arr['username']  = $row['username'];
    $temp_arr['lname']     = $row['lname'];
    $temp_arr['fname']     = $row['fname'];
    $temp_arr['gender']    = $gender_status;
    $temp_arr['email']     = $row['email'];
    $temp_arr['type']      = $row['sar_access_name'];

    $users[] = $temp_arr;
  }
}

foreach($users as $key => $value){
  
    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='Edit User' class='text-white bg-info'
        onclick='edit_user(".$value['staff_id'].")'>
 <i class='bx bx-edit'></i>
      </a>
      <a href='javascript:;' title='Change Password User' class='text-white bg-warning ms-2'
        onclick='list_changepassword(".$value['staff_id'].",\"".$value['username']."\")'>
        <i class='bx bx-key'></i>
      </a>
    </div>
  </td>
    ";
    $data['data'][] = array($value['username'],$value['fname'],$value['lname'], $value['gender'],$value['email'],$value['type'],$button);
  }
  
  
  echo json_encode($data);


?>




