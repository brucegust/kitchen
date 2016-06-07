<table align="center" border="0"><form action="article_edit.php" method="post">
				<tr>
<td colspan="2" align="right" bgcolor="#cccccc">
	<table border="0" bgcolor="#cccccc" align="right">
	<tr>
	<td align="right">
	featured&nbsp;
	<?php
	if(empty($featured)){
	?>
	<input type="checkbox" value="Y" name="featured">
	<?php
	}
	else
	{
	?>
	<input type="checkbox" value="Y" name="featured" checked>
	<?php
	}
	?>
	</td>
	<td align="right">
	retired&nbsp;
	<?php
	if(empty($retired)){
	?>
	<input type="checkbox" value="Y" name="retired">
	<?php
	}
	else
	{
	?>
	<input type="checkbox" value="Y" name="retired" checked>
	<?php
	}
	?>
	</td>
	</tr>
	</table>
</td>
</tr>
				<tr>
				<td class="MainText" background="images/spacer.gif" width="100" height="10">
				 Article Name
				</td>
				<td>
				<input type="text" size="78" name="name" value="<?php echo "$page_name"; ?>">
				</td>
				</tr>
				<tr>
				<td colspan="2">&nbsp;<BR>
				<textarea name="description" class="Photo"><?php $textarea = stripslashes($body); echo "$textarea"; ?></textarea>
				</td>
				</tr>
				<tr>
				<td colspan="2" align="center"><input type="hidden" name="id" value="<?php echo "$id"; ?>">
				<input type="Submit" value="Submit">
				</td>
				</tr>
				</table>