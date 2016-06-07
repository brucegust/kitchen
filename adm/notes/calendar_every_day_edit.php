<?php
if($_POST['frequency']=="every_day")
{
$frequency_title="every day";
	//you need an ending time frame for repeating values. We'll check all three month values to make sure that hotshot entered a valid date
	if(isset($_POST['end_repeat_month'])&&$_POST['end_repeat_month']=="month")
	{
	header("Location:missing_error.php?field=end_repeating_date");
	exit();
	}
if(isset($_POST['future_events'])&&$_POST['future_events']=="Y")
	{

	$the_start = strtotime($_POST['start_month'].' '.$_POST['start_day'].' '.$_POST['start_year']);
	$the_event_end_repeat = strtotime($_POST['end_repeat_month'].' '.$_POST['end_repeat_day'].' '.$_POST['end_repeat_year']);

	$num_days=$the_event_end_repeat-$the_start;
	$datediff= floor($num_days/(60*60*24));
	//here's your insert code
	$new_event_start=$event_start;
	$new_event_end=$event_end;
		for ($i=0; $i<=$datediff; $i++)
		{
			if($all_day>0)
			{
			$kyle = "update calendar
			$insert = "insert into calendar (event_name, event_start, event_end, event_category, event_desc, all_day, repeating_event_id)
			values ('$event_name', '$new_event_start', '$new_event_end', '$event_category', '$event_desc', 'Y','$c')";
			$insertexe = mysqli_query($cxn, $insert);
				if(!$insertexe) {
				$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
				die($error);
				} ;
			}
			else
			{
			$insert = "insert into calendar (event_name, event_start, event_end, event_category, event_desc, repeating_event_id)
			values ('$event_name', '$new_event_start', '$new_event_end', '$event_category', '$event_desc','$c')";
			$insertexe = mysqli_query($cxn, $insert);
				if(!$insertexe) {
				$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
				die($error);
				} ;
			}
		$new_event_start=date('Y-m-d H:i:s', strtotime($new_event_start) + 86400);
		$new_event_end=date('Y-m-d H:i:s', strtotime($new_event_end) + 86400);
		}
		//end daily repeat
	}
}
?>