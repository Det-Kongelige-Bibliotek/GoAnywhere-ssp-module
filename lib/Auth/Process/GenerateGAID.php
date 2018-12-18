<?php
class sspmod_GoAnywhere_Auth_Process_GenerateGAID extends  SimpleSAML_Auth_ProcessingFilter 
{

	private $user_id_attribute = 'urn:oid:1.3.6.1.4.1.5923.1.1.1.6';

        function __construct($config, $reserved) {
        
        }
        
        public function process(&$state) {      
                $attributes = $state['Attributes'];
		if (array_key_exists($user_id_attributes,$attributes) && $attributes[$user_id_attribute] != null
			&& is_array($attributes[$user_id_attribute]) && count($attributes[$user_id_attribute]) > 0) {
			$id = $attributes[$this->user_id_attribute][0];
                	$state['Attributes']['GAID'] = Array(preg_replace('/[\/\\\:\*\?\"\<\>|]/', '', $id));
		}
        }
}
