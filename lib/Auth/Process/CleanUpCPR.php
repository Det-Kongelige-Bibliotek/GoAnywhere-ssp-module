<?php
class sspmod_GoAnywhere_Auth_Process_CleanUpCPR extends SimpleSAML_Auth_ProcessingFilter 
{

	private $user_id_attribute = 'schacPersonalUniqueID';

        function __construct($config, $reserved) {
        
        }
        
        public function process(&$state) {      
                $attributes = $state['Attributes'];
                $id = $attributes[$this->user_id_attribute][0];
                $state['Attributes']['CPR'][0] = substr($id, strpos($id, 'CPR:') + 4);

        }
}
