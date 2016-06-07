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

include('student_clean.php'); 

$query = "UPDATE students SET first_name='$first_name',
userid='$userid',
last_name='$last_name',
street_one = '$street_one', 
street_two='$street_two',
city='$city', 
state='$state',
zip = '$zip', 
userid='$userid', 
phone_one='$phone_one', 
phone_two='$phone_two',
phone_three='$phone_three', 
phone_four='$phone_four',
email='$email', 
dob='$birthday', 
status='$status', 
class='$class_one',
class_two='$class_two',
rank='$rank',
rank_two='$rank_two',
password='$password' 
where id = '$_POST[ID]'";

$query_result = mysqli_query($cxn, $query);
if(!$query_result)
{
$rats=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($rats);
}

require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Student Edit Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the changes you just made. To return to the Student List, click <A HREF="student_list.php">here</a>. 
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
	<td class="black" style="width:200px;">
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
	<?php 
	if($birthday==0000-00-00)
	{
	echo "";
	}
	else
	{
	echo date("m/d/Y", strtotime($birthday)); 
	}
	?>	
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
	$scooter_count=mysqli_num_rows($scooter_query);
		if($scooter_count>0)
		{
		$scooter_row=mysqli_fetch_assoc($scooter_query);
		extract($scooter_row);
		echo stripslashes($scooter_row['rank']);
		}
		else
		{
		echo "belt history unavailable...";
		}
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