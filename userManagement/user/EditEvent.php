<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">

    <title>Event management system</title>

 <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	 <?php
		include('../include/DBConnect.php');
        include('../include/session.php');

		extract($_POST);
		$event_id=$_GET['event_id'];
		if(isset($submit)){
            
            //Update user data
			if ($submit=="update"){
			
				$query = "UPDATE Event SET topic='".$topic."',guest='".$guest."', limit_participant='".$limit_participant."',location='".$location."',need_approved='".$need_approved."',date='".$inputdate."',status='".$status."'  WHERE event_id='".$event_id."'";
				$results = $conn->query($query);
				if ($results) {
					echo "<script type='text/javascript'>alert(' Update successfully .')</script>";
				} 
			     
            } 
			if($submit=="changestatus"){
				$query = "UPDATE event_approval SET Status='".$status."'WHERE participant_id='".$participant_id."' and event_id='".$event_id."'";
				$results = $conn->query($query);
			}
			if($submit=="downloadqrcode"){

				header("https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=cncevent://event/".$event_id."&choe=UTF-8");
			}
		}
		        

        //Retrieve data from database to the fields
		$query = "select * from Event where event_id='$event_id'";
		$results = $conn->query($query);

		if ($data = $results->fetch_object()) {
			
			$topic=$data->topic;
			$guest=$data->guest;
			$limit_participant=$data->limit_participant;
			$location=$data->location;
			$need_approved=$data->need_approved;
			$postime=$data->postime;
			$date=$data->date;
			$status=$data->status;
			


                
		}
	 ?>
</head>

<body>

    <div id="wrapper">

    
        <?php include 'navbar.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Event</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<form id="createsingleuser" autocomplete="off" action="" method="POST">
						<div class="panel panel-default">
							<div class="panel-heading">
								Edit event
							</div>
                            
							<div class="panel-body" align="center">
								<table style="align:center;width:100%;">
									<tr>
										<td >
										Event ID:
										</td>
										<td >
										<input type="text" name="event_id"   <?php print "value='$event_id'"; ?> disabled>
										</td>
										<td>
										<a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=cncevent://event/<?php print $event_id; ?>&choe=UTF-8" target="_blank">Downaload QRcode</a>
								
										</td>
									</tr>
									<tr>
										<td >
                                        Topic:
                                        </td>
                                        <td >
                                        <input type="text" name="topic" <?php print "value='$topic'"; ?>>
                                        </td>
									</tr>
                                    <tr>
                                        <td >
                                        Guest:
                                        </td>
                                        <td >
                                        <input type="text" name="guest" <?php print "value='$guest'"; ?> required>
                                        </td>
                                    </tr>
									<tr>
										<td >
										Participant limit:
										</td>
										<td >
										<input type="text" name="limit_participant" <?php print "value='$limit_participant'"; ?> required>
										</td>
									</tr>
									<tr>
										<td >
										Location:
										</td>
										<td >
										<input type="text" name="location" <?php print "value='$location'"; ?> required>
										</td>
									</tr>
                                    <tr>
                                        <td>
                                    Need approval?
                                        </td>
                                        <td >
                                        <select type="text" id="need_approved" name="need_approved" >
                                        <option value="1">Yes</option>
                                        <option value="0" <?php if($need_approved=="0") echo"selected";?>>No</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td >
                                        Date:
                                        </td>
                                        <td >
											<input size="16" type="text" name="inputdate" <?php print "value='$date'"; ?> readonly class="form_datetime">
                                        </td>
                                    </tr>
									<tr>
										<td >
										Status:
										</td>
										<td >
										<select type="text" id="status" name="status" >
                                        <option value="Active">Active</option>
                                        <option value="Inactive" <?php if($status=="Inactive") echo"selected";?>>Inactive</option>
                                        
                                        <?php print "value = 'status'"; ?> >>
                                        </select>
										</td>
									</tr>
									
								</table>
							
							</div>
						<!-- /.panel -->
							<div align="center">
							<button style="padding-right:20px;padding-left:20px" type="submit" name="submit" id="update" value="update" >Save</button>
							
							</div>
							<br/>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Participant ID</th>
                                        <th>Participant Name</th>  
                                        <th>Status</th>
                                        <th>Submit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT event_approval.*,user.name FROM event_approval,user where event_approval.participant_id=user.user_id  and event_approval.event_id= '".$event_id."'";
                                        $result = $conn->query($query);
                                        if (!$conn->query($query)) {
                                            print $conn->error;
                                        }
                                        //Retrieve selected data to the fields
                                        while ($row = $result->fetch_object()) {
                                            print "<tr class='odd gradeX'>";
                                            print "<td>" . $row->participant_id. "</td>";
                                            print "<td>" . $row->name. "</td>";
											print "<form action='' method='POST'>";
											print "<td><select name='status'>";
											if($row->status=="waiting_approval"){
												print "<option value='waiting_approval' selected>Waiting to comfirm</option>";
												print "<option value='approved'>Approved</option>";
												print "<option value='denied'>Denied</option>";
											}if($row->status=="approved"){
												print "<option value='waiting_approval' >Waiting to comfirm</option>";
												print "<option value='approved' selected >Approved</option>";
												print "<option value='denied'>Denied</option>";
											}if($row->status=="denied"){
												print "<option value='waiting_approval' >Waiting to comfirm</option>";
												print "<option value='approved'  >Approved</option>";
												print "<option value='denied' selected>Denied</option>";
											}
											print "</select>";
											print "<td>";
											print "<input type='hidden' name='participant_id' value='".$row->participant_id."'>";
											print "<input type='hidden' name='event_id' value='". $row->event_id. "'>";
											print "<button type='submit' name='submit' id='changestatus' value='changestatus' >Submit</button>";
											print "</form>";
											print "</td>";
                                            print '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
						</div>
					</form>
				<!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
	<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
    </script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.zh-TW.js" charset="UTF-8"></script>
<script type="text/javascript">


     $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        autoclose: true,
        todayBtn: true,
        startDate: new Date().toLocaleString(),
        minuteStep: 10,

    });
</script>
</body>

</html>
