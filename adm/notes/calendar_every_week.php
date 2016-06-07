<?php
if($_POST['frequency']=="every week")
{
$frequency_title="every week";
	//you need an ending time frame for repeating values. We'll check all three month values to make sure that hotshot entered a valid date
	if(isset($_POST['end_repeat_month'])&&$_POST['end_repeat_month']=="month")
	{
	header("Location:missing_error.php?field=end_repeating_date");
	exit();
	}
$the_start = strtotime($_POST['start_month'].' '.$_POST['start_day'].' '.$_POST['start_year']);
if(!$all_day>0)
{
$the_event_end_repeat = strtotime($_POST['end_repeat_month'].' '.$_POST['end_repeat_day'].' '.$_POST['end_repeat_year']);
}
$c = uniqid (rand (),true);
//right here we're going to ask the question if the "all day" check mark has been checked
	
	if($all_day>0)
	{
	while ($the_start<= $the_event_end_repeat) 
		{
		$insert = "insert into calendar (event_name, event_start, event_category, repeating_event_id, event_desc, frequency, all_day)
		values ('$event_name', '$event_start', '$event_category', '$c', '$event_desc', '$frequency_title', 'Y')";
		$insertexe = mysqli_query($cxn, $insert);
			if(!$insertexe) {
			$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
			die($error);
			} ;
		$event_start = date('Y-m-d H:i:s', strtotime("$event_start + 7 day"));
		$the_start = strtotime('+1 week', $the_start);
		}
	}
	else
	{
	while ($the_start<= $the_event_end_repeat) 
		{
		$insert = "insert into calendar (event_name, event_start, event_end, event_category, repeating_event_id, event_desc, frequency)
		values ('$event_name', '$event_start', '$event_end', '$event_category', '$c', '$event_desc', '$frequency_title')";
		$insertexe = mysqli_query($cxn, $insert);
			if(!$insertexe) {
			$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
			die($error);
			} ;
		$event_start = date('Y-m-d H:i:s', strtotime("$event_start + 7 day"));
		$event_end= date('Y-m-d H:i:s', strtotime("$event_end + 7 day"));
		$the_start = strtotime('+1 week', $the_start);
		}
	}
}
?>