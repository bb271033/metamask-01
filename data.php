<?php
require_once 'HTTP/Request2.php';
//$url = 'https://opend.data.go.th/get-ckan/datastore_search?resource_id=93f74e67-6f76-4b25-8f5d-b485083100b6&limit=5';
$url = "https://covid19.th-stat.com/api/open/cases";
$request = new HTTP_Request2();
$request->setUrl($url);
$request->setMethod(HTTP_Request2::METHOD_GET);
$request->setConfig(array(
	'follow_redirects' => TRUE
));
$request->setHeader(array(
	'api-key' => '',
));
try {
	$response = $request->send();
	if($response->getStatus() == 200) {
		echo $response->getBody();
	}
	else {
		echo 'Unexpected HTTP status: '.$response->getStatus().' '.$response->getReasonPhrase();
	}
}
catch(HTTP_Request2_Exception $e) {
	echo 'Error: '.$e->getMessage();
}