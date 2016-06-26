<?php

?>

<!-- Code adapted from http://earlysandwich.com/programming/php/integrate-paypal-payment-system-website-php-mysql-261/
-->
<html>
<body>

<div style="text-align:center">
    <h2>Paypal Payment</h2>   
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
				</form>
			</div>
      </div>
   </div>
</div>
<!--  From paypal button creator -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SZX68WM8AQN7S">
<table align="center">
<tr><td><input type="hidden" name="on0" value="Drone Options">Drone Options</td></tr><tr><td><select name="os0">
	<option value="Option 1">Option 1 $250.00 USD</option>
	<option value="Option 2">Option 2 $500.00 USD</option>
	<option value="Option 3">Option 3 $1,000.00 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input style="display: block; margin: 0 auto;" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
</style>
</body>
</html>
