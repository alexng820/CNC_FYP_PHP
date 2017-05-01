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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	 <?php
		include('../include/DBConnect.php');
        include('../include/session.php');
		extract($_POST);
		if(isset($submit)){
// //create
// if ($_POST['submit'] ){
    // if(!isset($name) || trim($name) == ''||!isset($password) || trim($password) == ''||!isset($password_comfirm) || trim($password_comfirm) == ''||!isset($role) || trim($role) == ''||!isset($gender) ||
     // trim($gender) == ''||!isset($email) ||!isset($status) || trim($status) == '')
// { echo "<script type='text/javascript'>alert('Please enter all required fields.')</script>";
// }
// else{
    // if($password==$password_comfirm){
        // $options = [
        // 'cost' => 12,
        // ];
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT,$options);
        // $sql = "INSERT INTO user (password, name,role,gender,status)
        // VALUES ('$hashed_password','$name','$role','$gender','$status')";
        // $results=$conn->query($sql);
    // if ($results) {
     // echo "<script type='text/javascript'>alert('User is created !')</script>";
                        // $action="user updated by Admin";
                    // } 
				// }else{
					// echo "<script type='text/javascript'>alert('Password not match !')</script>";

				// }
                // }
			// }
		// }
			if($submit=="Create"){
				if($password==$password_comfirm){
					$options = ['cost' => 12,];
					$hashed_password = password_hash($password, PASSWORD_BCRYPT,$options);
					$sql = "INSERT INTO user (user_id,password, name,role,gender,status)VALUES (null,'$hashed_password','$name','$role','$gender','$status')";
					$result = mysqli_query($conn,$sql);
					if ($result) {
						if($role=="Admin"){$user_id=(sprintf("a%08s",mysqli_insert_id($conn)));}
						if($role=="Student"){$user_id=(sprintf("s%08s",mysqli_insert_id($conn)));}
						if($role=="Teacher"){$user_id=(sprintf("t%08s",mysqli_insert_id($conn)));}						
						$sql="UPDATE `user` SET `user_id`='".$user_id."' WHERE id=".mysqli_insert_id($conn);
						$result2 = mysqli_query($conn,$sql);
						if ($result2) {
							echo "<script type='text/javascript'>alert('User is created !')</script>";
						}
					}
				}else{
					echo "<script type='text/javascript'>alert('Password not match !')</script>";
				}
				
			}
		}
	 ?>
</head>

<body>

    <div id="wrapper">

          <div id="wrapper">

 
        <?php include 'navbar.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<form id="createsingleuser" autocomplete="off" action="" method="POST">
						<div class="panel panel-default">
							<div class="panel-heading">
								Create user
							</div>
							<div class="panel-body">
								<table style="align:center;width:100%;">
					                   <tr>
                                        <td>
                                        Name:
                                        </td>
                                        <td>
                                        <input type="text" name="name"   required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Password:
                                        </td>
                                        <td>
                                        <input type="password" name="password" pattern=".{6,}" required> at least 6 characters
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Password Confirmation:
                                        </td>
                                        <td>
                                        <input type="password" name="password_comfirm" pattern=".{6,}" required>
                                        </td>
                                    </tr>
									
                                    <tr>
                                        <td>
                                        Gender:
                                        </td>
                                        <td>
                                        <input type="radio" name="gender" value="M" required> Male &nbsp;    
                                        <input type="radio" name="gender" value="F" > Female
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                        Role:
                                        </td>
                                        <td>
                                        <select type="text" id="role" name="role" >
                                        <option value="Student">Student</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Admin">Admin</option>
                                    
                                        </select>
                                        </td>
                                    </tr>
                                    
									 <tr>
                                        <td>
                                        Status:
                                        </td>
                                        <td>
                                        <input type="radio" name="status" value="Active" required> Active     
                                        <input type="radio" name="status" value="Inactive" > Inactive
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

</body>

</html>
