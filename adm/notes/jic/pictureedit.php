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

$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));
$finaltext = mysqli_real_escape_string($cxn, trim($_POST['description']));

if(!empty($_POST['featured'])){
$flag=1;
//here's where I'm checking to see if the featured box is checked and if it is, I update with a "Y" value
$featured_contestant = "UPDATE pictures SET featured='1' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}
else
{
$flag=0;
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the featured option if need be
$featured_contestant = "UPDATE pictures SET featured='0' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}

$query = "UPDATE pictures SET name='$headline',
description='$finaltext', 
url = '$_POST[url]'
where id = '$_POST[ID]'";
$result = mysqli_query($cxn, $query);
if (!$result = mysqli_query($cxn, $query)) {
$error = mysql_errno() . mysql_error();
die($error);
}
require_once('header.php');
 
?>

			<table border="0" cellspacing="0" cellpadding="0" width=100%>
				<tr>
					<td class="TitleText">
					<b>Photo Edit Page</b>
					</td>
				</tr>
				<tr>
					<td>&nbsp;<BR>
					</td>
				</tr>
				<tr>
					<td class="MainText">
					<P>
					Here's the photo you just edited. To make any additional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Photo List, click <A HREF="pictureList.php">here</a>.
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
					<td>
						<table width="700" class="center" border="1">
							<tr>
								<td rowspan="4">
								<A HREF="../Photos/<?php echo "$_POST[url]"; ?>" target="_blank"><IMG SRC="../Photos/<?php echo "$_POST[url]"; ?>" border="0" width="100"></a>
								</td>
								<td class="MainText" background="../images/spacer.gif" width="100" height="10">
								<b>Name</b>
								</td>
								<td background="../images/spacer.gif" width="500" height="10">
								<?php echo "$_POST[name]"; ?>
								</td>
							</tr>
							<tr>
								<td class="MainText">
								<b>URL:</b>
								</td>
								<td background="../images/spacer.gif" width="500" height="10">
								<?php echo "$_POST[url]"; ?>
								</td>
							</tr>
							<tr>
								<td style="background-color:#cccccc; text-align:right;" colspan="2">
									<table align="right">
										<tr>
											<td>
											<IMG SRC="images/spacer.gif" height="10">
											</td>
											<td align="right">
											Gallery
											&nbsp;
											</td>
											<td>
											<?php 
											if($flag>0)
											{
											?>
											<input type="checkbox" value="Y" name="featured" checked>
											<?php
											}
											else
											{
											?>
											<input type="checkbox" value="Y" name="featured">
											<?php
											}
											?>
											</td>
										</tr>		
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="3">
								<?php 
								$textarea = stripslashes($_POST['description']);
								echo "$textarea";
								?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
	
 <?php require_once('footer.php'); ?>			