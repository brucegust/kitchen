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

include('student_clean_insert.php'); 

$jorja="select id from students where userid='$userid'";
$jorja_query=mysqli_query($cxn, $jorja)
or die("Couldn't make Jorja happen.");
$jorja_count=mysqli_num_rows($jorja_query);
if($jorja_count>0)
{
header("Location:student_duplicate.php");
exit();
}

$insert = "insert into students (first_name, last_name, street_one, street_two, city, state, zip, userid, phone_one, phone_two, phone_three, phone_four, email, password, dob, status, class, class_two, rank, rank_two) 
values ('$first_name', '$last_name', '$street_one', '$street_two', '$city', '$state', '$zip', '$userid', '$phone_one', '$phone_two', '$phone_three', '$phone_four', '$email', '$password', '$birthday', 
'$status', '$class_one', '$class_two', '$rank', '$rank_two')";
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe) {
$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($error);
} 

require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Student Insert Execute Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the student you just inserted into the database.
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
	<table align="center" border="1" width="800">
	<tr>
	<td class="black">
	Last Name
	</td>
	<td>
	<?php echo $_POST['last_name']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	First Name
	</td>
	<td>
	<?php echo $_POST['first_name']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Street One
	</td>
	<td>
	<?php echo $_POST['street_one']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Street Two
	</td>
	<td>
	<?php echo $_POST['street_two']; ?>
	</td>
	</tr>
		<tr>
	<td class="black">
	City
	</td>
	<td>
	<?php echo $_POST['city']; ?>
	</td>
	</tr>
		<tr>
	<td class="black">
	State
	</td>
	<td>
	<?php echo $_POST['state']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Zip
	</td>
	<td>
	<?php echo $_POST['zip']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Phone One
	</td>
	<td>
	<?php echo $_POST['phone_one']; ?>
	</td>
	</tr>
		<tr>
	<td class="black">
	Phone Two
	</td>
	<td>
	<?php echo $_POST['phone_two']; ?>
	</td>
	</tr>
		<tr>
	<td class="black">
	Phone Three
	</td>
	<td>
	<?php echo $_POST['phone_three']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Phone Four
	</td>
	<td>
	<?php echo $_POST['phone_four']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	userid
	</td>
	<td>
	<?php echo $_POST['userid']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	email
	</td>
	<td>
	<?php echo $_POST['email']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Password
	</td>
	<td>
	<?php echo $_POST['password']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	DOB
	</td>
	<td>
	<?php echo date("m/d/Y", strtotime($birthday)); ?>	
	</td>
	</tr>
	<tr>
	<td class="black">
	Status
	</td>
	<td>
	<?php echo $_POST['status']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Class
	</td>
	<td>
	<?php echo $_POST['class']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Class Two
	</td>
	<td>
	<?php echo $_POST['class_two']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Rank
	</td>
	<td>
	<?php 
	if(isset($_POST['rank'])&&$_POST['rank']!="")
	{
	$scooter = "select rank from ranks where id='$_POST[rank]'";
	$scooter_query=mysqli_query($cxn, $scooter)
	or die("Couldn't execute scooter.");
	$scooter_row=mysqli_fetch_assoc($scooter_query);
	extract($scooter_row);
	echo stripslashes($scooter_row['rank']);
	}
	else
	{
	echo "&nbsp;";
	}
	?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Rank Two
	</td>
	<td>
	<?php 
	if(isset($_POST['rank_two'])&&$_POST['rank_two']!="")
	{
	$braces = "select rank_two from ranks where id='$_POST[rank_two]'";
	$braces_query=mysqli_query($cxn, $braces)
	or die("Couldn't execute braces.");
	$braces_row=mysqli_fetch_assoc($braces_query);
	extract($braces_row);
	echo stripslashes($braces_row['rank_two']);
	}
	else
	{
	echo "&nbsp;";
	}
	?>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td style="text-align:center;"><br>
<input type="submit" value="submit">
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	