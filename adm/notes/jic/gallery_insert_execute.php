<?php
session_start();
 if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
 
include ("../carter.inc");

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
 
 
$target = "../Photos/"; 
$target = $target . basename( $_FILES['photo']['name']) ;
$url = basename($_FILES['photo']['name']); 
$ok=1; 
	if ($_FILES['photo']['type']=="text/php")
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
 
 
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));
$caption = mysqli_real_escape_string($cxn, trim($_POST['caption']));
$category = mysqli_real_escape_string($cxn, trim($_POST['category']));
$bigstory = mysqli_real_escape_string($cxn, trim($_POST['description']));
$insert = "insert into gallery (name, description, caption, category, url)
values ('$headline', '$bigstory', '$caption', '$category', '$url')";
$insertexe = mysqli_query($cxn, $insert);
	if(!$insertexe)
	{
	$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
	die($nuts);
	}
}

//make a thumbnail
$width = 160;  // pixels
$height = 100;   // pixels 
$newFilePath = '../Photos/thumbs/';
$imageFolder = '../Photos';
$fileParts = pathinfo( $url );
$filename  = $fileParts['filename'];
$extension = strtolower( $fileParts['extension'] );
$origName  = "$imageFolder/$filename.$extension";
$newName   = "$newFilePath/$filename.$extension"; 
if ( $extension == "jpg" || $extension == "jpeg" || $extension=="JPEG" || $extension=="JPG" ) {
jpgResizeFrom( $origName, $width, $height, $newName );
 }
 
require_once('header.php');
 
?> 

	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Gallery Photo Insert Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
		<tr>
		<td class="MainText">
		<P>
		Here's the gallery photo you just entered into the database. To make any changes, click <A HREF="galleryList.php">here</a>, or to add another photo, click <A HREF="galleryInsert.php">here</a>.
		<P>
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
		<td class="admin_body">
			<table width="700" align="center" border="1">
				<tr>
					<td rowspan="4">
					<A HREF="../Photos/<?php echo "$url"; ?>" target="_blank"><IMG SRC="../Photos/<?php echo "$url"; ?>" border="0" width="100"></a>
					</td>
					<td class="MainText" background="../images/spacer.gif" width="100" height="10">
					<b>Name</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[name]"; ?>
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="100" height="10">
					<b>Caption</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[caption]"; ?>
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="100" height="10">
					<b>Category</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php 
					$gallery_category="select name from doors where id='$_POST[category]'";
					//echo $gallery_category;
					$gallery_query=mysqli_query($cxn, $gallery_category);
					$gallery_row=mysqli_fetch_assoc($gallery_query);
					extract($gallery_row);								
					echo stripslashes($gallery_row['name']);								
					?>
					</td>
				</tr>
				<tr>
					<td class="MainText">
					<b>URL:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$url"; ?>
					</td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#cccccc">
					<b>Description:</b>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					<?php 
					echo stripslashes($_POST['description']);	?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
	

 <?php require_once('footer.php'); ?>	
		
