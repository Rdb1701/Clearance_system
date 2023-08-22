<?php
include('../../includes/connection.php');

$course = array();

$query = "
  SELECT * FROM items
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $status = "";
    if($row['status'] == 0){
      $status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Active</span>';

    }
    if($row['status'] == 1){
      $status = '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';

    }
 
    $temp_arr['item_id']      = $row['item_id'];
    $temp_arr['item_name']    = $row['item_name'];
    $temp_arr['status']       = $status;

    $course[] = $temp_arr;
  }
}


foreach($course as $key => $value){

  $button_status = "";

  if($value['status'] == '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Active</span>'){

    $button_status = "<a href='javascript:;' title='Inactive' class='text-white bg-secondary ms-2'
    onclick='item_inactive(".$value['item_id'].")'>
    <i class='bx bx-x'></i>
  </a>";
    
  }else{
    $button_status = " <a href='javascript:;' title='Activate' class='text-white bg-success ms-2'
    onclick='item_active(".$value['item_id'].")'>
    <i class='bx bx-check'></i>
  </a>";

  }

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='Edit' class='text-white bg-info'
        onclick='edit_item(".$value['item_id'].")'>
 <i class='bx bx-edit'></i>
      </a>
        ".$button_status."
    </div>
  </td>
    ";
    $data['data'][] = array($value['item_name'],$value['status'],$button);
  }
  
  
  echo json_encode($data);


?>




