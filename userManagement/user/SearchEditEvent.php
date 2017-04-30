<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User management system</title>

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
	?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include 'navbar.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Search/Edit Event</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form id="createsingleuser" autocomplete="off" action="" method="POST">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            Search event
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
									
                                        <th>Event ID</th>
                                        <th>Topic</th>
                                        <th>Guest</th>
                                        <th>Participant limit</th>
                                        <th>Location</th>
                                        <th>Approval</th>
                                        <th>Posttime</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										$query = "SELECT * FROM Event";
										$result = $conn->query($query);
										if (!$conn->query($query)) {
											print $conn->error;
										}
                                 //List out all event data
										while ($row = $result->fetch_object()) {
											print "<tr class='odd gradeX'>";
											print "<td><a href='EditEvent.php?event_id=" . $row->event_id. "'>" . $row->event_id. "</a></td>";
											
											print "<td>" . $row->topic. "</td>";
											print "<td>" . $row->guest. "</td>";
											print "<td>" . $row->limit_participant. "</td>";
											print "<td>" . $row->location. "</td>";
                                            if ($row->need_approved=='1') {
                                                print "<td>Yes</td>";

                                            } else {
                                                print "<td>No</td>";
                                            }
                                            
                                            print "<td>" . $row->postime. "</td>";
                                            print "<td>" . $row->date. "</td>";
                                            print "<td>" . $row->status. "</td>";
                                            
    
											print '</tr>';
										}
									?>

                                </tbody>
                            </table>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
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

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

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
