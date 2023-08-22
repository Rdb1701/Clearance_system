      </div>
      </div>
      <!--end page wrapper -->

      <!--start overlay-->
      <div class="overlay toggle-icon"></div>
      <!--end overlay-->

      <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
      <!--End Back To Top Button-->
      <footer class="page-footer">
      	<p class="mb-0">Clearance Processing System &copy; 2022</p>
      </footer>
      </div>

      <!-- MODAL -->
      <div class="modal fade" id="change_password_modal">
      	<div class="modal-dialog">
      		<div class="modal-content">

      			<!-- username, lname, fname, gender, phone, user_type_id -->

      			<div class="modal-header text-center">
      				<h3 class="modal-title w-100 dark-grey-text font-weight-bold">CHANGE PASSWORD</h3>
      				<button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      			</div>

      			<form id="form_change_password">
      				<div class="modal-body mx-4">

      					<div class="md-form">
      						<label data-error="wrong" data-success="right">Username</label>
      						<input type="text" class="form-control"
      							value="<?php echo $_SESSION['staff']['username']; ?>" readonly>
      					</div>

      					<div class="md-form">
      						<label data-error="wrong" data-success="right">Enter New Password <span
      								class="text-danger">*</span></label>
      						<input type="password" class="form-control" id="new_password" name="password" autocomplete="off">
      					</div>

      					<div class="md-form">
      						<label data-error="wrong" data-success="right">Re-enter New Password <span
      								class="text-danger">*</span></label>
      						<input type="password" class="form-control" id="re_new_password" autocomplete="off">
      					</div>

      					<div class="text-center mt-3">
      						<button type="submit" class="btn btn-primary btn-block z-depth-1a">SUBMIT</button>
      					</div>

      				</div>
      			</form>

      		</div>
      	</div>
      </div>

	  
						<!------Logout Modal ------->
 <div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> are you sure do you want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../backend/logout2.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  
      <!--end wrapper-->
      <script src="../../assets/plugins/simplebar/js/simplebar.min.js"></script>
      <script src="../../assets/plugins/metismenu/js/metisMenu.min.js"></script>
      <script src="../../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	  <script src="../../assets/js/sweetalert.min.js"></script>
      <!--app JS-->
      <script src="../../assets/js/app.js"></script>
	  <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
  	<script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  	<script src="../../assets/vendor/datatables/datatables-demo.js"></script>


      <script>
      	function change_password() {

      		$('#change_password_modal').modal('show');

      	}

      	function log_out() {

      		$('#logoutmodal').modal('show');

      	}



      	      	// Change password Ajax
					$(document).ready(function () {

				$('#form_change_password').submit(function (e) {
					e.preventDefault();

					let new_password = $('#new_password').val();
					let re_new_password = $('#re_new_password').val();

					if (new_password == re_new_password && new_password != '') {
						$.ajax({
							url: '../../includes/change_password_faculty.php',
							type: 'POST',
							data: {
								password: new_password
							},
							dataType: 'JSON',
							beforeSend: function () {

							}
						}).done(function (res) {
							console.log('Done!');
							$('#change_password_modal').modal('hide');
							swal("Password Changed","", "success");
							setTimeout("window.location.reload();", 2500);
						}).fail(function () {
							console.log('Fail!');
						});
					} else {
						alert("Invalid password!");
					}

				});

				});



		//TOAST
		function Toast(msg, icon)
		{
			const toastLive = document.getElementById('liveToast')
			const toast = new bootstrap.Toast(toastLive)
			$('.toast-icon').addClass('bi-' +icon);
			$('#toast-msg').html(msg);

			toast.show();

			$(".toast").toast({ autohide: false });

		}


      	// const popupCenter = ({url, title, w, h}) => {
      	// 	// Fixes dual-screen position                             Most browsers      Firefox
      	// 	const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
      	// 	const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;

      	// 	const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
      	// 	const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

      	// 	const systemZoom = width / window.screen.availWidth;
      	// 	const left = (width - w) / 2 / systemZoom + dualScreenLeft
      	// 	const top = (height - h) / 2 / systemZoom + dualScreenTop
      	// 	const newWindow = window.open(url, title, 
      	// 		`
      	// 		scrollbars=yes,
      	// 		width=${w / systemZoom}, 
      	// 		height=${h / systemZoom}, 
      	// 		top=${top}, 
      	// 		left=${left}
      	// 		`
      	// 	)

      	// 	if (window.focus) newWindow.focus();
      	// }




      	// $(document).ready(function() {

      	// 	$('#d_form_change_password').submit(function(e) {
      	// 		e.preventDefault();

      	// 		let new_password 		= $('#new_password').val();
      	// 		let re_new_password = $('#re_new_password').val();

      	// 		if (new_password == re_new_password && new_password != '') {
      	// 			$.ajax({
      	// 				url         : '../../includes/change_password.php', 
      	// 				type        : 'POST', 
      	// 				data        : {
      	// 					password : new_password
      	// 				}, 
      	// 				dataType    : 'JSON', 
      	// 				beforeSend  : function() {

      	// 				}
      	// 			}).done(function(res) {
      	// 				console.log('Done!');
      	// 				$('#change_password_modal').modal('hide');
      	// 				alert('Password Changed!');
      	// 			}).fail(function() {
      	// 				console.log('Fail!');
      	// 			});
      	// 		} else {
      	// 			alert("Invalid password!");
      	// 		}

      	// 	});

      	// });
      </script>

      </body>

      </html>