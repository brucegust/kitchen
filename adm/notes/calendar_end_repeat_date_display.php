<?php
$sean = "select repeating_event_id from calendar where id='$row[id]'";
$sean_query=mysqli_query($cxn, $sean);
if(!$sean_query)
{
$smoke=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($smoke);
}
$sean_row=mysqli_fetch_assoc($sean_query);
extract($sean_row);

$annabelle="select event_end from calendar where repeating_event_id='$sean_row[repeating_event_id]' order by event_end DESC LIMIT 1";
$annabelle_query=mysqli_query($cxn, $annabelle);
if(!$annabelle_query)
{
$fog=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($fog);
}
$annabelle_row=mysqli_fetch_assoc($annabelle_query);
extract($annabelle_row);
?>

<table border="1" align="right">
<tr>
<td colspan="3" class="admin_body">
Date
</td>
</tr>
<tr>
<td>
<select name="end_repeat_month">
<option selected><?php echo date('F', strtotime($annabelle_row['event_end'])); ?></option>
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
</td>
<td>
<select name="end_repeat_day">
<option selected><?php echo date('j', strtotime($annabelle_row['event_end'])); ?></option>
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
<select name="end_repeat_year">
<option selected><?php echo date('Y', strtotime($annabelle_row['event_end'])); ?></option>
<option selected><?php include('year_list.php'); ?></option>
</select>
</td>
</tr>
</table>