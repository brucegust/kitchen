<?php 
include("header_cart.php"); 
/*At this point the customer's order has been placed in the order_admin (customer information and shipping charges) and order_items (all of what they've ordered along with their session_id and their customer id
what needs to happen now is they need to pay for their order using either Paypal, their credit card or a check. The interface needs to be built in such a way where there's a screen for a failed credit card validation as well as a "success" screen that lets them know everything is good to go as well as an email sent to their inbox that confirms their order and gives them their order number
*/

$the_session_id=$_GET['session_id'];

function current_cart() {
	
	global $the_session_id;

	global $cxn;

		$sql="select cart.id, cart.session_id, cart.product_id, cart.door_id, cart.sequence, cart.product_cost, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' AND cart.product_id<>'392' AND cart.product_id<>'393' order by sequence DESC";

		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		$result_array = array();
	
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
	return $result_array;
	
}

function feature_cart($product_id, $door_id) {
	
	global $the_session_id;
	
	global $cxn;
	
		if(isset($_POST['session_id']))
		{
			$the_session_id=$_POST['session_id'];
		}
			elseif(isset($_POST['ajax_session_id']))
			{
				$the_session_id=$_POST['ajax_session_id'];
			}
		else
		{
			$the_session_id=$_GET['session_id'];
		}
	
	$sql="select cart.session_id, cart.option_id, cart.feature_id, cart.feature_cost as feature_cost, features.featurecaption, features.featurename from cart INNER JOIN features on cart.feature_id=features.id where cart.session_id='$the_session_id' AND cart.product_id='$product_id' AND door_id='$door_id' AND cart.option_id>0 ORDER BY features.featurecaption";
	//echo $sql;
	if(!$query=$cxn->query($sql))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	
	$result_array="";
	
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		
	return $result_array;
}

function cart_door($product_id, $feature_door_id) {
	
	global $cxn;
	
		if(isset($_POST['session_id']))
		{
			$the_session_id=$_POST['session_id'];
		}
			elseif(isset($_POST['ajax_session_id']))
			{
				$the_session_id=$_POST['ajax_session_id'];
			}
		else
		{
			$the_session_id=$_GET['session_id'];
		}
	
	//this is giving our the door / cabinet color and any corresponding costs
	$sql="select featurename, featureprice from features where product_id=(select part_id from products where id='$product_id') and part_number='$feature_door_id'";
	if(!$query=$cxn->query($sql))
	{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
	}
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	return $result_array;
	
}
function session_door($the_session_id) {
	
	global $cxn;
		
	$sql="select door_id from cart where session_id='$the_session_id'";
	//echo $sql;
	$query=$cxn->query($sql);
	$row=$query->fetch_object();
	return $row->door_id;
}

function cart_link($the_session_id) {
	 
	 global $cxn;
	 
	 /*$sql="select cart.product_id, cart.sequence, doors.id 
	FROM
	cart 
	INNER JOIN
	doors ON
	cart.door_id=doors.feature_door_id
	WHERE
	cart.session_id='$the_session_id'
	ORDER BY 
	cart.sequence DESC LIMIT 1";*/
	
	$sql="select * from cart WHERE session_id='$the_session_id' AND product_id<>'393'AND product_id<>'392' ORDER BY cart.sequence DESC LIMIT 1";
	
	//echo $sql;
	
	if(!$query=$cxn->query($sql))
	{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
	}
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	return $result_array;
	
}

