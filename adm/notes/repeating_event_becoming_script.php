<?php
//you're going to insert a brand new event first and then delete the original
$jorja= $start_hour.':'.$_POST['start_minutes'];
$jorja.=":00";
$event_start = date('Y-m-d H:i:s',strtotime($_POST['start_month'].' '.$_POST['start_day'].' '.$_POST['start_year'].' '.$jorja));

	if(isset($_POST['all_day'])&&!empty($_POST['all_day'])=="Y")
	{
	$all_day=1;
	}
	else
	{
	$vivian= $end_hour.':'.$_POST['end_minutes'];
	$vivian.=":00";
	$event_end = date('Y-m-d H:i:s',strtotime($_POST['end_month'].' '.$_POST['end_day'].' '.$_POST['end_year'].' '.$vivian));
	$all_day=0;
	}
	if(isset($_POST['frequency'])&&!empty($_POST['frequency']))
	{
	$frequency_alert=1;
		include('calendar_every_day.php');
		include('calendar_every_week.php');
		include('calendar_every_two_weeks.php');
		include('calendar_every_month.php');
		include('calendar_every_year.php');
	}
//wiping out the original stuff so you're now looking at the "new and improved"
$gabe="delete from calendar where id='$_POST[ID]'";
$gabe_query=mysqli_query($cxn, $gabe)
or die("Couldn't execute query.");
?>