<?php session_start();

$pageDetails = [
    "PageID" => "Login"
];

include dirname(__FILE__) . '/../Classes/Core/init.php';

$domainString = "http://192.168.1.34";
$jumpwayAppID = 72;
$JumpWayAppPublic = "6S06fWaSgCS759F0w7298524qWbQC2";
$JumpWayAppSecret = "VnQBt5dDEu4du971ZE0Nl5z92Z4ewoc7L8I";

$encypted = [];

$encypted["domainString"] = $_GeniSys->_helpers->oEncrypt($domainString);
$encypted["jumpwayAppID"] = $_GeniSys->_helpers->oEncrypt($jumpwayAppID);
$encypted["JumpWayAppPublic"] = $_GeniSys->_helpers->oEncrypt($JumpWayAppPublic);
$encypted["JumpWayAppSecret"] = $_GeniSys->_helpers->oEncrypt($JumpWayAppSecret);

echo "<pre>";
print_r($encypted);
echo "</pre>";

?>