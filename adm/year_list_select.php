<?php
$super_year = date("Y");
?>
<option selected><?php echo date("Y", strtotime($_GET['today'])); ?></option>
<option><?php echo $super_year; ?></option>
<option><?php echo $super_year+1; ?></option>
<option><?php echo $super_year+2; ?></option>
<option><?php echo $super_year+3; ?></option>
<option>_______________</option>