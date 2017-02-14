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
		include('DBConnect.php');
        include('session.php');

		extract($_POST);
		$user_id=$_GET['user_id'];
        
		if(isset($submit)){
            
            //Update user data
			if ($submit=="update"){
                if($password==""){
                    $query = "UPDATE user SET name='".$name."',gender='".$gender."', role='".$role."',status='".$status."'  WHERE user_id='".$user_id."'";
                    $results = $conn->query($query);
                }
                if($password){
                $options = [
                'cost' => 12,
                        ];
                $hashed_password = password_hash($password, PASSWORD_BCRYPT,$options);

				$query = "UPDATE user SET password='".$hashed_password."',name='".$name."',gender='".$gender."', role='".$role."',email='".$email."',status='".$status."'  WHERE user_id='".$user_id."'";
                
                }
				$results = $conn->query($query);
				if ($results) {
					echo "<script type='text/javascript'>alert(' Update successfully .')</script>";
				} 
			     
             }
		        }

        //Retrieve data from database to the fields
        else{
			$query = "select * from user where user_id='$user_id'";
            $results = $conn->query($query);
  
			if ($data = $results->fetch_object()) {
                
				$name=$data->name;
				$gender=$data->gender;
				$role=$data->role;
				$status=$data->status;


                
				
			}
		}
	 ?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="SearchEditUser.php">University Student Information App</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               

                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href = "logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i>User Management<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="CreateUser.php">Create User</a>
                                </li>
                                
                                <li>
                                    <a href="SearchEditUser.php">Search/Edit User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<form id="createsingleuser" autocomplete="off" action="" method="POST">
						<div class="panel panel-default">
							<div class="panel-heading">
								Edit user
							</div>
                            
							<div class="panel-body" align="center">
								<table style="align:center;width:100%;">
									<tr>
										<td >
										User ID:
										</td>
										<td >
										<input type="text" name="user_id"   <?php print "value='$user_id'"; ?> disabled>
										</td>
									</tr>
									<tr>
										<td >
                                        Password:
                                        </td>
                                        <td >
                                        <input type="password" name="password"  pattern=".{6,}" >at least 6 characters
                                        </td>
									</tr>
                                    <tr>
                                        <td >
                                        Name:
                                        </td>
                                        <td >
                                        <input type="text" name="name" <?php print "value='$name'"; ?> required>
                                        </td>
                                    </tr>
									<tr>
										<td >
										Gender:
										</td>
										<td >
										<select type="text" id="gender" name="gender" >
                                         <option value="M">Male</option>
                                        <option value="F" <?php if($gender=="F") echo"selected";?>>Female</option>
                                         <?php print "value = 'gender'"; ?> >>
                                        </select> 
										</td>
									</tr>
									<tr>
										<td >
										Role:
										</td>
										<td >
										<select type="text" id="role" name="role" >
                                        <option value="Student" <?php if($role=="Student") echo"selected";?>>Student</option>
                                        <option value="Teacher" <?php if($role=="Teacher") echo"selected";?>>Teacher</option>
                                        <option value="Admin" <?php if($role=="Admin") echo"selected";?>>Admin</option>
                                        <?php print "value = 'role'"; ?> >>
                                        </select>
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
                                        <th>User ID</th>
                                        <th>Name</th>  
                                        <th>Gender</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM user ";
                                        $result = $conn->query($query);
                                        if (!$conn->query($query)) {
                                            print $conn->error;
                                        }
                                        //Retrieve selected data to the fields
                                        while ($row = $result->fetch_object()) {
                                            print "<tr class='odd gradeX'>";
                                            print "<td><a href='EditUser.php?user_id=" . $row->user_id. "'>" . $row->user_id. "</a></td>";
                                            print "<td>" . $row->name. "</td>";
                                            print "<td>" . $row->gender. "</td>";
                                            print "<td>" . $row->role. "</td>";
                                            print "<td>" . $row->status. "</td>";
                                            
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
</body>

</html>
