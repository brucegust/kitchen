<?php
include("carter.inc");
$cxn = new mysqli($host,$user,$password,$database);
if($cxn->connect_errno)
{
	$err="CONNECT FAIL: "
	.$cxn->connect_errno
	. ' '
	.$cxn->connect_error
	;
	trigger_error($err, E_USER_ERROR);
}

$the_session_id=$_GET['session_id'];

function subtotal_cart() {
	
	global $cxn;
	
	global $the_session_id;
	
	$residential_cost=0;
	$liftgate_cost=0;
	
	$sql="SELECT SUM(feature_cost) as total_feature, SUM(product_cost) as total_product , SUM(door_cost) as total_door FROM cart where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$result_array=array();
		while ($row=$query->fetch_array())
		{
			//this is your odd number of results
			$result_array[]=$row;
		}
		foreach($result_array as $cost)
	{
		$total_feature_cost=$cost['total_feature'];
		$total_product_cost=$cost['total_product'];
		$total_door_cost=$cost['total_door'];
	}
	
	//echo $total_product_cost;
	
	$sql_2="select  product_cost from cart where session_id='$the_session_id' AND product_id='392'";
	if(!$query_2=$cxn->query($sql_2))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query_2
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	$count_2=mysqli_num_rows($query_2);
	//echo $count_2;
	if($count_2>0)
	{
		$query_2=$cxn->query($sql_2);
		$row_2=$query_2->fetch_object();
		$residential_cost=$row_2->product_cost;
	}
	
	$sql_3="select  product_cost from cart where session_id='$the_session_id' AND product_id='393'";
	if(!$query_3=$cxn->query($sql_3))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query_3
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	$count_3=mysqli_num_rows($query_3);
	//echo $count_3;
	if($count_3>0)
	{
		$query_3=$cxn->query($sql_3);
		$row_3=$query_3->fetch_object();
		$liftgate_cost=$row_3->product_cost;
	}
	
	$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost-$residential_cost - $liftgate_cost;		

	return $total_thus_far;
	
}

function current_shipping($id) {
	
	global $cxn;
	
	$sql="select price from products where id='$id'";
	$query=$cxn->query($sql);
	$row=$query->fetch_object();
	$the_price=$row->price;
	
	return $the_price;
	
}
function residential_check() {
	
	global $cxn;
	
	global $the_session_id;
	
	$sql="select id from cart where session_id='$the_session_id' and product_id='392'";
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
	$count=mysqli_num_rows($query);
	
	return $count;
}

function lift_check() {
	
	global $cxn;
	
	global $the_session_id;
	
	$sql="select id from cart where session_id='$the_session_id' and product_id='393'";
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
	$count=mysqli_num_rows($query);
	
	return $count;
}

function total_cart() {
	
	global $cxn;
	
	global $the_session_id;
	
	$sql="SELECT SUM(feature_cost) as total_feature, SUM(product_cost) as total_product , SUM(door_cost) as total_door FROM cart where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$result_array=array();
		while ($row=$query->fetch_array())
		{
			//this is your odd number of results
			$result_array[]=$row;
		}
		foreach($result_array as $cost)
	{
		$total_feature_cost=$cost['total_feature'];
		$total_product_cost=$cost['total_product'];
		$total_door_cost=$cost['total_door'];
	}
	
	//echo $total_product_cost;
	//you need to find out if there's any shipping costs that have been calculated
	
	$the_shipping_cost=0;
	
	 $sql_1="select id from fedex where session_id='$the_session_id'";
	 $query_1=$cxn->query($sql_1);
	$count_1=$query_1->num_rows;
	
	if($count_1>0)
	{
		//echo "here we come";
		$sql_2="select sum(shipping) as total_shipping from fedex where session_id='$the_session_id'";
		$query_2=$cxn->query($sql_2);
		$row_2=$query_2->fetch_array();
	
		$the_shipping_cost=$row_2['total_shipping'];
		//echo $the_shipping_cost;
	}
	//echo $the_shipping_cost;
	
	$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost+$the_shipping_cost;
	
	return $total_thus_far;
	
}

function totalShipping($the_session_id) {
	
	$the_shipping_cost=0;
	
	global $cxn;
	
	 $sql_1="select id from fedex where session_id='$the_session_id'";
	 $query_1=$cxn->query($sql_1);
	$count_1=$query_1->num_rows;
	
	if($count_1>0)
	{
		$sql="select sum(shipping) as total_shipping from fedex where session_id='$the_session_id'";
		$query=$cxn->query($sql);
		$row=$query->fetch_assoc();
	
		$the_shipping_cost=$row['total_shipping'];
	}
	
	return $the_shipping_cost;
}

$residential_row=0;
$lift_row=0;

