<?php
$globalConfig = SimpleSAML_Configuration::getInstance();
$t = new SimpleSAML_XHTML_Template($globalConfig, 'GoAnywhere:error.php');
$t->show();
?>

