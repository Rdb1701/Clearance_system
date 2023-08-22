<?php
include('../header.php');
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
  <i class="bx" style="margin-right: 8px;">
    <h1>Course</h1>
  </i>
  <div style="flex: 1;"></div>
  <button class="btn btn-sm btn-rasied btn-primary " data-bs-toggle="modal" data-bs-target="#list_add_modal"><i class="bx bx-plus"></i>Add Course</button>
</h5>
<!-- <input type="text" name="search" id="search" class="form-control" placeholder="Search"><br> -->
<div class="card radius-10">
  <div class="card-body">
    <div class="table-responsive">
      <form action="list.php" method="post">
        <table class="table" id="myTable">
          <thead class="table-light">
            <tr>
              <th class="text-center">Course</th>
              <th class="text-center">Department</th>
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
include('modals/modal_course.php');
?>

<script>

//DELETE COURSE
function course_delete(course_id){
  $('#delete_id').val(course_id);
  $('#delete_modal').modal('show');
}


//EDIT COURSE
  function edit_course(course_id){
    $.ajax({
            url: 'course/course_edit.php',
            type: 'POST',
            data: {
                course_id: course_id
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_edit').prop("disabled", true);
            }
        }).done(function(res) {

  
            $("#edit_course_id").val(res.course_id);
            $("#edit_course").val(res.course);
            $("#edit_department").val(res.department);
            $('#list_edit_modal').modal('show');

        })



  }
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#myTable').DataTable({
      ajax: 'course/course.php', // API endpoint to fetch data
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
        }
      ]
    });

    $('#form_insert').submit(function(e) {
      e.preventDefault();
      let course = $('#add_course').val();
      let department = $('#add_department').val();

      $.ajax({
        url: 'course/course_add.php',
        type: 'POST',
        data: {
          course     : course,
          department : department

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Added');

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


    })

    $('#form_update').submit(function(e){
      e.preventDefault();


      let course = $('#edit_course').val();
      let department = $('#edit_department').val();
      let course_id = $('#edit_course_id').val();

      $.ajax({
        url: 'course/course_update.php',
        type: 'POST',
        data: {
          course     : course,
          department : department,
          course_id : course_id

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Updated');

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


    })


    //DELETE COURSE

    $('#delete_form').submit(function(e){
      e.preventDefault();

      let delete_id = $('#delete_id').val();

      $.ajax({
        url: 'course/course_delete.php',
        type: 'POST',
        data: {
          course_id   : delete_id
       
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Deleted');

          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);
          $('#delete_modal').modal('hide');

        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('fail')
      })
    })

    //DOCUMENT READY
  })
</script>