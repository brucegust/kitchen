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

$first_name = mysqli_real_escape_string($cxn, trim($_POST['first_name']));
$last_name = mysqli_real_escape_string($cxn, trim($_POST['last_name']));
$belt = mysqli_real_escape_string($cxn, trim($_POST['belt']));

$the_belt=trim($_POST['belt']);
$scott = "select * from ranks where rank = '$the_belt'";
$scott_query=mysqli_query($cxn, $scott)
or die("Couldn't execute Scott!");
$scott_row=mysqli_fetch_assoc($scott_query);
extract($scott_row);

$taylor="update black_belt set first_name='$first_name', 
$last_name='$last_name',
belt='$belt', 
belt_sort_order='$scott_row[sort_order]'";
$taylor_query=mysqli_query($cxn, $taylor)
or die("Taylor didn't happen.");

require_once('header.php'); 
  
?>
	

			<table border="0" cellspacing="0" cellpadding="0" width=100%>
			<tr>
			<td class="TitleText">
			<b>Black Belt Edit </b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the black belt you just edited. To make any additional changes, click <A HREF="belt_list.php">here</a>, or to add another black belt, click <A HREF="belt_insert.php">here</a>.
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
				
					<table align="center" border="1">
					<tr>
					<td class="MainText">
					<b>First Name:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo $_POST['first_name']; ?>
					</td>
					</tr>
					<tr>
					<td class="MainText">
					<b>Last Name:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[last_name]"; ?>
					</td>
					</tr>
					<tr>
					<td>
					<b>Belt / Rank:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[belt]"; ?>
					</td>
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
		
