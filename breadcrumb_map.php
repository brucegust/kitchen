<?php
if($the_macro_category=="Cabinets")
{
	$macro_url="cabinets_home.php";
	$category_url="cabinets.php";
}
	elseif($the_macro_category=="Cabinet Accessories")
	{
		$macro_url="accessories_home.php";
		$category_url="accessories.php";
	}
	elseif($the_macro_category=="Posts, Corbels & Onlays")
	{
		$macro_url="posts_home.php";
		$category_url="posts.php";
	}
else
{
	$macro_url="trim_home.php";
	$category_url="trim.php";
}
?>