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
$month= mysqli_real_escape_string($cxn, trim($_POST['month']));
$days=trim($_POST['days']);
$year=trim($_POST['year']);
$starting_day=trim($_POST['starting_day']);
include('month_number_script.php');

$query = "UPDATE calendar_design SET month='$month',
number_days='$days',
year='$year',
starting_day='$starting_day',
month_number='$month_number'
where id = '$_POST[ID]'";
$result = mysqli_query($cxn, $query);
if (!$result = mysqli_query($cxn, $query)) {
$error = mysql_errno() . mysql_error();
die($error);
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
			<b>Calendar Design Edit Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the Month you just edited. To make any changes, click <A HREF="cal_design_list.php">here</a>, or to add another Month, click <A HREF="cal_design_insert.php">here</a>.
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
				<table width="700" border="0">
				<tr>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td align="center">	
					<table align="center" border="0"><form action="cal_design_insert_execute.php" method="post">
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Month
					</td>
					<td> 
					<select name="month">
					<option selected><?php echo $_POST['month']; ?></option>
					<option>January</option>
					<option>February</option>
					<option>March</option>
					<option>April</option>
					<option>May</option>
					<option>June</option>
					<option>July</option>
					<option>August</option>
					<option>September</option>
					<option>October</option>
					<option>November</option>
					<option>December</option>
					<option>_______________</option>
					</select>
					</td>
					</tr>
					<tr>
					<td>
					Number of Days
					</td>
					<td>
					<select name="days">
					<option selected><?php echo $_POST['days']; ?></option>
					<option></option>
					<option>28</option>
					<option>29</option>
					<option>30</option>
					<option>31</option>
					<option>_______________</option>
					</select>
					</td>
					</tr>
					<tr>
					<td>
					Starting Day
					</td>
					<td>
					<select name="starting_day">
					<option selected><?php echo $_POST['starting_day']; ?></option>
					<option></option>
					<option>Monday</option>
					<option>Tuesday</option>
					<option>Wednesday</option>
					<option>Thursday</option>
					<option>Friday</option>
					<option>Saturday</option>
					<option>Sunday</option>
					<option>_______________</option>
					</select>
					</td>
					</tr>
					<tr>
					<td>
					Year
					<td>
					<select name="year">
					<option selected><?php echo $_POST['year']; ?></option>
					<?php require_once('year_list.php'); ?>
					</select>
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
		