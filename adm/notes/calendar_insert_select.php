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
include('return_script_get.php');
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
			<td>
			<b>Calendar Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td>
			<P>
			To insert an Event into the calendar, fill in all of the fields, then click on "Submit." To return to the List of Calendar Events, click <A HREF="<?php echo $return_back_page; ?>">here</a>.
			<P>
			<div align="center"><b>You can also attach a document or a website to your event, but you'll do that after you first put the event on the calendar. Once it's been scheduled, go to the list of events and click on the "pencil" icon.</b></div>
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
			<td class="admin__body">
				<table width="800" border="0" class="center">
				<tr>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td><form action="calendar_insert_execute.php" method="post">	
					<table width=100% border="0">
					<tr>
					<td>
					Event Category
					</td>
					<td colspan="2">
					<select name="event_category">
					<option selected><?php echo $_GET['event_category']; ?></option>
					<option>Church Wide</option>
					<?php 
					$abe = "select * from calendar_category order by name";
					$abe_query=mysqli_query($cxn, $abe)
					or die("Couldn't make Abe happen.");
					$abe_count=mysqli_num_rows($abe_query);
						if($abe_count>0)
						{
						while($abe_row=mysqli_fetch_assoc($abe_query))
						{
						extract($abe_row);
						?>
					<option><?php echo stripslashes($abe_row['name']); ?></option>
						<?php
						}
						}
						else
						{
						?>
					<option>need to add categories</option>
						<?php
						}
						?>
					<option>_____________________________________________________________________</option>
					</select>
					</td>
					</tr>
					<tr>
					<td colspan="3">
					&nbsp;
					</td>
					</tr>
					<tr>
					<td>
					Event Name
					</td>
					<td colspan="2">
					<input type="text" name="event_name" size="81">
					</td>
					</tr>
					<tr>
					<td colspan="3">
					&nbsp;
					</td>
					</tr>
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Event Start Date
					</td>
					<td align="right">
						<?php require_once('calendar_insert_start_date_select.php'); ?>
					</td>
					<td align="right">
						<?php require_once('calendar_insert_start_time.php'); ?>
					</td>
					</tr>
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Event End Date
					</td>
					<td align="right">
						<?php require_once('calendar_insert_end_date_select.php'); ?>
					</td>
					<td align="right">
						<?php require_once('calendar_insert_end_time.php'); ?>
					</td>
					</tr>
					<tr>
					<td colspan="3"><BR>
					</td>
					</tr>
					<tr>
					<td colspan="3">
						<table width=100%>
						<tr>
						<td background=../images/spacer.gif" width="625" height="10">
						If event is all day, put a check in the box to the right.
						</td>
						<td align="right">
						<input type="checkbox" name="all_day" value="Y">
						</td>
						</tr>
						</table>
					</td>
					</tr>
					<tr>
					<td colspan="3"><BR>
					</td>
					</tr>
					<tr>
					<td colspan="3">
						<table width=100%>
						<tr>
						<td background="../images/spacer.gif" width="600" height="10">
						If this event repeats, click on the button to the right to select its "frequency."
						</td>
						<td>
						<script type="text/javascript">
						$(function() {
							// jQuery functions go here.
							$('#toggle1').click(function() {
							$('.toggle1').toggle();
							return false;
						});
						});
						</script></td><td><button id="toggle1">repeat</button></a>
						</td>
						</tr>
						</table>		
					</td>
					</tr>
					</table>
					<!-- here's your end date that's activated by the above pull down men -->
					<div class="toggle1" style="display:none;"><P>
					<table class="center" border="0">
					<tr>
					<td background="../images/spacer.gif" width="500" height="10">
					How Frequently...?
					</td>
					<td>
					<select name="frequency">
					<option></option>
					<option>every day</option>
					<option>every week</option>
					<option>every two weeks</option>
					<option>every month</option>
					<option>every year</option>
					<option>______________________________________</option>
					</select>
					</td>
					</tr>					
					<tr>
					<td>
					End Repeat
					</td>
					<td>
					<?php include('calendar_end_repeat_date.php'); ?>
					</td>
					<td>
					<IMG SRC="../images/spacer.gif" width="23" height="10">
					</td>
					</tr>
					</table>
					</div>
					<!--end end date stuff -->
					<table class="center">
					<tr>
					<td colspan="3" class="admin_body">&nbsp;<BR>
					<textarea name="event_desc">describe the event...</textarea>
					</td>
					</tr>
					<tr>
					<td colspan="3" class="admin_body"><input type="hidden" name="post_back_page" value="<?php echo $post_back_page; ?>">
<input type="hidden" name="post_month" value="<?php echo $post_back; ?>"><input type="hidden" name="post_right_now" value="<?php echo $post_right_now; ?>"><BR>
					<input type="Submit" value="Submit">
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
		</td></tr></table>
 <?php require_once('footer.php'); ?>	