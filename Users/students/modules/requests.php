<?php
include('../header.php');
include('requests/requests.php');
?>


<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Requests</h1>
    </i>
    <div style="flex: 1;"></div>
</h5>
<?php

$query = "
  SELECT * FROM request_transaction AS req
  LEFT JOIN students as stud ON stud.student_id = req.student_id
  WHERE req.student_id = '" . $_SESSION['student']['student_id'] . "'
  and clear_status = '0'
  ";

$result = mysqli_query($db, $query) or die('Error in Inserting users in ' . $query);

if (!mysqli_num_rows($result)) {
?>

    <button data-bs-toggle="modal" data-bs-target="#Clearance" class="btn btn-primary" id="btn_clearance" style="float:right;">Generate Clearance</button><br><br><br>

<?php
} else {
?>

    <button data-bs-toggle="modal" data-bs-target="#Clearance" class="btn btn-primary" id="btn_clearance" style="float:right;" disabled>Generate Clearance</button><br><br><br>

<?php
}
?>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">Designation</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($requests) {
                        foreach ($requests as $req) {
                    ?>
                            <tr class="text-center">
                                <td class="text-center"><?php echo $req['item_name']; ?></td>
                                <td class="text-center"><?php echo $req['status']; ?></td>
                            </tr>

                        <?php
                        }
                    } else {
                        ?>

                        <tr class="text-center">
                            <td class="text-start text-danger" colspan="11">No Record Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('../footer.php');
include('modals/modal_requests.php');
?>

<script>
    function lackings(request_id, staff_id) {

        $.ajax({
            url: 'requests/lackings.php',
            type: 'POST',
            data: {
                request_id: request_id,
                staff_id: staff_id
            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                // swal(res.remark_desc ,"","");
                $('#content').html(res.remark_desc);
                $('#lackingModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
                $('#lackingModal').modal('show');
            } else {
                alert(res.res_message)
            }
        })


    }
    $(document).ready(function() {


        $("#form_request_transaction").submit(function(e) {
            e.preventDefault();
            let student_id = $("#student_id").val();
            let semester = $("#semester").val();
            let school_year = $("#school_year").val();


            $.ajax({
                url: 'requests/generate_clearance.php',
                type: 'POST',
                data: {
                    student_id: student_id,
                    school_year: school_year,
                    semester: semester

                },
                dataType: 'JSON',
                beforeSend: function() {}
            }).done(function(res) {
                if (res.res_success == 1) {
                    $('#Clearance').modal('hide');
                    swal("Your Clearance Has been Generated!", "", "success");
                    setTimeout("window.location.reload();", 2500);

                } else {
                    $('#error1').text(res.res_message[0]);
                }
            }).fail(function() {
                console.log('Fail!');
            });


        })

    })
</script>