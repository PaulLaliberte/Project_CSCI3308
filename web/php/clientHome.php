<?php
$servername = "localhost";
$username = "paul";
$password = "paul";
$dbname = "project_db";

// Create connection
// It is important to close the connection using the three lines at the end of this file for security reasons.
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<html>
    <head>
        <title>Client Homepage</title>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <link href="static/bootstrap.min.css" rel="stylesheet" media="screen">
        <style type="text/css">
			.tg  {border-collapse:collapse;border-spacing:0;margin-left:auto;margin-right:auto;}
			.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
			.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
			.tg .tg-yw4l{vertical-align:top}
		</style>
    </head>
    <body>
        <div class="container" style="margin-left:auto;margin-right:auto;text-align:center;">
            <h1>Client Home</h2><br>
            <table class="tg">
			<tr>
			<th class="tg-yw4l">Drone ID</th>
			<th class="tg-yw4l">Drone Status</th>
			<th class="tg-yw4l">Order ID</th>
			<th class="tg-yw4l">Tracking Number</th>
			<th class="tg-yw4l">Order status</th>
			<th class="tg-yw4l">Notifications</th>
			</tr>
			<?php
			$sql = "select Drones.Id,Drones.status,Drones.Details,Orders.OrderId,Orders.Status FROM Drones LEFT JOIN Orders ON Drones.Id=Orders.DroneId";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					//echo "id: " . $row["id"]. " - status: " . $row["status"]. "<br>";
					echo '<tr>
					<td class="tg-yw4l">'.$row["Id"].'</td>
					<td class="tg-yw4l">'.$row["status"].'</td>
					<td class="tg-yw4l">'.$row["OrderId"].'</td>
					<td class="tg-yw4l">'.$row["OrderId"].'</td>
					<td class="tg-yw4l">'.$row["Status"].'</td>
					<td class="tg-yw4l">'.$row["Details"].'</td>
					</tr>';
						
				}
			} else {
				echo "Database Error, please contact the developers.";
			}
			?>			
			</table>
            <p>Click <a href="/">here</a> to go home.</p>
        </div>
    </body>
<html>
<?php
$conn->close();
?>
