<?php

$as = new \SimpleSAML\Auth\Simple(getAuthSourceId());

$param = Array();
if (array_key_exists('template',$_GET) && $_GET['template'] !== null) {
	$param['GoAnywhere:ga_webuser_template']  = $_GET['template'];
}

if (!$as->isAuthenticated()) {
	$as->login($param);
}

$returnUrl = null;
if (array_key_exists('ga_url',$_GET) && $_GET['ga_url'] !== null) {
	$returnUrl = $_GET['ga_url']; 
}

if ($returnUrl !== null) {
	\SimpleSAML\Utils\HTTP::redirectTrustedURL($returnUrl, array());
}



function getAuthSourceId() {
	if ($_GET['env'] === 'stage') {
		return 'default-sp-stage';
	}
	if ($_GET['env'] === 'prod') {
                return 'default-sp-prod';
        }
	return 'default-sp';	
}

?>
