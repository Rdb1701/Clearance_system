<?php
include('../header.php');
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>User</h1>
    </i>
    <div style="flex: 1;"></div>
    <button class="btn btn-sm btn-rasied btn-primary " onclick="add_user()"><i class="bx bx-plus"></i>Add User</button>
</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table" id="myTable">
                    <thead class="table-light">
                        <tr>

                            <th class="text-center">Username</th>
                            <th class="text-center">Firstname</th>
                            <th class="text-center">Lastname</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Access Right</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>


<?php
include('../footer.php');
include('modals/user_modal.php');
?>


<script>
    function add_user() {
        $('#list_add_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#list_add_modal').modal('show');
    }

    //------------------------------CHANGE PASSWORD----------------------------------//
    function list_changepassword(staff_id, username) {

        $('#cp_id').val(staff_id);
        $('#cp_username').val(username);
        $('#changepassword_modal').modal('show');

    }


    // -------------------------------EDIT USER --------------------------------//

    function edit_user(staff_id) {

        $.ajax({
            url: 'users/user_edit.php',
            type: 'POST',
            data: {
                staff_id: staff_id
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_edit').prop("disabled", true);
            }
        }).done(function(res) {

            let html = '';

            html += (res.gender == '1') ? '<option value="1" selected >Male</option>' : '<option value="1">Male</option>';
            html += (res.gender == '0') ? '<option value="0" selected >Female</option>' : '<option value="0">Female</option>';
            $("#edit_gender").val(res.gender);

            $("#edit_user_id").val(res.staff_id);
            $("#edit_username").val(res.username);
            $("#edit_lname").val(res.lname);
            $("#edit_fname").val(res.fname);
            $("#edit_email").val(res.email);
            $('#btn_edit').prop("disabled", false);
            $('#list_edit_modal').modal('show');

        })


    }

    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'users/user.php', // API endpoint to fetch data
            columns: [{
                    data: [0],
                    "className": "text-center"
                },
                {
                    data: [1],
                    "className": "text-center"
                },
                {
                    data: [2],
                    "className": "text-center"
                },
                {
                    data: [3],
                    "className": "text-center"
                },
                {
                    data: [4],
                    "className": "text-center"
                },
                {
                    data: [5],
                    "className": "text-center"
                },
                {
                    data: [6],
                    "className": "text-center"
                }
            ]
        });

        //ONCHANGE

        $('#add_access_right_id').change(function(){
            let avalue = this.value;

            if(avalue == 2){
                $('#item1').html(`
                
                    <?php
                    $sql = "SELECT item_id, item_name FROM items";
                    $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

                    $opt3 = "<select class='form-control' name='type' id = 'add_item_id' required>";
                    $opt3 .= "<option value='' selected hidden>Select Item</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $opt3 .= "<option value='".$row['item_id']."'>".$row['item_name']."</option>";
                    }
                    $opt3 .= "</select>";
                    ?>

                <label data-error="wrong" data-success="right">Select Item<span class="text-danger">*</span></label>
                <?php echo $opt3;  ?>
                <input type="hidden" id="add_course_id" readonly>
                
                `)
            }else if(avalue == 3){
                    $('#item1').html(`
                    
                    <?php
                    $sql = "SELECT course_id, course_name FROM course";
                    $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

                    $opt4 = "<select class='form-control' name='type' id = 'add_course_id' required>";
                    $opt4 .= "<option value='' selected hidden>Select Dean Course</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $opt4 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
                    }
                    $opt4 .= "</select>";
                    ?>

                <label data-error="wrong" data-success="right">Dean Course<span class="text-danger">*</span></label>
                <?php echo $opt4;  ?>
                <input type="hidden" id="add_item_id" readonly>
                
            `)
            }else{

                $('#item1').html(`
                <input type="hidden" id="add_item_id" readonly>
                <input type="hidden" id="add_course_id" readonly>
                `);

            }
        })



        $('#edit_access_right_id').change(function(){
            let avalue = this.value;

            if(avalue == 2){
                $('#item2').html(`
                
                    <?php
                    $sql = "SELECT item_id, item_name FROM items";
                    $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

                    $opt3 = "<select class='form-control' name='type' id = 'edit_item_id' required>";
                    $opt3 .= "<option value='' selected hidden>Select Item</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $opt3 .= "<option value='".$row['item_id']."'>".$row['item_name']."</option>";
                    }
                    $opt3 .= "</select>";
                    ?>

                <label data-error="wrong" data-success="right">Select Item<span class="text-danger">*</span></label>
                <?php echo $opt3;  ?>
                <input type="hidden" id="edit_course_id" readonly>
                
                `)
            }else if(avalue == 3){
                    $('#item2').html(`
                    
                    <?php
                    $sql = "SELECT course_id, course_name FROM course";
                    $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

                    $opt4 = "<select class='form-control' name='type' id = 'edit_course_id' required>";
                    $opt4 .= "<option value='' selected hidden>Select Dean Course</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $opt4 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
                    }
                    $opt4 .= "</select>";
                    ?>

                <label data-error="wrong" data-success="right">Dean Course<span class="text-danger">*</span></label>
                <?php echo $opt4;  ?>
                <input type="hidden" id="edit_item_id" readonly>
                
            `)
            }else{

                $('#item2').html(`
                <input type="hidden" id="edit_item_id" readonly>
                <input type="hidden" id="edit_course_id" readonly>
                `);

            }
        })




        //-------------------------------------------- ADD USER SUMBIT ---------------------------------------//
        $('#form_insert').on('submit', function(e) {
            e.preventDefault();

            let username = $('#add_username').val();
            let lname = $('#add_lname').val();
            let fname = $('#add_fname').val();
            let gender = $('#add_gender').val();
            let email = $('#add_email').val();
            let access_right_id = $('#add_access_right_id').val();
            let item_id = $('#add_item_id').val();
            let course_id = $('#add_course_id').val();

            let errors = new Array();
            let input = "Please Input";

            if (username == '') {
                errors.push('Username');
            }
            if (lname == '') {
                errors.push('Last Name');
            }
            if (fname == '') {
                errors.push('First Name');
            }
            if (gender == '') {
                errors.push('Gender');
            }
            if (email == '') {
                errors.push('Email');
            }
            if (access_right_id == '') {
                errors.push('User Type');
            }
            if (errors.length > 0) {
                let error = '';
                $.each(errors, function(key, value) {
                    if (error == '') {
                        error += '• ' + value;
                    } else {
                        error += '\n• ' + value;
                    }
                });
                alert(input + '\n' + error);
            } else {

                $.ajax({
                    url: 'users/add_user.php',
                    type: 'POST',
                    data: {
                        username: username,
                        fname: fname,
                        lname: lname,
                        gender: gender,
                        email: email,
                        access_right_id: access_right_id,
                        item_id : item_id,
                        course_id : course_id
                    },
                    dataType: 'JSON',
                    beforeSend: function() {

                    }
                }).done(function(res) {
                    if (res.res_success == 1) {
                        alert('Your password is your username');
                        var currentPageIndex = table.page.info().page;
                        table.ajax.reload(function() {
                            table.page(currentPageIndex).draw(false);
                        }, false);

                        $('#list_add_modal').modal('hide');
                    } else {
                        alert(res.res_message);
                    }

                }).fail(function() {
                    console.log('fail')
                })

            }
        })


        // ---------------------UPDATE edit user----------------------------------------//

        $('#form_update').on('submit', function(e) {
            e.preventDefault();

            let staff_id = $('#edit_user_id').val();
            let lname = $('#edit_lname').val();
            let fname = $('#edit_fname').val();
            let gender = $('#edit_gender').val();
            let email = $('#edit_email').val();
            let access_right_id = $('#edit_access_right_id').val();
            let position = $('#edit_position').val();
            let item_id = $('#edit_item_id').val();
            let course_id = $('#edit_course_id').val();

            let errors = [];
            let input = "Please Input";

            if (lname == '') {
                errors.push('Last Number')
            }
            if (fname == '') {
                errors.push('First Name')
            }
            if (email == '') {
                errors.push('Email')
            }
            if (access_right_id == '') {
                errors.push('user_type')
            }
            if (errors.length > 0) {
                let error = '';
                $.each(errors, function(key, value) {
                    if (error == '') {
                        error += '• ' + value;
                    } else {
                        error += '\n• ' + value;
                    }
                });
                alert(input + '\n' + error);
            } else {

                $.ajax({

                    url: 'users/user_update.php',
                    type: 'POST',
                    data: {
                        staff_id: staff_id,
                        lname: lname,
                        fname: fname,
                        gender: gender,
                        email: email,
                        access_right_id: access_right_id,
                        course_id : course_id,
                        item_id : item_id
                    },
                    dataType: 'JSON',
                    beforeSend: function() {

                    }
                }).done(function(res) {
                    if (res.res_success == 1) {
                        alert('Update Information')
                        var currentPageIndex = table.page.info().page;
                        table.ajax.reload(function() {
                            table.page(currentPageIndex).draw(false);
                        }, false);

                        $('#list_edit_modal').modal('hide');
                    } else {
                        alert(res.res_message);
                    }
                }).fail(function() {
                    console.log('Fail!');
                });
            }
        })

        // -----------------------CHANGE PASSWORD AJAX----------------------------- //
        $('#d_form_cp').on('submit', function(e) {
            e.preventDefault();

            let staff_id = $('#cp_id').val();
            let new_password = $('#cp_new_password').val()
            let re_new_password = $('#cp_re_new_password').val()

            if (new_password == '' || re_new_password == '') {
                alert('Please input Password')
            } else if (new_password != re_new_password) {
                alert('Password do not match!')

            } else if (new_password == re_new_password) {

                $.ajax({
                    url: 'users/user_changepass.php',
                    type: 'POST',
                    data: {
                        staff_id: staff_id,
                        new_password: new_password,
                        re_new_password: re_new_password,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {

                    }
                }).done(function(res) {
                    if (res.res_success == 1) {
                        alert('Password Changed!');
                        $('#changepassword_modal').modal('hide');
                    } else {
                        alert('Invalid Password!');

                    }
                })

            }


        })




    })
</script>