<?php
function image_fix($rough_image) {
	
	$image    = getimagesize($rough_image);
	$width    = $image[0];
	$height   = $image[1];
	//echo $width.'<br>'.$height;;
	//I've got to fit my image neatly within a 200px x 200px square, so the first thing I need to do is figure out whether my height is greater than my width of vice versa
	if($height>$width)
	{
		//portrait size
		//I want my height to be no more than 200 pixels, so...
		$calc_one=$width * 200;
		$new_width=round($calc_one/$height);
		//echo $value_two;//my target width;
	}
	else
	{
		//echo "yes";
		//landscape size
		$calc_one=$height*200; //my target width;
		$new_width=round($calc_one/$width); //my target height;
	}
	return $new_width;
}	

$the_image="assets/images/2010cabinetimages/bc45.jpg";
?>
<img src="assets/images/2010cabinetimages/bc45.jpg" style="width:<?php echo image_fix($the_image);?>px;">





