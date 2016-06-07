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

//this is the view the user gets when they've just added something to their cart
   ?>
	<form method="Post" id="cartForm">
	<table style="width:85%; margin:auto; padding:5px; border-collapse:separate; border-spacing:2px;" border="0">
		<tr>
			<td style="background-color:#000000; color:#ffffff; border-top-left-radius:5px; border-top-right-radius:5px;" colspan="3">&nbsp;
			<?php echo $_POST['category_name'];?>
			</td>
		</tr>
		<tr>
				<td style="background-color:#cccccc; color:#000000; width:90%;" colspan="3">&nbsp;
				<?php echo stripslashes($_POST['product_name']);?><div style="float:right; display:inline-block;">
				<input type="checkbox" name="ajax_product_<?php echo $_POST['product_id'];?>_<?php echo $_POST['feature_door_id'];?>" value="Y"><img src="images/trash_can.png" style="padding-bottom:3px;"></div>
				</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Qty</b></td>
			<td style="width:100px;"><b>Cost</b></td>
			<td><b>Total</b></td>
		</tr>
		<tr>
		<?php
		//all of this is coming right from the form
		if(isset($_POST['quantity'])&&trim($_POST['quantity']==""))
		{
			$quantity=1;
		}
		else
		{
			$quantity=trim($_POST['quantity']);
		}
		?>
			<td><input type="text" size="4" style="text-align:center;" name="ajax_quantity_<?php echo $_POST['product_id'];?>_<?php echo $_POST['feature_door_id'];?>" value="<?php echo $quantity; ?>"></td>
			<td>$<?php echo $_POST['price'];?></td>
			<?php
			$the_product_cost=$_POST['price'] * $quantity;
			?>
			<td>$<?php echo number_format($the_product_cost,2);?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br></td>
		</tr>
		<?php
		if(!isset($_POST['sample_door_alert']))
		{
		?>
		<tr>
			<td colspan="3"><b><u>Features...</b></u></td>
		</tr>
			<?php
			$the_cabinet_color=cart_door($_POST['product_id'], $_POST['feature_door_id']);
			foreach($the_cabinet_color as $the_color)
			{
			?>
			<tr>
				<td colspan="3"><b>Cabinet Color</b></td>
			</tr>
			<tr>
				<td colspan="2"><u><?php echo stripslashes($the_color['featurename']);?></u></td>
				<td>$<?php echo number_format($_POST['door_price'],2);?></td>
			</tr>
			<?php
			}
			for($x=1; $x<=$_POST['the_count']; $x++)
			{
				if(isset($_POST['select_'.$x])&&trim($_POST['select_'.$x])<>"")
				{
					$parts=explode("_", $_POST['select_'.$x]);
					//$parts[0] - this is the option_name_id in your feature table, if there's a cost, it will show up here
					//$parts[1] - this is the id of of the option as it appears in the features table
					//$parts[2] - this is the cost including any adjustment that's been made if the corresponding door is on sale
					$option_name=option_match($parts[0]);
					 $the_feature_name=feature_match($parts[1]);
					?>
					<tr>
						<td colspan="3"><b><?php echo stripslashes($option_name);?></b></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo stripslashes($the_feature_name);?></td>
						<td>$<?php echo $parts[2];?></td>
					</tr>
				<?php				
				}
			}
		}//this ends the if clause, as far as whether or not you just added a sample door
		//now you're listing whatever else might be in the cart, but first check to see if anything is there
		$cart_count=0;
		$the_cart=current_cart();
		if($the_cart)
		{
			$cart_count=1;
			$quantity_count=0;
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
				<td>
				<?php
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
			if($form_up>0)
			{
			?>
				<input type="hidden" name="form_up_value" value="1">
			<?php
			}
			else
			{
			?>
				<input type="hidden" name="form_up_value" value="0">
			<?php
			}
			?>
			<?php
			if($cart_count>0)
			{
			?>
				<input type="hidden" name="quantity_count" value="<?php echo $quantity_count;?>">
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
			<input type="hidden" name="ajax_session_id" value="<?php echo $_POST['session_id'];?>"><input type="image" src="images/update_cart.png"></td>
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