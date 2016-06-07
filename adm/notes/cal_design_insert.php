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
$this_year = date("Y");
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
			<b>Calendar Design Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			To insert a monthly format into the database, fill in all of the fields, then click on "Submit."
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
				<table width=100% border="0">
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
					<option selected>Month</option>
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
					<option selected>Day</option>
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
					<option selected>Starting Day</option>
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
					<option selected><?php echo $this_year; ?></option>
					<?php require_once('year_list.php'); ?>
					</select>
					</td>
					</tr>
					<tr>
					<td colspan="2" align="center"><BR>
					<input type="Submit" value="Submit">
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