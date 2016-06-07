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

$yes=0;

$the_content = mysqli_real_escape_string($cxn, trim($_POST['the_content']));
$the_id=$_POST['id'];

if(isset($_POST['yes_no'])&&$_POST['yes_no']=="Y")
{
	$yes=1;
}
else
{
	$yes=0;
}

if($the_id>0)
{
	$update="update ads set content='$the_content', 
	yes_no='$yes'
	where id='$the_id'";
	$update_query=mysqli_query($cxn, $update);
	if(!$update_query)
	{
		$rats=mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($rats);
	}
}
else
{
$insert = "insert into ads (content, yes_no)
values ('$the_content', '$yes')";
echo $insert;
$insertexe = mysqli_query($cxn, $insert)
or die ("Couldn't execute query.");
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
			<b>Ad Edit Page </b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the ad you just entered / edited. To return to the display page, click <a href="ad_page.php">here</a>.
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
				<table class="center" border="0"><form action="ad_edit.php" method="post">
					<tr>
						<td colspan="2" style="background-color:#cccccc; text-align:right; width:100%;">yes / no&nbsp;<?php if($yes==1){?><input type="checkbox" name="yes_no" value="Y" checked><?php }else{?><input type="checkbox" name="yes_no" value="Y"><?php }?></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;<BR>
						<textarea name="description"><?php echo $_POST['the_content']; ?></textarea>
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
		
