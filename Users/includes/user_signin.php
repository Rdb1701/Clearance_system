<?php

include('connection.php');


    $data        = array();
    $res_success = 0;
    $res_message = 0;
    $errors = array();


    $us = mysqli_escape_string($db, trim($_POST['username']));
    $pw = mysqli_escape_string($db, trim($_POST['password']));
    $opt = mysqli_escape_string($db, trim($_POST['options']));

  if(empty($us)){
    array_push($errors, "Username is Required");
  }
  if(empty($pw)){
    array_push($errors, "Password is Required");
  }
  if(empty($opt)){
    array_push($errors, "Log in Type is Required");
  }
  if(count($errors) == 0){

    // IF LOG IN AS STUDENT
    if($opt == 1){
      $query = "
      SELECT 
      stud.*,
      c.course_name AS c_course_name
      FROM students AS stud
      LEFT JOIN course as c ON c.course_id = stud.course_id
      WHERE
      stud.username = '$us'
      AND stud.password = '".md5($pw)."'
        ";
    
        $result = mysqli_query($db, $query) or die ('Error in Inserting users in '. $query);
        if (mysqli_num_rows($result) == 1) {
          //log user in
                 $res_success          = 1; 
                $row = mysqli_fetch_array($result);
                $_SESSION['student']     = $row;

              
        }else{
            array_push($errors, "Wrong username/password combination");
    
          }
    }

    //IF  LOG IN AS FACULTY
   if($opt == 2 || $opt == 3){

      $query = "
      SELECT
        st.*,
        i.item_name AS sp_name
      FROM staff AS st
      LEFT JOIN items as i ON i.item_id = st.item_id
      WHERE
        st.username = '$us'
        AND st.password = '".md5($pw)."'
    ";

      $result = mysqli_query($db, $query) or die ('Error in Inserting users in '. $query);
      if (mysqli_num_rows($result) == 1) {
        //log user in
              $res_success          = 1;           
              $row = mysqli_fetch_array($result);

              $_SESSION['staff']     = $row;
            
             
      }else{
          array_push($errors, "Wrong username/password combination");
  
         }
      }

    }
    

  $data['post'] = $_POST;
  $data['res_success'] = $res_success;
  $data['res_message'] = $errors;
 

    print_r(json_encode($data));

?>