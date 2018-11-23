<?php

if (!array_key_exists('stateId', $_REQUEST)) {
    throw new SimpleSAML_Error_BadRequest(
        'Missing required StateId query parameter.'
    );
}

if (!array_key_exists('gn', $_REQUEST)
	|| !array_key_exists('sn', $_REQUEST)
	|| !array_key_exists('mail', $_REQUEST)) {
    throw new SimpleSAML_Error_BadRequest(
        'Missing required parameter.'
    );
}

$user_id_attribute = 'schacPersonalUniqueID';

$stateId = $_REQUEST['stateId'];
$gn = $_REQUEST['gn'];
$sn = $_REQUEST['sn'];
$mail = $_REQUEST['mail'];

$state = SimpleSAML_Auth_State::loadState($stateId, 'GoAnywhere:createuser');

$ga_user_url = 'https://ga-mft-test-01.kb.dk:8001/goanywhere/rest/gacmd/v1/webusers';
$ga_admin_user = 'dgj';
$ga_admin_user_pw = 'JollyJ3aar';

$userId = $state['Attributes'][$user_id_attribute][0];

$userJSON = '{"addParameters" : { "userName":"'.$userId.'",'.
                                '"template" : "testTemplate",'.
                                '"firstName" : "'.$gn.'",'.
                                '"lastName" : "'.$sn.'",'.
                                '"email" : "'.$mail.'"}}';
                

$curl = curl_init();
curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_URL => $ga_user_url,
                        CURLOPT_USERPWD => $ga_admin_user . ":" . $ga_admin_user_pw,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                        CURLOPT_CUSTOMREQUEST => 'POST',                                                                     
                        CURLOPT_POSTFIELDS => $userJSON,                                                                  
                        CURLOPT_RETURNTRANSFER => true,                                                                      
                        CURLOPT_HTTPHEADER => array(                                                                          
                                'Content-Type: application/json',                                                                                
                                'Content-Length: ' . strlen($userJSON))  
));
                
$resp = curl_exec($curl);
if (curl_errno($curl)) {
	//log error
	throw new SimpleSAML_Error_BadRequest(
        	'Missing required StateId query parameter.'
    );
}

$info = curl_getinfo($curl);
if ($info['http_code'] !== 200) {
	//log error
        throw new SimpleSAML_Error_BadRequest(
                'Missing required StateId query parameter.'
    );

}


SimpleSAML_Auth_ProcessingChain::resumeProcessing($state);

