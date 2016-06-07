<?php
// Copyright 2009, FedEx Corporation. All rights reserved.
// Version 12.0.0

require_once('fedex-common.php');

//The WSDL is not included with the sample code.
//Please include and reference in $path_to_wsdl variable.


function addShipper(){
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
}

//sample code
function addRecipient($c_zip){
	$recipient = array(
		'Contact' => array(
			'PersonName' => '',
			'CompanyName' => '',
			'PhoneNumber' => ''
		),
		'Address' => array(
			'StreetLines' => array('Address Line 1'),
			'City' => '',
			'StateOrProvinceCode' => '',
			'PostalCode' => '17584',
			'CountryCode' => 'US',
			'Residential' => true
		)
	);
	return $recipient;	                                    
}

function addShippingChargesPayment(){
	$shippingChargesPayment = array(
		'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY
		'Payor' => array(
			'ResponsibleParty' => array(
				'AccountNumber' => getProperty('billaccount'),
				'CountryCode' => 'US'
			)
		)
	);
	return $shippingChargesPayment;
}

function addLabelSpecification(){
	$labelSpecification = array(
		'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY
		'ImageType' => 'PDF',  // valid values DPL, EPL2, PDF, ZPLII and PNG
		'LabelStockType' => 'PAPER_7X4.75'
	);
	return $labelSpecification;
}

function addSpecialServices(){
	$specialServices = array(
		'SpecialServiceTypes' => array('COD'),
		'CodDetail' => array(
			'CodCollectionAmount' => array(
				'Currency' => 'USD', 
				'Amount' => 150
			),
			'CollectionType' => 'ANY' // ANY, GUARANTEED_FUNDS
		)
	);
	return $specialServices; 
}

function addPackageLineItem1($height, $width, $depth, $weight){
	$packageLineItem = array(
		'SequenceNumber'=>1,
		'GroupPackageCount'=>1,
		'Weight' => array(
			//'Value' => 50.0,
			'Value' => $width,
			'Units' => 'LB'
		),
		'Dimensions' => array(
			/*'Length' => 108,
			'Width' => 5,
			'Height' => 5,*/
			'Length' => $depth,
			'Width' => $width,
			'Height' => $height,
			'Units' => 'IN'
		)
	);
	return $packageLineItem;
}

include("../carter.inc");
$cxn = new mysqli($host,$user,$password,$database);
if($cxn->connect_errno)
{
	$err="CONNECT FAIL: "
	.$cxn->connect_errno
	. ' '
	.$cxn->connect_error
	;
	trigger_error($err, E_USER_ERROR);
}

function getCart($the_session_id, $c_zip) {
//echo $the_session_id;	
global $cxn;

 $sql="select cart.product_id, cart.quantity, products.height, products.width, products.depth, products.weight from cart INNER JOIN products on cart.product_id=products.id where cart.session_id='$the_session_id' AND cart.product_cost>0 AND cart.product_id<>'392' AND cart.product_id<>'393'";
	 $query=$cxn->query($sql);
	while($row=$query->fetch_assoc())
	{
		// this part is retrieving the shipping cost
		
		$path_to_wsdl = "wsdl/RateService_v18.wsdl";

		ini_set("soap.wsdl_cache_enabled", "0");
		 
		$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

		$request['WebAuthenticationDetail'] = array(
			'ParentCredential' => array(
				'Key' => getProperty('parentkey'),
				'Password' => getProperty('parentpassword')
			),
			'UserCredential' => array(
				'Key' => getProperty('key'), 
				'Password' => getProperty('password')
			)
		); 
		$request['ClientDetail'] = array(
			'AccountNumber' => getProperty('shipaccount'), 
			'MeterNumber' => getProperty('meter')
		);
		$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Request using PHP ***');
		$request['Version'] = array(
			'ServiceId' => 'crs', 
			'Major' => '18', 
			'Intermediate' => '0', 
			'Minor' => '0'
		);
		$request['ReturnTransitAndCommit'] = true;
		$request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
		$request['RequestedShipment']['ShipTimestamp'] = date('c');
		$request['RequestedShipment']['ServiceType'] = 'GROUND_HOME_DELIVERY'; // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...
		$request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING'; // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
		$request['RequestedShipment']['TotalInsuredValue']=array(
			'Ammount'=>100,
			'Currency'=>'USD'
		);
		$request['RequestedShipment']['Shipper'] = addShipper();
		$request['RequestedShipment']['Recipient'] = addRecipient($c_zip);
		$request['RequestedShipment']['ShippingChargesPayment'] = addShippingChargesPayment();
		$request['RequestedShipment']['PackageCount'] = '1';
		$request['RequestedShipment']['RequestedPackageLineItems'] = addPackageLineItem1($row['height'], $row['width'], $row['depth'], $row['weight']);//you've got to pass in your height, width, depth and weight into this function



		if(setEndpoint('changeEndpoint'))
		{
			$newLocation = $client->__setLocation(setEndpoint('endpoint'));
		}
		
		$response = $client -> getRates($request);
			
		if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR')
		{  	
			$rateReply = $response -> RateReplyDetails;
			/*echo '<table border="1">';
			echo '<tr><td>Service Type</td><td>Amount</td><td>Delivery Date</td></tr><tr>';
			$serviceType = '<td>'.$rateReply -> ServiceType . '</td>';*/
			if($rateReply->RatedShipmentDetails && is_array($rateReply->RatedShipmentDetails))
			{
				$amount = number_format($rateReply->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",");
			}
				elseif($rateReply->RatedShipmentDetails && ! is_array($rateReply->RatedShipmentDetails))
				{
					$amount = number_format($rateReply->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",");
				}
			/*if(array_key_exists('DeliveryTimestamp',$rateReply)){
				$deliveryDate= '<td>' . $rateReply->DeliveryTimestamp . '</td>';
			}else if(array_key_exists('TransitTime',$rateReply)){
				$deliveryDate= '<td>' . $rateReply->TransitTime . '</td>';
			}else {
				$deliveryDate='<td>&nbsp;</td>';
			}
			echo $serviceType . $amount. $deliveryDate;
			echo '</tr>';
			echo '</table>';*/
			
			//printSuccess($client, $response);
		}
		else
		{
			//printError($client, $response);
		} 
		//writeToLog($client);    // Write to log file   

		//echo $amount;
		
		//end of fedex code
		
		$the_amount=$row['quantity'] * $amount;
		//echo $amount;
		//echo "<br>";
		
		$sql_1="insert into fedex (session_id, product_id, height, width, depth, weight, quantity, shipping) VALUES ('$the_session_id', '$row[product_id]', '$row[height]', '$row[width]', '$row[depth]', '$row[weight]', '$row[quantity]', '$the_amount')";
		//echo $sql_1;
		$query_1=$cxn->query($sql_1);
	 }

}

function clearCart($the_session_id) {
	
	global $cxn;
	
	$sql="delete from fedex where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	
}

function totalShipping($the_session_id) {
	
	global $cxn;
	
	$sql="select sum(shipping) as total_shipping from fedex where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$row=$query->fetch_assoc();
	
	return $row['total_shipping'];
}

//first, clear the fedex table of anything that is associated with this session id so you're starting off with a clean slate

$c_zip="37204";

$the_session_id="9edg65dghjosrj0g8umns9c3k3";

$clear=clearCart($the_session_id);

$hit_me=getCart($the_session_id, $c_zip);

$get_total=totalShipping($the_session_id);
echo number_format($get_total, 2);



?>