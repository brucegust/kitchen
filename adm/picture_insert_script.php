<?php

$library_target = "../download_images/"; 
$library_target = $library_target . basename( $_FILES['photo']['name']) ;
$library_url = basename($_FILES['photo']['name']); 
$library_ok=1; 
if ($uploaded_type =="text/php")
{
$library_ok=0;
} 
//Here we check that $ok was not set to 0 by an error 
if ($library_ok==0) 
{ 
header("Location: photo_badfile.php");
exit();
} 
 
if(!move_uploaded_file($_FILES['photo']['tmp_name'], $library_target)) 
{
header("Location: photo_noupload.php");
exit();
}
 
$vivian = "UPDATE download_playlist_desc SET playlist_image='$library_url' where id = '$_POST[ID]'";
$vivian_result = mysqli_query($cxn, $vivian);
$good_image=1;
?>

		
