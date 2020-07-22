<?php session_start();

$pageDetails = [
    "PageID" => "Login"
];

include dirname(__FILE__) . '/../Classes/Core/init.php';

$domainString = "";
$jumpwayAppID = 0;
$JumpWayAppPublic = "";
$JumpWayAppSecret = "";

$encypted = [];

$encypted["domainString"] = $_GeniSys->_helpers->oEncrypt($domainString);
$encypted["jumpwayAppID"] = $_GeniSys->_helpers->oEncrypt($jumpwayAppID);
$encypted["JumpWayAppPublic"] = $_GeniSys->_helpers->oEncrypt($JumpWayAppPublic);
$encypted["JumpWayAppSecret"] = $_GeniSys->_helpers->oEncrypt($JumpWayAppSecret);

echo "<pre>";
print_r($encypted);
echo "</pre>";

?>