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

$this_year =date("Y");

require_once('header.php');

?>
	
		<table border="0" cellspacing="0" cellpadding="0" width=100%>
		<tr>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		<td style="text-align:center;">
			<table border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
			<td class="TitleText">
			<b>Event Insert Class</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			To insert an event into the database, fill in all of the fields, then click on "Submit."
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
				<table border="0">
				<tr>
				<td align="center">	
					<table align="center" border="0"><form action="event_insert_execute.php" method="post">
					<tr>
					<td class="MainText" background="images/spacer.gif" width="100" height="10">
					Event Name
					</td>
					<td>
					<input type="text" size="85" name="event_name">
					</td>
					</tr>
					<td class="MainText" background="images/spacer.gif" width="100" height="10">
					Event Date
					</td>
					<td>
						<table>
						<tr>
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
						</td>
						<td>
						<select name="day">
						<option selected>Day</option>
						<option></option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
						<option>16</option>
						<option>17</option>
						<option>18</option>
						<option>19</option>
						<option>20</option>
						<option>21</option>
						<option>22</option>
						<option>23</option>
						<option>24</option>
						<option>25</option>
						<option>26</option>
						<option>27</option>
						<option>28</option>
						<option>29</option>
						<option>30</option>
						<option>31</option>
						</select>
						</td>
						<td>
						<select name="year">
						<option selected><?php echo $this_year; ?></option>
						<option></option>
						<option>2010</option>
						<option>2011</option>
						</select>
						</td>
						</tr>
						</table>
					</td>
					<tr>
					<td colspan="2">&nbsp;<BR>
					<textarea name="event_description">description</textarea>
					</td>
					</tr>
					<tr>
					<td colspan="2" style="text-align:center;">
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
