<?php

function option_match($option_id) {
	
	global $cxn;
	
	$sql="select option_name from options where id='$option_id'";
	$query=$cxn->query($sql);
	$row=$query->fetch_object();
	$the_name=stripslashes($row->option_name);
	return $the_name;
}

function feature_match($feature_id) {

	global $cxn; 

	$sql="select featurename from features where id='$feature_id'";
	//echo $sql;
	if(!$query=$cxn->query($sql))
	{
		$err_3='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	$row=$query->fetch_object();
	$the_name=stripslashes($row->featurename);
	return $the_name;
}

function recent_cart($the_session_id) {
	
	global $cxn;
	
	//establish your most recent sequence # is
	
	$sql_2="select sequence from cart where session_id='$the_session_id' AND quantity>'0' order by sequence DESC LIMIT 1";
	//echo $sql_2;
	$query_2=$cxn->query($sql_2);
	$row_2=$query_2->fetch_object();
	$the_sequence_number=$row_2->sequence;
	
	$sql="select cart.id, cart.session_id, cart.product_id, cart.door_id, cart.sequence, cart.product_cost, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' AND sequence='$the_sequence_number'";
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
	
	$result_array = array();

	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
return $result_array;	
}

function the_current_cart($the_session_id) {
	
	global $cxn;
	
	$sql_2="select sequence from cart where session_id='$the_session_id' AND quantity>'0' order by sequence DESC LIMIT 1";
	//echo $sql_2;
	$query_2=$cxn->query($sql_2);
	$row_2=$query_2->fetch_object();
	$the_sequence_number=$row_2->sequence;
	
	$sql="select cart.id, cart.session_id, cart.product_id, cart.sequence, cart.product_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' AND sequence<'$the_sequence_number' order by sequence DESC";
	//echo $sql;
	/*$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.option_id, cart.feature_id, cart.feature_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' order by product_category, products.name";*/
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
	$result_array = array();

	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}

return $result_array;

}

//this is the view the user gets when they've just added something to their cart

