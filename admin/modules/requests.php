<?php
include('../header.php');
?>
<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Requests</h1>
    </i>
    <div style="flex: 1;"></div>
</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form>
                <table class="table" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">ID Number</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Sem</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <!--------------------------- DATATABLE ------------------------------->
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>




<?php
include('../footer.php');
include('modals/modal_requests.php');
?>
<script>
    function clear_request(student_id){
        $('#clear_id').val(student_id);
        $('#clear_modal').modal('show')

    }
    function view_status(student_id) {
        let table = "<thead>";
        table += "<tr>" +
            "<th class=\"text-center\">Designation</th>" +
            "<th class=\"text-center\">Status</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        $.ajax({
            url: 'requests/view_status.php',
            type: 'POST',
            data: {
                student_id: student_id
            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {

                // swal(res.remark_desc ,"","");
                $.each(res.requests, function(key, value) {
                    table += '<tr>' +
                        '<td class="text-center">' + value.item_name + '</td>' +
                        '<td class="text-center">' + value.status + '</td>' +
                        '<tr>'

                    $('#my_table').html(table)
                    $('#course').text(value.course_name + ' - ' + value.year_level);
                })

                $('#status_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
                $('#status_modal').modal('show');
            } else {
                alert(res.res_message)
            }
        })
    }


    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'requests/request.php', // API endpoint to fetch data
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
                }
            ]
        });

        // CLEAR FORM
        $('#clear_form').submit(function(e){
            e.preventDefault();

            let clear_id = $('#clear_id').val();

         $.ajax({
          url: 'requests/clear_request.php',
          type: 'POST',
          data: {
            clear_id : clear_id
          },
          dataType: 'JSON',
          beforeSend: function() {
            
          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Cleared');
            var currentPageIndex = table.page.info().page;
            table.ajax.reload(function() {
              table.page(currentPageIndex).draw(false);
            }, false);

            $('#clear_modal').modal('hide');
          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })


        })

    })
</script>