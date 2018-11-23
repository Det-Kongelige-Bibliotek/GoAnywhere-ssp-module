<?php

class sspmod_GoAnywhere_Auth_Process_GoAnywhere extends SimpleSAML_Auth_ProcessingFilter 
{
	private $ga_user_url = 'https://ga-mft-test-01.kb.dk:8001/goanywhere/rest/gacmd/v1/webusers';
	private $ga_admin_user = 'dgj';
	private $ga_admin_user_pw = 'JollyJ3aar';
	
	private $user_id_attribute = 'schacPersonalUniqueID';


	function __construct($config, $reserved) {
	
	}
	
	public function process(&$state) {	
		$attributes = $state['Attributes'];
		$id = $attributes[$this->user_id_attribute][0];
		if ($this->checkGAUserExist($id)) {
			return;
		}
		$stateId = SimpleSAML_Auth_State::saveState($state, 'GoAnywhere:createuser');
        	$url = SimpleSAML\Module::getModuleURL('GoAnywhere/createuser.php');
        	\SimpleSAML\Utils\HTTP::redirectTrustedURL($url, array('StateId' => $stateId));

	}

	public function checkGAUserExist($userId) {
                $curl = curl_init();
                echo $this->ga_user_url.'/'.$userId."\n";
                curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_URL => $this->ga_user_url.'/'.$userId,
                        CURLOPT_USERPWD => $this->ga_admin_user . ":" . $this->ga_admin_user_pw,
                        CURLOPT_HEADER => true,
                        CURLOPT_NOBODY => true,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false
                ));
                
                $resp = curl_exec($curl);
                if (curl_errno($curl)) {
                        echo 'Curl error: ' . curl_error($curl);
			return false;
                }
                $info = curl_getinfo($curl);
                return $info['http_code'] == 200;
        }


}
?>
