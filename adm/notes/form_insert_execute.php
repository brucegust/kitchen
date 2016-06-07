<?php 
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$form_name = mysqli_real_escape_string($cxn, trim($_POST['form_name']));
$bruce = "INSERT into forms (name, category, description) values ('$form_name', 'hardcopy calendar', 'new calendar')";
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
$target = $target . $bruce_id.'.'.$file_ext;
	if(!move_uploaded_file($_FILES['form']['tmp_name'], $target)) {
	header("Location: form_noupload.php");
	exit();
	}
$url = "forms/";
$url .=$bruce_id;
$url .=".";
$url .=$file_ext;
$vivian="update forms set url = '$url' where id = '$bruce_id'";
$vivian_query = mysqli_query($cxn, $vivian)
or die("Couldn't execute query.");	

//eliminating all other calendars save the one that was just uploaded

$michelle="delete from forms where id<>'$bruce_id'";
$michelle_query=mysqli_query($cxn, $michelle)
or die("Couldn't execute Michelle");

require_once('header.php');
 
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Form Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the calendar you just entered into the database. To check whether or not the calendar was uploaded correctly, click <A HREF="../forms/<?php echo $url; ?>" target="_blank">here</a>.
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
<td style="text-align:center;">
	<table width=100% border="0">
	<tr>
	<td align="center">	
		<table width="700" align="center" border="1">
		<tr>
		<td class="MainText" background="images/spacer.gif" width="200" height="10">
		Calendar Name
		</td>
		<td>
		<?php echo $_POST['form_name']; ?>
		</td>
		</tr>
		<tr>
		<td>
		<b>Calendar</b>:
		</td>
		<td>
		<A HREF="<?php echo "$target"; ?>" target="_blank"><?php echo $_POST['form_name']; ?></a>
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