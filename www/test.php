<?php
$globalConfig = SimpleSAML_Configuration::getInstance();

$t = new SimpleSAML_XHTML_Template($globalConfig, 'GoAnywhere:createuser.php');
$t->show();
?>

