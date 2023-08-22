<!---------------------------- Download MODAL --------------------------------->
<div class="modal fade" id="download_clearance">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Download Clearance</h5>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          <form action="approved/downloadpdf.php" method="get">
          <span class="fw-bold">Ready to Download?</span>
          <input type="hidden" id="stud_id" name="stud_id">
          <!-- <input type="" id="sms_id" name="sms_id"> -->
        </div>
        <div class="modal-footer justify-content-center">
          <button type="sumbit" class="btn btn-primary" id="download_c" onclick="download_cc()"><i class="bx bx-download"></i>Download</button>
        </div>
        </form>
      </div>
    </div>
  </div>