<?php
// include('../../../includes/connection.php');

$requests = array();

$query = "
  SELECT rt.*, c.course_name , i.item_name, access_name
  FROM request_transaction as rt
  LEFT JOIN staff as st ON st.staff_id = rt.staff_id
  LEFT JOIN course as c ON c.course_id = st.dean_course_id
  LEFT JOIN items as i ON i.item_id = st.item_id
  LEFT JOIN staff_access_right as str ON str.access_right_id = st.access_right_id
  WHERE rt.student_id = '".$_SESSION['student']['student_id']."' and clear_status = 0
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $status = "";
    if($row['status'] == 0){
      $status = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';

    }
    if($row['status'] == 1){
      $status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Approved</span>';

    }
    if($row['status'] == 2){
        $status = '<a href="javascript:;" title="Show Lackings" onclick="lackings('.$row["request_id"].')"><span class="btn btn-outline-danger text-black" style="padding: 1px 2px;border-radius: 5px;">&nbsp;<i class="bx bx-notepad"></i></span></a>';
  
      }
 
    $temp_arr['request_id']     = $row['request_id'];
    $temp_arr['item_name']      = $row['item_name']? $row['item_name'] : '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">'.$row['course_name'].' Dean</span>';
    $temp_arr['course_name']    = $row['course_name'];
    $temp_arr['status']       = $status;

    $requests[] = $temp_arr;
  }
}

// foreach($course as $key => $value){

//     $button= "
//     <td class='text-center'>
//     <div class='d-flex justify-content-center order-actions'>
//       <a href='javascript:;' title='Edit' class='text-white bg-info'
//         onclick='edit_item(".$value['item_id'].")'>
//  <i class='bx bx-edit'></i>
//       </a>
//         ".$button_status."
//     </div>
//   </td>
//     ";
//     $data['data'][] = array($value['item_name'],$value['status'],$button);
//   }
  
  
//   echo json_encode($data);





?>