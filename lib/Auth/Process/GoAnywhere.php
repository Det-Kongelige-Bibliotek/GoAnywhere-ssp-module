<?php

class sspmod_GoAnywhere_Auth_Process_GoAnywhere extends SimpleSAML_Auth_ProcessingFilter 
{
	private $ga_user_url = null;
	private $ga_admin_user = null;
	private $ga_admin_user_pw = null;
	private $ga_webuser_template = null;
	private $user_id_attribute = 'urn:oid:1.3.6.1.4.1.5923.1.1.1.6';
	private $ask_user = true;


	function __construct($config, $reserved) {
		if (!array_key_exists('ga_user_url',$config)) {
			throw new ConfigError('Missing GoAnywhere parameter ga_user_url');
		}
		$this->ga_user_url = $config['ga_user_url'];
		if (!array_key_exists('ga_admin_user',$config)) {
                        throw new ConfigError('Missing GoAnywhere parameter ga_admin_user');
                }
		$this->ga_admin_user = $config['ga_admin_user'];
		if (!array_key_exists('ga_admin_user_pw',$config)) {
                        throw new ConfigError('Missing GoAnywhere parameter ga_admin_user_pw');
                }
		$this->ga_admin_user_pw = $config['ga_admin_user_pw'];
		if (!array_key_exists('ga_webuser_template',$config)) {
                        throw new ConfigError('Missing GoAnywhere parameter ga_admin_user_pw');
                }
		$this->ga_webuser_template = $config['ga_webuser_template'];

		if (array_key_exists('ask_user',$config)) {
			$this->ask_user = $config['ask_user'];
		}
	}
	
	public function process(&$state) {
		$attributes = $state['Attributes'];
		$id = $attributes[$this->user_id_attribute][0];
		if ($this->checkGAUserExist($id)) {
			return;
		}
		$state['GoAnywhere:user_url'] = $this->ga_user_url;
                $state['GoAnywhere:ga_admin_user'] = $this->ga_admin_user;
                $state['GoAnywhere:ga_admin_user_pw'] = $this->ga_admin_user_pw;
		$state['GoAnywhere:ask_user'] = $this->ask_user;
		

		if (array_key_exists('GoAnywhere:ga_webuser_template',$state['saml:sp:State']) 
			&& ($state['saml:sp:State']['GoAnywhere:ga_webuser_template'] !== null)) {
			$state['GoAnywhere:ga_webuser_template'] = $state['saml:sp:State']['GoAnywhere:ga_webuser_template'];
		} else {
			$state['GoAnywhere:ga_webuser_template'] = $this->ga_webuser_template;
		}
		$stateId = SimpleSAML_Auth_State::saveState($state, 'GoAnywhere:createuser');
        	$url = SimpleSAML\Module::getModuleURL('GoAnywhere/createuser.php');
        	\SimpleSAML\Utils\HTTP::redirectTrustedURL($url, array('StateId' => $stateId));	

	}

	public function checkGAUserExist($userId) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_URL => $this->ga_user_url.'/'.preg_replace('/[\/\\\:\*\?\"\<\>|]/', '', $userId),
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
