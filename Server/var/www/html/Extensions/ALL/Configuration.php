<?php session_start();

$pageDetails = [
    "PageID" => "Settings"
];

include dirname(__FILE__) . '/../../../Classes/Core/init.php';

include dirname(__FILE__) . '/../../iotJumpWay/Classes/core.php';
include dirname(__FILE__) . '/../../iotJumpWay/Classes/devices.php';
include dirname(__FILE__) . '/../../iotJumpWay/Classes/applications.php';

include dirname(__FILE__) . '/../../Extensions/ALL/Classes/Core.php';

include dirname(__FILE__) . '/../../Server/Classes/core.php';
include dirname(__FILE__) . '/../../People/Classes/core.php';

include dirname(__FILE__) . '/../../GeniSysAI/Language/Classes/core.php';

$_GeniSysAiUsers->checkSession();
$device  = $_GeniSys->_confs['amlID'] ? $_iotJumpWayDevices->getDevice($_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['amlID'])) : null;
$devices = $_iotJumpWayDevices->getDeviceList();

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META name="robots" content="noindex, nofollow">

        <!-- 
          /*********************************************************
          ** @project GeniSys AI Location UI
          ** @author  Adam Milton-Barker <www.adammiltonbarker.com>
          **********************************************************/	
        -->

        <title><?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["meta_title"]); ?></title>
        <meta name="description" content="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["meta_description"]); ?>">
        <meta name="author" content="Adam Milton-Barker">

        <link type="text/css" rel="stylesheet" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Media/CSS/GeniSys.css">
        <link type="text/css" rel="stylesheet" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/vendor/bootstrap/css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/vendor/metisMenu/metisMenu.min.css">
        <link type="text/css" rel="stylesheet" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/CSS/sb-admin-2.css">
        <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link type="image/x-icon" rel="icon" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/Images/Site/favicon.png" />
        <link type="image/x-icon" rel="shortcut icon" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/Images/Site/favicon.png" />
        <link type="image/x-icon" rel="apple-touch-icon" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/Images/Site/favicon.png" />

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
    
        <div id="wrapper">

            <?php include dirname(__FILE__) . '/../../Includes/nav.php'; ?>

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">AML & ALL AI RESEARCH PROJECT</h1>
                        <div class="col-lg-12"><?php include dirname(__FILE__) . '/../../Server/Includes/top.php'; ?></div>
                    </div>
                </div>
                
                <div class="row">

                    <div class="col-lg-8">

                        <div class="panel panel-default">

                            <div class="panel-heading">

                                <i class="fa fa-cogs fa-fw"></i> ACUTE LYMPHOBLASTIC LEUKEMIA DETECTION SYSTEM 2019 CONFIGURATION

                                <div class="pull-right">

                                    <div class="btn-group">

                                    </div>

                                </div>

                            </div>
                            
                            <div class="panel-body">

                                <?php 
                                    if($_GeniSys->_confs["amlID"]):
                                ?>

                                    <form role="form" id="formAML">
                                        
                                        <div class="form-group">

                                            <label>Choose iotJumpWay Device</label>
                                            <select id="deviceID" name="deviceID" class="form-control select-validate">

                                                <option value="">CHOOSE DEVICE</option>
                                                <?php
                                                    if(count($devices->ResponseData)):
                                                        foreach($devices->ResponseData AS $deviceKey => $devVal):
                                                ?>

                                                <option value="<?=abs($devVal->id); ?>" <?=abs($devVal->id)==$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["amlID"]) ? " selected " : ""; ?>><?=abs($devVal->id); ?>: <?=$devVal->device; ?></option>

                                                <?php
                                                        endforeach;
                                                    else:
                                                    endif;
                                                ?>
 
                                            </select>

                                            <input type="hidden" id="deviceIDOld" name="deviceIDOld" value="<?=$_GeniSys->_confs['amlID']; ?>">

                                        </div>

                                        <div class="form-group">

                                            <label>AML Address</label>
                                            <input type="text" id="AMLAddress" name="AMLAddress" class="form-control text-validate" value="<?=$_GeniSys->_confs["amlAddress"] ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["amlAddress"]) : ""; ?>">
                                            <p class="help-block">API URL For GeniSys AML/ALL Detection System Server.</p>

                                        </div>

                                        <input type="hidden" id="ftype" name="ftype" value="updatAMLdevice" /> 
                                        <a class="btn btn-default" id="formSubmit">Submit</a>

                                    </form>

                                <?php 
                                    else:
                                ?>
                                    <form role="form" id="formAML">
                                        
                                        <div class="form-group">

                                            <?php
                                                $devices = $_iotJumpWayDevices->getDeviceList();
                                            ?>

                                            <label>Choose Related iotJumpWay Device</label>
                                            <select id="deviceID" name="deviceID" class="form-control select-validate">

                                                <option value="">CHOOSE DEVICE</option>
                                                <?php
                                                    if(count($devices->ResponseData)):
                                                        foreach($devices->ResponseData AS $deviceKey => $devVal):
                                                ?>

                                                <option value="<?=abs($devVal->id); ?>"><?=abs($devVal->id); ?>: <?=$devVal->device; ?></option>

                                                <?php
                                                        endforeach;
                                                    else:
                                                    endif;
                                                ?>
 
                                            </select>

                                            <input type="hidden" id="ftype" name="ftype" value="updateAMLdeviceID" /> 

                                        </div>

                                        <a class="btn btn-default" id="formSubmit">Submit</a>

                                    </form>

                                <?php 
                                    endif;
                                ?>

                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="col-lg-4">
        
                        <?php  include dirname(__FILE__) . '/../../iotJumpWay/Includes/live.php'; ?>

                    </div>
                </div>
            </div>
        </div>
        
        <?php  include dirname(__FILE__) . '/../../Includes/Scripts.php'; ?>

        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/mqttws31.js" type="text/javascript"></script>
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/iotJumpWay.js" type="text/javascript"></script>
 
    </body>
</html> 