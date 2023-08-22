<?php
include('../header.php');
?>


<h5 class="d-flex" style="margin-bottom: 15px;">
  <i class="bx" style="margin-right: 8px;">
    <h1>Students</h1>
  </i>
  <div style="flex: 1;"></div>
  <button class="btn btn-sm btn-rasied btn-primary " data-bs-toggle="modal" data-bs-target="#list_add_modal"><i class="bx bx-plus"></i>Add Student</button>
</h5>
<!-- <input type="text" name="search" id="search" class="form-control" placeholder="Search"><br> -->
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
              <th class="text-center">Course</th>
              <th class="text-center">Year Level</th>
              <th class="text-center">Email</th>
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
include('modals/modal_student.php');
?>


<script>
  //------------------------------CHANGE PASSWORD----------------------------------//
  function list_changepassword(student_id, username) {

    $('#cp_id').val(student_id);
    $('#cp_username').val(username);
    $('#cp_new_password').val('');
    $('#cp_re_new_password').val('');
    $('#changepassword_modal').modal('show');

  }
  //EDIT STUDENT
  function edit_student(student_id) {

    $.ajax({
      url: 'students/student_edit.php',
      type: 'POST',
      data: {
        student_id: student_id
      },
      dataType: 'JSON',
      beforeSend: function() {
        $('#btn_edit').prop("disabled", true);
      }
    }).done(function(res) {


      $("#edit_gender").val(res.gender);

      $("#edit_student_id").val(res.student_id);
      $("#edit_username").val(res.username);
      $("#edit_lname").val(res.lname);
      $("#edit_fname").val(res.fname);
      $("#edit_email").val(res.email);
      $("#edit_course").val(res.course);
      $("#edit_year").val(res.year_level);
      $('#list_edit_modal').modal('show');

    })

  }


  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#myTable').DataTable({
      ajax: 'students/student.php', // API endpoint to fetch data
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
        },
        {
          data: [7],
          "className": "text-center"
        }
      ]
    });

    //-------------------------------------------- ADD Student SUMBIT ---------------------------------------//
    $('#form_insert_student').on('submit', function(e) {
      e.preventDefault();

      let username = $('#add_username').val();
      let lname = $('#add_lname').val();
      let fname = $('#add_fname').val();
      let gender = $('#add_gender').val();
      let year_level = $('#add_year').val();
      let email = $('#add_email').val();
      let course = $('#add_course').val();

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
      if (year_level == '') {
        errors.push('Year Level');
      }
      if (course == '') {
        errors.push('Course');
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
          url: 'students/student_add.php',
          type: 'POST',
          data: {
            username: username,
            fname: fname,
            lname: lname,
            gender: gender,
            year_level: year_level,
            email: email,
            course: course
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



    //--------------------------------------------UPDATE Student---------------------------------------//
    $('#form_update_student').on('submit', function(e) {
      e.preventDefault();

      let student_id = $('#edit_student_id').val();
      let lname = $('#edit_lname').val();
      let fname = $('#edit_fname').val();
      let gender = $('#edit_gender').val();
      let year_level = $('#edit_year').val();
      let email = $('#edit_email').val();
      let course = $('#edit_course').val();

      let errors = new Array();
      let input = "Please Input";


      if (lname == '') {
        errors.push('Last Name');
      }
      if (fname == '') {
        errors.push('First Name');
      }
      if (gender == '') {
        errors.push('Gender');
      }
      if (year_level == '') {
        errors.push('Year Level');
      }
      if (email == '') {
        errors.push('Email');
      }
      if (course == '') {
        errors.push('Course');
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
          url: 'students/student_update.php',
          type: 'POST',
          data: {
            student_id: student_id,
            fname: fname,
            lname: lname,
            gender: gender,
            year_level: year_level,
            email: email,
            course: course
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Update Information');
            var currentPageIndex = table.page.info().page;
            table.ajax.reload(function() {
              table.page(currentPageIndex).draw(false);
            }, false);

            $('#list_edit_modal').modal('hide');
          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })

      }
    })


    // -----------------------CHANGE PASSWORD AJAX----------------------------- //
    $('#d_form_cp').on('submit', function(e) {
      e.preventDefault();

      let student_id = $('#cp_id').val();
      let new_password = $('#cp_new_password').val()
      let re_new_password = $('#cp_re_new_password').val()

      if (new_password == '' || re_new_password == '') {
        alert('Please input Password')
      } else if (new_password != re_new_password) {
        alert('Password do not match!')

      } else if (new_password == re_new_password) {

        $.ajax({
          url: 'students/student_changepass.php',
          type: 'POST',
          data: {
            student_id: student_id,
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




    //DOCUMENT READY
  })
</script>