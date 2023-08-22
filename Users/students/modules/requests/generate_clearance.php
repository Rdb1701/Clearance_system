<?php
include('../../../includes/connection.php');
date_default_timezone_set('Asia/Manila');

$dean_id = '';
$data = array();
$res_success = 0;
$res_meesage = '';
$errors = array();
$items = array();


extract($_POST); //extracting POST data


//GETTING THE ITEMS  FOR CLEARANCE
$sql = "
SELECT st.*
FROM staff as st
LEFT JOIN items as i ON i.item_id = st.item_id
WHERE st.item_id != '0' and i.status != '1'
";
$firstresult = $db->query($sql);
$numRows1 = $firstresult->num_rows;

if($numRows1 > 0){
    while($row = $firstresult->fetch_assoc()){
            $temp_arr = array();
        $temp_arr['staff_id'] = $row['staff_id'];

        $items[] =  $temp_arr;
    }
}

foreach($items as $key => $value){

    $first_query = "
    INSERT INTO request_transaction(student_id,
    staff_id,
    sem,
    school_year,
    status,
    date_inserted)VALUES('$student_id',
    '".$value['staff_id']."',
    '$semester',
    '$school_year',
    '0',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    $db ->query($first_query);
    
}



// GETTING DEAN STAFF ID
$query = "
SELECT st.* 
FROM staff as st
LEFT JOIN course as c ON c.course_id = st.dean_course_id
WHERE st.dean_course_id = '".$_SESSION['student']['course_id']."'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    $row = $result->fetch_assoc();

    $dean_id = $row['staff_id'];

}

//INSERTING TO TABLE
$query1 = "
INSERT INTO request_transaction(student_id,
staff_id,
sem,
school_year,
status,
date_inserted)VALUES('$student_id',
'$dean_id',
'$semester',
'$school_year',
'0',
'".date("Y-m-d H:i:s")."'
)
";

if($db->query($query1)){

$res_success = 1;

    
}else{
    $res_meesage = "Failed Query 1";
}


$data['res_success'] = $res_success;
$data['res_message'] = $res_meesage;

echo json_encode($data);

?>