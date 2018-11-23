<?php
$globalConfig = SimpleSAML_Configuration::getInstance();


if (!array_key_exists('StateId', $_REQUEST)) {
    throw new SimpleSAML_Error_BadRequest(
        'Missing required StateId query parameter.'
    );
}

$stateId = $_REQUEST['StateId'];

$state = SimpleSAML_Auth_State::loadState($stateId, 'GoAnywhere:createuser');
$attributes = $state['Attributes'];
                
$gn = '';
if (array_key_exists('gn',$attributes) && count($attributes['gn'])>0) {
	$gn = $attributes['gn'][0];
}

$sn = '';
if (array_key_exists('sn',$attributes) && count($attributes['sn'])>0) {
	$sn = $attributes['sn'][0];
}   

$mail = '';
if (array_key_exists('mail',$attributes) && count($attributes['mail'])>0) {
	$mail = $attributes['mail'][0];
}

$t = new SimpleSAML_XHTML_Template($globalConfig, 'GoAnywhere:createuser.php');
$t->data['gn'] = $gn;
$t->data['sn'] = $sn;
$t->data['mail'] = $mail;
$t->data['stateId'] = $stateId;
$t->data['yesTarget'] = SimpleSAML\Module::getModuleURL('GoAnywhere/createuserok.php');
$t->data['noTarget'] = SimpleSAML\Module::getModuleURL('GoAnywhere/createuserno.php');


$t->show();

