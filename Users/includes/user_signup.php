<?php
include('connection.php');



    $data        = array();
    $res_success = 0;
    $res_message = 0;
    $errors = array();
    

    $us         = mysqli_real_escape_string($db, trim($_POST['user2'])); 
    $pw         = mysqli_real_escape_string($db, trim($_POST['pass2']));
    $repw       = mysqli_real_escape_string($db, trim($_POST['repass']));
    $fname      = mysqli_real_escape_string($db, trim($_POST['fname']));
    $mname      = mysqli_real_escape_string($db, trim($_POST['mname']));
    $lname      = mysqli_real_escape_string($db, trim($_POST['lname']));
    $phone      = mysqli_real_escape_string($db, trim($_POST['phone']));
    $gender     = mysqli_real_escape_string($db, trim($_POST['gender']));
    $bday       = mysqli_real_escape_string($db, trim($_POST['bday']));
    $province   = mysqli_real_escape_string($db, trim($_POST['province']));
    $city       = mysqli_real_escape_string($db, trim($_POST['city']));
    $brgy       = mysqli_real_escape_string($db, trim($_POST['barangay']));

    if (empty($us)) {
		array_push($errors, "Username is Required"); // add error to errors array
	}
	if (empty($pw )) {
		array_push($errors, "Password is Required"); // add error to errors array
	}
	if (empty($repw)) {
		array_push($errors, "Repassword is Required"); // add error to errors array
	}
    if (empty($fname)) {
		array_push($errors, "Firstname is Required"); // add error to errors array
	}
    if (empty($lname)) {
		array_push($errors, "lastname is Required"); // add error to errors array
	}
    if (empty($mname)) {
		array_push($errors, "Middlename is Required"); // add error to errors array
	}
    if (empty($phone)) {
		array_push($errors, "Phone Number is Required"); // add error to errors array
	}
    if (empty($gender)) {
		array_push($errors, "Gender is Required"); // add error to errors array
	}
    if (empty($bday)) {
		array_push($errors, "Birthdate Required"); // add error to errors array
	}
    if (empty($province)) {
		array_push($errors, "Province Required"); // add error to errors array
	}
    if (empty($city)) {
		array_push($errors, "City Required"); // add error to errors array
	}
    if (empty($brgy)) {
		array_push($errors, "Barangay Required"); // add error to errors array
	}
	if ($pw != $repw) {
		array_push($errors, "Password do not match");
	}

    if (count($errors) == 0) {
        $passhash = md5($pw);

        $query= "INSERT INTO prospects (username, password, fname, mname, lname, phone, gender, bday, province_id, city_id, barangay_id) VALUES ('$us','$passhash','$fname','$mname','$lname','$phone','$gender','$bday','$province','$city','$brgy')";   

       $result= mysqli_query($db,$query)or die ('Error in Inserting prospects in '. $query);
     
       if($result)
        {
            $res_success=1;
        }
    }     
        

    
    $data['post'] = $_POST;
    $data['res_success'] = $res_success;
    $data['res_message'] = $errors;
 

    print_r(json_encode($data));
 




?>

    