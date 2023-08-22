
<?php

include('../../includes/connection.php');
$faculties = array();

$query = "
SELECT
st.*, c.course_name, i.item_name
FROM staff as st
LEFT JOIN course as c ON c.course_id = st.dean_course_id
LEFT JOIN items as i ON i.item_id = st.item_id
WHERE st.access_right_id != '1'
ORDER by st.lname ASC";


$result = mysqli_query($db, $query);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

        $temp_arr = array();

        $temp_arr['fname']       = $row['fname'];
        $temp_arr['lname']       = $row['lname'];
        $temp_arr['email']       = $row['email'];
        $temp_arr['course_name'] = $row['course_name'];
        $temp_arr['item_name']   = $row['item_name'] ? $row['item_name'] : '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Dean</span>';

        $faculties[] = $temp_arr;
    }


}

foreach($faculties as $key => $value){


 $data['data'][] =  array($value['fname'], $value['lname'], $value['email'], $value['course_name'].$value['item_name']);

}

echo json_encode($data);



?>