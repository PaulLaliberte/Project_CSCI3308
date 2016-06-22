<?php

if(isset($_GET['OrderId'])) {

	$senderCoordinates = array(0,0);  // order lat, lon
	$recieverCoordinates = array(0,0);
	$droneCoordinates = array(0,0);

	$orderId = $_GET["OrderId"];

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "project_db";

	// Create connection
	// It is important to close the connection using the three lines at the end of this file for security reasons.
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		echo "connection error";
		die("Connection failed: " . $conn->connect_error);
	}
	

	//validate the given order id number
	$sql = "SELECT OrderId FROM Orders WHERE OrderId=".$orderId.";";
	$result = $conn->query($sql);
	
	
	if ($result->num_rows > 0) {
		// the orderid is valid, show the map	

	//get sender location
	$sql = "SELECT SenderLat,SenderLong from Clients WHERE Id = (SELECT ClientId FROM Orders WHERE OrderID=".$orderId.");";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$senderCoordinates[0] = $row["SenderLat"];
			$senderCoordinates[1] = $row["SenderLong"];
		}
	} else {
		echo 'Database Error, please contact the developers or click the link below to make sure that OrderId is set in the URL.<br>
		<a href="?OrderId=121114">clientTracking.php?OrderId=121114</a><br><br>
		';
	}

	//get receiver location, drone position, and drone launch time
	$sql = "SELECT RecieverLat,RecieverLong,DroneLat,DroneLong FROM Orders WHERE OrderID=".$orderId.";";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$recieverCoordinates[0] = $row["RecieverLat"];
			$recieverCoordinates[1] = $row["RecieverLong"];
			$droneCoordinates[0] = $row["DroneLat"];
			$droneCoordinates[1] = $row["DroneLong"];
			$droneTimeOut = $row["TimeOut"];
		}
	} else {
		echo "Database Error, please contact the developers.";
	}
?>
<html>
    <head>
        <title>Tracking</title>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <link href="static/bootstrap.min.css" rel="stylesheet" media="screen">
	<style>
      		#map {
        		width: 600px;
        		height: 500px;
     		 }
   	 </style>
    </head>
    <body>
	<h2>Drone Tracking Page</h2>
	<div id="map"></div>
    	<script>
			
      		function initMap() {
				
				//set drone coordinates.
				var droneLatLng = ['Delivery Location', <?php 
				echo $droneCoordinates[0].", ".$droneCoordinates[1];?>];
			
				//initiate map
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 9,
					center: {lat: droneLatLng[1], lng: droneLatLng[2]}
				});
				
				// custom drone marker
				var drone = {
				url:'https://cdn2.iconfinder.com/data/icons/modern-future-technology/128/drone-128.png',
				scaledSize: new google.maps.Size(25,25)
				};
				
				var marker = new google.maps.Marker({
					position: {lat: droneLatLng[1], lng: droneLatLng[2]},
					map: map,
					icon: drone,
					title: droneLatLng[0]
				});
				
				// info window for drone marker
				var contentstr = '<div id = "content">' + 
					'<div id="deliveryInfo">' + 
					'</div>' + 
					'<h1 id="firstHeading" class="firstHeading">Delivery Info</h1>' +  
					'<p><b>Order ID:</b> placeholder</p>' +
					'<b>Current Status:</b> in transit</p>' +
					'<b>Flight Speed:</b> 20 meters per second (40 miles per hour)</p>' + 
					'<b>Delivery ETA:</b> placeholder</p>' + 
					'</div>' + 
					'</div>';

				var infowindow = new google.maps.InfoWindow({
					content: contentstr
				}); 

				marker.addListener('click', function() {
					infowindow.open(map, marker);
				});	
	
				// call to set remaining markers
				setMarkers(map);
			}	
			
			// set sender/reciever markers
			var coords = [
				['Sender Location', <?php echo $senderCoordinates[0].", ".$senderCoordinates[1]; ?>, 2, 'https://cdn1.iconfinder.com/data/icons/buildings-landmarks-set-2/96/Post-Office-512.png'],
				['Reciever Location', <?php echo $recieverCoordinates[0].", ".$recieverCoordinates[1]; ?>, 3, 'http://simpleicon.com/wp-content/uploads/home-5.png'] 
			];
				
			function setMarkers(map) {
				
				// custom sender/reciever markes;
				var bounds = new google.maps.LatLngBounds();

				for (var i = 0; i < coords.length; i++) {
					var coord = coords[i];

					var image = {
                                        url: coord[4],
                                        scaledSize: new google.maps.Size(25,25)
                                	};	

					var marker = new google.maps.Marker({
						position: {lat: coord[1], lng: coord[2]},
						map: map,
						icon: image,
						title: coord[0],
						zIndex: coord[3]
					});
					
					bounds.extend(marker.position);				
				}
				map.fitBounds(bounds);
			}
		
    	</script>
    	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9yKxAbb4cH2ZJ_D3EWp3sG-DHJLxLURI&callback=initMap"
        async defer></script>
<?php

	} else { ?>
		<h1>Invalid Order ID.  Try again.</h1>
<?php
	}
}
?>
	<div class="tracking">
		<form action="" method="get">
			<h3>Enter information to see the drone location</h3>
			Tracking number:
			<input type="text" name="OrderId">
			<input type="submit">
		</form>
	</div>
        <div class="container">
        	<p>Click <a href="/">here</a> to go home.</p>
        <div>
    </body>
<html>
<?php
$conn->close();
?>
