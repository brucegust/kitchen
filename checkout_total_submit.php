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

if(isset($_POST['session_id']))
{
	$the_session_id=$_POST['session_id'];
}
else
{
	$the_session_id=$_GET['session_id'];
}

function residential_cart() {
	
	global $cxn;
	
	global $the_session_id;
	
	 if(isset($_POST['residential'])&&$_POST['residential']=="Y")
	 {
	
		$sql_8="select sequence, door_id from cart where session_id='$the_session_id' and quantity>'0' order by sequence DESC LIMIT 1";
		//echo $sql_8;
		$query_8=$cxn->query($sql_8);
		$result_array=array();
			while ($row_8=$query_8->fetch_array())
			{
				//this is your odd number of results
				$result_array[]=$row_8;
			}
			foreach($result_array as $cost)
			{
				$the_door_id=$cost['door_id'];
				$the_sequence=$cost['sequence']+1;
			}
			
		//just for grins, be sure not to add this more than once
		
		$sql_2="select id from cart where session_id='$the_session_id' AND product_id='392'";
		$query_2=$cxn->query($sql_2);
		$count_2=mysqli_num_rows($query_2);
		if($count_2==0)
		{
			$residential_cost=$_POST['residential_price'];
			 $sql="insert into CART (session_id, product_id, product_cost, door_id, sequence, quantity) VALUES ('$the_session_id', '392', '$residential_cost', '$the_door_id', '$the_sequence', '1')";
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
		}
	 }
	 
	  if(isset($_POST['liftgate'])&&$_POST['liftgate']=="Y")
	 {
		$sql_10="select sequence, door_id from cart where session_id='$the_session_id' and quantity>'0' order by sequence DESC LIMIT 1";
		//echo $sql_10;
		$query_10=$cxn->query($sql_10);
		$result_array_1=array();
			while ($row_10=$query_10->fetch_array())
			{
				//this is your odd number of results
				$result_array_1[]=$row_10;
			}
			foreach($result_array_1 as $cost_1)
			{
				$the_door_id_1=$cost_1['door_id'];
				$the_sequence_1=$cost_1['sequence']+1;
			}
			
		//just for grins, be sure not to add this more than once
		
		$sql_13="select id from cart where session_id='$the_session_id' AND product_id='393'";
		$query_13=$cxn->query($sql_13);
		$count_13=mysqli_num_rows($query_13);
		if($count_13==0)
		{
			$liftgate_cost=$_POST['liftgate_price'];
			 $sql_14="insert into CART (session_id, product_id, product_cost, door_id, sequence, quantity) VALUES ('$the_session_id', '393', '$liftgate_cost', '$the_door_id_1', '$the_sequence_1', '1')";
			 if(!$query_14=$cxn->query($sql_14))
			 {
				$err_14='your course list didn\'t happen because: '
				.'ERRNO: '
				.$cxn->errno
				.' ERROR: '
				.$cxn->error
				.' for this query: '
				.$query_14
				.PHP_EOL;
				trigger_error($err_14, E_USER_WARNING);
			 }
		}
	 }
	 
	  if(isset($_POST['residential_trash'])&&$_POST['residential_trash']=="Y")
	  {
		  $sql="delete from cart where product_id='392' and session_id='$the_session_id'";
		  //echo $sql;
		  $query=$cxn->query($sql);		  
	  }
	  
	  	  if(isset($_POST['liftgate_trash'])&&$_POST['liftgate_trash']=="Y")
	  {
		  $sql="delete from cart where product_id='393' and session_id='$the_session_id'";
		  $query=$cxn->query($sql);		  
	  }
	
}

function subtotal_cart() {
	
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
	if($count_2==0)
	{
		$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost;
	}
	else
	{
		$query_2=$cxn->query($sql_2);
		$row_2=$query_2->fetch_object();
		$residential_cost=$row_2->product_cost;
		$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost-$residential_cost;		
	}
	
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
	$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost;
	
	return $total_thus_far;
	
}

$residential_row=0;
$lift_row=0;

 if(isset($_POST['session_id'])&&$_POST['session_id']<>"")
 {
	 $residential_update=residential_cart();
 }
 
?>
<form method="Post" id="michelleForm">
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
			<td colspan="3" class="subtotal_cell"><input type="checkbox" name="residential" value="Y" style="margin-top:5px;">&nbsp;add Residential Delivery ($<?php $res_price=current_shipping("392"); echo number_format($res_price, 2);?>)&nbsp;</td>
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
						<td><img src="images/trash_can.png"></td>
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
		<td colspan="3" class="subtotal_cell"><input type="checkbox" name="liftgate" value="Y">&nbsp;add Liftgate  Charge ($<?php $lift_price=current_shipping("393"); echo number_format($lift_price,2);?>)&nbsp;</td>
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
						<td><img src="images/trash_can.png"></td>
					</tr>
				</table>
			</td>
			<td style="text-align:right;">+ $<?php $lift_price=current_shipping("393"); echo number_format($lift_price, 2);?></td>
		<?php
		}
		?>
	</tr>
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
$("#michelleForm").submit(function(e) {// use the correct ID
e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.

var devTest = $( "#michelleForm" ).serialize(); //packaging all of our submitted variables into one, neat little var
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