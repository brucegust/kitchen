<?php
if(isset($_POST['bring_it'])&&$_POST['bring_it']==1)
{
?>
<table>
	<tr>
		<td style="font-variant:small-caps;">Name</td>
		<td><input type="text" style="width:35px;" name="name" value="<?php echo $_POST['
		<div style="background-color:#000000; color:#ffffff; font-weight:bold; width:560px; height:25px; margin:auto; text-align:center; padding-top:3px;"><?php echo stripslashes($grid['name']);?> | <?php echo stripslashes($the_category_name); ?> | $<?php echo $the_price;?></div><br>
		<!--end of beginning text and nameplate-->
		<table style="width:475px; margin:auto;" border="0"><form method="Post" id="theForm">
		<?php
		$select_count=0;
		$current_option_id="";
		$feature_list=$new_door->product_features($grid['part_id']);
		foreach($feature_list as $feature)
		{
			if($feature['featuretype']=="DropImage" OR $feature['featuretype']=="Dropdown")
			{
			?>
				<?php if($current_option_id<>$feature['option_name_id'])
				{
					$select_count=$select_count+1;
				?>
				<tr>
					<td><b><?php echo stripslashes($feature['featurecaption']);?></b></td>
				</tr>
				<tr>
					<td><select name="<?php echo stripslashes($feature['option_name_id']);?>" style="width:450px;">
					<option></option>
					<?php 
					$option_roster=$new_door->option_list($feature['product_id'], $feature['sorting']);
					foreach($option_roster as $option)
					{
					?>
					<option value="<?php echo $option['id'];?>"><?php echo stripslashes($option['featurename']);?></option>
					<?php
					}
					?>
					</select>
					<br><br></td>
				</tr>
				<?php
				}
			}
			$current_option_id=$feature['option_name_id'];
		}
		?>
		
		</table>
	&nbsp;<br>
	<!--end of bordered div-->
	
	<!-- close button -->
	<div style="bottom:0; left:0; right:0; position:absolute; padding-bottom:5px; width:248px; height:50px; text-align:center; margin:auto;"><input type="image" src="images/cancel.png" class="close_window" style="float:left;">&nbsp;&nbsp;<input type="hidden" name="final_count" value="<?php echo $select_count;?>"><input type="hidden" name="part_id" value="<?php echo $grid['part_id'];?>"><input type="hidden" name="product_id" value="<?php echo $grid['id'];?>"><input type="hidden" name="price" value="<?php echo $the_price;?>"><input type="hidden" name="toggle_baby" value="1"><input type="image" class="menu_toggle" src="images/add_to_cart_button.png" style="float:left;" border="0"></form></div>
	<!--end of close button-->
	
}
<!--end of hidden box div-->