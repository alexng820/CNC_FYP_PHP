<?php
	include('DBConnect.php');
	include('session.php');

	extract($_POST);

	if(isset($submit) && ($num_of_section > 0)){
		$sql = "INSERT INTO course (course_code, name, num_of_section) VALUES ('$course_code', '$name', '$num_of_section')";
		$result = mysqli_query($conn, $sql);
		for ($i=0; $i<=$num_of_section; $i++) {
			$sql = "INSERT INTO section (section_code, weekday, starttime, endtime, location, tearcher) VALUES ('$section_code[$i]', '$weekday[$i]', '$starttime[$i]', '$endtime[$i]', '$location[$i]', '$tearcher[$i]')";
			$result = mysqli_query($conn, $sql);
			if (!$result) {
				echo "<script type='text/javascript'>alert('Error: Operation failed!');";
				echo "window.location.href = 'CreateCourse.php';</script>";
			}
		}
		echo "<script type='text/javascript'>alert('New course is created!');";
		echo "window.location.href = 'SearchEditCourse.php';</script>";
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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" ></script>
	<script type="text/javascript">
		//when the webpage has loaded do this
		$(document).ready(function() {
			//if the value within the dropdown box has changed then run this code
			$('#num_of_section').change(function(){
				//get the number of fields required from the dropdown box
				var num = $('#num_of_section').val();

				var i = 0; //integer variable for 'for' loop
				var html = ''; //string variable for html code for fields
				//loop through to add the number of fields specified
				//concatinate number of fields to a variable
				html += '<tr><td>Lecture Code:</td><td><input type="text" name="section_code[]" required></td></tr>';
				html += '<tr><td>Lecture Weekday:</td><td><input type="text" name="weekday[]" required></td></tr>';
				html += '<tr><td>Lecture Start Time:</td><td><input type="time" name="starttime[]" required></td></tr>';
				html += '<tr><td>Lecture End Time:</td><td><input type="time" name="endtime[]" required></td></tr>';
				html += '<tr><td>Lecture Location:</td><td><input type="text" name="location[]" required></td></tr>';
				html += '<tr><td>Lecture Tutor:</td><td><input type="text" name="tearcher[]" required></td></tr>';
				html += '<tr style="height: 20px"></tr>';
				for (i=1;i<=num;i++) {
					//concatinate number of fields to a variable
					html += '<tr><td>Tutorial Code ' + i + ':</td><td><input type="text" name="section_code[]" required></td></tr>';
					html += '<tr><td>Tutorial Weekday ' + i + ':</td><td><input type="text" name="weekday[]" required></td></tr>';
					html += '<tr><td>Tutorial Start Time ' + i + ':</td><td><input type="time" name="starttime[]" required></td></tr>';
					html += '<tr><td>Tutorial End Time ' + i + ':</td><td><input type="time" name="endtime[]" required></td></tr>';
					html += '<tr><td>Tutorial Location ' + i + ':</td><td><input type="text" name="location[]" required></td></tr>';
					html += '<tr><td>Tutorial Tutor ' + i + ':</td><td><input type="text" name="tearcher[]" required></td></tr>';
					html += '<tr style="height: 20px"></tr>';
				}

				//insert this html code into the div with class catList
				$('.sectionList').html(html);
			});
		});
	</script>
</head>
<body>
	<!-- #wrapper -->
	<div id="wrapper">
		<!-- .navbar-static-side -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0">
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
				<h1 class="page-header">Create Course</h1>
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
						<div class="panel-heading">Create New Course</div>
						<div class="panel-body">
							<table style="align:center; width:100%;">
								<tr>
									<td>Course Name:</td>
									<td><input type="text" name="name" required></td>
								</tr>
								<tr>
									<td>Course Code:</td>
									<td><input type="text" name="course_code" required></td>
								</tr>
								<tr>
									<td>Number of Tutorials:</td>
									<td>
										<select type="text" id="num_of_section" name="num_of_section">
											<option selected></option>
											<option value="1">1 tutorial</option>
											<option value="2">2 tutorials</option>
											<option value="3">3 tutorials</option>
											<option value="4">4 tutorials</option>
											<option value="5">5 tutorials</option>
											<option value="6">6 tutorials</option>
											<option value="7">7 tutorials</option>
											<option value="8">8 tutorials</option>
											<option value="9">9 tutorials</option>
											<option value="10">10 tutorials</option>
										</select>
									</td>
								</tr>
								<tr style="height: 20px"></tr>
							</table>
							<div class="sectionList"></div>
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