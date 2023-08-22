     <!---------------------------- MODAL --------------------------------->
     <div class="modal fade" id="status_modal">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="text-center" style="margin: 10px;">
                     <h3 id='course'></h3>
                 </div>
                 <div style="margin:10px;">
                     <table class="table" id="my_table">
                         <thead>
                             <tr class="text-center">
                                 <th class="text-center">Designation</th>
                                 <th class="text-center">Status</th>
                             </tr>
                         </thead>
                         <tbody>

                         </tbody>
                     </table>
                 </div>
                 <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-lable="close" style="margin: 10px; float:right;">CLOSE</button>
             </div>
         </div>
     </div>
     </div>



     <!------------------------------------- CLEAR DATA -------------------------------------------------->
<div class="modal fade" id="clear_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Clear?</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="clear_form">
        <div class="modal-body">
          <input type="hidden" name="" id="clear_id">
          <span>are you sure do you want to clear the requests?</span>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Clear</button>
        </div>
      </form>
    </div>

  </div>
</div>