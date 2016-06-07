<table class="tooltip" border="0">
<tr>
<td>
<b>Event Category</b>
</td>
<td class="right">
Church Wide
</td>
</tr>
<tr>
<td>
<b>Event Name</b>
</td>
<td class="right">
<?php echo stripslashes($jim_row['event_name']); ?>
</td>
</tr>
<tr>
<td>
<b>Start Date / Time</b>
</td>
<td class="right">
<?php echo date('l, F j, Y g:i a',strtotime($jim_row['event_start'])); ?>
</td>
</tr>
<tr>
<td background="../images/spacer.gif" width="150" height="10">
<b>End Date / Time</b>
</td>
<td class="right">
<?php 
if($jim_row['all_day']=="Y")
{
echo "all day";
}
else
{
echo date('l, F j, Y g:i a',strtotime($jim_row['event_end'])); 
}
?>
</td>
</tr>
<?php if($cassidy_alert>0)
{
?>
<tr>
<td colspan="2">
<i>This is a repeating event and ends <?php echo date("m/d/Y", strtotime($jerry_row['event_start'])); ?></i>
</td>
</tr>
<?php
}
?>
</table>
<div id="tooltip_description">
<b><u>Event Description</u></b>
<P>
<?php
if(strlen($jim_row['event_desc'])>200)
{
echo substr(stripslashes($jim_row['event_desc']), 0, 200).'...'; 
}
else
{
echo substr(stripslashes($jim_row['event_desc']), 0, 200);
} 
?>
</div>