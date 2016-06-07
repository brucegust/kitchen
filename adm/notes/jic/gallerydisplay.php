<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");
if ($_GET['Edit'] != "Yes")
{
$ID=$_GET['ID'];
header("Location: gallerydelete.php?ID=$ID");
}
else
{
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from gallery where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
require_once('header.php');
}
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Gallery Photo Display Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Here's the gallery photo you just selected. Change whatever information you need to alter and then click on "Submit." To return to the Gallery Photo List, click <A HREF="galleryList.php">here</a>.
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
		<td class="admin_body">
			<table class="center" border="0"><form action="galleryedit.php" method="Post">
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Name
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="name" value="<?php $photo=stripslashes($name); echo "$photo"; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Category
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<select name="category" style="width:495px;">
					<?php
					$gallery_name="select id, name from doors where id='$row[category]'";
					$gallery_query=mysqli_query($cxn, $gallery_name);
					$gallery_row=mysqli_fetch_assoc($gallery_query);
					extract($gallery_row);
					?>
					<option selected value="<?php echo $gallery_row['id']; ?>"><?php echo stripslashes($gallery_row['name']); ?></option>
					<?php
					$querystate = "select * from doors order by name ASC";
					$resultstate = mysqli_query($cxn, $querystate)
					or die ("Couldn't execute query.");
				
					while ($result_row=mysqli_fetch_assoc($resultstate))
					{
					extract($result_row);
					?>
					<option value="<?php echo $result_row['id']; ?>"><?php echo stripslashes($result_row['name']); ?></option>
					<?php
					}
					?>
					</td>
				</tr>
				<tr>
					<td>Caption</td>
					<td><input type="text" size="80" name="caption" value="<?php echo $caption;?>">
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					<A HREF="../Photos/<?php echo $url; ?>" target="_blank">URL</a>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="url" value="<?php echo "$url"; ?>">
					</td>
				</tr>
				<tr>
				<tr>
			<td style="background-color:#cccccc; text-align:right;" colspan="2">
				<table align="right">
					<tr>
						<td>
						<IMG SRC="images/spacer.gif" height="10">
						</td>
						<td align="right">
						Featured
						&nbsp;
						</td>
						<td>
						<?php 
						if($featured==1){
						?>
						<input type="checkbox" value="Y" name="featured">
						<?php
						}
						else
						{
						?>
						<input type="checkbox" value="Y" name="featured" checked>
						<?php
						}
						?>
						</td>
					</tr>		
				</table>
			</td>
			</tr>	
				</tr>
				<tr>
					<td colspan="2" class="admin_body"><div align="center">
					<textarea name="description"><?php $textarea = stripslashes($row['description']); echo "$textarea";?></textarea></div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="admin_body"><input type="hidden" name="ID" value="<?php echo "$_GET[ID]"; ?>">
					<input type="Submit" value="Submit"></form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
			
 <?php require_once('footer.php'); ?>	
		