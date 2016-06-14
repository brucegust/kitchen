<?php 
include("header_cart.php"); 

$the_session_id=$_GET['session_id'];

function current_cart() {
	
	global $the_session_id;

	global $cxn;

		$sql="select cart.id, cart.session_id, cart.product_id, cart.door_id, cart.sequence, cart.product_cost, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' AND cart.product_id<>'392' AND cart.product_id<>'393' order by sequence DESC";

		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		$result_array = array();
	
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
	return $result_array;
	
}

function feature_cart($product_id, $door_id) {
	
	global $the_session_id;
	
	global $cxn;
	
		if(isset($_POST['session_id']))
		{
			$the_session_id=$_POST['session_id'];
		}
			elseif(isset($_POST['ajax_session_id']))
			{
				$the_session_id=$_POST['ajax_session_id'];
			}
		else
		{
			$the_session_id=$_GET['session_id'];
		}
	
	$sql="select cart.session_id, cart.option_id, cart.feature_id, cart.feature_cost as feature_cost, features.featurecaption, features.featurename from cart INNER JOIN features on cart.feature_id=features.id where cart.session_id='$the_session_id' AND cart.product_id='$product_id' AND door_id='$door_id' AND cart.option_id>0 ORDER BY features.featurecaption";
	//echo $sql;
	if(!$query=$cxn->query($sql))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	
	$result_array="";
	
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		
	return $result_array;
}

function cart_door($product_id, $feature_door_id) {
	
	global $cxn;
	
		if(isset($_POST['session_id']))
		{
			$the_session_id=$_POST['session_id'];
		}
			elseif(isset($_POST['ajax_session_id']))
			{
				$the_session_id=$_POST['ajax_session_id'];
			}
		else
		{
			$the_session_id=$_GET['session_id'];
		}
	
	//this is giving our the door / cabinet color and any corresponding costs
	$sql="select featurename, featureprice from features where product_id=(select part_id from products where id='$product_id') and part_number='$feature_door_id'";
	if(!$query=$cxn->query($sql))
	{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
	}
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	return $result_array;
	
}
function session_door($the_session_id) {
	
	global $cxn;
		
	$sql="select door_id from cart where session_id='$the_session_id'";
	//echo $sql;
	$query=$cxn->query($sql);
	$row=$query->fetch_object();
	return $row->door_id;
}

function cart_link($the_session_id) {
	 
	 global $cxn;
	 
	 /*$sql="select cart.product_id, cart.sequence, doors.id 
	FROM
	cart 
	INNER JOIN
	doors ON
	cart.door_id=doors.feature_door_id
	WHERE
	cart.session_id='$the_session_id'
	ORDER BY 
	cart.sequence DESC LIMIT 1";*/
	
	$sql="select * from cart WHERE session_id='$the_session_id' AND product_id<>'393'AND product_id<>'392' ORDER BY cart.sequence DESC LIMIT 1";
	
	//echo $sql;
	
	if(!$query=$cxn->query($sql))
	{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
	}
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	return $result_array;
	
}

