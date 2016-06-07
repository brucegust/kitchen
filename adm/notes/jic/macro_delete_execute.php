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


$query = "delete from macro_categories where id=".$_POST["ID"];
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
					<b>Macro Category Delete Page</b>
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
								Congratulations! You have successfully deleted the <b><?php echo $_POST['name'];?></b> from the database. Click <A HREF="macro_list.php">here</a> to return to the Macro Category List.
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
		
