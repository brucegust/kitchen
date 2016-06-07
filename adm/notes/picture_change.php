<?php

session_start(); 

if (@$_SESSION['auth'] != "yes")                   

{

header("Location: default.php");

exit();

}

ini_set('display_errors', 1);  error_reporting(E_ALL);


include ("../carter.inc");



$cxn = mysqli_connect($host,$user,$password,$database)

or die ("couldn't connect to server");

     function jpgResizeFrom( $filename, $width, $height, $newFilePath, $quality=75 ) { 
	 $width = 160;  // pixels
					$height = 100;   // pixels 
					$newFilePath = 'thumbs/';
					$imageFolder = '../Photos/';
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
                    imagedestroy($image_p);
                    imagedestroy($image);
     
               } 

          } // if file_exists
     }


require_once('header.php');



?>

	

		<table border="0" cellspacing="0" cellpadding="0" width=100%>

		<tr>

		<td>

		<td>

		<IMG SRC="../Images/spacer.gif" width="10" height="10">

		</td>

		<td>

			<table border="0" cellspacing="0" cellpadding="0" width=100%>

			<tr>

			<td class="TitleText">

			<b>Photo List</b>

			</td>

			</tr>

			<tr>

			<td>&nbsp;<BR>

			</td>

			</tr>

			<tr>

			<td class="MainText">

			<P>

			Just sit back and watch the magical transformation happen!

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

			<td align="center">

				<table width=100% border="0">

				<tr>

				<td>

				<IMG SRC="../Images/spacer.gif" width="10" height="10">

				</td>

				<td align="center">

				
					<table>
					<?php

					$querystate = "select * from photos order by photo_date";

					$resultstate = mysqli_query($cxn, $querystate)

					or die ("Couldn't execute query.");

					while ($query_row = mysqli_fetch_assoc($resultstate))
					{
					?>
					<tr>
					<td>
					<?php
					$width = 160;  // pixels
					$height = 100;   // pixels 
					$newFilePath = 'thumbs/';
					$imageFolder = '../Photos/';
					 $fileParts = pathinfo($query_row['url'] );
					  $filename  = $fileParts['filename'];
					  $extension = strtolower( $fileParts['extension'] );
					  $origName  = "$imageFolder/$filename.$extension";
					  $newName   = "$newFilePath/$filename.$extension"; 
					  if ($extension == "jpg" || $extension == "jpeg" ) {
						   jpgResizeFrom( $origName, $width, $height, $newName );
						   echo "<a href='./$origName'><img src='$newName' /></a>";
					  } 

						} 

					 ?>
					 </td>
					 </tr>
					 </table>
				 </td>
				 </tr>
					</table>&nbsp;<BR>

				

				</td>

				<td>

				<IMG SRC="../Images/spacer.gif" width="10" height="10">

				</td>

				</tr>

				</table>

			</td>

			</tr>

			</table>

		</td>

		

		<td>

		<IMG SRC="../Images/spacer.gif" width="10" height="10">

		</td>

		</tr>

		</table>