function subtotal_cart() {
	
	global $cxn;
	
	global $the_session_id;
	
	$residential_cost=0;
	$liftgate_cost=0;
	
	$sql="SELECT SUM(feature_cost) as total_feature, SUM(product_cost) as total_product , SUM(door_cost) as total_door FROM cart where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$result_array=array();
		while ($row=$query->fetch_array())
		{
			//this is your odd number of results
			$result_array[]=$row;
		}
		foreach($result_array as $cost)
	{
		$total_feature_cost=$cost['total_feature'];
		$total_product_cost=$cost['total_product'];
		$total_door_cost=$cost['total_door'];
	}
	
	//echo $total_product_cost;
	
	$sql_2="select  product_cost from cart where session_id='$the_session_id' AND product_id='392'";
	if(!$query_2=$cxn->query($sql_2))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query_2
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	$count_2=mysqli_num_rows($query_2);
	//echo $count_2;
	if($count_2>0)
	{
		$query_2=$cxn->query($sql_2);
		$row_2=$query_2->fetch_object();
		$residential_cost=$row_2->product_cost;
	}
	
	$sql_3="select  product_cost from cart where session_id='$the_session_id' AND product_id='393'";
	if(!$query_3=$cxn->query($sql_3))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query_3
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	$count_3=mysqli_num_rows($query_3);
	//echo $count_3;
	if($count_3>0)
	{
		$query_3=$cxn->query($sql_3);
		$row_3=$query_3->fetch_object();
		$liftgate_cost=$row_3->product_cost;
	}
	
	$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost-$residential_cost - $liftgate_cost;		

	return $total_thus_far;
	
}


function residential_check() {
	
	global $cxn;
	
	global $the_session_id;
	
	$sql="select id from cart where session_id='$the_session_id' and product_id='392'";
	if(!$query=$cxn->query($sql))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	$count=mysqli_num_rows($query);
	
	return $count;
}

function lift_check() {
	
	global $cxn;
	
	global $the_session_id;
	
	$sql="select id from cart where session_id='$the_session_id' and product_id='393'";
	if(!$query=$cxn->query($sql))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	$count=mysqli_num_rows($query);
	
	return $count;
}

function total_cart() {
	
	global $cxn;
	
	global $the_session_id;
	
	$sql="SELECT SUM(feature_cost) as total_feature, SUM(product_cost) as total_product , SUM(door_cost) as total_door FROM cart where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$result_array=array();
		while ($row=$query->fetch_array())
		{
			//this is your odd number of results
			$result_array[]=$row;
		}
		foreach($result_array as $cost)
	{
		$total_feature_cost=$cost['total_feature'];
		$total_product_cost=$cost['total_product'];
		$total_door_cost=$cost['total_door'];
	}
	
	//echo $total_product_cost;
	//you need to find out if there's any shipping costs that have been calculated
	
	$the_shipping_cost=0;
	
	 $sql_1="select id from fedex where session_id='$the_session_id'";
	 $query_1=$cxn->query($sql_1);
	$count_1=$query_1->num_rows;
	
	if($count_1>0)
	{
		//echo "here we come";
		$sql_2="select sum(shipping) as total_shipping from fedex where session_id='$the_session_id'";
		$query_2=$cxn->query($sql_2);
		$row_2=$query_2->fetch_array();
	
		$the_shipping_cost=$row_2['total_shipping'];
		//echo $the_shipping_cost;
	}
	//echo $the_shipping_cost;
	
	$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost+$the_shipping_cost;
	
	return $total_thus_far;
	
}

function check_shipping($the_session_id) {
	
	$the_shipping_cost=0;
	
	global $cxn;
	
	 $sql_1="select id from fedex where session_id='$the_session_id'";
	 $query_1=$cxn->query($sql_1);
	$count_1=$query_1->num_rows;
	
	if($count_1>0)
	{
		$sql="select sum(shipping) as total_shipping from fedex where session_id='$the_session_id'";
		$query=$cxn->query($sql);
		$row=$query->fetch_assoc();
	
		$the_shipping_cost=$row['total_shipping'];
	}
	
	return $the_shipping_cost;
}

$residential_row=0;
$lift_row=0;

//the first thing we're going to do is check to see if the shipping has been calculated and if not, we'll take care of that here

//here's all of your shipping functionality

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

