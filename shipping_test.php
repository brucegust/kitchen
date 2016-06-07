<html>
<head>
<title>Shipping Prep</title>
</head>

<body>
<form action="rta_fedex.php" method="Post">
zip code: <input type="text" size="35" name="zipcode">
<hr>
<?php
$package_count=1;
for($x=1; $x<=4; $x++)
{
?>
weight <?php echo $x;?>&nbsp;<input type="text" size="5" name="weight_<?php echo $x;?>" value="50"><br>
height: <?php echo $x;?>&nbsp;<input type="text" size="5" name="height_<?php echo $x;?>" value="50"><br>
depth: <?php echo $x;?>&nbsp;<input type="text" size="5" name="depth_<?php echo $x;?>" value="50"><br>
length <?php echo $x;?>&nbsp;<input type="text" size="5" name="length_<?php echo $x;?>" value="50"><br>
<?php
$package_count=$package_count+1;
}
?>
<input type="text" size="5" name="package_count" value="<?php echo $package_count;?>"><br><br>
<input type="submit" value="submit">
</form>

</body>