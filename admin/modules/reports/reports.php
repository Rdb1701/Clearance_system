<?php
include('../../includes/connection.php');

$reports = array();

$query = "
SELECT DISTINCT s.fname, s.lname, s.username, c.course_name, req.sem, DATE_FORMAT( req.date_inserted, '%b. %d, %Y'  ) as date_now,
DATE_FORMAT( req.date_cleared, '%b. %d, %Y'  ) as date_cleared, req.date_cleared as reference_no
FROM request_transaction as req
LEFT JOIN students as s ON s.student_id = req.student_id
LEFT JOIN course as c ON c.course_id = s.course_id
ORDER BY date_now DESC
";
$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    while($row = $result->fetch_assoc()){
        $temp_arr = array();

        $semester = '';
        if($row['sem'] == '1'){
        $semester = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">1st Semester</span>';
        }

        if($row['sem'] == '2'){
            $semester = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">2nd Semester</span>';
         }
        
        if($row['sem'] == '3'){
            $semester = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Summer</span>';
        }


        $temp_arr['username']     = $row['username'];
        $temp_arr['fname']        = $row['fname'];
        $temp_arr['lname']        = $row['lname'];
        $temp_arr['sem']          = $semester;
        $temp_arr['course_name']  = $row['course_name'];
        $temp_arr['date_now']     = $row['date_now'];
        $temp_arr['date_cleared'] = $row['date_cleared']? $row['date_cleared'] : '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';
        $temp_arr['reference_no'] = $row['reference_no']? $row['reference_no']: '...';

        $reports[] = $temp_arr;
    }
}

foreach($reports as $key => $value){

    // For the contatanation of the qr/bar code
    $q   = substr($value['reference_no'],0,4);
    $w   = substr($value['reference_no'],5,-12);
    $e   = substr($value['reference_no'],8,-9);
    $r   = substr($value['reference_no'],11,-6);
    $t   = substr($value['reference_no'],14,-3);
    $y   = substr($value['reference_no'],-2);

    // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
    $concatqr =$q.$w.$e.$r.$t.$y;


    $data['data'][] = array($value['username'], $value['fname'].' '. $value['lname'], $value['course_name'],$value['sem'],$value['date_now'],$value['date_cleared'], $concatqr);
}

echo json_encode($data);
