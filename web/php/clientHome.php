<?php
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
   if ($res->num_rows ==1){
      $row = $res->fetch_assoc();
      if ($row["Id"]==$_SESSION["ClientID"]){
         $num = (int) $_POST["drones"];
         $sql_in = "INSERT INTO Drones (Id, Status, Details, Renter) VALUES (NULL, 0, 'Returning to Base', '$_SESSION[ClientID]');";
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
}

if (!empty($_GET["address"]) && !empty($_GET["weight"]) && !empty($_GET["city"]) && !empty($_GET["priority"])) {

	//Convert address to Coordinates
	$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".urlencode($_GET["address"].','.$_GET["city"].','.$_GET["state"].',USA')."&sensor=true";
	$xml = simplexml_load_file($request_url) or die("url not loading");
	$status = $xml->status;
	if ($status=="OK") {
		$recieverLat = $xml->result->geometry->location->lat;
		$recieverLon = $xml->result->geometry->location->lng;
	} else {
		echo "Could not parse address into coordinates, please contact the developers.";
		exit();
	}

	//get receiver location, drone position, and drone launch time
	$sql = "SELECT Id FROM Drones WHERE Status=0 LIMIT 1;"; //This is a bug because 0 is currently for "Returning to Base", but it should be "drone availiable".
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$droneID = $row["Id"];
		}
	} else {
		echo "Sorry, all drones are busy.  A drone will be asigned to you order as soon as possible.";
		$droneID = "NULL";
	}
	// if (new DateTime() > new DateTime($_GET["pickupTime"])) {
	//     $pickupTime = time();
	// } else {
	// 	$pickupTime = date_timestamp_get(new DateTime($_GET["pickupTime"]));
	// }
	$orderTime = time();
	//Insert the order into the database
	$sql = 'INSERT INTO Orders (OrderId, ClientId, DroneId, OrderTimestamp, RecieverLat, RecieverLong, Status, TimeOut, DroneLat, DroneLong) VALUES (NULL, '.$_SESSION["ClientID"].', '.$droneID.', '.$orderTime.', '.$recieverLat.', '.$recieverLon.', 0, NULL, NULL, NULL);';

	if ($conn->query($sql) === TRUE) {
		echo 'Your Order, #'.$conn->insert_id.', has been placed.  <br><a href="/clientHome.php">Click here to go back.</a>';
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		exit();
	}
} else if (empty($_GET)) {
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
      <li><a href="/clientHome.php#drone">Request Drones</a></li>
   </ul>
    </div>
    </div>
  </div>
</div>

        <div class="container" style="margin-left:auto;margin-right:auto;text-align:center;">
            <h1>Client Home</h2><br>
            <p>Click on the Order IDs to see where the drones carrying those packages are.</p>
            <table class="tg">
			<tr>
			<th class="tg-yw4l">Drone ID</th>
			<th class="tg-yw4l">Drone Status</th>
			<th class="tg-yw4l">Order ID</th>
			<th class="tg-yw4l">Order status</th>
			<th class="tg-yw4l">Departure Time</th>
			<th class="tg-yw4l">Notifications</th>
			</tr>
			<?php
			$sql = "select Drones.Id,Drones.Details,Drones.Details AS DroneStatus,Orders.OrderId,Orders.TimeOut,OrderStatus.Description AS Status FROM Drones RIGHT JOIN Orders ON Drones.Id=Orders.DroneId LEFT JOIN OrderStatus ON OrderStatus.Status=Orders.Status WHERE Orders.ClientId = ".$_SESSION["ClientID"].";";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					//echo "id: " . $row["id"]. " - status: " . $row["status"]. "<br>";
					if (is_null($row["TimeOut"])) {
						$timeOut = 'Shipment Pending';
					} else {
						$timeOut = date('Y-m-d H:i:s',$row["TimeOut"]);
					}
					echo '<tr>
					<td class="tg-yw4l">'.$row["Id"].'</td>
					<td class="tg-yw4l">'.$row["DroneStatus"].'</td>
					<td class="tg-yw4l"><a href="/tracking_v2.php?OrderId='.$row["OrderId"].'">'.$row["OrderId"].'</a></td>
					<td class="tg-yw4l">'.$row["Status"].'</td>
					<td class="tg-yw4l">'.$timeOut.'</td>
					<td class="tg-yw4l">'.$row["Details"].'</td>
					</tr>';
						
				}
			} else{
            echo 'error accessing databse';
         }

         ?>			
			</table><br><br>
			
				
		<div class="container">
        <div class="row main">
          <div class="panel-heading">
            <div class="panel-title text-center">
               <div name="order" id ="order" ><h3 class="title">Place Order</h3></div>
               <hr />
            </div>
         </div>
         <div class="main-login main-center">
            <div class="form-horizontal">
		      <form action="" method="GET" id="orderForm">
               <div class="form-group">
                  <label for="address" class="cols-sm-2 control-label">Recipient Street</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="address" placeholder="Street" autocomplete="street-address"></input>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="city" class="cols-sm-2 control-label">Recipient City</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="city" placeholder="City" autocomplete="address-level2"></input>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="state" class="cols-sm-2 control-label">Recipient State</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input list="state" class="form-control" name="state" placeholder="State" autocomplete="address-level1"></input>
                     </div>
                  </div>
               </div>
						<datalist id='state' name="state">
						<option value="Alaska">
						<option value="Arizona">
						<option value="Arkansas">
						<option value="California">
						<option value="Colorado">
						<option value="Connecticut">
						<option value="Delaware">
						<option value="District Of Columbia">
						<option value="Florida">
						<option value="Georgia">
						<option value="Hawaii">
						<option value="Idaho">
						<option value="Illinois">
						<option value="Indiana">
						<option value="Iowa">
						<option value="Kansas">
						<option value="Kentucky">
						<option value="Louisiana">
						<option value="Maine">
						<option value="Maryland">
						<option value="Massachusetts">
						<option value="Michigan">
						<option value="Minnesota">
						<option value="Mississippi">
						<option value="Missouri">
						<option value="Montana">
						<option value="Nebraska">
						<option value="Nevada">
						<option value="New Hampshire">
						<option value="New Jersey">
						<option value="New Mexico">
						<option value="New York">
						<option value="North Carolina">
						<option value="North Dakota">
						<option value="Ohio">
						<option value="Oklahoma">
						<option value="Oregon">
						<option value="Pennsylvania">
						<option value="Rhode Island">
						<option value="South Carolina">
						<option value="South Dakota">
						<option value="Tennessee">
						<option value="Texas">
						<option value="Utah">
						<option value="Vermont">
						<option value="Virginia">
						<option value="Washington">
						<option value="West Virginia">
						<option value="Wisconsin">
						<option value="Wyoming" name="WY">
						</datalist><br>
               <div class="form-group">
                  <label for="weight" class="cols-sm-2 control-label">Package Weight</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input list="text" class="form-control" name="weight" placeholder="Weight(kg)"></input>
                     </div>
                  </div>
               </div>
					<!--Pickup Time: <input type="datetime-local" name="pickupTime" value="<?php echo date("Y-m-d\TH:i:s"); ?>"><br>-->
					Shipping Priority: <input type="radio" name="priority" checked="checked" value="high">High<br>
               <div class="form-group ">
                     <input type="submit" class="btn btn-primary btn-lg btn-block" value="Place Order">
                  </div>
				</form>
			</div>
      </div>
   </div>
</div>

      <div class="container">
        <div class="row main">
          <div class="panel-heading">
            <div class="panel-title text-center">
               <div name="drone" id ="drone" ><h3 class="title">Request Drones</h3></div>
               <hr />
            </div>
         </div>
         <div class="main-login main-center">
            <div class="form-horizontal">
            <form action="clientHome.php" method="POST">
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
               <div class="form-group">
                  <label for="drones" class="cols-sm-2 control-label">Number of Drones to Request</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="drones" placeholder="Number"></input>
                     </div>
                  </div>
               </div>	
               <div class="form-group ">
                     <input type="submit" class="btn btn-primary btn-lg btn-block" value="Process Request">
               </div>
            </form>
            </div>
         </div>
      </div>
   </div>

			<div>
            <p>Click <a href="/clientHome.php">here</a> to go back to top.</p>
        </div>
    </body>
<html>
<?php
}
$conn->close();
?>
