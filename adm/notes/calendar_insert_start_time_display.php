<table border="1">
<tr>
<td colspan="3" class="admin_body">
Time
</td>
</tr>
<tr>
<td>
<select name="start_hour">
<option selected><?php echo date('g', strtotime($bruce_row['time_in'])); ?></option>
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
</select>
</td>
<td>
<select name="start_minutes">
<option selected><?php echo date('i', strtotime($bruce_row['time_in'])); ?></option>
<option></option>
<option>00</option>
<option>05</option>
<option>10</option>
<option>15</option>
<option>20</option>
<option>25</option>
<option>30</option>
<option>35</option>
<option>40</option>
<option>45</option>
<option>50</option>
<option>55</option>
</select>
</td>
<td>
<select name="start_morning_evening">
<option selected><?php echo date('a', strtotime($bruce_row['time_in'])); ?></option>
<option>am</option>
<option>pm</option>
</select>
</td>
</tr>
</table>