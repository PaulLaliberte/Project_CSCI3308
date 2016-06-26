<?php

date_default_timezone_set('America/Denver');

session_start();

if (!isset($_SESSION["ClientID"])) {
   echo 'Not logged in.<br><a href="/">Click here to go home.</a>';
   exit();
}

$credentials = str_getcsv(file_get_contents('credentials.csv'));
//echo '<pre>'; print_r($credentials); echo '</pre>';  //uncomment this line to see the structure of $credentials

$conn = mysqli_connect($credentials[0],$credentials[1],$credentials[2],$credentials[3]);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!empty($_POST["verifyid"]) && !empty($_POST["verifypass"]) && !empty($_POST["drones"])){
   $sql = "SELECT Id FROM Clients WHERE Business = '$_POST[verifyid]' AND Password = '$_POST[verifypass]';";
   $res = $conn->query($sql);
   $num = (int) $_POST["drones"];
   if($num > 0){
      if ($res->num_rows ==1){
         $row = $res->fetch_assoc();
         if ($row["Id"]==$_SESSION["ClientID"]){
            $sql_in = "INSERT INTO Drones (Id, Status, Details, Renter) VALUES (NULL, 4, 'Available', '$_SESSION[ClientID]');";
            for ($i=1; $i<= $num; $i++){
               if($conn->query($sql_in)){
               }else{
                  echo "Error registering drones, please try again";
               }
            }
            header("Location: /clientHome.php");
            exit();
         }else{
            echo "Logged in as different user, drone request failed";
            exit();
         }
      }else{
         echo "Drone request failed";
         exit();
      }
   }else{
      $num = -$num;
      $sql_out = "DELETE FROM Drones WHERE Renter = '$_SESSION[ClientID]' AND Status = 4 LIMIT 1;";
      for($i=1;$i<=$num;$i++){
         if($conn->query($sql_out)){
         }else{
            echo "Failed to remove drones";
         }
      }
      header("Location: /https://www.paypal.com/cgi-bin/webscr");
      exit();

   }
}
?>

<html>
    <head>
        <title>Client Homepage</title>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <link href="static/bootstrap.min.css" rel="stylesheet" media="screen">
       <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0;margin-left:auto;margin-right:auto;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg .tg-yw4l{vertical-align:top}
      </style>
                     <script type="text/javascript">
                     function calculateCost(){
                        var num = document.getElementById('drones').value;
                        var output = num*250;
                        document.getElementById('cost').innerHTML = "$"+output+".00";
                     }
                     </script>

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
    </div>
    <div class="navbar-collapse">
   <ul class="nav navbar-nav">
      <li><a href="/clientHome.php#order">Place Order</a></li>
      <li><a href="/registerDrones.php">Request/Remove Drones</a></li>
   </ul>
    </div>
    </div>
  </div>
</div>

     <div class="container">
        <div class="row main">
          <div class="panel-heading">
            <div class="panel-title text-center">
               <div name="drone" id ="drone" ><h3 class="title">Request/Remove Drones</h3></div>
               <hr />
            </div>
         </div>
         <div class="main-login main-center">
            <div class="form-horizontal">
            <form action="registerDrones.php" method="POST">
               <div class="form-group">
                  <label for="verifyid" class="cols-sm-2 control-label">Verify Business ID</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="verifyid" placeholder="Business ID"></input>
                     </div>
                 </div>
               </div>
               <div class="form-group">
                  <label for="verifypass" class="cols-sm-2 control-label">Verify Password</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="verifypass" placeholder="Password"></input>
                     </div>
                  </div>
               </div>
               <div class="form-group" style="width:60%;float:left;">
                  <label for="drones" class="cols-sm-2 control-label">Number of Drones to Request/Remove</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input onchange="calculateCost()" type="text" class="form-control" id='drones' name="drones" placeholder="Positive number to add drones, negative to remove"></input>
                     </div>
                  </div>
               </div>
               <div class="form-group" style="width:40%;float:right">
                  <label for="cost" class = "cols-sm-2 control-label">Monthly Cost</label>
                  <div class = "cols-sm-10">
                     <p id='cost'></p>
                  </div>
               </div><br><br>
 

<!--  From paypal button creator -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SZX68WM8AQN7S">
<input type="hidden" name="currency_code" value="USD">
<input style="display: block; margin: 0 auto;" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">           </form>
            </div>
         </div>
      </div>
   </div>
 </body>
<html>
<?php
$conn->close();
?>
