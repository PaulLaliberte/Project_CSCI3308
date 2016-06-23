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
   if($res->num_rows == 0){
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
						<label for="address" class="cols-sm-2 control-label">Address</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="address" id="address" placeholder="Business Address"></input>
							</div>
						</div>
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
