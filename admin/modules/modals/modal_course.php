<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New Course</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_insert">
        <div class="modal-body mx-4">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Course<span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_course" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="add_department" required>
              <option value="" selected hidden>Select Department</option>
              <option value="CIS">CIS</option>
              <option value="CAS">CAS</option>
              <option value="CTE">CTE</option>
              <option value="AGRICULTURE">AGRICULTURE</option>
            </select>
          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


<!-- EDIT COURSE -->
<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit Course</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_update">
        <div class="modal-body mx-4">
          <div class="md-form">
          <input type="hidden" class="form-control validate" id="edit_course_id">
            <label data-error="wrong" data-success="right">Course<span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_course" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_department" required>
              <option value="" selected hidden>Select Department</option>
              <option value="CIS">CIS</option>
              <option value="CAS">CAS</option>
              <option value="CTE">CTE</option>
              <option value="AGRICULTURE">AGRICULTURE</option>
            </select>
          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>

<!------------------------------------- DELETE COURSE -------------------------------------------------->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_form">
                <div class="modal-body">
                    <span>are you sure do you want to delete?</span>
                    <input type="hidden" name="" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>

    </div>
</div>