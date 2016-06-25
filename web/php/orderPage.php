<?php
#("redirect.php");
?>

<!-- Code adapted from http://earlysandwich.com/programming/php/integrate-paypal-payment-system-website-php-mysql-261/
-->
<html>
<body>
<style>
.title{
    font-weight:bold;
}
.buy
{
    border: 1px solid #cecece;
    padding: 10px;
    margin: 5px;
    padding: 5px;
    text-align: center;
    width: 300px;
 
   
}
</style>
<div style="text-align:center">
    <h2>Paypal Payment</h2>   
   
<h3>Buy this item now.</h3>
 
<div class="buy">   
    <!-- Logo source code from: https://www.paypal.com/us/webapps/mpp/logo-center -->
    <div class="image">
   <!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" border="0" alt="PayPal Logo"></a></td></tr></table><!-- PayPal Logo --> 

    </div>
    <div class="title">
        Order with Paypal.
        <br /><br />
    </div>

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
				</form>
			</div>
      </div>
   </div>
</div>

    <div class="btn">
    
    <form action="<?php echo $payment_url; ?>" method="post" name="frmPayPal1">
    <input typ name="handling" value="0">
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>
</div>
 
</div>
</style>
</body>
</html>
