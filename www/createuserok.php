<?php

function cleanUpUserId($userId) {
        return preg_replace('/[\/\\\:\*\?\"\<\>|]/', '', $userId);
}


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

$user_id_attribute = 'GAID';

$stateId = $_REQUEST['stateId'];
$gn = $_REQUEST['gn'];
$sn = $_REQUEST['sn'];
$mail = $_REQUEST['mail'];

$state = SimpleSAML_Auth_State::loadState($stateId, 'GoAnywhere:createuser');

$ga_user_url = $state['GoAnywhere:user_url'];
$ga_admin_user = $state['GoAnywhere:ga_admin_user'];
$ga_admin_user_pw = $state['GoAnywhere:ga_admin_user_pw'];
$template = $state['GoAnywhere:ga_webuser_template'];
$userId = cleanUpUserId($state['Attributes'][$user_id_attribute][0]);

$userJSON = '{"addParameters" : { "userName":"'.$userId.'",'.
                                '"template" : "'.$template.'",'.
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
	SimpleSAML\Logger::error('Error creating user in GoAnywhere resp:'.var_export($resp,true).' userinfo:'.$userJSON);
	throw new SimpleSAML_Error_BadRequest(
        	'Der opstod et problem med at oprette ny bruger i upload portalen. Det kan skyldes at email allerede er registreret');
}

$info = curl_getinfo($curl);
if ($info['http_code'] !== 201) {
	SimpleSAML\Logger::error('Error creating user in GoAnywhere resp:'.var_export($resp,true).' info:'.var_export($info,true).' userinfo:'.$userJSON);
        throw new SimpleSAML_Error_BadRequest(
                'Der opstod et problem med at oprette ny bruger i upload portalen. Det kan skyldes at email allerede er registreret');

}
SimpleSAML_Auth_ProcessingChain::resumeProcessing($state);
