<?php
//you've got to establish your repeating values based on the select menu on the the display page, so...
$new_frequency = $_POST['frequency'];
if(isset($_POST['this_event_only'])&&$_POST['this_event_only']=="Y")
{
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

	if($all_day>0)
	{
	$insert = "insert into calendar (event_name, event_start, event_category, event_desc, repeating_event_id, frequency, all_day)
	values ('$event_name', '$event_start', '$event_category', '$event_desc', '$michelle_row[repeating_event_id]', '$new_frequency', 'Y')";
	$insertexe = mysqli_query($cxn, $insert);
		if(!$insertexe) {
		$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($error);
		} 
	}
	else
	{
	$insert = "insert into calendar (event_name, event_start, event_end, event_category, repeating_event_id, frequency, event_desc)
	values ('$event_name', '$event_start', '$event_end', '$event_category','$michelle_row[repeating_event_id]', '$new_frequency', '$event_desc')";
	$insertexe = mysqli_query($cxn, $insert);
		if(!$insertexe) {
		$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($error);
		} 
	}
//now delete the original entry and you're now going with the new stuff you just entered
$gabe="delete from calendar where id='$_POST[ID]'";
$gabe_query=mysqli_query($cxn, $gabe)
or die("Couldn't execute query.");
}
//here's where you deal with the scenario where it's everybody...
if(isset($_POST['future_events'])&&$_POST['future_events']=="Y")
{
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
$gabe="delete from calendar where repeating_event_id='$michelle_row[repeating_event_id]'";
$gabe_query=mysqli_query($cxn, $gabe)
or die("Couldn't execute query.");
}