function getCart($the_session_id, $c_zip) {
	$amount="";
//echo $the_session_id;	
global $cxn;

 $sql="select cart.product_id, cart.quantity, products.height, products.width, products.depth, products.weight from cart INNER JOIN products on cart.product_id=products.id where cart.session_id='$the_session_id' AND cart.product_cost>0 AND cart.product_id<>'392' AND cart.product_id<>'393'";
	 $query=$cxn->query($sql);
	while($row=$query->fetch_assoc())
	{
		// this part is retrieving the shipping cost
		
		$path_to_wsdl = "fedex/wsdl/RateService_v18.wsdl";

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

function current_shipping($id) {
	
	global $cxn;
	
	$sql="select price from products where id='$id'";
	$query=$cxn->query($sql);
	$row=$query->fetch_object();
	$the_price=$row->price;
	
	return $the_price;
	
}

function state_list() {
	
	global $cxn;
	
	$sql="select * from states order by state_name";
	$query=$cxn->query($sql);
	
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	
	return $result_array;
}

//end of shipping functionality

//this is your customer table functionality, checking to see if current customer is in database or simply retrieving their id

function check_customer($email) {

	global $cxn;
	
	$the_id=0;
	
	$sql="select id from customers where email='$email'";
	$query=$cxn->query($sql);
	$count=$query->num_rows;
	if($count>0)
	{
		//echo "hello";
		$row=$query->fetch_object();
		$the_id=$row->id;
	}
	else
	{
		
	$first_name=$cxn->real_escape_string(trim($_POST['first_name']));
	$last_name=$cxn->real_escape_string(trim($_POST['last_name']));
	$street_address_one=$cxn->real_escape_string(trim($_POST['street_address_one']));
	$street_address_two=$cxn->real_escape_string(trim($_POST['street_address_two']));
	$city=$cxn->real_escape_string(trim($_POST['city']));
	$state=$cxn->real_escape_string(trim($_POST['state']));
	$zip=$cxn->real_escape_string(trim($_POST['zip']));
	$cell_phone=$cxn->real_escape_string(trim($_POST['cell_phone']));
	$billing_first_name=$cxn->real_escape_string(trim($_POST['billing_first_name']));
	$billing_last_name=$cxn->real_escape_string(trim($_POST['billing_last_name']));
	$billing_street_address_one=$cxn->real_escape_string(trim($_POST['billing_street_address_one']));
	$billing_street_address_two=$cxn->real_escape_string(trim($_POST['billing_street_address_two']));
	$billing_city=$cxn->real_escape_string(trim($_POST['billing_city']));
	$billing_state=$cxn->real_escape_string(trim($_POST['billing_state']));
	$billing_zip=$cxn->real_escape_string(trim($_POST['billing_zip']));
	$email=$cxn->real_escape_string(trim($_POST['email_address']));
	$password=$cxn->real_escape_string(trim($_POST['password']));
	
	$sql="INSERT into customers (first_name, last_name, street_one, street_two, city, state, zip, shipping_first_name, shipping_last_name, shipping_address_one, shipping_address_two, shipping_city, shipping_state, shipping_zip, cell_phone, email, password) VALUES ('$billing_first_name', '$billing_last_name', '$billing_street_address_one', '$billing_street_address_two', '$billing_city', '$billing_state', '$billing_zip', '$first_name', '$last_name', '$street_address_one', '$street_address_two', '$city', '$state', '$zip', '$cell_phone', '$email', '$password')";
		if(!$query=$cxn->query($sql))
		{
			$err='query_failure:'
			.'ERRNO: '
			.$mysqli->errno
			.'ERROR: '
			.$mysqli->error
			.PHP_EOL
			.' QUERY: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
	
	$the_id = $cxn->insert_id;
		
	}
	
	return $the_id;
}

//end of customer functionality

//start your transfer from cart to order_items and order_admin functionality
//order admin has your customer id as well as the "paid" and "shipping" fields. I've also got the shipping charge in there as well

function transfer_cart($customer_id, $the_session_id) {
	//echo "OK";
	global $cxn;
	
	$sql="select * from cart where session_id='$the_session_id' order by sequence";
	if(!$query=$cxn->query($sql))
	{
		$err='query_failure:'
		.'ERRNO: '
		.$cxn->errno
		.'ERROR: '
		.$cxn->error
		.PHP_EOL
		.' QUERY: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	while($row=$query->fetch_assoc())
	{
		
		//be sure that you're not adding something that's already in the order table
		
		$sql_2="select id from order_items where session_id='$the_session_id' and product_id='$row[id]'";
		//echo $sql_2;
		$query_2=$cxn->query($sql_2);
		$count_2=$query_2->num_rows;
		
		if($count_2==0)
		{
			$sql_1="INSERT into order_items (session_id, product_id, product_cost, option_id, feature_id, feature_cost, door_id, quantity, sequence, customer_id) VALUES (
			'$the_session_id',
			'$row[product_id]', 
			'$row[product_cost]', 
			'$row[option_id]', 
			'$row[feature_id]', 
			'$row[feature_cost]', 
			'$row[door_id]', 
			'$row[quantity]',
			'$row[sequence]', 
			'$customer_id')";
			//echo $sql_1;
			if(!$query_1=$cxn->query($sql_1))
			{
				$err_1='query_failure:'
				.'ERRNO: '
				.$cxn->errno
				.'ERROR: '
				.$cxn->error
				.PHP_EOL
				.' QUERY: '
				.$query_1
				.PHP_EOL;
				trigger_error($err_1, E_USER_WARNING);
			}
		}
	}
}

function transfer_order_admin($customer_id, $the_session_id, $get_shipping_total) {
	
	global $cxn;
	
	$today=date("Y-m-d");
	
	$sql="select id from order_admin where session_id='$the_session_id' and customer_id='$customer_id'";
	if(!$query=$cxn->query($sql))
	{
		$err='query_failure:'
		.'ERRNO: '
		.$cxn->errno
		.'ERROR: '
		.$cxn->error
		.PHP_EOL
		.' QUERY: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	
	$count=$query->num_rows;
	
	if(!$count>0)
	{
		
		$sql_1="INSERT into order_admin (session_id, shipping, customer_id, order_date) VALUES ('$the_session_id', '$get_shipping_total', '$customer_id', '$today')";
		if(!$query_1=$cxn->query($sql_1))
		{
			$err_1 = 'your attachment check query didn\'t fly because:.'
			.'ERRNO '
			.$mysqli->errno
			.'ERROR: '
			.$mysqli->error
			.' and the nasty sql statement responsible for all this is: '
			.$sql_1;
			PHP_EOL;
			trigger_error($err_1, E_USER_WARNING);
		}
	}
}

//start by checking to see if user has calculated their shipping or not. If not, do it here.

$ship_check=check_shipping($the_session_id);

$get_shipping_total="";

if(!$ship_check>0)
{
	$c_zip=$_POST['zip'];
	$clear=clearCart($the_session_id);
	$hit_me=getCart($the_session_id, $c_zip);
	$get_shipping_total=totalShipping($the_session_id);
}
else
{
	$get_shipping_total=$ship_check;
}

// echo $get_shipping_total;

//now you're going to either insert this customer into the customer database, or you're simply going to retrieve the id from the database

$welcome_customer=check_customer($_POST['email_address']); //check_customer either adds a new customer or returns the id of a customer that's already in the database

//echo $welcome_customer;

//now you're going to transfer what's in the cart to the order_admin and the order_items table

$load_orders=transfer_cart($welcome_customer, $the_session_id);

//finally, add the customer id as well as the shipping and paid column values to the order_admin table

$load_admin=transfer_order_admin($welcome_customer, $the_session_id, $get_shipping_total);


?>

			<span class="satellite_title">Checkout</span><br><br>
			Hello, <?php echo $_POST['first_name'];?>!
			<br><br>Take a moment to review your order...all you need to do now is fill in your payment information below, click on "Pay for my Order," and you'll be emailed a receipt. 
			<br><br>
			Please call 615-828-8377 with any questions or Email: <a href="mailto:orders@onlinecabinetsdirect.com" style="color:#000000;">orders@onlinecabinetsdirect.com</a>.
			<br><br>
			Thanks!
			<br><br>
			<?php
			$the_link=cart_link($the_session_id);
			foreach($the_link as $link)
			{
				$the_product_id=$link['product_id'];
				$the_id=$link['door_id'];
			}
			?>
			To return to your Shopping Cart, click <a href="door_shop.php?door_id=<?php echo $the_id;?>&product_id=<?php echo $the_product_id;?>">here</a>.<br><br><br>
				<div style="width:80%; padding:5px; border:1px solid #cccccc; border-radius:10px; margin:auto;">
					<table style="width:85%; margin:auto; padding:5px; border-collapse:separate; border-spacing:2px; margin-top:10px;" border="0">
					<?php
					$cart_count=1; //this is for the sake of aesthetics
					$check_cart=current_cart();
					foreach($check_cart as $till)
					{	
					//if your feature id is = 0, then you're looking at your product
					?>
						<tr>
							<?php
							if($cart_count>1)
							{
							?>
							<td style="background-color:#000000; color:#ffffff;" colspan="3">&nbsp;
							<?php
							}
							else
							{
							?>
							<td style="background-color:#000000; color:#ffffff; border-top-left-radius:5px; border-top-right-radius:5px;" colspan="3">&nbsp;
							<?php
							}
							?>
							<?php echo stripslashes($till['product_category']);?>
							</td>
						</tr>
						<tr>
							<td style="background-color:#cccccc; color:#000000;" colspan="3">&nbsp;
							<?php echo stripslashes($till['product_name']);?>
							</td>
						</tr>
						<tr>
							<td style="width:400px;">&nbsp;&nbsp;&nbsp;<b>Qty</b></td>
							<td style="width:100px;">&nbsp;<b>Cost</b></td>
							<td style="width:100px; text-align:right;"><b>Total Price</b></td>
						</tr>
						<?php
						//your product cost is going to be whatever is under the "product_cost" column in the cart table divided by the quantity. That will accommodate any "special" or "sale price" that might be in place
						if($till['product_cost']>0.00)
						{
							$the_actual_cost = $till['product_cost']/$till['quantity'];
						}
						else
						{
							$the_actual_cost=0.00;
						}
						?>
							<!--you changed your session_id here-->
							<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $till['quantity']; ?></td>
							<td>$<?php echo number_format($the_actual_cost, 2);?></td>
							<td style="text-align:right;">$<?php echo number_format($till['product_cost'],2);?>&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;<br></td>
						</tr>
						<?php
						$feature_roster=feature_cart($till['product_id'], $till['door_id']); 
						if($feature_roster)
						{
						?>
						<tr>
							<td colspan="3"><b><u>Features...</b></u> (<a href="#" class="show_hide">show / hide</a>)</td>
						</tr>
						<tr class="current_cart_features" style="display:none;">
							<td colspan="3">
								<table>
								<?php 
									$cabinet_color=cart_door($till['product_id'], $till['door_id']);
									foreach($cabinet_color as $color)
									{
									?>
									<tr>
										<td colspan="3"><b>Cabinet Color</b></td>
									</tr>
									<tr>
										<td colspan="2"><u><?php echo stripslashes($color['featurename']);?></u></td>
										<td>$<?php echo number_format($color['featureprice'],2);?></td>
									</tr>
									<?php
									}
									foreach($feature_roster as $cadillac)
									{
									?>
									<tr>
										<td colspan="3"><b><?php echo stripslashes($cadillac['featurecaption']);?></b></td>
									</tr>
									<tr>
										<td colspan="2"><?php echo stripslashes($cadillac['featurename']);?></td>
										<td>$<?php echo number_format($cadillac['feature_cost'],2);?></td>
									</tr>
									<?php		
									}
								?>
								</table>
							</td>
						</tr>
						<?php
						}
						?>
					<?php
					$cart_count=$cart_count+1;
					}
					?>
					<tr>
						<td colspan="3"><hr></td>
					</tr>
					<tr>
						<td colspan="3">
							<!--<form action="checkout_total_submit.php" method="Post">-->
							<table class="subtotal" border="0">
								<tr>
									<td colspan="2"><b>Sub Total:</b></td>
									<td style="text-align:right; min-width:200px;">$<?php $sub_total=number_format(subtotal_cart($the_session_id), 2); echo $sub_total;?></td>
								</tr>
								<?php
								$the_total=total_cart();
								if($the_total>=25)
								{
								?>
									<tr>
										<td colspan="2"><b>Discount:</b></td>
										<td style="text-align:right;">- $<?php 
										$the_discount=floor($the_total *.05);
										echo number_format($the_discount,2);
										?>
										</td>
									</tr>
								<?php
								}
								?>
								<?php
								$the_res_count=residential_check();
								if($the_res_count>0)
								{
								?>
								<tr>
									<td colspan="2"><b>Residential Delivery</b>&nbsp;</td>
									<td style="text-align:right;">$<?php $res_price=current_shipping("392"); echo number_format($res_price, 2);?></td>
								</tr>
								<?php
								}
								else
								{
									$res_price=0;
								}
								?>
								<?php 
								$the_lift_count=lift_check();
								if($the_lift_count>0)
								{
								?>
								<tr>
									<td colspan="2"><b>Liftgate Charge</b>&nbsp;</td>
									<td style="text-align:right;">$<?php $lift_price=current_shipping("393"); echo number_format($lift_price, 2);?></td>
								</tr>
								<?php
								}
								else
								{
									$lift_price=0;
								}
								?>
								<?php
								$shipping_charge=totalShipping($the_session_id);
								if($shipping_charge>0)
								{
								?>
								<tr>
									<td colspan="2"><b>Shipping:</b></td>
									<td style="text-align:right; min-width:200px;">$<?php echo number_format($shipping_charge, 2); ?></td>
								</tr>
								<?php
								}
								else
								{
								?>
								<tr>
									<td colspan="2"><b>Shipping:</b></td>
									<td style="text-align:right; min-width:200px;">yet to be calculated...</td>
								</tr>
								<?php
								}
								?>
								<tr>
									<td colspan="2"><b>Grand Total:</b></td>
									<td style="text-align:right;">$<?php echo number_format($the_total-$the_discount,2);?></td>
								</tr>
								<tr>
									<td colspan="3"><hr></td>
								</tr>
								<tr>
									<td colspan="3">
										<table style="width:100%;" border="0"><form action="checkout_post.php" method="Post">
											<tr>
												<td colspan="2"><b>shipping information</b></td>
											</tr>
											<tr>
												<td>first name</td>
												<td><input type="text" size="55" name="first_name" id="fname" value="<?php echo $_POST['first_name'];?>"></td>
											</tr>
											<tr>
												<td>last name</td>
												<td><input type="text" size="55" name="last_name" id="lname" value="<?php echo $_POST['last_name'];?>"></td>
											</tr>
											<tr>
												<td>street address 1</td>
												<td><input type="text" size="55" name="street_address_one" id="street1" value="<?php echo $_POST['street_address_one'];?>"></td>
											</tr>
											<tr>
												<td>street address 2</td>
												<td><input type="text" size="55" name="street_address_two" id="street2" value="<?php echo $_POST['street_address_two'];?>"></td>
											</tr>
											<tr>
												<td>city</td>
												<td><input type="text" size="55" name="city" id="city" value="<?php echo $_POST['city'];?>"></td>
											</tr>
											<tr>
												<td>state</td>
												<td><select name="state" style="width:379px;" id="state">
												<option selected><?php echo $_POST['state'];?></option>
												<?php 
												$select_state=state_list();
												foreach($select_state as $state)
												{
												?>
													<option><?php echo $state['abbreviation'];?></option>
												<?php
												}
												?>
												</select>											
												</td>
											</tr>
											<tr>
												<td>zip code</td>
												<td><input type="text" size="55" name="zip" id="zip" value="<?php echo $_POST['zip'];?>"></td>
											</tr>
												<tr>
												<td>cell phone</td>
												<td><input type="text" size="55" name="cell_phone" value="<?php echo $_POST['cell_phone'];?>"></td>
											</tr>
											<tr>
												<td colspan="2"><b>billing information</b></td>
											</tr>
											<tr>
												<td>first name</td>
												<td><input type="text" size="55" name="billing_first_name" id="bill_fname" value="<?php echo $_POST['billing_first_name'];?>"></td>
											</tr>
											<tr>
												<td>last name</td>
												<td><input type="text" size="55" name="billing_last_name" id="bill_lname" value="<?php echo $_POST['billing_last_name'];?>"></td>
											</tr>
											<tr>
												<td>street address 1</td>
												<td><input type="text" size="55" name="billing_street_address_one" id="bill_street1" value="<?php echo $_POST['billing_street_address_one'];?>"></td>
											</tr>
											<tr>
												<td>street address 2</td>
												<td><input type="text" size="55" name="billing_street_address_two" id="bill_street2" value="<?php echo $_POST['billing_street_address_two'];?>"></td>
											</tr>
											<tr>
												<td>city</td>
												<td><input type="text" size="55" name="billing_city" id="bill_city" value="<?php echo $_POST['billing_city'];?>"></td>
											</tr>
											<tr>
												<td>state</td>
												<td><select name="billing_state" style="width:379px;" id="bill_state">
												<option selected><?php echo $_POST['billing_state'];?></option>
												<?php 
												$select_state_billing=state_list();
												foreach($select_state_billing as $state_billing)
												{
												?>
													<option><?php echo $state_billing['abbreviation'];?></option>
												<?php
												}
												?>
												</select>											
												</td>
											</tr>
											<tr>
												<td>zip code</td>
												<td><input type="text" size="55" name="billing_zip" id="bill_zip" value="<?php echo $_POST['billing_zip'];?>"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="3" style="text-align:center; vertical-align:middle;"><br><br><input type="hidden" name="session_id" value="<?php echo $the_session_id;?>"><input type="hidden" name="residential_price" value="<?php echo $res_price;?>"><input type="hidden" name="liftgate_price" value="<?php echo $lift_price;?>"><input type="hidden" name="session_id" value="<?php echo $the_session_id;?>"><input type="image" src="images/proceed_checkout.jpg" style="width:185px; margin-top:-36px;"></td>
								</tr>
							</table></form>
						
						
						
						</td><!--this is where you're putting your liftgate and residential options-->
					</tr>
				</table>
					
			<br>
			<div style="width:85%; height:auto; padding:10px; margin:auto;">
			<img src="images/credit_cards.jpg" style="float:right; width:150px;"> <li>Enter your shipping postal code to calculate shipping costs</li>
			 <li><b>Payment options available</b>: Credit Card, PayPal, Certified Check or Wire Transfer</li>
			<li><b>Free Shipping Promotion</b>: Free shipping is available on order amounts over $2,500.00</li>
			<li><b>5% Discount Promotion</b>: Order amounts ranging from $25.00 To $2,499.00 will receive a 5% discount which typically covers the majority of shipping costs</li>
			<li><b>Residential Delivery</b>: Residential Delivery is available on all shipments for a $99.00 fee. This fee is in addition to standard shipping rates. Residential delivery can be added to your order from our Shipping Extras Page</li></ul>
			</div><br><br>
			</div><br><br><!-- this ends your table frame-->
	</div><!--this ends your main content frame-->
</div><!-- this ends your "filler" div-->
	<script>
	$(function(){
		
		$('.show_hide').click(function(e){
		e.preventDefault();
		$(this).parents('tr').next(".current_cart_features").toggle("slow");
		});
		
		 $('#bill_same').click(function(){
 	
		   var _chk = $('#bill_same').is(':checked');
		 	  if ( _chk == true ) { 

			  //set inputs
				$('#bill_fname').val( $('#fname').val() );
				$('#bill_lname').val( $('#lname').val() );
				$('#bill_street1').val( $('#street1').val() );
				$('#bill_street2').val( $('#street2').val() );
				$('#bill_city').val( $('#city').val() );
				$('#bill_state').val( $('#state').val() );
				$('#bill_zip').val( $('#zip').val() );
			  }else{
				  //Clear inputs
				$('#bill_fname').val(' ');
				$('#bill_lname').val(' ');
				$('#bill_street1').val(' ');
				$('#bill_street2').val(' ');
				$('#bill_city').val(' ');
				$('#bill_state').val(' ');
				$('#bill_zip').val(' ');
			 }
		});
	});
	
	$("#shippingForm").submit(function(e) {
	cache:false,
	e.preventDefault();
	$('#shipping_result').html("calculating your shipping...");
	var devTest = $( "#shippingForm").serialize(); 
	
	//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
	
	$.post( "shipping_form.php", devTest) 
		.done(function(Drumstick) { 
			if (Drumstick.charAt(0) == "E") 
			{
				alert("ERROR - The submarket has been entered before");
			}
			else 
			{	
				//alert(Drumstick);
				$('#shipping_result').html(Drumstick);    
			}
		});
	});
	</script>
	
	</body>
</html>
<?php include("footer.php"); ?>

