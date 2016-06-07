<table align="center" border="0"><form action="article_edit_video.php" method="Post">
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
<td class="MainText">
Video Name
</td>
<td>
<input type="text" size="73"name="article_name" value="<?php echo stripslashes($page_name); ?>">
</td>
</tr>
<tr>
<td colspan="2">&nbsp;<BR>
<textarea name="video_code" class="Photo"><?php $video_script = html_entity_decode($video_code); echo stripslashes($video_script);?></textarea>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;<BR>
<textarea name="description" class="Photo"><?php echo stripslashes($description); ?></textarea>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="hidden" name="id" value="<?php echo $id; ?>">&nbsp;<BR>
<input type="Submit" value="Submit">
</td>
</tr>
</table>