<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");
if (!is_numeric($_POST['ID'])) 
{ 
// id's not numeric?  
// kill the script before the query can run 
die("The id must be numeric!"); 
} 
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$bruce="select * from pictures where id='$_POST[ID]'";
$bruce_query=mysqli_query($cxn, $bruce)
or die("Couldn't execute query.");
$bruce_row=mysqli_fetch_assoc($bruce_query);
extract($bruce_row);
$the_url = $url;
/*$ftp_server = "ftp.countryshowdown.com";
$ftp_user = "brucegust";
$ftp_pass = "M1chelle!";
if (function_exists('ftp_connect')) {
  $conn = ftp_connect("ftp.countryshowdown.com") 
  or die("Could not connect");
  ftp_login($conn,"brucegust","M1chelle!");
}
if (@ftp_login($conn_, $ftp_user, $ftp_pass)) {
	echo ftp_delete($conn,"Photos/$the_url");
} else {
    echo "Couldn't connect as $ftp_user\n";
}
ftp_close($conn);*/

require_once('header.php');
$query = "delete from pictures where id=".$_POST["ID"];
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
require_once('header.php');
 
?>
	
		
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Photo Delete Page</b>
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
	<table width="800" class="center" border="0" cellspacing="1" cellpadding="1">
	<tr>
	<td>	
	Congratulations! You have successfully deleted your selection from the database. Click <A HREF="pictureList.php">here</a> to return to the Photo List.
	<P>
	<?php include ("help.php"); ?>
	</td>
	</tr>
	<td>&nbsp;<BR>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
			
		
 <?php require_once('footer.php'); ?>	
		