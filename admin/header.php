<?php
  require_once('includes/connection.php');
  
?>
<!doctype html>
<html lang="en" class="color-header headercolor4">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../assets/images/logo.png" type="image/png" />
	<!--plugins-->
	<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="../assets/css/dark-theme.css" />
	<link rel="stylesheet" href="../assets/css/semi-dark.css" />
	<link rel="stylesheet" href="../assets/css/header-colors.css" />
	<!-- additionals -->
	<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<!-- 
	<link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

	<title>Asscat - Clearance Processing System</title>

	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="../assets/js/moment.min.js"></script>
	<script src="../assets/js/daterangepicker.js"></script>

</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../assets/images/logo.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="bx logo-text text-dark" style= "font-size: 33px;">Clearance</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="">
					<a href="../modules/dashboard.php">
						<div class="parent-icon"><i class="fa fa-home"></i>
							<!-- <i class='bx bx-home'></i> -->
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li class="">
					<a href="../modules/requests.php">
						<div class="parent-icon"><i class="fa fa-list"></i>
							<!-- <i class='bx bx-list-ol'></i> -->
						</div>
						<div class="menu-title">Requests</div>
					</a>

				</li>
				<!-- <li class="">
					<a href="../modules/cleared.php">
						<div class="parent-icon"><i class="fa fa-check-circle"></i>
							
						</div>
						<div class="menu-title">Cleared</div>
					</a>
				</li> -->
				<li class="">
					<a href="../modules/faculties.php">
						<div class="parent-icon"><i class="fa-solid fa-clipboard-user"></i>
						</div>
						<div class="menu-title">Faculties</div>
					</a>
				</li>
				<!-- <li class="">
					<a href="../modules/items.php">
						<div class="parent-icon"><i class="fa-solid fa-briefcase"></i>
						</div>
						<div class="menu-title">Items</div>
					</a>
				</li> -->
				<li class="">
					<a href="../modules/course.php">
						<div class="parent-icon"><i class='fa fa-book'></i>
						</div>
						<div class="menu-title">Course</div>
					</a>
				</li>
				<li class="">
					<a href="../modules/items.php">
						<div class="parent-icon"><i class='fa fa-toolbox'></i>
						</div>
						<div class="menu-title">Items</div>
					</a>
				</li>
				<li class="">
					<a href="../modules/students.php">
						<div class="parent-icon"><i class='fa fa-user-graduate'></i>
						</div>
						<div class="menu-title">Students</div>
					</a>
				</li>

				<li class="">
					<a href="../modules/users.php">
						<div class="parent-icon"><i class='fa fa-user-tie'></i>
						</div>
						<div class="menu-title">Users</div>
					</a>
				</li>
				<li class="">
					<a href="../modules/reports.php">
						<div class="parent-icon"><i class="fa-solid fa-clipboard-list"></i>
							<!-- <i class='bx bx-file-blank'></i> -->
						</div>
						<div class="menu-title">Reports</div>
					</a>
				</li>
			</ul>

			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
					<div style="flex: 1;"></div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
							role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img class="user-img" alt="user avatar"
							<?php
						if($_SESSION['admin']['gender']=='1'){
							echo 'src="../assets/images/avatars/avatar.jpg"';
						} else{
							echo 'src="../assets/images/avatars/avatar2.png"';
						}
               			 ?>>
							<div class="user-info ps-3">
								<p class="user-name mb-0">

								<?php echo $_SESSION['admin']['fname'].' '.$_SESSION['admin']['lname']; ?>
							 </p>
								<p class="designattion mb-0">
								<?php echo $_SESSION['admin']['username']; ?>
								</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<a class="dropdown-item" href="javascript:;" onclick="change_password()"><i
										class="bx bx-cog"></i><span>Change Password</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li>
								<a class="dropdown-item" href="../includes/logout.php" ><i
										class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				<!------Logout Modal ------->
				<div class="modal fade" id="logoutmodal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header text-center">
								<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
								<button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body"> are you sure do you want to logout?</div>
							<div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
								<a class="btn btn-primary" href="../backend/logout.php">Logout</a>
							</div>
						</div>
					</div>
				</div>

		<!-- TOAST-->
		<div class="toast-container position-fixed bottom-0 end-0 p-3">
		<div id="liveToast" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
			<span class='toast-icon bi-info-circle'></span>
			<strong class="me-auto">&nbsp; Notifications</strong>
			<div id="toast-msg"></div>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body text-white">
			</div>
		</div>
		</div>
				