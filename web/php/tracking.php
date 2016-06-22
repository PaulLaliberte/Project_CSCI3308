
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
	<h3>Click <a href="/tracking_v2.php">here</a> for an updated version of this page.</h3>
	<div id="map"></div>
    	<script>
			
      		function initMap() {
				
				var droneLatLng = ['Delivery Location', 39.7555, -105.2211];
			
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 15,
					center: {lat: droneLatLng[1], lng: droneLatLng[2]}
				});
				
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
				
				setMarkers(map);
			}	
			
			var coords = [
				['Sender Location', 40.0150, -105.2705, 2],
				['Reciever Location', 39.6536, -105.1911, 3] 
			];
				
			function setMarkers(map) {
				
				var image = {
					url: 'https://cdn1.iconfinder.com/data/icons/buildings-landmarks-set-2/96/Post-Office-512.png',
					scaledSize: new google.maps.Size(25,25)
				};
				
				var bounds = new google.maps.LatLngBounds();
				
				for (var i = 0; i < coords.length; i++) {
					var coord = coords[i];
					
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
	<div class="tracking">
		<form>
			<h3>Enter information to see the drone location</h3>
			Tracking number:<br>
			<input type="text" name="tracking number">
			<input type="submit" name="Submit">
		</form>
	</div>
        <div class="container">
        	<p>Click <a href="/">here</a> to go home.</p>
        <div>
    </body>
<html>

