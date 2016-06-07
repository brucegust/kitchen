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


$description = mysqli_real_escape_string($cxn, trim($_POST['description']));
$element_name= mysqli_real_escape_string($cxn, trim($_POST['page_name']));
$video_code = htmlspecialchars("$_POST[video_code]", ENT_QUOTES);

$insert = "insert into articles (page_name, article_type, description, video_code) 
values ('$element_name', 'video', '$description', '$video_code')";
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe) {
$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($error);
} 
$novie_id = $cxn->insert_id;	
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

			<b>Video / Article Insert Page (Video)</b>

			</td>

			</tr>

			<tr>

			<td>&nbsp;<BR>

			</td>

			</tr>

			<tr>

			<td class="MainText">

			<P>

			Here's the video / article you just inserted. 
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
				<td class="MainText">
				Video / Article Name
				</td>
				<td>
				<A HREF="../video_article_player.php?id=<?php echo $novie_id; ?>" target="_blank"><?php echo $_POST['page_name']; ?></a>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<?php echo nl2br($_POST['description']); ?>
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
