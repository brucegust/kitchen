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

//this is a quick select statement so I can grab the class id and use that as part of the doc target so I don't wind up with repetitive names


$description = mysqli_real_escape_string($cxn, trim($_POST['description']));

$article_name = mysqli_real_escape_string($cxn, trim($_POST['article_name']));

$bruce = "INSERT into articles (page_name, description, article_type) values ('$article_name', '$description', 'document')";
$bruce_query = mysqli_query($cxn, $bruce);
if(!$bruce_query){
$whoops = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($whoops);
}
$bruce_id = $cxn->insert_id;

//we've added the file to the database, now we upload the form using the new id as it's title

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
$url .=".";
$url .=$file_ext;

$vivian="update articles set url = '$url' where id = '$bruce_id'";
$vivian_query = mysqli_query($cxn, $vivian)
or die("Couldn't execute query.");	
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

			<b>Article Insert Page (Document)</b>

			</td>

			</tr>

			<tr>

			<td>&nbsp;<BR>

			</td>

			</tr>

			<tr>

			<td class="MainText">

			<P>

			Here's the pdf that you just inserted into the database.
			<P>
		
			To return to the List of Articles, click <A HREF="article_list.php">here</a>, to return to the admin page, click <A HREF="admin.php">here</a>.

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

				<table align="center" border="1" width="600">
				<tr>
				<td>
				<b>Article (pdf)</b>:
				</td>
				<td>
				<A HREF="<?php echo "$target"; ?>" target="_blank"><?php echo $_POST['article_name']; ?></a>
				</td>
				</tr>
				<tr>
				<td colspan="2" bgcolor="#CCCCCC">
				<b>Description:</b>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<?php echo stripslashes(nl2br($_POST['description'])); ?>
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

		</table></form>



 <?php require_once('footer.php'); ?>	
