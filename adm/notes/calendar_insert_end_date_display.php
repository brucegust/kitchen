<table border="1">
<tr>
<td colspan="3" class="admin_body">
Date
</td>
</tr>
<tr>
<td>
<select name="end_month">
<?php 
if($row['all_day']=="Y")
{
?>
<option selected>month</option>
<?php
}
else
{
?>
<option selected><?php echo date('F', strtotime($row['event_end'])); ?></option>
<?php
}
?>
<option>January</option>
<option>February</option>
<option>March</option>
<option>April</option>
<option>May</option>
<option>June</option>
<option>July</option>
<option>August</option>
<option>September</option>
<option>October</option>
<option>November</option>
<option>December</option>
</select>
</td>
<td>
<select name="end_day">
<?php 
if($row['all_day']=="Y")
{
?>
<option selected>day</option>
<?php
}
else
{
?>
<option selected><?php echo date('j', strtotime($row['event_end'])); ?></option>
<?php
}
?>
<option></option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
</td>
<td>
<select name="end_year">
<?php 
if($row['all_day']=="Y")
{
?>
<option selected><?php include('year_list.php'); ?></option>
<?php
}
else
{
?>
<option selected><?php echo date('Y', strtotime($row['event_end'])); ?></option>
<option><?php include('year_list.php'); ?></option>
<?php
}
?>
</select>
</td>
</tr>
</table>