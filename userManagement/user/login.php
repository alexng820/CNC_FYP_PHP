<!DOCTYPE html>
<?php
include("DBConnect.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
   //Get input from user
   $user_id_input = mysqli_real_escape_string($conn, $_POST['user_id_input']);
   $password_input = mysqli_real_escape_string($conn, $_POST['password_input']);
   //Retrieve data from database java
   $sql=  "SELECT * FROM user WHERE user_id = '$user_id_input' LIMIT 1";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_assoc($result);
   $password = $row['password'];
   $role = $row['role'];
   $status = $row['status'];
       
   //Check if user is admin
   if($role!="Admin"){
            echo "<script type='text/javascript'>alert('Sorry,you are not allowed to access.')</script>";
   }
 //  Check if account is active
   if($status=="Inactive"){
          echo "<script type='text/javascript'>alert('Sorry,your account has been disabled.')</script>";
   }
   if($role=="Admin" && $status=="Active"){
         //Verify password
      if (password_verify($password_input, $password)) {
         $count = mysqli_num_rows($result);
         //If success,redirect to create page 
            if($count == 1) {
               $_SESSION['login_user'] = $user_id_input;
               header("location: CreateUser.php");
            }
         }
         else{
         echo "<script type='text/javascript'>alert('Your User Id or password is invalid.')</script>";
         }
      }
      
 }
?>
<html >
<head>
   <meta charset="UTF-8">
   <title>User managment system</title>
   <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="login-page">
  <div class="form">

    <form action = "login.php" method = "post">
      <input type = "text" name = "user_id_input" id="user_id_input" class = "box" placeholder="User ID"/>
      <input input type = "password" name = "password_input" id="password_input" class = "box" placeholder="password"/>
      <button type = "submit" value = " Submit "/>login</button>
      
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>
