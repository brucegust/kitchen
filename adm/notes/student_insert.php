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
<b>Student Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
To insert a student into the database, fill in all of the fields, then click on "Submit."
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
	<table align="center" border="0"><form  action="student_insert_execute.php" method="POST">
	<tr>
	<td class="black">
	Last Name
	</td>
	<td>
	<input type="text" size="105"name="last_name">
	</td>
	</tr>
	<tr>
	<td class="black">
	First Name
	</td>
	<td>
	<input type="text" size="105"name="first_name">
	</td>
	</tr>
	<tr>
	<td class="black">
	Street One
	</td>
	<td>
	<input type="text" size="105"name="street_one">
	</td>
	</tr>
	<tr>
	<td class="black">
	Street Two
	</td>
	<td>
	<input type="text" size="105"name="street_two">
	</td>
	</tr>
		<tr>
	<td class="black">
	City
	</td>
	<td>
	<input type="text" size="105"name="city">
	</td>
	</tr>
		<tr>
	<td class="black">
	State
	</td>
	<td>
	<input type="text" size="105"name="state">
	</td>
	</tr>
	<tr>
	<td class="black">
	Zip
	</td>
	<td>
	<input type="text" size="105"name="zip">
	</td>
	</tr>
	<tr>
	<td class="black">
	Phone One
	</td>
	<td>
	<input type="text" size="105"name="phone_one">
	</td>
	</tr>
		<tr>
	<td class="black">
	Phone Two
	</td>
	<td>
	<input type="text" size="105"name="phone_two">
	</td>
	</tr>
		<tr>
	<td class="black">
	Phone Three
	</td>
	<td>
	<input type="text" size="105"name="phone_three">
	</td>
	</tr>
	<tr>
	<td class="black">
	Phone Four
	</td>
	<td>
	<input type="text" size="105"name="phone_four">
	</td>
	</tr>
	<tr>
	<td class="black">
	email
	</td>
	<td>
	<input type="text" size="105"name="email">
	</td>
	</tr>
	<tr>
	<td class="black">
	userid
	</td>
	<td>
	<input type="text" size="105"name="userid">
	</td>
	</tr>
	<tr>
	<td class="black">
	Password
	</td>
	<td>
	<input type="text" size="105"name="password" value="Secret">
	</td>
	</tr>
	<tr>
	<td class="black">
	DOB
	</td>
	<td>
		<table width="500">
		<tr>
		<td>
		<select name="month">
		<option selected></option>
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
		<option selected></option>
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
		<input type="text" size="80" name="year">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
	<td class="black">
	Status
	</td>
	<td>
	<select name="status">
	<option></option>
	<option>Active</option>
	<option>Inactive</option>
	<option>_________________________________________________________________________________________</option>
	</select>
	</td>
	</tr>
	<tr>
	<td class="black">
	Class
	</td>
	<td>
	<select name="class">
	<option></option>
	<?php 
	$jorja="select * from classes order by name";
	$jorja_query=mysqli_query($cxn, $jorja)
	or die("Couldn't execute query.");
	while($jorja_row=mysqli_fetch_assoc($jorja_query))
	{
	extract($jorja_row);
	?>
	<option><?php echo stripslashes($jorja_row['name']); ?></option>
	<?php
	}
	?>
	<option>_________________________________________________________________________________________</option>
	</select>
	</td>
	</tr>
	<tr>
	<td class="black">
	Class #2
	</td>
	<td>
	<select name="class_two">
	<option></option>
	<?php 
	$vivian="select * from classes order by name";
	$vivian_query=mysqli_query($cxn, $vivian)
	or die("Couldn't execute query.");
	while($vivian_row=mysqli_fetch_assoc($vivian_query))
	{
	extract($vivian_row);
	?>
	<option><?php echo stripslashes($vivian_row['name']); ?></option>
	<?php
	}
	?>
	<option>_________________________________________________________________________________________</option>
	</select>
	</td>
	</tr>
	<tr>
	<td class="black">
	Rank #1
	</td>
	<td>
	<select name="rank">
	<option></option>
	<?php
	$cheryl = "select * from ranks order by sort_order";
	$cheryl_query=mysqli_query($cxn, $cheryl)
	or die("Couldn't execute Cheryl");
	while($cheryl_row=mysqli_fetch_assoc($cheryl_query))
	{
	extract($cheryl_row);
	?>
	<option value="<?php echo $cheryl_row['id']; ?>"><?php echo stripslashes($cheryl_row['rank']); ?></option>
	<?php
	}
	?>
	<option>_________________________________________________________________________________________</option>
	</select>
	</td>
	</tr>
	<tr>
	<td class="black">
	Rank #2
	</td>
	<td>
	<select name="rank_two">
	<option></option>
	<?php
	$cathy = "select * from ranks order by sort_order";
	$cathy_query=mysqli_query($cxn, $cathy)
	or die("Couldn't execute cathy");
	while($cathy_row=mysqli_fetch_assoc($cathy_query))
	{
	extract($cathy_row);
	?>
	<option value="<?php echo $cathy_row['id']; ?>"><?php echo stripslashes($cathy_row['rank']); ?></option>
	<?php
	}
	?>
	<option>_________________________________________________________________________________________</option>
	</select>
	</td>
	</tr>
<tr>
<td style="text-align:center;" colspan="2"><br>
<input type="submit" value="submit">
</td>
</tr>
</table>
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	