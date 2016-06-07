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

require_once('header.php');

?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Asset Conversion Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Use this page to ensure that all of the image files are listed correctly in the database.<br><br>
<ul><li>adjust the code so you're looking at the correct directory</li>
<li>refresh the page to update database so all image file entries match what's in the database</li></ul>
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
		<table width="700" align="center" border="1">
		<tr>
		<td style="background-color:#000000; color:#ffffff;">
		image file
		</td>
		<td style="background-color:#000000; color:#ffffff;">
		database thumbnail
		</td>
		</tr>
		<?php
		$dir    = 'http://brucegust.com/kitchen/assets/images/2010CabinetImages/';
		$files1 = scandir($dir);
		foreach($files1 as $picture_file)
		{
		?>
		<tr>
			<td><?php
			$image_file="ASSETS/IMAGES/2010CABINETIMAGES/";
			$image_file.= strtoupper($picture_file);
			echo $image_file; ?>
			</td>
			<td>
			<?php
			$jorja="select id, thumbnail from products";
			$jorja_query=mysqli_query($cxn, $jorja)
			or die("Jorja didn't happen.");
			while($jorja_row=mysqli_fetch_assoc($jorja_query))
			{
				$new_thumbnail=strtoupper($jorja_row['thumbnail']);
				//echo $new_thumbnail;
				if($new_thumbnail==$image_file)
				{
					$new_picture_file="assets/images/2010CabinetImages/";
					$new_picture_file.=$picture_file;
					//echo $new_picture_file;
					$michelle="update products set thumbnail='$new_picture_file' where id = '$jorja_row[id]'";
					$michelle_query=mysqli_query($cxn, $michelle);
					if(!$michelle_query)
					{
						$nuts=mysqli_errno($cxn).' '.mysqli_error($cxn);
						die($nuts);
					}
				echo "done&nbsp;";
				}
				
			}
			?>
			
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</td>
</tr>
</table>

		
	

