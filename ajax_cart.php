<form method="Post" id="theForm">
<table style="width:85%; margin:auto; padding:5px; border-collapse:separate; border-spacing:2px;" border="0">
<?php
	$quantity_count=0;
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
			<?php echo stripslashes($till['product_name']);?><div style="float:right; display:inline-block;"><input type="checkbox" name="product_<?php echo $till['product_id'];?>_<?php echo $till['door_id'];?>" value="Y"><img src="images/trash_can.png" style="padding-bottom:3px;"></div>
			</td>
		</tr>
		<tr>
			<td style="width:400px;">&nbsp;&nbsp;&nbsp;<b>Qty</b></td>
			<td style="width:100px;"><b>Cost</b></td>
			<td style="width:100px;"><b>Total Price</b></td>
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
			<td id="cost_<?php echo $quantity_count;?>">$<?php echo number_format($the_actual_cost, 2);?></td>
			<td id="price_<?php echo $quantity_count;?>">$<?php echo number_format($till['product_cost'],2);?></td>
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
	$quantity_count=$quantity_count+1;
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
		<td colspan="3" style="text-align:center;"><input type="hidden" name="quantity_count" value="<?php echo $quantity_count;?>"><input type="hidden" name="form_up_value" value="0"><input type="hidden" name="ajax_session_id" value="<?php echo $_GET['session_id'];?>"><input type="image" src="images/update_cart.png"></td>
	</tr>
</table>
</form>


	
<script>

$(function(){
	$('.show_hide').click(function(e){
	e.preventDefault();
	$(this).parents('tr').next(".current_cart_features").toggle("slow");
	});

	$("#theForm").submit(function(e) {// use the correct ID
		cache:false,
		e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.
		
		var devTest = $( "#theForm" ).serialize();
		$.post( "ajax_relay.php", devTest) 
		.done(function(Drumstick) { 
			if (Drumstick != "fail") 
			{
				//alert(Drumstick);//here is where I need to refresh my page and set my toggled parts of my page to their appropriate setting	
				$('#sidebar_content').load('ajax.php?session_id=<?php echo $the_session_id;?>');
			}
			else
			{
				alert("Something went wrong! Please contact Customer Service!");
			}
		});
	});
});


</script>