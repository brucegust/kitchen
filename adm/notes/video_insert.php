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
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width=100%>
			<tr>
			<td class="TitleText">
			<b>Video Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			To insert a video into the database, fill in all of the fields, then click on "Submit." For the "video code" field, just copy and pasted the "embed" code from youtube.com.
			<P>
				<b><font color="red">Remember!</font></b>The only thing you need from the youtube video code is the 11 character code that you see in bold below:
			<P>
			<div align="center">&lt;iframe width="560" height="315" src="http://www.youtube.com/embed/<b>HAbsSYEJ6wk</b>?rel=0&showinfo=0&autoplay=1&autohide=1" frameborder="0" allowfullscreen&gt;</div>
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
				<table width="700" align="center" border="0"><form action="video_insert_execute.php" method="POST">
				<tr>
				<td class="MainText" background="../Images/spacer.gif" width="200" height="10">
				Video Name
				</td>
				<td background="../Images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="name">
				</td>
				</tr>
				<tr>
				<td>
				Class Name
				</td>
				<td>
				<select name="class">
				<option></option>
				<option>Tae Kwon Do</option>
				<option>Hapkido</option>
				<option>____________________________________________________________________</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
				Age Group
				</td>
				<td>
				<select name="age">
				<option></option>
				<option>Adults</option>
				<option>Students</option>
				<option>____________________________________________________________________</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
				Belt
				</td>
				<td>
				<select name="belt">
				<option></option>
				<?php 
				$vivian="select * from ranks order by sort_order";
				$vivian_query=mysqli_query($cxn, $vivian)
				or die("Couldn't run Vivian.");
				while($vivian_row=mysqli_fetch_assoc($vivian_query))
				{
				extract($vivian_row);
				?>
				<option value=<?php echo $vivian_row['id']; ?>"><?php echo stripslashes($vivian_row['rank']); ?></option>
				<?php
				}
				?>
				<option>____________________________________________________________________</option>
				</select>
				</td>
				</tr>
				<tr>
				<td class="MainText">
				Video Code
				</td>
				<td>
				<input type="text" size="80" name="video_code">
				</td>
				</tr>
				<tr>
				<td colspan="2" style="text-align:center;">&nbsp;<BR>
				<textarea name="description">Description</textarea>
				</td>
				</tr>
				<tr>
				<td colspan="2" style="text-align:center;">&nbsp;<BR>
				<input type="Submit" value="Submit">
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
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>
 <?php require_once('footer.php'); ?>	