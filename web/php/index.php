<?php
session_start();

$host="localhost";
$user="root";
$pass="root";
$db="project_db";

$conn = mysqli_connect($host,$user,$pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST['user'])){
   $sql = "SELECT * FROM Clients WHERE Business='$_POST[user]'AND Password ='$_POST[pass]' LIMIT 1";
   $res = $conn->query($sql);
   if($res->num_rows==1){
      $_SESSION["ClientID"]=$_POST['user'];
      header("Location: /clientHome.php");
      exit();
   }else{
      echo "Login unsuccessful";
      exit();
   }
}
?>
<!DOCTYPE HTML>
<html>
<head>
   <title>Log in</title>
</head>
<body>
<div class="container">
   <div class="page-header">
     <h1>Welcome to TRACKING</h1>
   </div>
   <div class="container">
      <div class="row main">
         <div class="panel-heading">
            <div class="panel-title text-center">
               <h1 class="title">Please Login</h1>
               <hr />
            </div>
         <div>
         <div class="main-login main-center">
            <div class="form-horizontal" method="POST" action="index.php">
               <div class="form-group">
                  <label for="name" class="cols-sm-2 control-label">Name</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="user" id="user" placeholder="Business Name"></input>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label for="password" class="cols-sm-2 control-label">Password</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Account Password"></input>
                     </div>
                  </div>
               </div>
            <div class="form-group ">
             <input id="button" type="submit" name="submit" value="Log In">
            <a class="btn btn-primary btn-lg btn-block" role="button" type="submit">Login</a>
                  </div>
                  <div class="login-register">
                        <li> <a href="/register.php">Register</a></li>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
    </body>
</div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
$conn->close();
?>
