<?php
$userid=trim($_POST['userid']);
$first_name = mysqli_real_escape_string($cxn, trim($_POST['first_name']));
$last_name = mysqli_real_escape_string($cxn, trim($_POST['last_name']));
$street_one = mysqli_real_escape_string($cxn, trim($_POST['street_one']));
$street_two = mysqli_real_escape_string($cxn, trim($_POST['street_two']));
$city = mysqli_real_escape_string($cxn, trim($_POST['city']));
$city = mysqli_real_escape_string($cxn, trim($_POST['city']));
$state = mysqli_real_escape_string($cxn, trim($_POST['state']));
$zip = mysqli_real_escape_string($cxn, trim($_POST['zip']));
$userid = mysqli_real_escape_string($cxn, trim($_POST['userid']));
$phone_one = mysqli_real_escape_string($cxn, trim($_POST['phone_one']));
$phone_two = mysqli_real_escape_string($cxn, trim($_POST['phone_two']));
$phone_three = mysqli_real_escape_string($cxn, trim($_POST['phone_three']));
$phone_four = mysqli_real_escape_string($cxn, trim($_POST['phone_four']));
$email = trim($_POST['email']);
if(trim($_POST['month'])=="")
{
$birthday=0000-00-00;
}
else
{
$birthday = date('Y-m-d',strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));
}
$status = mysqli_real_escape_string($cxn, trim($_POST['status']));
$class_one = mysqli_real_escape_string($cxn, trim($_POST['class']));
$class_two = mysqli_real_escape_string($cxn, trim($_POST['class_two']));
$rank=trim($_POST['rank']);
$rank_two=trim($_POST['rank_two']);
$password = mysqli_real_escape_string($cxn, trim($_POST['password']));
?>