<?php
$jorja= $start_hour.':'.$_POST['start_minutes'];
$jorja.=":00";
$event_start = date('Y-m-d H:i:s',strtotime($_POST['start_month'].' '.$_POST['start_day'].' '.$_POST['start_year'].' '.$jorja));

//first thing: delete the entry as it is right now and start all over with the info that's just been documented

$maria = "delete from calendar where id = '$_POST[ID]'";
$maria_query=mysqli_query($cxn, $maria);
if(!$maria_query)
{
$rats=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($rats);
}

//now enter what you've got into the database and BOOM, you're gold

$insert = "insert into calendar (event_name, event_start, event_category, event_desc, all_day)
values ('$event_name', '$event_start', '$event_category', '$event_desc', 'Y')";
$insertexe = mysqli_query($cxn, $insert);
	if(!$insertexe) {
	$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
	die($error);
	}
?>