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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	 <?php
        include('../include/session.php');
        include('../include/DBConnect.php');
		extract($_POST);
		if(isset($submit)){

			if($submit=="Create"){
				$sql = "INSERT INTO Event (event_id,topic,guest,limit_participant,location,need_approved,postime,date,status)VALUES (null,'$topic','$guest','$participant_limit','$location','$need_approved',NOW(),'$inputdate','$status')";
				$result = mysqli_query($conn,$sql);
				if ($result) {
					$event_id=(sprintf("e%08s",mysqli_insert_id($conn)));
                   $sql="UPDATE `Event` SET `event_id`='".$event_id."' WHERE id=".mysqli_insert_id($conn);
                } 
                $result2 = mysqli_query($conn,$sql);
                if ($result2) {
                    echo "<script type='text/javascript'>alert('Event is created !')</script>";
                }
                
            }else{
                echo "<script type='text/javascript'>alert('Error !')</script>";

            }
				
				
			
		}
	 ?>
 
</head>

<body>

    <div id="wrapper">

        <?php include 'navbar.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Event</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<form id="createsingleuser" autocomplete="off" action="" method="POST">
						<div class="panel panel-default">
							<div class="panel-heading">
								Create event
							</div>
							<div class="panel-body">
								<table style="align:center;width:100%;">


                                       <tr>
                                        <td>
                                        Topic:
                                        </td>
                                        <td>
                                        <input type="text" name="topic"   required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Guest:
                                        </td>
                                        <td>
                                        <input type="text" name="guest"  required> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Participant limit:
                                        </td>
                                        <td>
                                        <input type="text" name="participant_limit" required>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                        Location:
                                        </td>
                                        <td>
                                        <input type="text" name="location" required>
                                    </tr>
                                                                        <tr>
                                        <td>
                                        Need approval?
                                        </td>
                                        <td>
                                        <input type="radio" name="need_approved" value="1" required> Yes     
                                        <input type="radio" name="need_approved" value="0" > No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Date:
                                        </td>
                                        <td>
                                        <input size="16" type="text" name="inputdate" readonly class="form_datetime">
 

                                            <br/>
            </div>
                                </td>
                                    </tr>
                                    
                                     <tr>
                                        <td>
                                        Status:
                                        </td>
                                        <td>
                                        <input type="radio" name="status" value="active" required> Active     
                                        <input type="radio" name="status" value="inactive" > Inactive
                                        </td>
                                    </tr>
                                    
                                </table>
                            
                            </div>
                        <!-- /.panel -->
                            <div align="center">
                                <input style="padding-right:25px;padding-left:25px" type="submit" name="submit" id="submit" value="Create" >
							</div>
							<br/>
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
