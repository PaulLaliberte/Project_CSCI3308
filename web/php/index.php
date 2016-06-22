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
<div class = "navbar navbar-inverse navbar-custom1" role="navigation">
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
    <div class="navbar-collapse collapse">
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
		<div class="row main">
         <div class="panel-heading">
            <div class="panel-title text-center">
               <h1 class="title">Please Login</h1>
               <hr />
            </div>
         <div>
			<div class="main-login main-center">
				<div class="form-horizontal" method="post" action="#">
					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="name" id="name" placeholder="Login ID"></input>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="password" class="form-control" name="password" id="password" placeholder="Account Password" required></input>
							</div>
						</div>
					</div>
				<div class="form-group ">
               <a class="btn btn-primary btn-lg btn-block" role="button" href="/clientTracking.php">Login</a>
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

