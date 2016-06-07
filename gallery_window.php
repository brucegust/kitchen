<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KitchenCabinetCo.com by Online Cabinets Direct</title>
</head>
<body style="text-align:center;">

<?php
include("carter.inc"); 
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$shane="SELECT * FROM gallery where id='$_GET[id]'";
//echo $shane;
$shane_query=mysqli_query($cxn, $shane);
$shane_row=mysqli_fetch_assoc($shane_query);
extract($shane_row);
?>

<?php
$stunning_pic="Photos/";
$stunning_pic.=$shane_row['url'];
$image    = getimagesize($stunning_pic);
$the_width    = $image[0];
$the_height   = $image[1];
//$type     = $image[2];
if($the_height>$the_width)
{
//portrait size
//I want my width on my portrait size to be 200 pixels so if my ratio is height / width and my final height is 200px, then...
$value_one=$the_width * 200;
$value_two=round($value_one/$the_height);
//echo $value_two;//my target width;
?>
<br><a href="Photos/<?php echo $shane_row['url'];?>" target="_blank"><img src="Photos/<?php echo $shane_row['url']; ?>" border="0" style="width:<?php echo $value_two;?>;"></a>
<?php
}
else
{
//landscape size
$value_one=$the_height*600; //my target width;
$value_two=round($value_one/$the_width); //my target height;
?>
<a href="Photos/<?php echo $shane_row['url'];?>" target="_blank"><img src="Photos/<?php echo $shane_row['url']; ?>" border="0" style="width:600px;"></a>
<?php
}
?>

</body>
</html>
