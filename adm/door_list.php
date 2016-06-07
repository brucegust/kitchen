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
<b>Door List Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Below is the list of all the doors that have been entered into the database. To either edit or delete an entry, simply click on one of the two buttons located to the right of each name.
<ul><li>If you see a red flag displayed to the right of any of the door names, that indicates a "featured" door.</li>
<li>To insert a "multiplier," click on the edit button of the door that you want to discount</li></ul>
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
		<table width="900" align="center" border="1">
		<tr>
		<td style="background-color:#000000; color:#ffffff;">
		Door Name
		</td>
		<td style="background-color:#000000; color:#ffffff; text-align:center;">
		Part Number
		</td>
		<td style="background-color:#000000; color:#ffffff; text-align:center;">
		Edit / Delete / Product Pricing
		</td>
		</tr>
		<?php	
		$querystate = "select * from doors order by name ASC";
		$resultstate = mysqli_query($cxn, $querystate)
		or die ("Couldn't execute query.");
	
		while ($row=mysqli_fetch_assoc($resultstate))
		{
		extract($row);
		?>
		<tr>
			<td background="../images/spacer.gif" width="500" height="10">
			<?php
			if($featured==1)
			{
			?>
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td>&nbsp;<a href="../assets/images/door_colors/<?php echo $image1; ?>" target="_blank" style="color:#000000;"><?php echo stripslashes($name);?></a></td>
						<td><IMG SRC="images/white_flag.jpg"></td>
					</tr>
				</table>
			<?php
			}
			else
			{
			?>
			<table cellspacing="0" cellpadding="0">
					<tr>
						<td>&nbsp;<a href="../assets/images/door_colors/<?php echo $image1; ?>" target="_blank" style="color:#000000;"><?php echo stripslashes($name);?></a></td>
						<td><IMG SRC="images/spacer.gif" style="height:25px;"></td>
					</tr>
				</table>
			<?php
			}
			?>
			</td>
			</td>
			<td>
				<?php echo stripslashes($part_id); ?>
			</td>
			<td style="text-align:center; background-color:#cccccc; color:#000000;">
			<A HREF="door_display.php?ID=<?php echo "$id"; ?>&Edit=Yes" >Edit</a> | <A HREF="door_display.php?ID=<?php echo "$id"; ?>&Delete=Yes">Delete</a> | <a href="door_pricing.php?feature_id=<?php echo $row['feature_door_id'];?>">Pricing</a>
			</td>
		</tr>
		<?php
		}
		?>
		</table>
</td>
</tr>
</table>

		
	

