<?php

include('connection.php');

    $data        = array();
    $res_success = 0;
    $res_message = 0;
    $errors = array();

    $us         = mysqli_real_escape_string($db, trim($_POST['username'])); 
    $pw         = mysqli_real_escape_string($db, trim($_POST['password']));

    if (empty($us)) {
		array_push($errors, "Username is Required"); // add error to errors array
	}
	if (empty($pw)) {
		array_push($errors, "Password is Required"); // add error to errors array
	}
	if (count($errors) == 0) {

		
		$query = "
    SELECT * FROM staff
    WHERE
      username = '$us'
      AND password = '".md5($pw)."'
  ";

		$result = mysqli_query($db, $query) or die ('Error in Inserting users in '. $query);
			//log user in
                   
            $numRow = $result->num_rows;

            if($numRow > 0){
              $res_success          = 1;   
              $row = $result->fetch_array();
            $_SESSION['admin']     = $row;
          
           
		}else{
				array_push($errors, "Wrong username/password combination");

	    }
    }

    $data['post'] = $_POST;
    $data['res_success'] = $res_success;
    $data['res_message'] = $errors;
 

    print_r(json_encode($data));

    ?>