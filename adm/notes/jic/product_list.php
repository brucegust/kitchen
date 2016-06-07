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
<b>Product List Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Below is the list of all the products that have been entered into the database ordered according to "product category" . To either edit or delete an entry, simply click on one of the two buttons located to the right of each name.
<br><br>
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
		<table style="width:auto; margin:auto; padding:10px;" border="1">
		<tr>
		<td style="background-color:#000000; color:#ffffff; padding:10px;">
		Product Name
		</td>
		<td style="background-color:#000000; color:#ffffff; text-align:center; padding:10px;">
		Edit / Delete
		</td>
		</tr>
		<?php
		$current_category_id="";		
		$querystate = "select * from products order by categories ASC, name DESC";
		$resultstate = mysqli_query($cxn, $querystate)
		or die ("Couldn't execute query.");
	
		while ($row=mysqli_fetch_assoc($resultstate))
		{
		extract($row);
		?>
			<?php
			if($current_category_id<>$row['category_id'])
			{
			?>
				<tr>
					<td style="background-color:#0861c5; color:#ffffff; padding:5px;" colspan="2"><?php echo stripslashes($row['categories']);?></td>
				</tr>
			<?php
			}
			?>
		<tr>
			<td style="width:600px; vertical-align:middle; padding:5px;"><?php echo stripslashes($row['name']);?></td>
			<td style="text-align:center; background-color:#cccccc; color:#000000; vertical-align:middle; padding:5px;">
			<A HREF="product_display.php?ID=<?php echo $row['id']; ?>&Edit=Yes" >Edit</a>&nbsp;&nbsp;
			<A HREF="product_display.php?ID=<?php echo $row['id']; ?>&Delete=Yes">Delete</a>
			</td>
		</tr>
		<?php
		$current_category_id=$row['category_id'];
		}
		?>
		</table>
</td>
</tr>
</table>

		
	

