<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KitchenCabinetCo.com by Online Cabinets Direct</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script>
$(document).ready(function(){
	$(".menu_toggle").click(function(e){		
		alert("hello");
		document.forms["myForm"].submit();
	});
});

</script>
<body>
<?php
echo $_POST['price'];
$number=1;
for($x=0; $x<=4; $x++)
{
	echo $number;
	echo "<br>";
	$number=$number+1;
}
echo "<br>";
echo $number;
//echo $final_result;
?>
<form method="Post" id="myForm">
<input type="hidden" name="result" value="<?php echo $number;?>">
<input type="hidden" name="price" value="157.50">
<a href="#" class="menu_toggle">click here</a>

</body>
</html>