<!--------------------------------------- ADD STUDENT MODAL ------------------------------------------->
<?php

$sql = "SELECT course_id, course_name FROM course";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_course'>";
$opt1 .= "<option value='' selected hidden>Select Course</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
  }

$opt1 .= "</select>";

?>

<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New Student</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="form_insert_student">
        <div class="modal-body mx-4">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_username">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_fname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_lname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="add_gender">
              <option value="" selected hidden>- Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Year <span class="text-danger">*</span></label>
            <select class='form-control' id="add_year">
              <option value="" selected hidden>- Select year</option>
              <option value="1">1st Year</option>
              <option value="2">2nd Year</option>
              <option value="3">3rd Year</option>
              <option value="4">4th Year</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="add_email">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Course <span class="text-danger">*</span></label>
           <?php echo $opt1;  ?>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


<!--------------------------------------- ADD STUDENT MODAL ------------------------------------------->
<?php

$sql = "SELECT course_id, course_name FROM course";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'edit_course'>";
$opt2 .= "<option value='' selected hidden>Select Course</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
  }

$opt2 .= "</select>";

?>

<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit Student</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="form_update_student">
        <div class="modal-body mx-4">

        <input type="hidden" class="form-control validate" id="edit_student_id">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_fname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_lname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_gender">
              <option value="" selected hidden>- Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Year <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_year">
              <option value="" selected hidden>- Select year</option>
              <option value="1">1st Year</option>
              <option value="2">2nd Year</option>
              <option value="3">3rd Year</option>
              <option value="4">4th Year</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="edit_email">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Course <span class="text-danger">*</span></label>
           <?php echo $opt2;  ?>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>

<!-------------------------------------------- Change Password modal ------------------------------------------------->
<div class="modal fade" id="changepassword_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_cp">
        <div class="modal-body mx-4">

          <input type="hidden" id="cp_id" value="">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username</label>

            <input type="text" class="form-control validate" id="cp_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_new_password" required>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Re-enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_re_new_password" required>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" name="signupbtn">SUBMIT</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>