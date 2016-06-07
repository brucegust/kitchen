<?php
if(isset($_POST['ajax_session_id'])&&$_POST['ajax_session_id'])
{
//you've got some updating to do
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KitchenCabinetCo.com by Online Cabinets Direct</title>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/carousel_stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/sidebar.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script>
$('.show_hide').click(function(e){
e.preventDefault();
$(this).parents('tr').next(".current_cart_features").toggle("slow");
});

$("#ajaxForm").submit(function(e) {// use the correct ID
		e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.
		var devAjax = $( "#ajaxForm" ).serialize(); //packaging all of our submitted variables into one, neat little var
		//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
		$.post( "ajax_test.php", devAjax) // posting all of our variables to ajax.php 
		});
</script>
</head>
<body>

<table style="width:85%; margin:auto; padding:5px; border-collapse:separate; border-spacing:2px;" border="0"><form method="Post" id="ajaxForm">
		<tr>
			<td style="background-color:#000000; color:#ffffff; border-top-left-radius:5px; border-top-right-radius:5px;" colspan="3">&nbsp;
			<?php echo $_POST['category_name'];?>
			</td>
		</tr>
		<tr>
				<td style="background-color:#cccccc; color:#000000; width:90%;" colspan="3">&nbsp;
				<?php echo stripslashes($_POST['product_name']);?><div style="float:right; display:inline-block;"><a href="ajax_test.php?session_id=3u47gee83n0tmtp4u9sq8le7k4&product_id=121">X</a>&nbsp;&nbsp;</div>
				</td>
		<tr>
		<tr>
			<td style="text-align:center;"><b>Qty</b></td>
			<td style="width:100px;"><b>Cost</b></td>
			<td><b>Total Price</b></td>
		</tr>
		<tr>
			<td><input type="text" size="4" style="text-align:center;" name="ajax_quantity_121" value="2"> </td>
			<td>$94.50</td>
			<td>$189.00</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br></td>
		</tr>
		<tr>
			<td colspan="3"><b><u>Features...</b></u></td>
		</tr>
		<tr>
			<td colspan="3"><b>Cabinet Color</b></td>
		</tr>
		<tr>
			<td colspan="2"><u>Brandywine Shaker</u></td>
			<td>$0.00</td>
		</tr>
		<tr>
			<td colspan="3"><b>Custom finished Interior Option</b></td>
		</tr>
		<tr>
			<td colspan="2">Add Custom Finished Interior</td>
			<td>$49.50</td>
		</tr>
			
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr>
			<td colspan="2"><b>Total:</b></td>
			<td>$499.50</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align:center;"><input type="hidden" name="ajax_session_id" value="3u47gee83n0tmtp4u9sq8le7k4"><input type="image" src="images/update_cart.png"></td>
		</tr>
	</table>
</body>
</html>