<?php
/*function addShipper(){
	$shipper = array(
		'Contact' => array(
			'PersonName' => 'Shane Doyle',
			'CompanyName' => 'KitchenCabinetCo',
			'PhoneNumber' => '615.828.8377'
		),
		'Address' => array(
			'StreetLines' => '3515 Cleburne Road',
			'City' => 'Spring Hill',
			'StateOrProvinceCode' => 'TN',
			'PostalCode' => '37174',
			'CountryCode' => 'US'
		)
	);
	return $shipper;
}*/

function addRecipient($c_zip){
	$recipient = array(
		'Contact' => array(
			'PersonName' => 'Recipient Name',
			'CompanyName' => 'Company Name',
			'PhoneNumber' => '9012637906'
		),
		'Address' => array(
			'StreetLines' => array('Address Line 1'),
			'City' => '',
			'StateOrProvinceCode' => '',
			'PostalCode' => $c_zip,
			'CountryCode' => 'US',
			'Residential' => true
		)
	);
	return $recipient;	                                    
}

if(isset($_POST['submit']))
{
	/*$the_sender_name=$_POST['sender_name'];
	$the_company_name=$_POST['company_name'];
	$the_company_phone=$_POST['company_phone_number'];
	$the_company_street=$_POST['company_street'];*/
	$c_zip=$_POST['c_zip'];
	$vivian=addRecipient($c_zip);
	print_r ($vivian['Address']);
}



?>

<form method="Post" action="RateWebServiceClient.php">
<input type="text" name="c_zip" value="17584">
<!--<input type="hidden" name="company_name" value="KitchenCabinetCo.com">
<input type="hidden" name="company_phone_number" value="615.828.8377">
<input type="hidden" name="company_phone_number" value="615.828.8377">-->
<input type="submit" value="submit" name="submit">
</form>