<?php

$cleared = array();

$query = "
SELECT DISTINCT req.sem, req.school_year, req.student_id
FROM request_transaction as req
LEFT JOIN students as stud ON stud.student_id = req.student_id
LEFT JOIN course as c ON c.course_id = stud.course_id
WHERE req.student_id = '".$_SESSION['student']['student_id']."'
and after_status = '1'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
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
      
      $temp_arr['student_id']   = $row['student_id'];
      $temp_arr['sem']          = $sem;
      $temp_arr['school_year']  = $row['school_year'];

      $cleared[] = $temp_arr;
      }
    }


?>