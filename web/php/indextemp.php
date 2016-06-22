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
   $sql = "SELECT Id FROM Clients WHERE Business='$_POST[user]'AND Password ='$_POST[pass]' LIMIT 1";
   $res = $conn->query($sql);
   if($res->num_rows==1){
      $row = $res->fetch_assoc();
      $_SESSION["ClientID"]=$row["Id"];
      header("Location: /clientHome.php");
      exit();
   }else{
      echo "Login unsuccessful";
      exit();
   }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> UAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/styling/index_styling.css" type="text/css"/> 
  </head>
  <body>
<div class = "navbar navbar-inverse navbar-custom" role="navigation">
  <div class="container">
    <div class="navbar-header">
   <button type="button" class="navbar-toggle"
   data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr.only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
   </button>
   <a class="navbar-brand" href="/">Home</a>
    </div>
    <div class="navbar-collapse">
   <ul class="nav navbar-nav">
      <li><a href="/tracking.php">Tracking</a></li>
   </ul>
    </div>
    </div>
  </div>
</div>

<div class="container">
   <div class="page-header">
     <h1>Welcome to TRACKING</h1>
   </div>
   <div class="container">
      <div id="Log-in">
         <form method="POST" action="indextemp.php">
            User <br><input type="text" name="user" size="40"><br>
            Password <br><input type="password" name="pass" size="40"><br>
            <input id="button" type="submit" name="submit" value="Log In">
         </form>
      </div>
   </div>
</div>
</body>
</html>
<?php
$conn->close();
?>