?>
	<?php 
	$quantity_count=1; //you've got one "round" of products here, 
	$new_cart=recent_cart($the_session_id);
	foreach($new_cart as $baby)
	{
		$the_product_category=$baby['product_category'];
		$the_product_name=$baby['product_name'];
		$the_product_id=$baby['product_id'];
		$the_quantity=$baby['quantity'];
		$the_cost=$baby['product_cost'];
		$the_door_cost=$baby['door_cost'];
		$the_door_id=$baby['door_id'];
		$the_id=$baby['id'];
	}
	?>
	<form method="Post" id="cartForm">
	<table style="width:85%; margin:auto; padding:5px; border-collapse:separate; border-spacing:2px;" border="0">
		<tr>
			<td style="background-color:#000000; color:#ffffff; border-top-left-radius:5px; border-top-right-radius:5px;" colspan="3">&nbsp;
			<?php echo $baby['product_category'];?>
			</td>
		</tr>
		<tr>
				<td style="background-color:#cccccc; color:#000000; width:90%;" colspan="3">&nbsp;
				<?php echo stripslashes($the_product_name);?><div style="float:right; display:inline-block;"><input type="checkbox" name="product_<?php echo $the_product_id;?>_<?php echo $the_door_id;?>" value="Y"><img src="images/trash_can.png" style="padding-bottom:3px;"></div>
				</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Qty</b></td>
			<td style="width:100px;"><b>Cost</b></td>
			<td><b>Total</b></td>
		</tr>
		<tr>
			<td><input type="text" size="4" style="text-align:center;" name="quantity_<?php echo $quantity_count.'_'.$the_id;?>" id="quantity_<?php echo $quantity_count;?>" value="<?php echo $the_quantity; ?>"></td>
			<?php
			if($the_cost>0)
			{
				$the_product_price=$the_cost / $the_quantity;
			}
			else
			{
				$the_product_price=0;
			}
			?>
			<td>$<?php echo number_format($the_product_price, 2);?></td>
			<td>$<?php echo number_format($the_cost,2);?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br></td>
		</tr>
		<?php
		$the_feature_roster=feature_cart($the_product_id, $the_door_id); 
			if($the_feature_roster)
			{
			?>
			<tr>
				<td colspan="3"><b><u>Features...</b></u></td>
			</tr>
			<?php
			//you have to retrieve the door_id based on the user's session_id
			$the_cabinet_color=cart_door($the_product_id, $the_door_id);
			foreach($the_cabinet_color as $the_color)
			{
			?>
			<tr>
				<td colspan="3"><b>Cabinet Color</b></td>
			</tr>
			<tr>
				<td colspan="2"><u><?php echo stripslashes($the_color['featurename']);?></u></td>
				<td>$<?php echo number_format($the_door_cost,2);?></td>
			</tr>
			<?php
			}
			foreach($the_feature_roster as $the_cadillac)
			{
			?>
			<tr>
				<td colspan="3"><b><?php echo stripslashes($the_cadillac['featurecaption']);?></b></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo stripslashes($the_cadillac['featurename']);?></td>
				<td>$<?php echo number_format($the_cadillac['feature_cost'],2);?></td>
			</tr>
			<?php		
			}
		}
		?>
		<?php
		//now you're listing whatever else might be in the cart, but first check to see if anything is there
		$cart_count=0;
		$the_cart=the_current_cart($the_session_id);
		if($the_cart)
		{
			$cart_count=1;
			foreach($the_cart as $till)
			{
			//if your feature id is = 0, then you're looking at your product
			?>
			<tr>
				<td style="background-color:#000000; color:#ffffff;" colspan="3">&nbsp;
				<?php echo stripslashes($till['product_category']);?>
				</td>
			</tr>
			<tr>
				<td style="background-color:#cccccc; color:#000000;" colspan="3">&nbsp;
				<?php echo stripslashes($till['product_name']);?><div style="float:right; display:inline-block;"><input type="checkbox" name="product_<?php echo $till['product_id'];?>_<?php echo $till['door_id'];?>" value="Y"><img src="images/trash_can.png" style="padding-bottom:3px;"></div>
				</td>
			</tr>
			<tr>
				<td style="width:400px;">&nbsp;&nbsp;&nbsp;<b>Qty</b></td>
				<td style="width:100px;"><b>Cost</b></td>
				<td style="width:100px;"><b>Total</b></td>
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
				<td><?php
				if($till['product_id']=='393' OR $till['product_id']=='392')
				{
				?>
					<input type="text" size="4" readonly style="text-align:center;" name="quantity_<?php echo $quantity_count.'_'.$till['id'];?>" id="quantity_<?php echo $quantity_count;?>" value="<?php echo $till['quantity']; ?>">
				<?php
				}
				else
				{
				?>
						<input type="text" size="4" style="text-align:center;" name="quantity_<?php echo $quantity_count.'_'.$till['id'];?>" id="quantity_<?php echo $quantity_count;?>" value="<?php echo $till['quantity']; ?>">
				<?php
				}
				?>
				</td>
				<td>$<?php echo $the_actual_cost;?></td>
				<td>$<?php echo number_format($till['product_cost'],2);?></td>
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
								<td>$<?php echo number_format($till['door_cost'],2);?></td>
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
			$cart_count=$cart_count+1;
			$quantity_count=$quantity_count+1;
			}
		}
		?>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr>
			<td colspan="2"><b>Total:</b></td>
			<td>$<?php $the_total=number_format(total_cart(), 2); echo $the_total;?></td>
		</tr>
		<tr>
		<!--if $form_up (line 411 of ajax.php is greater than 0, then you've got something that's just been added to the cart and that needs to be communicated with $form_up_value. That will determine how ajax_relay.php is going to process things-->
		<!-- in a similar way, $cart_count on line 119 and 212 will let you know whether or not there's anything in the cart currently, which will effect how ajax_relay.php processes things as well-->
			<td colspan="3" style="text-align:center;">
			<?php
			if($cart_count>0)
			{
			?>
				<input type="hidden" name="current_cart_value" value="1">
			<?php
			}
			else
			{
			?>
				<input type="hidden" name="current_cart_value" value="0">
			<?php
			}
			?>
			<input type="hidden" name="form_up_value" value="0">		
			<input type="hidden" name="quantity_count" value="<?php echo $quantity_count;?>">			
			<input type="hidden" name="ajax_session_id" value="<?php echo $the_session_id;?>"><input type="image" src="images/update_cart.png"></td>
		</tr>
	</table></form>

<script>	


$(function(){
	$('.show_hide').click(function(e){
	e.preventDefault();
	$(this).parents('tr').next(".current_cart_features").toggle("slow");
	});

	$("#cartForm").submit(function(e) {// use the correct ID
		e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.
		
		var devTest = $( "#cartForm" ).serialize();
		//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
		$.post( "ajax_relay.php", devTest) 
		.done(function(Drumstick) { 
			if (Drumstick != "fail") 
			{
				//alert(Drumstick);//here is where I need to refresh my page and set my toggled parts of my page to their appropriate setting	
				$('#sidebar_content').load('ajax.php?session_id=<?php echo $the_session_id;?>&register=1');
			}
			else
			{
				alert("Something went wrong! Please contact Customer Service!");
			}
		});
	});
});

</script>