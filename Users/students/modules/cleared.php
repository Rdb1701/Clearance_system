<?php
include('../header.php');
include('cleared/cleared.php');
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Cleared</h1>
    </i>
    <div style="flex: 1;"></div>
</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table align-middle mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Semester</th>
                            <th class="text-center">School Year</th>
                            <th class="text-center">Download Clearance</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            if ($cleared) {
              foreach ($cleared as $cl) {
                ?>
                <tr class="text-center">          
                  <td class="text-center"><?php echo $cl['sem']; ?></td>
                  <td class="text-center"><?php echo $cl['school_year']; ?></td>
                  <td class="text-center"> <button type="button" class="btn btn-primary ms-2"
                      onclick="download_btn('<?php echo $_SESSION['student']['student_id']; ?>')"><i class="bx bx-download"></i>Download</button></td>
                </tr>
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
            </form>
        </div>
    </div>
</div>

<?php
include('../footer.php');
include('modals/modal_cleared.php');
?>


<script>

function download_btn(student_id){

let stud_id = $('#stud_id').val(student_id);
// let smss_id = $('#sms_id').val(sms_id);
$('#download_clearance').modal('show');

}

$(document).ready(function(){

  $('#download_c').click(function(e){
    e.preventDefault();

    let stud_id = $('#stud_id').val();
    let smsss_id = $('#sms_id').val();
    let data = '';

    console.log(stud_id);

    data = 'IDNumber=' + stud_id;
    // data += 'sms_id=' + smsss_id;
    
   popupCenter({url:'cleared/download.php?'+data, title: 'SFXC Clearance', w: 900, h: 500});
   $('#download_clearance').modal('hide');
                      
  })

})


</script>