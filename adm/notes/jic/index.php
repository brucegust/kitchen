<?php 
session_start(); 
 
switch (@$_POST['do'])
{
      case "login":
      $password=$_POST['password'];
	 if ($password != "Secret") { 
      header("Location:login_wrong.php");
      exit ();
      }
     else
      {
      $_SESSION['auth'] = "yes";
      header("Location:admin.php");
      exit();
      }
 
      break;
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
			<b>Admin Page Login</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">Enter your password below, then click on "Submit." 
			</td>
			</tr>
			<tr>
			<td class="admin_body"><BR>
				<table width=100% class="center"><form action="default.php" method="post">
				<tr>
				<td class="admin_body">
				<input type="password" name="password" size="35">
				</td>
				</tr>
				<tr>
				<td class="admin_body">
				<input type="Submit" value="Submit">  <input type="hidden" name="do" value="login">
				</td>
				</tr>
				</table></form>
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