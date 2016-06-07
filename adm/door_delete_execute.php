<?php

session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}

include ("../carter.inc");

if (!is_numeric($_POST['ID'])) 
{ 
// id's not numeric?  
// kill the script before the query can run 
die("The id must be numeric!"); 
} 

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

$michelle="select image1 from doors where id='$_POST[ID]'";
$michelle_query=mysqli_query($cxn, $michelle);
$michelle_row=mysqli_fetch_assoc($michelle_query);
if($michelle_row['imagepath']<>"")
{
	$the_file="../assets/images/door_colors/";
	$the_file.=$michelle_row['imagepath'];
	//echo $the_file;
	unlink($the_file);
}

$query = "delete from doors where id=".$_POST["ID"];
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");

require_once('header.php');
 
?>

	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td>
		<IMG SRC="../Images/spacer.gif" width="10" height="10">
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width=100%>
				<tr>
					<td class="TitleText">
					<b>Door Delete Page</b>
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
						<table width="900" align="center" border="0" cellspacing="1" cellpadding="1">
							<tr>
								<td>	
								Congratulations! You have successfully deleted the <b><?php echo $_POST['name'];?></b> from the database. Click <A HREF="door_list.php">here</a> to return to the Door List.
								<P>
								<?php include ("help.php"); ?>
								</td>
							</tr>
							<tr>
								<td>&nbsp;<BR>
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

 <?php require_once('footer.php'); ?>	
		