?>
<form method="Post" id="residentialForm">
<!--<form action="checkout_total_submit.php" method="Post">-->
<table class="subtotal" border="0">
	<tr>
		<td colspan="2"><b>Sub Total:</b></td>
		<td style="text-align:right; min-width:200px;">$<?php $sub_total=number_format(subtotal_cart($the_session_id), 2); echo $sub_total;?></td>
	</tr>
	<?php
	$the_total=total_cart();
	if($the_total>=25)
	{
	?>
		<tr>
			<td colspan="2"><b>Discount:</b></td>
			<td style="text-align:right;">- $<?php 
			$the_discount=floor($the_total *.05);
			echo number_format($the_discount,2);
			?>
			</td>
		</tr>
	<?php
	}
	?>
	<tr>
		<?php
		$the_res_count=residential_check();
		if($the_res_count==0)
		{
		?>
			<td colspan="3" class="subtotal_cell"><input type="checkbox" name="residential" value="Y" style="margin-top:3px;" id="residential_box" onchange="reminder_resident()">&nbsp;add Residential Delivery ($<?php $res_price=current_shipping("392"); echo number_format($res_price, 2);?>)&nbsp;</td>
		<?php
		}
		else
		{
		?>
			<td colspan="2" style="vertical-align:middle;">
				<table style="table-spacing:0; border-collapse: collapse; width:200px;">
					<tr>
						<td><b>Residential Delivery</b>&nbsp;</td>
						<td><input type="checkbox" name="residential_trash" value="Y"></td>
						<td><img src="images/trash_can.png" style="padding-bottom:3px;"></td>
					</tr>
				</table>
			</td>
			<td style="text-align:right;">+ $<?php $res_price=current_shipping("392"); echo number_format($res_price, 2);?></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<?php 
		$the_lift_count=lift_check();
		if($the_lift_count==0)
		{
		?>
		<td colspan="3" class="subtotal_cell"><input type="checkbox" name="liftgate" value="Y" style="margin-top:3px;" id="liftgate_box" onchange="reminder()">&nbsp;add Liftgate  Charge ($<?php $lift_price=current_shipping("393"); echo number_format($lift_price,2);?>)&nbsp;</td>
		<?php
		}
		else
		{
		?>
			<td colspan="2" style="vertical-align:middle;">
				<table style="table-spacing:0; border-collapse: collapse; width:185px;">
					<tr>
						<td><b>Liftgate Charge</b>&nbsp;</td>
						<td><input type="checkbox" name="liftgate_trash" value="Y"></td>
						<td><img src="images/trash_can.png" style="padding-bottom:3px;"></td>
					</tr>
				</table>
			</td>
			<td style="text-align:right;">+ $<?php $lift_price=current_shipping("393"); echo number_format($lift_price, 2);?></td>
		<?php
		}
		?>
	</tr>
	<?php
	$shipping_charge=totalShipping($the_session_id);
	if($shipping_charge>0)
	{
	?>
	<tr>
		<td colspan="2"><b>Shipping:</b></td>
		<td style="text-align:right; min-width:200px;">$<?php echo number_format($shipping_charge, 2); ?></td>
	</tr>
	<?php
	}
	else
	{
	?>
	<tr>
		<td colspan="2"><b>Shipping:</b></td>
		<td style="text-align:right; min-width:200px;">yet to be calculated...</td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="2"><b>Grand Total:</b></td>
		<td style="text-align:right;">$<?php echo number_format($the_total-$the_discount,2);?></td>
	</tr>
	<tr>
		<td colspan="3"><hr></td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center; vertical-align:middle;"><input type="hidden" name="session_id" value="<?php echo $the_session_id;?>"><input type="hidden" name="residential_price" value="<?php echo $res_price;?>"><input type="hidden" name="liftgate_price" value="<?php echo $lift_price;?>"><input type="image" src="images/update_cart.png" style="display:inline-block;">&nbsp;&nbsp;&nbsp;<a href="checkout_login.php?session_id=<?php echo $the_session_id;?>"><img src="images/proceed_checkout.jpg" border="0" style="width:185px; margin-top:-36px;"></a></td>
	</tr>
</table></form>
<script>
function reminder() {
  if (document.getElementById('liftgate_box').checked) {
   alert("Be sure to click \"update cart\" so the\nLiftgate Charge is appropriately added.\n\nThanks!");
   return false;
   }
}

function reminder_resident() {
  if (document.getElementById('residential_box').checked) {
   alert("Be sure to click \"update cart\" so the\nResidential Delivery charge is appropriately added.\n\nThanks!");
   return false;
   }
}

$("#residentialForm").submit(function(e) {// use the correct ID
e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.

var devTest = $( "#residentialForm" ).serialize(); //packaging all of our submitted variables into one, neat little var
//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
$.post( "checkout_total_submit.php", devTest) // posting all of our variables to ajax.php 
	.done(function(Drumstick) { //the "done"function is what you\'re doing when the AJAX call (in this case the ajax.php page) is "done" running and we\'re now hearing back from the server
		if (Drumstick.charAt(0) == "E") //"Drumstick.charAT(0) is just fancy code for the first letter of what you\'re getting back from the server
		{
			alert("ERROR - The submarket has been entered before");
		}
		else 
		{	
			//alert(Drumstick);
			$('#checkout_subtotal').load('checkout_total_submit.php?session_id=<?php echo $the_session_id;?>');
		}
	});
});

</script>