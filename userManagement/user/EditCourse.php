<?php
	include('DBConnect.php');
	include('session.php');

	extract($_POST);
	$course_code=$_GET['course_code'];

	if (isset($submit)) {
		$query = "SELECT * FROM course WHERE course_code = '$course_code'";
		$results = $conn->query($query);
		if ($data = $results->fetch_object()) {
			$num_of_section = $data->num_of_section;
		}
		$query = "UPDATE course SET name = '$name', num_of_section = '$newSectionNumber' WHERE course_code = '$course_code'";
		$results = mysqli_query($conn, $query);
		if (!$results) {
			echo "<script type='text/javascript'>alert('Error: Operation failed!');";
			echo "window.location.href = 'SearchEditCourse.php';</script>";
		}
		for ($i=0; $i<=$newSectionNumber; $i++) {
			if ($i <= $num_of_section) {
				$sql = "UPDATE section SET weekday = '$weekday[$i]', starttime = '$starttime[$i]', endtime = '$endtime[$i]', location = '$location[$i]', tearcher = '$tearcher[$i]' WHERE section_code = '$section_code[$i]'";
				$results = mysqli_query($conn, $sql);
				if (!$results) {
					echo "<script type='text/javascript'>alert('Error: Operation failed!');";
					echo "window.location.href = 'SearchEditCourse.php';</script>";
				}
			} else {
				$sql = "INSERT INTO section (section_code, weekday, starttime, endtime, location, tearcher) VALUES ('$section_code[$i]', '$weekday[$i]', '$starttime[$i]', '$endtime[$i]', '$location[$i]', '$tearcher[$i]')";
				$results = mysqli_query($conn, $sql);
				if (!$results) {
					echo "<script type='text/javascript'>alert('Error: Insert operation failed!');";
					echo "window.location.href = 'SearchEditCourse.php';</script>";
				}
			}
		}
		if ($results) {
			echo "<script type='text/javascript'>alert('Section data is updated!');";
			echo "window.location.href = 'SearchEditCourse.php';</script>";
		}
	} else {
		$query = "SELECT * FROM course WHERE course_code = '$course_code'";
		$results = $conn->query($query);
		if ($data = $results->fetch_object()) {
			$course_code = $data->course_code;
			$name = $data->name;
			$num_of_section = $data->num_of_section;
		}
		$query = "SELECT * FROM section WHERE section_code LIKE '$course_code%'";
		$results = $conn->query($query);
		$i = 0;
		$section_code = array();
		$weekday = array();
		$starttime = array();
		$endtime = array();
		$location = array();
		$tearcher = array();
		while ($data = $results->fetch_object()) {
			$section_code[$i] = $data->section_code;
			$weekday[$i] = $data->weekday;
			$starttime[$i] = $data->starttime;
			$endtime[$i] = $data->endtime;
			$location[$i] = $data->location;
			$tearcher[$i] = $data->tearcher;
			$i++;
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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" ></script>
	<script type="text/javascript">
		//when the webpage has loaded do this
		$(document).ready(function() {
			showSectionList();
			//if the value within the dropdown box has changed then run this code
			$('#newSectionNumber').change(function() {
				showSectionList();
			});
		});

		function showSectionList() {
			//clean all old content
			$(".sectionList").html("");

			//get the number of fields required from the dropdown box
			var num = $('#newSectionNumber').val();

			var i = 0; //integer variable for 'for' loop
			var oldSectionNumber = <?php echo $num_of_section;?>;
			var html = ''; //string variable for html code for fields

			//parse the php variables to json so js can read
			var section_code = <?php echo json_encode($section_code);?>;
			var weekday = <?php echo json_encode($weekday);?>;
			var starttime = <?php echo json_encode($starttime);?>;
			var endtime = <?php echo json_encode($endtime);?>;
			var location = <?php echo json_encode($location);?>;
			var tearcher = <?php echo json_encode($tearcher);?>;

			//loop through to add the number of fields specified
			html += '<tr><td>Lecture Code:</td><td><input type="text" name="section_code[]" value="' + section_code[i] + '" hidden>' + section_code[i] + '</td></tr>';
			html += '<tr><td>Lecture Weekday:</td><td><input type="text" name="weekday[]" value="' + weekday[i] + '" required></td></tr>';
			html += '<tr><td>Lecture Start Time:</td><td><input type="time" name="starttime[]" value="' + starttime[i] + '" required></td></tr>';
			html += '<tr><td>Lecture End Time:</td><td><input type="time" name="endtime[]" value="' + endtime[i] + '" required></td></tr>';
			html += '<tr><td>Lecture Location:</td><td><input type="text" name="location[]" value="' + location[i] + '" required></td></tr>';
			html += '<tr><td>Lecture Tutor:</td><td><input type="text" name="tearcher[]" value="' + tearcher[i] + '" required></td></tr>';
			html += '<tr style="height: 20px"></tr>';
			for (i=1;i<=num;i++) {
				if (i <= oldSectionNumber) {
					//concatinate number of fields to a variable
					html += '<tr><td>Tutorial Code ' + i + ':</td><td><input type="text" name="section_code[]" value="' + section_code[i] + '" hidden>' + section_code[i] + '</td></tr>';
					html += '<tr><td>Tutorial Weekday ' + i + ':</td><td><input type="text" name="weekday[]" value="' + weekday[i] + '" required></td></tr>';
					html += '<tr><td>Tutorial Start Time ' + i + ':</td><td><input type="time" name="starttime[]" value="' + starttime[i] + '" required></td></tr>';
					html += '<tr><td>Tutorial End Time ' + i + ':</td><td><input type="time" name="endtime[]" value="' + endtime[i] + '" required></td></tr>';
					html += '<tr><td>Tutorial Location ' + i + ':</td><td><input type="text" name="location[]" value="' + location[i] + '" required></td></tr>';
					html += '<tr><td>Tutorial Tutor ' + i + ':</td><td><input type="text" name="tearcher[]" value="' + tearcher[i] + '" required></td></tr>';
					html += '<tr style="height: 20px"></tr>';
				} else {
					//concatinate number of fields to a variable
					html += '<tr><td>Tutorial Code ' + i + ':</td><td><input type="text" name="section_code[]" value="" required></td></tr>';
					html += '<tr><td>Tutorial Weekday ' + i + ':</td><td><input type="text" name="weekday[]" value="" required></td></tr>';
					html += '<tr><td>Tutorial Start Time ' + i + ':</td><td><input type="time" name="starttime[]" value="" required></td></tr>';
					html += '<tr><td>Tutorial End Time ' + i + ':</td><td><input type="time" name="endtime[]" value="" required></td></tr>';
					html += '<tr><td>Tutorial Location ' + i + ':</td><td><input type="text" name="location[]" value="" required></td></tr>';
					html += '<tr><td>Tutorial Tutor ' + i + ':</td><td><input type="text" name="tearcher[]" value="" required></td></tr>';
					html += '<tr style="height: 20px"></tr>';
				}
			}
			//insert this html code into the div with class catList
			$('.sectionList').html(html);
		}
	</script>
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
				<h1 class="page-header">Edit Course</h1>
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
						<div class="panel-heading">Edit Course</div>
						<div class="panel-body">
							<table style="align:center; width:100%;">
								<tr>
									<td>Course Code:</td>
									<td><input type="text" name="course_code"<?php print ' value="'.$course_code.'" ';?>disabled></td>
								</tr>
								<tr>
									<td>Course Name:</td>
									<td><input type="text" name="name"<?php print ' value="'.$name.'" ';?>required></td>
								</tr>
								<tr>
									<td>Number of Tutorials:</td>
									<td>
										<select type="text" id="newSectionNumber" name="newSectionNumber">
											<option value="1"<?php if ($num_of_section == 1) print " selected";?>>1 tutorial</option>
											<option value="2"<?php if ($num_of_section == 2) print " selected";?>>2 tutorials</option>
											<option value="3"<?php if ($num_of_section == 3) print " selected";?>>3 tutorials</option>
											<option value="4"<?php if ($num_of_section == 4) print " selected";?>>4 tutorials</option>
											<option value="5"<?php if ($num_of_section == 5) print " selected";?>>5 tutorials</option>
											<option value="6"<?php if ($num_of_section == 6) print " selected";?>>6 tutorials</option>
											<option value="7"<?php if ($num_of_section == 7) print " selected";?>>7 tutorials</option>
											<option value="8"<?php if ($num_of_section == 8) print " selected";?>>8 tutorials</option>
											<option value="9"<?php if ($num_of_section == 9) print " selected";?>>9 tutorials</option>
											<option value="10"<?php if ($num_of_section == 10) print " selected";?>>10 tutorials</option>
										</select>
									</td>
								</tr>
								<tr style="height: 20px"></tr>
							</table>
							<div class="sectionList"></div>
						</div>
						<div align="center">
							<button style="padding-right:20px; padding-left:20px" type="submit" name="submit" id="update" value="update">Save</button>
						</div>
						<br/>
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
							<thead>
								<tr>
									<th>Course Code</th>
									<th>Course Name</th>
									<th>Number of Tutorials</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$query = "SELECT * FROM course";
									$result = $conn->query($query);
									if (!$conn->query($query)) {
										print $conn->error;
									}
									//List out all programe data
									while ($row = $result->fetch_object()) {
										print "<tr class='odd gradeX'>";
										print "<td><a href='EditCourse.php?course_code=" . $row->course_code. "'>" . $row->course_code. "</a></td>";
										print "<td>" . $row->name. "</td>";
										print "<td>" . $row->num_of_section. "</td>";
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