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
require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>News Article Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
To insert an article into the database, fill in all of the fields, then click on "Submit."
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
	<table width=100% border="0">
	<tr>
	<td>
	<IMG SRC="../images/spacer.gif" width="10" height="10">
	</td>
	<td class="admin_body">	
		<table width="700" class="center" border="0"><form enctype="multipart/form-data" action="news_insert_execute.php" method="post">
		<tr>
		<td class="MainText" background="../Images/spacer.gif" width="200" height="10">
		Photo #1
		</td>
		<td>
		<input name="photo" type="file" size="66">
		</td>
		</tr>
		<tr>
		<td class="MainText" background="../Images/spacer.gif" width="200" height="10">
		Date
		</td>
		<td background="../Images/spacer.gif" width="500" height="10">
			<table width="500">
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
			<?php include('year_list.php'); ?>
			</select>
			</td>
			<td>
			<IMG SRC="../images/spacer.gif" width="300" height="10">
			</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr>
		<td class="MainText" background="../images/spacer.gif" width="200" height="10">
		Name
		</td>
		<td background="../images/spacer.gif" width="500" height="10">
		<input type="text" size="80" name="headline">
		</td>
		</tr>
		<tr>
		<td colspan="2" class="admin_body">
		<textarea name="main_body">Main Body</textarea>
		</td>
		</tr>
		<tr>
		<td colspan="2" class="admin_body">
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
		
 <?php require_once('footer.php'); ?>	