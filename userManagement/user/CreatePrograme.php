<?php
	include('DBConnect.php');
	include('session.php');

	extract($_POST);

	if (isset($submit)) {
		$sql = "INSERT INTO programe (prog_code, name, degree, year) VALUES ('$prog_code', '$name', '$degree', '$year')";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script type='text/javascript'>alert('New programe is created!');";
			echo "window.location.href = 'SearchEditPrograme.php';</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course management system</title>
	<!-- Bootstrap Core CSS -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- #wrapper -->
	<div id="wrapper">
		<!-- .navbar-static-side -->
		
        <?php include 'navbar.php'; ?>
		<!-- /.navbar-static-side -->
	</div>
	<!-- /#wrapper -->

	<!-- #page-wrapper -->
	<div id="page-wrapper">
		<!-- .row -->
		<div class="row">
			<!-- .col-lg-12 -->
			<div class="col-lg-12">
				<h1 class="page-header">Create Programe</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

		<!-- .row -->
		<div class="row">
			<!-- .col-lg-12 -->
			<div class="col-lg-12">
				<form id="createsingleuser" autocomplete="off" action="" method="POST">
					<!-- .panel -->
					<div class="panel panel-default">
						<div class="panel-heading">Create New Programe</div>
						<div class="panel-body">
							<table style="align:center; width:100%;">
								<tr>
									<td>Programe Name:</td>
									<td><input type="text" name="name" required></td>
								</tr>
								<tr>
									<td>Programe Code:</td>
									<td><input type="text" name="prog_code" required></td>
								</tr>
								<tr>
									<td>Programe Degree:</td>
									<td>
										<select type="text" name="degree">
											<option value="Bachelor">Bachelor</option>
											<option value="Master">Master</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Programe Length:</td>
									<td>
										<select type="text" name="year">
											<option value="1">1 Year</option>
											<option value="2">2 Years</option>
											<option value="3">3 Years</option>
											<option value="4">4 Years</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div align="center">
							<input style="padding-right:25px; padding-left:25px" type="submit" name="submit" id="submit" value="Create">
						</div>
						<br/>
					</div>
					<!-- /.panel -->
				</form>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->

	<!-- jQuery -->
	<script src="../vendor/jquery/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js"></script>
</body>
</html>