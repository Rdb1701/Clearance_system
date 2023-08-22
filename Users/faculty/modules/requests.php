<?php
include('../header.php');
?>
<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h2>Requests</h2>
    </i>
    <div style="flex: 1;"></div>
    <hr>

</h5>
<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table align-middle mb-0" id="myTable">
                    <!--------------------------------------------- ONCHANGE TABLE --------------------------------------------------->
                    <thead class="table-light">
                        <tr>
                            <!-- <th class="text-center"><input type="checkbox" name="" id="checkAll"></th> -->
                            <th class="text-center">ID Number</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Year Level</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DATATABLE -->
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
include('../footer.php');
include('modals/modal_request.php');
?>


<script>
    //ACCEPT REQUESTS
    function accept_request(request_id, student_id) {
        $("#request_id").val(request_id);
        $('#student_id').val(student_id);
        $('#approve_modal').modal('show')
    }

    //DEAN ACCEPT
    function accept_dean_request(request_id, student_id) {
        $("#request_dean_id").val(request_id);
        $('#student_dean_id').val(student_id);
        $('#approve_dean_modal').modal('show')
    }

    //REMARKS
    function reject_request(request_id) {
        $('#request_remark_id').val(request_id);
        $('#reject_modal').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
        $('#reject_modal').modal('show')

    }

    //-----------------------------------------------------REMARKS EDIT---------------------------------------------------------->
    function edit_request(request_id) {
        $.ajax({
            url: 'requests/remark_edit.php',
            type: 'POST',
            data: {
                request_id: request_id
            },
            dataType: 'JSON',
            beforeSend: function() {}
        }).done(function(res) {
            if (res.res_success == 1) {
                // swal(res.remark_desc ,"","");
                $('#lacking2').val(res.remarks);
                $('#remark_id').val(res.remark_id);
                $('#reject_edit_Modal').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
                $('#reject_edit_Modal').modal('show');
            } else {
                alert('There is No Remarks Yet');
            }
        })
    }

    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'requests/requests.php', // API endpoint to fetch data
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

            ]
        });

        //----------------------------------------------------APPROVED REQUEST------------------------------------------------------------------
        $('#approvedbtn').click(function(e) {
            e.preventDefault();
            let stud_id = $('#student_id').val();
            let request_id = $('#request_id').val();

            $.ajax({
                url: 'requests/approvedprocess.php',
                type: 'POST',
                data: {
                    stud_id: stud_id,
                    request_id: request_id
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    alert('Approve Successfully')
                    $('#approve_modal').modal('hide')
                    // setTimeout("window.location.reload();", 2500);
                } else {
                    alert(res.res_message);
                }

            })
        })

        //APPROVED PROCCESS
        $('#dean_submit').submit(function(e) {
            e.preventDefault();
            let stud_id = $('#student_dean_id').val();
            let request_id = $('#request_dean_id').val();

            $.ajax({
                url: 'requests/approved_dean_process.php',
                type: 'POST',
                data: {
                    stud_id: stud_id,
                    request_id: request_id
                },
                dataType: 'JSON',
                beforeSend: function() {
                $('#approve_button').prop('disabled', true);
                $("#loader").show();
                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $("#loader").hide();
                    Toast("Success!", "info-circle");
                    $('#approve_dean_modal').modal('hide')
                    // setTimeout("window.location.reload();", 2500);
                } else {
                    alert(res.res_message);
                }
            })
        })


        // --------------------------------------------------ADD REMARKS-------------------------------------------------------------//
        $('#add_remarks').submit(function(e) {
            e.preventDefault();
            let request_id = $('#request_remark_id').val()
            let remarks = $('#lacking').val();

            if (remarks == '') {
                alert('Please Input remarks');
            } else {

                $.ajax({
                    url: 'requests/remark_process.php',
                    type: 'POST',
                    data: {
                        request_id: request_id,
                        remarks: remarks

                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('#remark_button').prop('disabled', true);
                        $("#loader1").show();
                    }
                }).done(function(res) {
                    if (res.res_success == 1) {
                        var currentPageIndex = table.page.info().page;
                        table.ajax.reload(function() {
                            table.page(currentPageIndex).draw(false);
                        }, false);
                        $("#loader1").hide();
                        $('#reject_modal').modal('hide');
                        Toast("Success!", "info-circle");
                    } else {
                        alert(res.res_message);
                        $('#reject_modal').modal('hide');
                    }
                })
            }
        })


        //---------------------------------------------UPDATE REMARKS-------------------------------------------------------
        $('#remarks_update').submit(function(e) {
            e.preventDefault();
            let remark_id = $('#remark_id').val()
            let remarks = $('#lacking2').val()

            $.ajax({
                url: 'requests/remark_update.php',
                type: 'POST',
                data: {
                    remark_id: remark_id,
                    remarks: remarks
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#reject_edit_Modal').modal('hide');
                    Toast("Success!", "info-circle");
                } else {
                    alert(res.res_message);
                    $('#reject_edit_Modal').modal('hide');
                }
            })
        })



    })
</script>