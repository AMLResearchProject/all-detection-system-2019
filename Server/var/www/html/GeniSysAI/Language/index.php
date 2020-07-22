<?php session_start();

$pageDetails = [
    "PageID" => "Settings"
];

include dirname(__FILE__) . '/../../../Classes/Core/init.php';

include dirname(__FILE__) . '/../../Server/Classes/core.php';

include dirname(__FILE__) . '/../../GeniSysAI/Language/Classes/core.php';

include dirname(__FILE__) . '/../../iotJumpWay/Classes/core.php';
include dirname(__FILE__) . '/../../iotJumpWay/Classes/devices.php';
include dirname(__FILE__) . '/../../iotJumpWay/Classes/applications.php';

include dirname(__FILE__) . '/../../People/Classes/core.php';

$_GeniSysAiUsers->checkSession();

$device  = $_GeniSys->_confs['nluID'] ? $_iotJumpWayDevices->getDevice($_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['nluID'])) : null;
$devices = $_iotJumpWayDevices->getDeviceList();
$AIConf = $_NLU->getAIConf();

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
          ** @Project:      GeniSysAI IntelliLan Home Network
          ** @Repository:   Server
          ** @Project:      Server UI
          ** @Github:       https://github.com/GeniSysAI/
          ** 
          ** @Author:       Adam Milton-Barker (AdamMiltonBarker.com)
          ** @Contributors:
          ** @Description:  The GeniSysAI IntelliLan Home Network UI.
          ** License:       MIT License
          **********************************************************/	
        -->

        <title>GeniSysAI IntelliLan Home Network</title>
        <meta name="description" content="GeniSysAI IntelliLan Home Network is a open source intelligent network using Computer Vision, Natural Linguistics & Internet of Things powered by the iotJumpWay.">
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
                        <h1 class="page-header">GeniSysAI Language Understanding Engine</h1>
                    </div>
                    <div class="col-lg-12"><?php include dirname(__FILE__) . '/../../Server/Includes/top.php'; ?></div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="col-lg-6" style="color: #fff !important;">
            
                                    <?php include dirname(__FILE__) . '/../../Includes/Weather.php'; ?>                                
                                
                                </div>
                                <div class="col-lg-6">
            
                                    <?php include dirname(__FILE__) . '/../../Includes/Time.php'; ?>  

                                </div>

                            </div>
                        </div>

                        <?php 
                            if($_GeniSys->_confs["nluID"]):
                        ?>

                        <form role="form" id="form">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> Device Configuration
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Device URL</label>
                                        <input type="text" id="fqdn" name="fqdn" class="form-control text-validate" value="<?=$AIConf["fqdn"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["fqdn"]) : ""; ?>">
                                        <p class="help-block">Device URL for GeniSysAI Language Understanding Engine server device.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Local IP Address:</label>
                                        <input type="text" id="ip" name="ip" class="form-control text-validate" value="<?=$AIConf["ip"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["ip"]) : ""; ?>" placeholder="Update your NLU Engine IP">
                                        <p class="help-block">Local IP address of your GeniSysAI Language Understanding Engine device (This device).</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Local Port:</label>
                                        <input type="text" id="port" name="port" class="form-control text-validate" value="<?=$AIConf["port"]; ?>" placeholder="Update your NLU Engine Port">
                                        <p class="help-block">Local Port of your GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Local Mac Address:</label>
                                        <input type="text" id="mac" name="mac" class="form-control text-validate" value="<?=$AIConf["mac"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["mac"]) : ""; ?>" placeholder="Update your NLU Engine Mac address">
                                        <p class="help-block">Local Mac address of your GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Log Path:</label>
                                        <input type="text" id="logsPath" name="logsPath" class="form-control text-validate" value="<?=$AIConf["logsPath"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["logsPath"]) : ""; ?>" placeholder="Update your NLU Engine log path">
                                        <p class="help-block">Local log path used by your GeniSysAI Language Understanding Engine.</p>
                                    </div>

                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> iotJumpWay Configuration
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                        
                                    <div class="form-group">
                                        <label>Device</label>
                                        <select id="deviceID" name="deviceID" class="form-control select-validate">
                                            <option value="">CHOOSE NLU DEVICE</option>


                                            <?php
                                                if(count($devices->ResponseData)):
                                                    foreach($devices->ResponseData AS $deviceKey => $devVal): echo $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["nluID"]);
                                                    
                                            ?>

                                            <option value="<?=abs($devVal->id); ?>" <?=abs($devVal->id)==$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["nluID"]) ? " selected " : ""; ?>><?=abs($devVal->id); ?>: <?=$devVal->device; ?></option>

                                            <?php
                                                    endforeach;
                                                endif;
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Device Location</label>
                                        <input type="text" id="deviceLocation" name="deviceLocation" class="form-control text-validate" value="<?=$AIConf["deviceLocation"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["deviceLocation"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Language Understanding Engine device location.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device Name</label>
                                        <input type="text" id="deviceName" name="deviceName" class="form-control text-validate" value="<?=$AIConf["deviceName"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["deviceName"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Language Understanding Engine device name.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device Floor</label>
                                        <input type="text" id="deviceFloor" name="deviceFloor" class="form-control text-validate" value="<?=$AIConf["deviceFloor"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["deviceFloor"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Language Understanding Engine device zone.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device Zone</label>
                                        <input type="text" id="deviceZone" name="deviceZone" class="form-control text-validate" value="<?=$AIConf["deviceZone"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["deviceZone"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Language Understanding Engine device zone.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device MQTT User</label>
                                        <input type="text" id="deviceMuser" name="deviceMuser" class="form-control text-validate" value="<?=$AIConf["deviceMuser"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["deviceMuser"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Language Understanding Engine device MQTT user.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device MQTT Password</label>
                                        <input type="text" id="deviceMpass" name="deviceMpass" class="form-control text-validate" value="<?=$AIConf["deviceMpass"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["deviceMpass"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Language Understanding Engine device MQTT password.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> NLU Configuration
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Activation</label>
                                        <input type="text" id="Activation" name="Activation" class="form-control text-validate" value="<?=$AIConf["Activation"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["Activation"]) : ""; ?>" placeholder="Update your NLU Engine activation function">
                                        <p class="help-block">Activation function used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Threshold</label>
                                        <input type="text" id="Threshold" name="Threshold" class="form-control text-validate" value="<?=$AIConf["Threshold"]; ?>" placeholder="Update your NLU Engine threshold">
                                        <p class="help-block">Threshold used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Regression</label>
                                        True: <input type="radio" name="Regression" value=1 <?=$AIConf["Regression"] ? " checked " : ""; ?> /> False: <input type="radio" name="Regression" value=0 <?=!$AIConf["Regression"] ? " checked " : ""; ?> />
                                        <p class="help-block">Whether to use regression when training the GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Fully Connected Layers</label>
                                        <input type="text" id="FcLayers" name="FcLayers" class="form-control text-validate" value="<?=$AIConf["FcLayers"]; ?>" placeholder="Update your NLU Engine fully connected layers">
                                        <p class="help-block">Number of fully connected layers used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Fully Connected Units</label>
                                        <input type="text" id="FcUnits" name="FcUnits" class="form-control text-validate" value="<?=$AIConf["FcUnits"]; ?>" placeholder="Update your NLU Engine fully connected units">
                                        <p class="help-block">Number of fully connected units used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Epochs</label>
                                        <input type="text" id="Epochs" name="Epochs" class="form-control text-validate" value="<?=$AIConf["Epochs"]; ?>" placeholder="Update your NLU Engine training epochs">
                                        <p class="help-block">Epochs used by GeniSysAI Language Understanding Engine training.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>BatchSize</label>
                                        <input type="text" id="BatchSize" name="BatchSize" class="form-control text-validate" value="<?=$AIConf["BatchSize"]; ?>" placeholder="Update your NLU Engine training batch size">
                                        <p class="help-block">BatchSize used by GeniSysAI Language Understanding Engine training.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>ShowMetric</label>
                                        True: <input type="radio" name="ShowMetric" value=1 <?=$AIConf["ShowMetric"] ? " checked " : ""; ?> /> False: <input type="radio" name="ShowMetric" value=0 <?=!$AIConf["ShowMetric"] ? " checked " : ""; ?> />
                                        <p class="help-block">Whether to show metrics when training the GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> TFLearn Configuration
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>TFLearn Logs</label>
                                        <input type="text" id="TFLearn_Logs" name="TFLearn_Logs" class="form-control text-validate" value="<?=$AIConf["TFLearn_Logs"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["TFLearn_Logs"]) : ""; ?>" placeholder="Update your NLU Engine TFLearn logs directory">
                                        <p class="help-block">TFLearn logs directory used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>TFLearn Logs</label>
                                        <input type="text" id="TFLearn_LogsLevel" name="TFLearn_LogsLevel" class="form-control text-validate" value="<?=$AIConf["TFLearn_LogsLevel"]; ?>" placeholder="Update your NLU Engine TFLearn logs level">
                                        <p class="help-block">TFLearn logs level used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>TFLearn Model Path</label>
                                        <input type="text" id="TFLearn_ModelPath" name="TFLearn_ModelPath" class="form-control text-validate" value="<?=$AIConf["TFLearn_ModelPath"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["TFLearn_ModelPath"]) : ""; ?>" placeholder="Update your NLU Engine TFLearn model path">
                                        <p class="help-block">TFLearn model path used by GeniSysAI Language Understanding Engine training.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>TFLearn Model Info</label>
                                        <input type="text" id="TFLearn_ModelInfo" name="TFLearn_ModelInfo" class="form-control text-validate" value="<?=$AIConf["TFLearn_ModelInfo"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["TFLearn_ModelInfo"]) : ""; ?>" placeholder="Update your NLU Engine TFLearn model info path">
                                        <p class="help-block">TFLearn model info path used by GeniSysAI Language Understanding Engine training.</p>
                                    </div>

                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> Engine Entities Configuration
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Entity Extractor</label>
                                        <input type="text" id="EntityExtractor" name="EntityExtractor" class="form-control text-validate" value="<?=$AIConf["EntityExtractor"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["EntityExtractor"]) : ""; ?>" placeholder="Update your NLU Engine entity extractor">
                                        <p class="help-block">Entity extractor used by GeniSysAI Language Understanding Engine. Currently only Mitie is supported.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Mitie Lib Location</label>
                                        <input type="text" id="MitieLocation" name="MitieLocation" class="form-control text-validate" value="<?=$AIConf["MitieLocation"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["MitieLocation"]) : ""; ?>" placeholder="Update your NLU Engine Mitie lib location">
                                        <p class="help-block">Mitie lib location used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Mitie Model Location</label>
                                        <input type="text" id="MitieModelLocation" name="MitieModelLocation" class="form-control text-validate" value="<?=$AIConf["MitieModelLocation"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["MitieModelLocation"]) : ""; ?>" placeholder="Update your NLU Engine Mitie model location">
                                        <p class="help-block">Mitie model location used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Mitie DAT Location</label>
                                        <input type="text" id="EntitiesDat" name="EntitiesDat" class="form-control text-validate" value="<?=$AIConf["EntitiesDat"] != "" ? $_GeniSys->_helpers->oDecrypt($AIConf["EntitiesDat"]) : ""; ?>" placeholder="Update your NLU Engine Mitie dat path">
                                        <p class="help-block">Mitie dat location path used by GeniSysAI Language Understanding Engine.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Mitie Threshold</label>
                                        <input type="text" id="MitieThreshold" name="MitieThreshold" class="form-control text-validate" value="<?=$AIConf["MitieThreshold"]; ?>" placeholder="Update your NLU Engine Mitie threshold">
                                        <p class="help-block">Mitie threshold used by GeniSysAI Language Understanding Engine.</p>
                                    </div>

                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> Submit Updates
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <input type="hidden" id="deviceIDOld" name="deviceIDOld" value="<?=$_GeniSys->_confs['nluID']; ?>">
                                    <input type="hidden" id="ftype" name="ftype" value="updateNLUdevice" /> 
                                    <a class="btn btn-default" id="formSubmit">Submit</a>

                                </div>
                            </div>

                        </form>

                        <?php 
                            else:
                        ?>

                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <i class="fa fa-cogs fa-fw"></i> GeneSysAI Language Understanding Engine ConfigurationX
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">

                                <form role="form" id="form">
                                    
                                    <div class="form-group">

                                        <?php
                                            $devices = $_iotJumpWayDevices->getDeviceList();
                                        ?>

                                        <label>Choose iotJumpWay Device</label>
                                        <select id="nluID" name="nluID" class="form-control select-validate">

                                            <option value="">CHOOSE DEVICE</option>
                                            <?php
                                                if(count($devices->ResponseData)):
                                                    foreach($devices->ResponseData AS $deviceKey => $devVal):
                                            ?>

                                            <option value="<?=abs($devVal->id); ?>" <?=$_GeniSys->_confs["nluID"] ? abs($devVal->id)==$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["nluID"]) ? " selected " : "" : ""; ?>><?=abs($devVal->id); ?>: <?=$devVal->device; ?></option>

                                            <?php
                                                    endforeach;
                                                else:
                                                endif;
                                            ?>

                                        </select>

                                        <input type="hidden" id="ftype" name="ftype" value="updateNLUdeviceID" /> 

                                    </div>

                                    <a class="btn btn-default" id="formSubmit">Submit</a>

                                </form>        
                            
                            </div>
                        </div>

                        <?php 
                            endif;
                        ?>
                        
                    </div>
                    <div class="col-lg-4">
        
                        <?php  include dirname(__FILE__) . '/../../GeniSysAI/Language/Includes/deviceInfo.php'; ?>
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