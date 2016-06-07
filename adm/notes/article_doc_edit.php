<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}

$good_url="";

include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

if(!empty($_POST['retired'])){
//here's where I'm checking to see if the retired box is checked and if it is, I update with a "Y" value
$retired_contestant = "UPDATE articles SET retired='Y' where id='$_POST[id]'";
$retired_contestant_result = mysqli_query($cxn, $retired_contestant);
}
else
{
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the retired option if need be
$retired_contestant = "UPDATE articles SET retired='' where id='$_POST[id]'";
$retired_contestant_result = mysqli_query($cxn, $retired_contestant);
}

if(!empty($_POST['featured'])){
//here's where I'm checking to see if the featured box is checked and if it is, I update with a "Y" value
$featured_contestant = "UPDATE articles SET featured='Y' where id='$_POST[id]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}
else
{
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the featured option if need be
$featured_contestant = "UPDATE articles SET featured='' where id='$_POST[id]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}


$description = mysqli_real_escape_string($cxn, trim($_POST['description']));
$form_name = mysqli_real_escape_string($cxn, trim($_POST['article_name']));
$the_url = trim($_POST['url']);

$query = "UPDATE articles SET description='$description',
url='$the_url',
page_name = '$form_name'
where id = '$_POST[id]'";
$result = mysqli_query($cxn, $query);
	if (!$result = mysqli_query($cxn, $query)) {
	$error = mysql_errno() . mysql_error();
	die($error);
	}

$bruce_id=$_POST['id'];	
if(isset($_FILES['form']['name'])&& !empty($_FILES['form']['name']))
{
$userfile_name = (isset ($_FILES['form']['name']) ? $_FILES['form']['name'] : '');

$filename = explode ('\\.', $userfile_name);
$good_ext = false;
$file_ext = '';
    if (strcmp (substr ($userfile_name, 0 - 4, 1), '.') === 0)
    {
      $good_ext = true;
      $file_ext = substr ($userfile_name, 0 - 3);
    }

    if (!$good_ext)
    {
      if (strcasecmp (substr ($userfile_name, 0 - 5, 1), '.') === 0)
      {
        $good_ext = true;
        $file_ext = substr ($userfile_name, 0 - 4);
      }
    }

    if (!$good_ext)
    {
      if (strcasecmp (substr ($userfile_name, 0 - 3, 1), '.') === 0)
      {
        $good_ext = true;
        $file_ext = substr ($userfile_name, 0 - 2);
      }
    }

$target = "../forms/";

$target = $target . $bruce_id.'article'.'.'.$file_ext;
	if(!move_uploaded_file($_FILES['form']['tmp_name'], $target)) {
	header("Location: form_noupload.php");
	exit();
	}
$url =$bruce_id;
$url .="article";
$url .=".";
$url .=$file_ext;

$vivian="update articles set url = '$url' where id = '$bruce_id'";
$vivian_query = mysqli_query($cxn, $vivian)
or die("Couldn't execute query.");
	
	$good_url = 1;
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
			<b>Article / Document Edit Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the article / document you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the List of Articles, click <A HREF="article_list.php">here</a>.
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
					<table width="700" align="center" border="1">
					<tr>
				<td colspan="2" bgcolor="#cccccc" align="right">
					<table width=100%>
					<tr>
					<td>
					featured&nbsp;
					<?php
					if(empty($_POST['featured'])){
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
					<td>
					retired&nbsp;
					<?php
					if(empty($_POST['retired'])){
					?>
					<input type="checkbox" value="Y" name="retired">
					<?php
					}
					else
					{
					?>
					<input type="checkbox" value="Y" name="retired" checked>
					<?php
					}
					?>
					</td>
					</tr>
					</table>
				</td>
				</tr>
					<tr>
					<td background="../images/spacer.gif" width="200" height="10">
					Article
					</td>
					<td>
					<A HREF="../forms/<?php echo $_POST['id']; ?>.pdf" target="_blank"><?php echo $_POST['article_name']; ?></a>
					</td>
					</tr>
					<tr>
					<td>
					Form URL
					</td>
					<?php
					if($good_url>0)
					{
					?>
					<td>
					<A HREF="../forms/<?php echo $url;  ?>" target="_blank"><?php echo $url; ?></a>
					</td>
					<?php
					}
					else
					{
					?>
					<td>
					<A HREF="../forms/<?php echo $the_url; ?>" target="_blank"><?php echo $the_url; ?></a>
					</td>
					<?php
					}
					?>
					</tr>
					<tr>
					<td colspan="2" bgcolor="#CCCCCC">
					<b>Description:</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<?php 
					$textarea = stripslashes(nl2br($_POST['description']));
					echo "$textarea";
					?>
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



		



