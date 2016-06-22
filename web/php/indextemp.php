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
   <title>LOG IN</title>
</head>
<body>
<div id="Log-in">
   <fieldset style="width:30%"><legend>Log-in here</legend>
   <form method="POST" action="index.php">
      User <br><input type="text" name="user" size="40"><br>
      Password <br><input type="password" name="pass" size="40"><br>
      <input id="button" type="submit" name="submit" value="Log In">
   </form>
   </fieldset>
</div>
</body>
</html>
<?php
$conn->close();
?>
