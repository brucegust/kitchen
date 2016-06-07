<?php

function addPackageLineItem1($count){
	$packageLineItem = array(
	for($x=1; $x<=$count; $x++)
	{
			'SequenceNumber'=>1,
			'GroupPackageCount'=>1,
			'Weight' => array(
				'Value' => 50.0,
				'Units' => 'LB'
			),
			'Dimensions' => array(
				'Length' => 108,
				'Width' => 5,
				'Height' => 5,
				'Units' => 'IN'
			)
		);
	}
	return $packageLineItem;
}	

$form_package_count=4;

$request['RequestedShipment']['PackageCount'] = '1';
$request['RequestedShipment']['RequestedPackageLineItems'] = addPackageLineItem1();


$new_package=addPackageLineItem1(1);
var_dump($new_package);
foreach ($new_package as $package)
{
echo $package['SequenceNumber'];

//array(4) { ["SequenceNumber"]=> int(1) ["GroupPackageCount"]=> int(1) ["Weight"]=> array(2) { ["Value"]=> float(50) ["Units"]=> string(2) "LB" } ["Dimensions"]=> array(4) { ["Length"]=> int(108) ["Width"]=> int(5) ["Height"]=> int(5) ["Units"]=> string(2) "IN" } } 

}

?>