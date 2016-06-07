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

if ($_GET['Edit'] != "Yes")
{
$ID=$_GET[ID];
header("Location: student_delete.php?ID=$ID");
}
else
{
$query = "select * from students where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
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
Here's the student you just selected. Make your changes and then click on "submit." To return to the Student List, click <A HREF="student_list.php">here</a>.
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
	<table align="center" border="1"><form  action="student_edit.php" method="POST">
	<tr>
	<td class="black">
	Last Name
	</td>
	<td>
	<input type="text" size="105"name="last_name" value="<?php echo stripslashes($row['last_name']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	First Name
	</td>
	<td>
	<input type="text" size="105"name="first_name" value="<?php echo stripslashes($row['first_name']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	Street One
	</td>
	<td>
	<input type="text" size="105"name="street_one" value="<?php echo stripslashes($row['street_one']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	Street Two
	</td>
	<td>
	<input type="text" size="105"name="street_two" value="<?php echo stripslashes($row['street_two']); ?>">
	</td>
	</tr>
		<tr>
	<td class="black">
	City
	</td>
	<td>
	<input type="text" size="105"name="city" value="<?php echo stripslashes($row['city']); ?>">
	</td>
	</tr>
		<tr>
	<td class="black">
	State
	</td>
	<td>
	<input type="text" size="105"name="state" value="<?php echo stripslashes($row['state']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	Zip
	</td>
	<td>
	<input type="text" size="105"name="zip" value="<?php echo stripslashes($row['zip']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	Phone One
	</td>
	<td>
	<input type="text" size="105"name="phone_one" value="<?php echo stripslashes($row['phone_one']); ?>">
	</td>
	</tr>
		<tr>
	<td class="black">
	Phone Two
	</td>
	<td>
	<input type="text" size="105"name="phone_two" value="<?php echo stripslashes($row['phone_two']); ?>">
	</td>
	</tr>
		<tr>
	<td class="black">
	Phone Three
	</td>
	<td>
	<input type="text" size="105"name="phone_three" value="<?php echo stripslashes($row['phone_three']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	Phone Four
	</td>
	<td>
	<input type="text" size="105"name="phone_four" value="<?php echo stripslashes($row['phone_four']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	userid
	</td>
	<td>
	<input type="text" size="105"name="userid" value="<?php echo stripslashes($row['userid']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	email
	</td>
	<td>
	<input type="text" size="105"name="email" value="<?php echo stripslashes($row['email']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	Password
	</td>
	<td>
	<input type="text" size="105"name="password" value="<?php echo stripslashes($row['password']); ?>">
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
		<option selected><?php 
		if($row['dob']==0000-00-00)
		{
		echo "";
		}
		else
		{
		echo date("F", strtotime($row['dob'])); 
		}
		?></option>
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
		<option selected><?php 
		if($row['dob']==0000-00-00)
		{
		echo "";
		}
		else
		{
		echo date("d", strtotime($row['dob']));
		}
		?></option>
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
		<input type="text" size="80" name="year" value="<?php 
		if($row['dob']==0000-00-00)
		{
		echo "";
		}
		else
		{
		echo date("Y", strtotime($row['dob']));
		}
		?>">
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
	<option selected><?php echo $row['status']; ?></option>
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
	<option selected><?php echo stripslashes($row['class']); ?></option>
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
	<option selected><?php echo stripslashes($row['class_two']); ?></option>
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
	if($row['rank']==0 OR $row['rank']=="" OR $row['rank']==" ")
	{
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
	}
	else
	{
	$scooter = "select * from ranks where id='$row[rank]'";
	$scooter_query=mysqli_query($cxn, $scooter)
	or die("Couldn't execute scooter.");
	$scooter_row=mysqli_fetch_assoc($scooter_query);
	extract($scooter_row);
	?>
	<option selected value="<?php echo $scooter_row['id']; ?>"><?php echo stripslashes($scooter_row['rank']); ?></option>
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
	if($row['rank_two']==0 OR $row['rank_two']=="" OR $row['rank_two']==" ")
	{
		$nick = "select * from ranks order by sort_order";
		$nick_query=mysqli_query($cxn, $nick)
		or die("Couldn't execute nick");
		while($nick_row=mysqli_fetch_assoc($nick_query))
		{
		extract($nick_row);
		?>
		<option value="<?php echo $nick_row['id']; ?>"><?php echo stripslashes($nick_row['rank']); ?></option>
		<?php
		}
	}
	else
	{
	$jason = "select rank from ranks where id='$row[rank]'";
	$jason_query=mysqli_query($cxn, $jason)
	or die("Couldn't execute jason.");
	$jason_row=mysqli_fetch_assoc($jason_query);
	extract($jason_row);
	?>
	<option selected value="<?php echo $scotter_row['id']; ?>"><?php echo stripslashes($jason_row['rank']); ?></option>
		<?php
		$nick = "select * from ranks order by sort_order";
		$nick_query=mysqli_query($cxn, $nick)
		or die("Couldn't execute nick");
		while($nick_row=mysqli_fetch_assoc($nick_query))
		{
		extract($nick_row);
		?>
		<option value="<?php echo $nick_row['id']; ?>"><?php echo stripslashes($nick_row['rank']); ?></option>
		<?php
		}
	}
	?>
	<option>_________________________________________________________________________________________</option>
	</select>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td style="text-align:center;"><input type="hidden" name="ID" value="<?php echo $row['id']; ?>"><br>
<input type="submit" value="submit">
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	