?>

			<div style="float:right; border:1px solid #cccccc; border-radius:10px; width: 200px; height:235px; margin-right:10px; font-size:9pt; padding:5px;"><img src="images/fedex-logo.gif" style="width:85px; float:right; margin-right:5px; margin-top:5px;"><br><hr>Enter your zip code below and click "Calculate Shipping."<br><form method="Post" id="shippingForm"><!--<form method="Post" action="shipping_form.php">--><input type="text" name="shipping_zip" style="width:180px; margin-top:10px; margin-left:3px;"><input type="hidden" name="shipping_session_id" value="<?php echo $the_session_id;?>"><input type="image" src="images/calculate_shipping.png" style="margin-left:3px;"></form><div id="shipping_result" style="border:1px solid #cccccc; width:180px; margin:auto; height:25px; font-weight:bold; padding-top:3px;"></div></div><span class="satellite_title">Checkout</span><br><br>
			Take a moment to review your order, login or create an account if you're a brand new customer, then click on "Proceed to Checkout" at the bottom of the page.
			<br><br>
			Please call 615-828-8377 with any questions or Email: <a href="mailto:orders@onlinecabinetsdirect.com" style="color:#000000;">orders@onlinecabinetsdirect.com</a>.
			<br><br>
			Thanks!
			<br><br>
			<?php
			$the_link=cart_link($the_session_id);
			foreach($the_link as $link)
			{
				$the_product_id=$link['product_id'];
				$the_id=$link['door_id'];
			}
			?>
			To return to your Shopping Cart, click <a href="door_shop.php?door_id=<?php echo $the_id;?>&product_id=<?php echo $the_product_id;?>">here</a>.<br><br><br>
				<div style="width:80%; padding:5px; border:1px solid #cccccc; border-radius:10px; margin:auto;">
					<table style="width:85%; margin:auto; padding:5px; border-collapse:separate; border-spacing:2px; margin-top:10px;" border="0">
					<?php
					$cart_count=1; //this is for the sake of aesthetics
					$check_cart=current_cart();
					foreach($check_cart as $till)
					{	
					//if your feature id is = 0, then you're looking at your product
					?>
						<tr>
							<?php
							if($cart_count>1)
							{
							?>
							<td style="background-color:#000000; color:#ffffff;" colspan="3">&nbsp;
							<?php
							}
							else
							{
							?>
							<td style="background-color:#000000; color:#ffffff; border-top-left-radius:5px; border-top-right-radius:5px;" colspan="3">&nbsp;
							<?php
							}
							?>
							<?php echo stripslashes($till['product_category']);?>
							</td>
						</tr>
						<tr>
							<td style="background-color:#cccccc; color:#000000;" colspan="3">&nbsp;
							<?php echo stripslashes($till['product_name']);?>
							</td>
						</tr>
						<tr>
							<td style="width:400px;">&nbsp;&nbsp;&nbsp;<b>Qty</b></td>
							<td style="width:100px;">&nbsp;<b>Cost</b></td>
							<td style="width:100px; text-align:right;"><b>Total Price</b></td>
						</tr>
						<?php
						//your product cost is going to be whatever is under the "product_cost" column in the cart table divided by the quantity. That will accommodate any "special" or "sale price" that might be in place
						if($till['product_cost']>0.00)
						{
							$the_actual_cost = $till['product_cost']/$till['quantity'];
						}
						else
						{
							$the_actual_cost=0.00;
						}
						?>
							<!--you changed your session_id here-->
							<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $till['quantity']; ?></td>
							<td>$<?php echo number_format($the_actual_cost, 2);?></td>
							<td style="text-align:right;">$<?php echo number_format($till['product_cost'],2);?>&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;<br></td>
						</tr>
						<?php
						$feature_roster=feature_cart($till['product_id'], $till['door_id']); 
						if($feature_roster)
						{
						?>
						<tr>
							<td colspan="3"><b><u>Features...</b></u> (<a href="#" class="show_hide">show / hide</a>)</td>
						</tr>
						<tr class="current_cart_features" style="display:none;">
							<td colspan="3">
								<table>
								<?php 
									$cabinet_color=cart_door($till['product_id'], $till['door_id']);
									foreach($cabinet_color as $color)
									{
									?>
									<tr>
										<td colspan="3"><b>Cabinet Color</b></td>
									</tr>
									<tr>
										<td colspan="2"><u><?php echo stripslashes($color['featurename']);?></u></td>
										<td>$<?php echo number_format($color['featureprice'],2);?></td>
									</tr>
									<?php
									}
									foreach($feature_roster as $cadillac)
									{
									?>
									<tr>
										<td colspan="3"><b><?php echo stripslashes($cadillac['featurecaption']);?></b></td>
									</tr>
									<tr>
										<td colspan="2"><?php echo stripslashes($cadillac['featurename']);?></td>
										<td>$<?php echo number_format($cadillac['feature_cost'],2);?></td>
									</tr>
									<?php		
									}
								?>
								</table>
							</td>
						</tr>
						<?php
						}
						?>
					<?php
					$cart_count=$cart_count+1;
					}
					?>
					<tr>
						<td colspan="3"><hr></td>
					</tr>
					<tr>
						<td id="checkout_subtotal" colspan="3"></td><!--this is where you're putting your liftgate and residential options ,it's your checkout_total.php page-->
					</tr>
				</table>
					
			<br>
			<div style="width:85%; height:auto; padding:10px; margin:auto;">
			<img src="images/credit_cards.jpg" style="float:right; width:150px;"> <li>Enter your shipping postal code to calculate shipping costs</li>
			 <li><b>Payment options available</b>: Credit Card, PayPal, Certified Check or Wire Transfer</li>
			<li><b>Free Shipping Promotion</b>: Free shipping is available on order amounts over $2,500.00</li>
			<li><b>5% Discount Promotion</b>: Order amounts ranging from $25.00 To $2,499.00 will receive a 5% discount which typically covers the majority of shipping costs</li>
			<li><b>Residential Delivery</b>: Residential Delivery is available on all shipments for a $99.00 fee. This fee is in addition to standard shipping rates. Residential delivery can be added to your order from our Shipping Extras Page</li></ul>
			</div><br><br>
			</div><br><br><!-- this ends your table frame-->
	</div><!--this ends your main content frame-->
</div><!-- this ends your "filler" div-->
	<script>
	$(function(){
		//load the bottom section of the cart including the different delivery options
		$('#checkout_subtotal').load('checkout_total.php?session_id=<?php echo $the_session_id;?>');
		
		$('.show_hide').click(function(e){
		e.preventDefault();
		$(this).parents('tr').next(".current_cart_features").toggle("slow");
		});
	});
	
	$("#shippingForm").submit(function(e) {
	cache:false,
	e.preventDefault();
	$('#shipping_result').html("calculating your shipping...");
	var devTest = $( "#shippingForm").serialize(); 
	
	//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
	
	$.post( "shipping_form.php", devTest) 
		.done(function(Drumstick) { 
			if (Drumstick.charAt(0) == "E") 
			{
				alert("ERROR - The submarket has been entered before");
			}
			else 
			{	
				//alert(Drumstick);
				$('#shipping_result').html(Drumstick);    
			}
		});
	});
	</script>
	
	</body>
</html>
<?php include("footer.php"); ?>

