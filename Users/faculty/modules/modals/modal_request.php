<!---------------------------- APPROVE MODAL --------------------------------->
<div class="modal fade" id="approve_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approving Request</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="fw-bold">are you sure to approve?</span>
        <input type="hidden" id="student_id" name="student_id">
        <input type="hidden" id="request_id" name="request_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
        <button type="sumbit" class="btn btn-primary" id="approvedbtn">Submit</button>
      </div>
    </div>
  </div>
</div>

<!----------------------------DEAN APPROVE MODAL--------------------------------->
<div class="modal fade" id="approve_dean_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approving Request</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="dean_submit">
        <div class="modal-body">
          <span class="fw-bold">are you sure to approve?</span>
          <input type="hidden" id="student_dean_id" name="student_id">
          <input type="hidden" id="request_dean_id" name="request_id">
        </div>
        <div class="modal-footer">
              <!-- Image loader -->
              <div id='loader' style='display: none; float:left;' class="text-center">
                        <img src='../../assets/images/loader.gif' width="10%"><b>Loading...</b>
                    </div>
          <button type="sumbit" id='approve_button' class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!----------------------------Remarks MODAL--------------------------------->
<div class="modal fade" id="reject_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="add_remarks">
        <div class="modal-body">
          <input type="hidden" id="request_remark_id" name="requests_id">
          <label for="">Lacking(s)<span class="text-danger">*</span></label><br>
          <textarea class="form-control" id="lacking" cols="10" rows="5" maxlength="255"></textarea>
        </div>
        <div class="modal-footer">
              <!-- Image loader -->
              <div id='loader1' style='display: none; float:left;' class="text-center">
                        <img src='../../assets/images/loader.gif' width="10%"><b>Loading...</b>
                    </div>
          <button type="sumbit" id="remark_button" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!----------------------------Edit Remarks MODAL--------------------------------->
<div class="modal fade" id="reject_edit_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Remarks</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="remarks_update" method="post">
        <div class="modal-body">
          <input type="hidden" id="remark_id" name="remark_id">
          <label for="">Lacking(s)<span class="text-danger">*</span></label><br>
          <textarea class="form-control" id="lacking2" cols="10" rows="5" maxlength="255"></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="sumbit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>