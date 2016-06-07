<?php
session_start();
$password='$_POST[password]';
if (!$password=="Secret")
{
header("Location:login_wrong.php");
exit ();
}
else
{
$_SESSION['auth'] = "yes";
header("Location:admin.php");
exit();
}
?>