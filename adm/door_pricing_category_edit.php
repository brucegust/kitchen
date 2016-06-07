<?php

session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}

include ("../carter.inc");

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

$michelle="select * from doors where feature_door_id='$_POST[feature_id]'";
$michelle_query=mysqli_query($cxn, $michelle)
or die("Michelle didn't happen");
$michelle_row=mysqli_fetch_assoc($michelle_query);
extract($michelle_row);
$door_name=stripslashes(str_replace('Door Sample', '', $michelle_row['name']));

$vivian = "select features.id, features.product_id, features.part_number, features.featureprice, products.categories as product_category,products.category_id,  products.thumbnail as thumbnail from features INNER JOIN products on features.product_id = products.part_id where features.part_number='$_POST[feature_id]' AND products.category_id='$_POST[category_id]' order by features.product_id ASC";
//echo $vivian;
$vivian_query=mysqli_query($cxn, $vivian)
or die("Vivian didn't happen.");
$vivian_row=mysqli_fetch_assoc($vivian_query);
extract($vivian_row);
$the_category=stripslashes($vivian_row['product_category']);

require_once('header.php');

?>

<style>
.tip {

	background-color:#ffffff;
	filter:alpha(opacity=95);
	/* CSS3 standard */
	/*opacity:0.6;*/
	border:1px solid #cccccc;
	display:none; /*--Hides by default--*/
	padding:10px;
	position:absolute;
	margin-top:-50px;
	margin-left:25px;
	z-index:1000;
	text-decoration: none;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
 </style>

	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Door Pricing Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Below is the list of all the products that you just edited that correspond to the...<div style="margin:auto; text-align:center; font-weight:bold;"><?php echo $door_name;?></div><br>...door / cabinet color price.</br><br>To return to the 
<P>
To return to the <b><?php echo $door_name;?> page</b>, click <a href="door_pricing.php?feature_id=<?php echo $_POST['feature_id'];?>">here</a>. To return to the Door List, click <a href="door_list.php">here</a>.<br><br>
<?php include ("help.php"); ?>
</td>
</tr>
<tr>
<td>
&nbsp;<BR>
</td>
</tr>
<tr>
<td>
<HR>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td align="center">
		<table width="900" align="center" border="1"><form action="door_pricing_category_edit.php" method="Post">
		<tr style="height:25px;">
			<td style="background-color:#000000; color:#ffffff; width:80%;">
			Part Number / Image
			</td>
			<td style="background-color:#000000; color:#ffffff; text-align:center;">
			New Price
			</td>
		</tr>
		<tr style="height:25px;">
			<td style="background-color:#0861c5; color:#ffffff; text-align:center;" colspan="2"><b><?php echo $the_category;?></b></td>
		</tr>
		<?php	
		$product_count=0;
		$querystate = "select features.id as feature_table_id, features.product_id, features.part_number, features.featureprice, products.categories as product_category,products.category_id,  products.thumbnail as thumbnail from features INNER JOIN products on features.product_id = products.part_id where features.part_number='$_POST[feature_id]' AND products.category_id='$_POST[category_id]' order by features.product_id ASC";
		//echo $querystate;
		$resultstate = mysqli_query($cxn, $querystate);
			if(!$resultstate)
			{
				$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
				die($nuts);
			}
		while ($row=mysqli_fetch_assoc($resultstate))
		{
		extract($row);
		?>
		<tr style="height:25px;">
			<td>
			<a href="#" class="tip_trigger" style="color:#000000; text-decoration:underline;"><span class="tip"><img src="../<?php echo $row['thumbnail'];?>" style="width:150px;"></span><?php echo stripslashes($row['product_id']); ?></a>
			</td>
			<td>$<?php
				$row_name="featureprice_";
				$row_name.=$row['feature_table_id'];
				if(isset($_POST[$row_name])&&trim($_POST[$row_name])<>"")
				{
					$new_price=$_POST[$row_name];
					$pieces = explode("_", $row_name);
					//$pieces[1] is the id in the features table...
					$jorja="update features set featureprice='$new_price' where id='$pieces[1]'";
					$jorja_query=mysqli_query($cxn,$jorja);
					if(!$jorja_query)
					{
						$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
						die($nuts);
					}
					echo $new_price;				
				}
				?>
			</td>
		</tr>
		<?php
		$current_category=$row['product_category'];
		$product_count=$product_count+1;
		}
		?>
		</table>
	</td>
</tr>
<tr>
	<td style="text-align:center"><br><input type="hidden" name="product_count" value="<?php echo $product_count;?>"><input type="submit" value="submit"></td>
</tr>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
	$(".tip_trigger").hover(function(){
		tip = $(this).find('.tip');
		tip.show(); //Show tooltip
	}, function() {
		tip.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip.width(); //Find width of tooltip
		var tipHeight = tip.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip.css({  top: mousey, left: mousex });
	});
</script>

<?php require_once("footer.php"); ?>
		
	

