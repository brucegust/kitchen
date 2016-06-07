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
$category= mysqli_real_escape_string($cxn, trim($_POST['category']));

$insert = "insert into calendar_category (category)
values ('$category')";
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe) {
$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($error);
} 	
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
			<b>Calendar Category Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the Calendar Category you just entered into the database. To make any changes, click <A HREF="calendar_category_list.php">here</a>, or to add another Calendar Category, click <A HREF="calendar_category_insert.php">here</a>.
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
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td align="center">	
					<table width="700" align="center" border="0"><form action="calendar_category_insert_execute.php" method="post">
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Category Name
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="category" value="<?php echo $_POST['category']; ?>">
					</td>
					</tr>
					</table>
				</td>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
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
		