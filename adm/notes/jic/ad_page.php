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
$query = "select * from ads";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$count=mysqli_num_rows($result);
if($count>0)
{
$row = mysqli_fetch_assoc($result);
extract($row);
$the_content=stripslashes($row['content']);
$the_id=$row['id'];
$yes=$row['yes_no'];
}
else
{
	$the_content="";
	$the_id=0;
	$yes=0;
}


require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Ad Display</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the ad that's currently in the database. To turn it "on," simply put a "check" in the "on" box below.
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
	<table class="center" border="0"><form action="ad_edit.php" method="post">
		<tr>
			<td colspan="2" style="background-color:#cccccc; text-align:right; width:100%;">yes / no&nbsp;<?php if($yes==1){?><input type="checkbox" name="yes_no" value="Y" checked><?php }else{?><input type="checkbox" name="yes_no" value="Y"><?php }?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;<BR>
			<textarea name="the_content"><?php echo $the_content; ?></textarea>
			</td>
		</tr>
			<tr>
			<td colspan="2" class="admin_body"><input type="hidden" name="id" value="<?php echo $the_id; ?>">
			<input type="Submit" value="Submit">
			</td>
		</tr>
		</table>
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
		