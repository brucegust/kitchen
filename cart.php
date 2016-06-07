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
$(document).ready(function() {
		
	$("#theForm").submit(function(e) {// use the correct ID
	e.preventDefault();// we don't want to submit anything until we've first determined that the user's not get ready to duplicate something that's already in the database.
	//alert("form submitted");
	var devTest = $( "#theForm" ).serialize(); //packaging all of our submitted variables into one, neat little var
	//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
	$.post( "ajax.php", devTest) // posting all of our variables to ajax.php 
		.done(function(fromServer) { //the "done"function is what you're doing when the AJAX call (in this case the ajax.php page) is "done" running and we're now hearing back from the server
			if (fromServer.charAt(0) == "E") //"fromServer.charAT(0) is just fancy code for the first letter of what you're getting back from the server
			{
				alert("ERROR - The submarket has been entered before");
			}
			else 
			{	
				alert(fromServer);
				//url="success.php";
				//$(location).attr("href", url);
			}
		});
	});
});
</script>
</head>

<body>

<table style="width:475px; margin:auto;" border="0"><form action="ajax.php" method="Post" id="testForm">
	<tr>
		<td><b>Mullion Door Options</b></td>
	</tr>
	<tr>
		<td><select name="1" style="width:450px;">
		<option></option>
		<option value="4453_24">Add Mullion Doors Custom Finish</option>
		<option value="4452_24">Add Mullion Doors Standard Finish</option>
		<option value="4451_24">Do Not Add Mullion Doors</option>
		</select>
		<br><br></td>
	</tr>
	<tr>
		<td><b>Prep Door For Glass Option</b></td>
	</tr>
	<tr>
		<td><select name="2" style="width:450px;">
		<option></option>
		<option value="4454_22">Prep Door For Glass Option</option>
		</select>
		<br><br></td>
	</tr>
	<tr>
		<td><b>Finish Interior Option</b></td>
	</tr>
	<tr>
		<td><select name="3" style="width:450px;">
		<option></option>
		<option value="4444_20">Add Finished Interior Custom Finish Cabinet</option>
		<option value="4443_20">Add Finished Interior Standard Finish Cabinet</option>
		<option value="4442_20">Do Not Add Finished Interior</option>
		</select>
		<br><br></td>
	</tr>
	<tr>
		<td><b>Hinge Direction As You Are Looking At The Cabinet Front</b></td>
	</tr>
	<tr>
		<td><select name="4" style="width:450px;">
		<option></option>
		<option value="4450_25">Hinge Right</option>
		<option value="4449_25">Hinge Left</option>
		</select>
		<br><br></td>
	</tr>
	<tr>
		<td><b>Cabinet Assembly</b></td>
	</tr>
	<tr>
		<td><select name="5" style="width:450px;">
		<option></option>
		<option value="4439_3">Standard Finish Utility / Oven Cabinet Assembly</option>
		<option value="4438_3">Standard Finish Base / Wall Cabinet Assembly</option>
		<option value="4440_3">No Assembly / Customer Will Assemble Upon Receipt</option>
		</select>
		<br><br></td>
	</tr>
	<tr>
		<td><b>Finished Side Panel Skins As You Are Looking At The Cabinet Front</b></td>
	</tr>
	<tr>
		<td><select name="6" style="width:450px;">
		<option></option>
		<option value="4446_4">Both Side Exposed</option>
		<option value="4448_4">Right Side Exposed</option>
		<option value="4441_31">Add Custom Finished Interior</option>
		<option value="4447_4">Left Side Exposed</option>
		<option value="4445_4">No Side Exposed</option>
		</select>
		<br><br></td>
	</tr>
	<tr>
		<td><b>Custom Finished Interior Option</b></td>
	</tr>
	<tr>
		<td><select name="7" style="width:450px;">
		<option></option>
		<option value="4446_4">Both Side Exposed</option>
		<option value="4448_4">Right Side Exposed</option>
		<option value="4441_31">Add Custom Finished Interior</option>
		<option value="4447_4">Left Side Exposed</option>
		<option value="4445_4">No Side Exposed</option>
		</select>
		<br><br></td>
	</tr>
	<tr>
		<td><b>Finished Side Panel Skins As You Are Looking At The Cabinet Front</b></td>
	</tr>
	<tr>
		<td><select name="8" style="width:450px;">
		<option></option>
		<option value="4446_4">Both Side Exposed</option>
		<option value="4448_4">Right Side Exposed</option>
		<option value="4441_31">Add Custom Finished Interior</option>
		<option value="4447_4">Left Side Exposed</option>
		<option value="4445_4">No Side Exposed</option>
		</select>
		<br><br></td>
	</tr>
</table>

<div style="bottom:0; left:0; right:0; position:absolute; padding-bottom:5px; width:248px; height:50px; text-align:center; margin:auto;"><input type="image" src="images/cancel.png" class="close_window" style="float:left;">&nbsp;&nbsp;<input type="hidden" name="the_count" value="8"><input type="hidden" name="part_id" value="AW1230"><input type="hidden" name="product_id" value="121"><input type="hidden" name="product_name" value="AW1230 (Universal Left or Right Side Angle)"><input type="hidden" name="price" value="94.50"><input type="image" src="images/add_to_cart_button.png" style="float:left;" border="0"></div></form><!--end of close button-->
</body></form><!--end of close button-->
</body>
</html>