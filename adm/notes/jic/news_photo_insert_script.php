<?php
 
function jpgResizeFrom( $filename, $width, $height, $newFilePath, $quality=75 ) { 
if ( file_exists( $filename ) && !is_dir( $filename ) ) { 
// Get current dimensions and calculate the best size
list($widthOrig, $heightOrig) = getimagesize($filename);

if ( $heightOrig > 0 ) {

$ratioOrig = $widthOrig/$heightOrig;

if ( ($width/$height) > $ratioOrig)
	 $width = $height * $ratioOrig;
else
	 $height = $width / $ratioOrig;


// Resample the original image
//
$image_p = imagecreatetruecolor($width, $height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);


// Output to a file and clear memory of the old images
//
imagejpeg($image_p, $newFilePath, $quality);
//imagedestroy($image_p);
//imagedestroy($image);

} 

} // if file_exists
}

include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");


//insert data into database, followed by entering picture according to id of new staff member

$uploaded_type="";

$target = "../Photos/"; 
$target = $target . basename( $_FILES['photo']['name']) ;
$url = basename($_FILES['photo']['name']); 
$ok=1; 
if ($uploaded_type =="text/php")
{
$ok=0;
} 
//Here we check that $ok was not set to 0 by an error 
if ($ok==0) 
{ 
header("Location: photo_badfile.php");
} 
 
if(!move_uploaded_file($_FILES['photo']['tmp_name'], $target))  header("Location: photo_noupload.php");
else 
{
  
$michelle = "update news set photo_one='$url' where id = '$novie_id'";
$michelle_query=mysqli_query($cxn, $michelle);
if(!$michelle_query)
{
$whoops = mysqli_errno($cxn).' '.mysqli_error($cxn);
die($whoops);
}


//make a thumbnail
$width = 160;  // pixels
$height = 100;   // pixels 
$newFilePath = '../Photos/thumbs/';
$imageFolder = '../Photos/';
$fileParts = pathinfo( $url );
$filename  = $fileParts['filename'];
$extension = $fileParts['extension'];
$origName  = "$imageFolder/$filename.$extension";
$newName   = "$newFilePath/$filename.$extension"; 
jpgResizeFrom( $origName, $width, $height, $newName );
  
}
 
 

?>

