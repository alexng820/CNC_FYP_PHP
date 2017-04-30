<?php
	include('DBConnect.php');
	include('session.php');

	extract($_POST);
	$prog_code=$_GET['prog_code'];

	if (isset($submit)) {
		$query = "UPDATE programe SET prog_code = '$prog_code', name = '$name', degree = '$degree', year = '$year' WHERE prog_code = '$prog_code'";
		$results = $conn->query($query);
		if ($results) {
			echo "<script type='text/javascript'>alert('Programe is updated!');";
			echo "window.location.href = 'SearchEditPrograme.php';</script>";
		}
	} else {
		$query = "SELECT * FROM programe WHERE prog_code = '$prog_code'";
		$results = $conn->query($query);
		if ($data = $results->fetch_object()) {
			$prog_code = $data->prog_code;
			$name = $data->name;
			$degree = $data->degree;
			$year = $data->year;
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
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<!-- .navbar-header -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="SearchEditUser.php">University Student Information App</a>
			</div>
			<!-- /.navbar-header -->

			<!-- .navbar-top-links -->
			<ul class="nav navbar-top-links navbar-right">
				<!-- .dropdown -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>
						<i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href = "logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
					</ul>
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<!-- .sidebar-collapse -->
			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<ul class="nav" id="side-menu">
							<li>
								<a href="tables.html"><i class="fa fa-table fa-fw"></i>Course Management<span class="fa arrow"></a>
								<!-- .nav-second-level -->
								<ul class="nav nav-second-level">
									<li><a href="CreateUser.php">Create User</a></li>
									<li><a href="SearchEditUser.php">Search/Edit User</a></li>
									<li><a href="CreatePrograme.php">Create Programe</a></li>
									<li><a href="SearchEditPrograme.php">Search/Edit Programe</a></li>
									<li><a href="CreateCourse.php">Create Course</a></li>
									<li><a href="SearchEditCourse.php">Search/Edit Course</a></li>
								</ul>
								<!-- /.nav-second-level -->
							</li>
						</ul>
					</ul>
				</div>
			</div>
			<!-- /.sidebar-collapse -->
		</nav>
		<!-- /.navbar-static-side -->
	</div>
	<!-- /#wrapper -->

	<!-- #page-wrapper -->
	<div id="page-wrapper">
		<!-- .row -->
		<div class="row">
			<!-- .col-lg-12 -->
			<div class="col-lg-12">
				<h1 class="page-header">Edit Programe</h1>
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
						<div class="panel-heading">Edit Programe</div>
						<div class="panel-body" align="center">
							<table style="align:center;width:100%;">
								<tr>
									<td>Programe Code:</td>
									<td><input type="text" name="prog_code"<?php print ' value="'.$prog_code.'" ';?>disabled></td>
								</tr>
								<tr>
									<td>Programe Name:</td>
									<td><input type="text" name="name"<?php print ' value="'.$name.'" ';?>required></td>
								</tr>
								<tr>
									<td>Programe Degree:</td>
									<td><input type="text" name="degree"<?php print ' value="'.$degree.'" ';?>required></td>
								</tr>
								<tr>
									<td>Programe Length:</td>
									<td>
										<select type="text" name="year">
											<option value="1"<?php if ($year == 1) print " selected";?>>1 Year</option>
											<option value="2"<?php if ($year == 2) print " selected";?>>2 Years</option>
											<option value="3"<?php if ($year == 3) print " selected";?>>3 Years</option>
											<option value="4"<?php if ($year == 4) print " selected";?>>4 Years</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div align="center">
							<button style="padding-right:20px;padding-left:20px" type="submit" name="submit" id="update" value="update">Save</button>
						</div>
						<br/>
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
							<thead>
								<tr>
									<th>Programe Code</th>
									<th>Programe Name</th>
									<th>programe Degree</th>
									<th>Programe Length</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$query = "SELECT * FROM programe";
									$result = $conn->query($query);
									if (!$conn->query($query)) {
										print $conn->error;
									}
									//List out all programe data
									while ($row = $result->fetch_object()) {
										print "<tr class='odd gradeX'>";
										print "<td><a href='EditPrograme.php?prog_code=".$row->prog_code."'>".$row->prog_code."</a></td>";
										print "<td>".$row->name."</td>";
										print "<td>".$row->degree."</td>";
										print "<td>".$row->year."</td>";
										print '</tr>';
									}
								?>
							</tbody>
						</table>
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
	<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
		$(document).ready(function() {
			$('#dataTables').DataTable({
				responsive: true
			});
		});
	</script>
</body>
</html>