

 <!------------------------------- GENERATE CLEARANCE MODAL ------------------------->
<div class="modal fade" id="Clearance">
      	<div class="modal-dialog">
      		<div class="modal-content">

      			<div class="modal-header text-center">
      				<h3 class="modal-title w-100 dark-grey-text font-weight-bold">Generate Clearance</h3>
      				<button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      			</div>
      			<form id="form_request_transaction">
      				<div class="modal-body mx-4">
              <span id="error1" style="color: red;"></span>
              <div class="alert alert-warning">
                  <strong>Warning!</strong> You can only generate clearance once per semester, be careful upon fill up.
              </div>
              <input type="hidden" name="student_id" id="student_id" value="<?php echo $_SESSION['student']['student_id']; ?>"readonly>
        
            <div class="md-form">
            <label data-error="wrong" data-success="right">Semester<span class="text-danger">*</span></label>
            <select class='form-control' id="semester" name="semester">
              <option value="" selected hidden>- Select Semester</option>
              <option value="1">1st Semester</option>
              <option value="2">2nd Semester</option>
              <option value="3">Summer</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">School Year<span class="text-danger">*</span></label>
            <select class='form-control' id="school_year" name="school_year">
              <option value="" selected hidden>- School Year</option>
              <option value="2022-2023">SY: 2022-2023</option>
              <option value="2022-2023">SY: 2023-2024</option>
              <option value="2024-2025">SY: 2024-2025</option>
            </select>
          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


       <!---------------------------- MODAL --------------------------------->
       <div class="modal fade" id="lackingModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Lacking(s)</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
          </button>
        </div>
        <div class="modal-body text-center"> 
          <h4 id="content" class="fw-bold">
                <!-- CONTENT -->
         </h4>
        </div>
      </div>
    </div>
  </div>

