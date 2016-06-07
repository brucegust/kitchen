<?php
if(isset($_POST['start_hour'])&& $_POST['start_hour']=="hour")
{
header("Location:missing_error.php?field=start_date");
exit();
}
if(isset($_POST['start_minutes'])&&$_POST['start_minutes']=="day")
{
header("Location:missing_error.php?field=start_date");
exit();
}

if(isset($_POST['end_hour'])&& $_POST['end_hour']=="hour")
{
header("Location:missing_error.php?field=end_time");
exit();
}
if(isset($_POST['end_minutes'])&&$_POST['end_minutes']=="minutes")
{
header("Location:missing_error.php?field=end_time");
exit();
}
?>
		