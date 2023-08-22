<!--------------------------------------- ADD USER  MODAL ------------------------------------------->
<?php


$sql = "SELECT DISTINCT access_right_id, access_name FROM staff_access_right";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_access_right_id'>";
$opt1 .= "<option value='' selected hidden>Select User Type</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='".$row['access_right_id']."'>".$row['access_name']."</option>";
  }

$opt1 .= "</select>";


$query = "SELECT staff_position_id, name FROM staff_position";
$result = mysqli_query($db, $query) or die ("Bad SQL: $query");

$pos1 = "<select class='form-control' id = 'add_position'>";
$pos1 .= "<option value='' selected hidden> Select Position</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $pos1 .= "<option value='".$row['staff_position_id']."'>".$row['name']."</option>";
  }
$pos1 .= "</select>";


?>

<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New User</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_insert">
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
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="add_email">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">User Type <span class="text-danger">*</span></label>
           <?php echo $opt1;  ?>
          </div>
          <div class="md-form" id = "item1">
           
          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


<!--------------------------------------- EDIT USER  MODAL ------------------------------------------->
<?php

$sql = "SELECT DISTINCT access_right_id, access_name FROM staff_access_right";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='type' id = 'edit_access_right_id' required>";
$opt .= "<option value='' selected hidden>Select User Type</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['access_right_id']."'>".$row['access_name']."</option>";
  }

$opt .= "</select>";


$sql = "SELECT DISTINCT staff_position_id, name FROM staff_position";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$pos2 = "<select class='form-control' name='type' id = 'edit_position'>";
$pos2 .= "<option value='' selected hidden>Select User Type</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $pos2 .= "<option value='".$row['staff_position_id']."'>".$row['name']."</option>";
  }

$pos2 .= "</select>";

?>

<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit User</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="form_update">
        <div class="modal-body mx-4">

          <input type="hidden" id="edit_user_id" readonly>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_lname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_fname">
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
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="edit_email">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">User Type <span class="text-danger">*</span></label>
            <?php echo $opt; ?>
          </div>
          <div class="md-form" id = "item2">
           
           </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_edit">SUBMIT</button>
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
