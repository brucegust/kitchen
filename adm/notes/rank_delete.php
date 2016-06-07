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

$query = "select * from ranks where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);

$name = stripslashes($rank);
$ID = $id;

require_once('header.php');
 
?>

	
		<table border="0" cellspacing="0" cellpadding="0" width=100%>
		<tr>
		<td>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width=100%>
			<tr>
			<td class="TitleText">
			<b>Delete Belt</b>
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
				<table width="900" align="center" border="0" cellspacing="1" cellpadding="1"><form action="rank_delete_execute.php" method="Post">
				<tr>
				<td>	
				To delete the belt named, <b>"<?php echo "$name"; ?>"</b>, click on the "Delete" button below. Otherwise, click <A HREF="rank_list.php">here</a> to return to the Belt List.
				<P>
				<?php include ("help.php"); ?>
				</td>
				</tr>
				<td>&nbsp;<BR>
				</td>
				</tr>
				<tr>
				<td style="text-align:center;"><input type="hidden" name="do" value="delete"><input type="hidden" name="ID" value="<?php echo "$ID"; ?>">
				<input type="Submit" value="Delete"></form>
				</tr>
				</table>
			</td>
			</tr>
			</table>
			
		</td>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>

 <?php require_once('footer.php'); ?>	
		
