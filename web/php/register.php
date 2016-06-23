<?php
//register page

$host="localhost";
$user="root";
$pass="root";
$db="project_db";

$conn = mysqli_connect($host,$user,$pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST['name'])&&!empty($_POST['user'])&&!empty($_POST['address'])){
   $sql = "SELECT * FROM Clients WHERE Business = '$_POST[user]'";
   $res = $conn->query($sql);

   //this is where i get errors
   if($res->num_rows == 0){
      $sqlid = "SELECT Id FROM Clients ORDER DESC LIMIT 1"; //get id
      $s_id = $conn->query($sqlid);
      $q_id = $s_id->fetch_assoc();
      $id = $s_id["Id"] + 1;
      $latlong = (int) explode("/",$_POST['address']); //parse lat/long
      $lat = $latlong[0];
      $long = $latlong[1];

      $sql_in = "INSERT INTO Clients (Id, Name, Password, Business, SenderLat, SenderLong) VALUES ('$id','$_POST[name]','$_POST[pass],'$_POST[user]','$lat','$long')";
      if($conn->query($sql_in) == TRUE){
         echo "SUCCESS";
         exit();
      }else{
         echo "FAIL";
         exit();
      }
      header("Location: /");
      exit();
   }else{
      echo "Username already in use, please register again";
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
  </head>
  <body>
    
<div class = "navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle"
	data-toggle="collapse" data-target=".navbar-collapse">
	   <span class="sr.only">Toggle navigatio</span>
	   <span class="icon-bar"></span>
	   <span class="icon-bar"></span>
	   <span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/">Home</a>
    </div>
    <div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
	   <li><a href="/tracking">Tracking</a></li>
	</ul>
    </div>
    </div>
  </div>
</div>

    
	<div class="container">
		<div class="row main">
         <div class="panel-heading">
            <div class="panel-title text-center">
               <h1 class="title">Register</h1>
               <hr />
            </div>
         <div>
			<div class="main-login main-center">
				<div class="form-horizontal">
               <form method="POST" action="register.php">
					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="name" id="name" placeholder="Name"></input>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="business" class="cols-sm-2 control-label">Business</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="user" id="user" placeholder="Business name"></input>
							</div>
						</div>
					</div>
			   	<div class="form-group">
						<label for="address" class="cols-sm-2 control-label">Latitude/Longitude</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="address" id="address" placeholder="Business Lat/Long (in format lat/long)"></input>
							</div>
						</div>
   				</div>
               <div class="login-register">
                    <li> <a href="http://stevemorse.org/jcal/latlon.php" target="_blank">Address to lat/long</a></li>
               </div>
					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="password" class="form-control" name="pass" id="pass" placeholder="Account Password" required></input>
							</div>
						</div>
					</div>
            <div class="form-group ">
                <input id="button" type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">
            </div>
            </form>	
            </div>
			</div>
		</div>
	</div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
   $conn->close();
?>
