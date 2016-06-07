<?php

session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}

include ("../carter.inc");

if ($_GET['Edit'] != "Yes")
{
$ID=$_GET[ID];
header("Location: quotedelete.php?ID=$ID");
}
else
{

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

$query = "select * from quotes where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);

require_once('header.php');

}

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
			<b>Testimonial Display</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the testimonial you just selected. Change whatever information you need to alter and then click on "Submit." To return to the List of Testimonials, click <A HREF="quoteList.php">here</a>.
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
				<table align="center" border="0"><form action="quoteedit.php" method="post">
				<tr>
				<td colspan="2" bgcolor="#cccccc">
					<table border="0" bgcolor="#cccccc" align="right">
					<tr>
					<td align="right">
					featured&nbsp;
					<?php
					if(empty($featured)){
					?>
					<input type="checkbox" value="Y" name="featured">
					<?php
					}
					else
					{
					?>
					<input type="checkbox" value="Y" name="featured" checked>
					<?php
					}
					?>
					</td>
					</tr>
					</table>
					</td>
					</tr>
				<tr>
				<td class="MainText">
				Date:
				</td>
				<td>
				<tr>
				<td class="MainText">
				Article Date:
				</td>
				<td background="../Images/spacer.gif" width="500" height="10">
					<table width="500">
					<tr>
					<td>
					<select name="month">
					<option selected><?php echo date("F", strtotime($date)); ?></option>
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
					<option selected><?php echo date("d", strtotime($date)); ?></option>
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
				</td>
				</tr>
				<tr>
				<td class="MainText">
				 Author:
				</td>
				<td>
				<input type="text" size="72" name="name" value="<?php echo "$author"; ?>">
				</td>
				</tr>
				<tr>
				<td colspan="2">&nbsp;<BR>
				<textarea name="description" rows="35"><?php echo stripslashes(nl2br($quote)); ?></textarea>
				</td>
				</tr>
				<tr>
				<td colspan="2" style="text-align:center;"><input type="hidden" name="ID" value="<?php echo "$id"; ?>">
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
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>

 <?php require_once('footer.php'); ?>	
		
