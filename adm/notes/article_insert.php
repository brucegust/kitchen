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

$doc=0;
$web=0;
$video=0;
$plain_text=0;
 
require_once('header.php');

if(isset($_POST['submit']))
{
	if(isset($_POST['document'])&&$_POST['document']=="Y")
	{
	$element="document";
	$doc=1;
	}
	if(isset($_POST['website'])&&$_POST['website']=="Y")
	{
	$element="website";
	$web=1;
	}
	if(isset($_POST['video'])&&$_POST['video']=="Y")
	{
	$element="video";
	$video=1;
	}
	if(isset($_POST['plain_text'])&&$_POST['plain_text']=="Y")
	{
	$element="plain_text";
	$plain_text=1;
	}
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
			<b>Article Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<?php if(!isset($_POST['submit']))
			{
			?>
			<tr>
			<td class="MainText">
			<P>
			Being by inserting the kind of, "article" you're getting ready to add to the database. Once you've made your selection, click on "submit."<BR><BR>
				<div align="center"><form action="article_insert.php" method="Post"><table>
				<tr>
				<td>
				<input type="checkbox" value="Y" name="document">
				</td>
				<td>
				Document (pdf, picture, etc.)
				</td>
				<td>
				<input type="checkbox" value="Y" name="website">
				</td>
				<td>
				Website (podcast, webpage, etc.)
				</td>
				</tr>
				<tr>
				<td>
				<input type="checkbox" value="Y" name="video">
				</td>
				<td>
				Video (hosted on youtube)
				</td>
				<td>
				<input type="checkbox" value="Y" name="plain_text">
				</td>
				<td>
				Plain Text
				</td>
				</tr>
				<tr>
				<td colspan="4" class="admin_body"><BR>
				<input type="submit" value="submit" name="submit"></form>
				</td>
				</tr>
				</table></div>
			<P>
			<?php include ("help.php"); ?>
			</td>
			</tr>
			<?php
			}
			else
			{
			?>
			<tr>
			<td>
			<?php
			if($element=="plain_text")
			{
			?>
			To insert a <b>plain text /  article</b>, fill in the fields below and click on "submit."
			<?php
			}
			else
			{
			?>
			To insert a <b><?php echo $element; ?> /  article</b>, fill in the fields below and click on "submit."
			<?php
			}
			?>
			<P>
			To return to the admin page, click <A HREF="admin.php">here</a>.
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;<BR><BR><HR><BR><BR>
			</td>
			</tr>
			<?php
				if($doc>0)
				{
				require_once('insert_script_doc.php');
				}
				?>
				<?php
				if($web>0)
				{
				require_once('insert_script_web.php');
				}
				?>
				<?php
				if($video>0)
				{
				require_once('insert_script_video.php');
				}
				?>
				<?php
				if($plain_text>0)
				{
				require_once('insert_script_plain_text.php');
				}
				?>
		
		
				</td>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				</tr>
				<?php
				}
				?>
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
