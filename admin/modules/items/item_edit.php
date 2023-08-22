<?php
include('../../includes/connection.php');


$data = array();

extract($_POST);


$item = '';


$query = "
SELECT * FROM items
WHERE item_id = '$item_id'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    $row = $result->fetch_assoc();

    $item     = $row['item_name'];
}

$data['item'] = $item;
$data['item_id']  = $item_id;


echo json_encode($data);


?>