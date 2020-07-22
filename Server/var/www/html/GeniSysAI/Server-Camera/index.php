<?php session_start();

$pageDetails = [
    "PageID" => "Vision"
];

include dirname(__FILE__) . '/../../../Classes/Core/init.php';

include dirname(__FILE__) . '/../../Server/Classes/core.php';

include dirname(__FILE__) . '/../../GeniSysAI/Server-Camera/Classes/core.php';

include dirname(__FILE__) . '/../../iotJumpWay/Classes/core.php';
include dirname(__FILE__) . '/../../iotJumpWay/Classes/devices.php';
include dirname(__FILE__) . '/../../iotJumpWay/Classes/applications.php';

include dirname(__FILE__) . '/../../People/Classes/core.php';

$_GeniSysAiUsers->checkSession();

$device  = $_GeniSys->_confs['tassID'] ? $_iotJumpWayDevices->getDevice($_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["tassID"])) : null;
$devices = $_iotJumpWayDevices->getDeviceList();

$authConfs = $_TASS->getAccessConfs();

$accessCamera  = $_GeniSys->_confs['tassID'] ? $_iotJumpWayDevices->getDevice($_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['tassID'])) : null;

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
                        <h1 class="page-header">GeniSysAI Local Access Camera</h1>
                        <div class="col-lg-12"><?php include dirname(__FILE__) . '/../../Server/Includes/top.php'; ?></div>
                    </div>
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

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-address-card fa-fw"></i> Local Access Camera
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">
                            
                                <p>The GeniSysAI IntelliLan Server Local Access Camera feature is a program that is meant to connect to the GeniSysAI server camera, but can also connect to remote cameras.</p>
                                
                                
                                <p>The Local Access Camera has a facial identification program to classify known and unknown visitors from from your GeniSysAI Vision devices. The system uses Intel Neural Compute Stick (Movidius) and Siamese Neural Networks to classify if a person is authorized, an authorized visitor or an intruder. This information can be used to track visitors/family members/intruders in your home and allows the network administrator to review faces of people seen.
                            
                                <p><strong>For a full installation guide check out <a href="https://github.com/GeniSysAI/Vision/tree/master/Local" target="_BLANK">this link</a></strong>.</p>
                            
                            </div>
                        </div>

                        <?php 
                            if($_GeniSys->_confs["tassID"]):
                        ?>

                        <form role="form" id="form">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> Local Access Camera Configuration

                                    <div class="pull-right">
                                        <div class="btn-group">
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="panel-body">

                                    <div class="form-group">

                                        <label>MAC Address</label>
                                        <input type="text" id="MAC" name="MAC" class="form-control text-validate" value="<?=$authConfs["MAC"] ? $_GeniSys->_helpers->oDecrypt($authConfs["MAC"]) : ""; ?>">
                                        <p class="help-block">MAC address of the Local Access Camera device.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Stream Address</label>
                                        <input type="text" id="StreamIP" name="StreamIP" class="form-control text-validate" value="<?=$authConfs["StreamIP"] ? $_GeniSys->_helpers->oDecrypt($authConfs["StreamIP"]) : ""; ?>">
                                        <p class="help-block">Address for the Local Access Camera device stream.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Stream Port</label>
                                        <input type="text" id="StreamPort" name="StreamPort" class="form-control text-validate" value="<?=$authConfs["StreamPort"] ? $_GeniSys->_helpers->oDecrypt($authConfs["StreamPort"]) : ""; ?>">
                                        <p class="help-block">Port for the Local Access Camera device stream.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Socket Address</label>
                                        <input type="text" id="socketIP" name="socketIP" class="form-control text-validate" value="<?=$authConfs["socketIP"] ? $_GeniSys->_helpers->oDecrypt($authConfs["socketIP"]) : ""; ?>">
                                        <p class="help-block">Address for the Local Access Camera device socket stream.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Socket Port</label>
                                        <input type="text" id="socketPort" name="socketPort" class="form-control text-validate" value="<?=$authConfs["socketPort"] ? $_GeniSys->_helpers->oDecrypt($authConfs["socketPort"]) : ""; ?>">
                                        <p class="help-block">Port for the Local Access Camera socket stream.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>API URL</label>
                                        <input type="text" id="API" name="API" class="form-control text-validate" value="<?=$authConfs["API"] ? $_GeniSys->_helpers->oDecrypt($authConfs["API"]) : ""; ?>">
                                        <p class="help-block">URL for the Local Access Camera API.</p> 

                                    </div>
                                   
                                </div>
                                
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> iotJumpWay Configuration

                                    <div class="pull-right">
                                        <div class="btn-group">
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Device Name</label>
                                        <input type="text" id="jdf" name="jdn" class="form-control text-validate" value="<?=$authConfs["jdn"] != "" ? $_GeniSys->_helpers->oDecrypt($authConfs["jdn"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Local Access Camera API iotJumpWay device name.</p>
                                    </div>
                                        
                                    <div class="form-group">

                                        <label>Connect iotJumpWay Device</label>
                                        <select id="deviceID" name="deviceID" class="form-control select-validate">

                                            <option value="">CHOOSE DEVICE</option> 
                                            <?php
                                                if(count($devices->ResponseData)):
                                                    foreach($devices->ResponseData AS $deviceKey => $devVal): 
                                            ?>

                                            <option value="<?=abs($devVal->id); ?>" <?=abs($devVal->id)==$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["tassID"]) ? " selected " : ""; ?>><?=abs($devVal->id); ?>: <?=$devVal->device; ?></option>

                                            <?php
                                                    endforeach;
                                                else:
                                            ?>
                                            
                                            <?php
                                                endif;
                                            ?>

                                        </select>

                                        <input type="hidden" id="deviceIDOld" name="deviceIDOld" value="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["tassID"]); ?>">

                                    </div>

                                    <div class="form-group">
                                        <label>Device Location</label>
                                        <input type="text" id="jdl" name="jdl" class="form-control text-validate" value="<?=$authConfs["jdl"] != "" ? $_GeniSys->_helpers->oDecrypt($authConfs["jdl"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Local Access Camera API iotJumpWay device location.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device Floor</label>
                                        <input type="text" id="jdf" name="jdf" class="form-control text-validate" value="<?=$authConfs["jdf"] != "" ? $_GeniSys->_helpers->oDecrypt($authConfs["jdf"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Local Access Camera API iotJumpWay device floor.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device Zone</label>
                                        <input type="text" id="jdz" name="jdz" class="form-control text-validate" value="<?=$authConfs["jdz"] != "" ? $_GeniSys->_helpers->oDecrypt($authConfs["jdz"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Local Access Camera API iotJumpWay device zone.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device MQTT User</label>
                                        <input type="text" id="jdmu" name="jdmu" class="form-control text-validate" value="<?=$authConfs["jdmu"] != "" ? $_GeniSys->_helpers->oDecrypt($authConfs["jdmu"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Local Access Camera API iotJumpWay device MQTT user.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Device MQTT Password</label>
                                        <input type="text" id="jdmp" name="jdmp" class="form-control text-validate" value="<?=$authConfs["jdmp"] != "" ? $_GeniSys->_helpers->oDecrypt($authConfs["jdmp"]) : ""; ?>">
                                        <p class="help-block">GeniSysAI Local Access Camera API iotJumpWay device MQTT password.</p>
                                    </div>
                                   
                                </div>
                                
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> Facenet Configuration

                                    <div class="pull-right">
                                        <div class="btn-group">
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="panel-body">

                                    <div class="form-group">

                                        <label>Graph</label>
                                        <input type="text" id="Graph" name="Graph" class="form-control text-validate" value="<?=$authConfs["Graph"] ? $_GeniSys->_helpers->oDecrypt($authConfs["Graph"]) : ""; ?>">
                                        <p class="help-block">Path to Facenet graph.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Dlib</label>
                                        <input type="text" id="Dlib" name="Dlib" class="form-control text-validate" value="<?=$authConfs["Dlib"] ? $_GeniSys->_helpers->oDecrypt($authConfs["Dlib"]) : ""; ?>">
                                        <p class="help-block">Path to Facenet Dlib model.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Testing Data Path</label>
                                        <input type="text" id="TestingPath" name="TestingPath" class="form-control text-validate" value="<?=$authConfs["TestingPath"] ? $_GeniSys->_helpers->oDecrypt($authConfs["TestingPath"]) : ""; ?>">
                                        <p class="help-block">Path to Facenet testing data.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Known Data Path</label>
                                        <input type="text" id="ValidPath" name="ValidPath" class="form-control text-validate" value="<?=$authConfs["ValidPath"] ? $_GeniSys->_helpers->oDecrypt($authConfs["ValidPath"]) : ""; ?>">
                                        <p class="help-block">Path to Facenet testing data.</p> 

                                    </div>

                                    <div class="form-group">

                                        <label>Classification Threshold</label>
                                        <input type="text" id="Threshold" name="Threshold" class="form-control text-validate" value="<?=$authConfs["Threshold"] ? $_GeniSys->_helpers->oDecrypt($authConfs["Threshold"]) : ""; ?>">
                                        <p class="help-block">Threshold for facial classifications.</p> 

                                    </div>

                                    <input type="hidden" id="ftype" name="ftype" value="updateTASSlocal" /> 
                                    <a class="btn btn-default" id="formSubmit">Submit</a>
                            
                                </div>

                            </form>

                        <?php 
                            else:
                        ?>

                        <form role="form" id="form">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> Local Access Camera Configuration

                                    <div class="pull-right">
                                        <div class="btn-group">
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="panel-body">
                                        
                                    <div class="form-group">

                                        <?php
                                            $devices = $_iotJumpWayDevices->getDeviceList();
                                        ?>

                                        <label>Choose iotJumpWay Device</label>
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
                                            ?>
                                            
                                            <?php
                                                endif;
                                            ?>

                                        </select>

                                        <input type="hidden" id="ftype" name="ftype" value="updateTassLocalID" /> 

                                    </div>

                                    <a class="btn btn-default" id="formSubmit">Submit</a>

                                </div>
                            </form>

                            <?php 
                                endif;
                            ?>
                            
                        </div>
                        
                    </div>
                    <div class="col-lg-4">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-superpowers fa-fw"></i> Server Local Access Camera
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">
                            
                                <?php  include dirname(__FILE__) . '/../..//GeniSysAI/Server-Camera/Includes/Cam.php'; ?>
                            
                            </div>
                        </div>
        
                        <?php  include dirname(__FILE__) . '/../../GeniSysAI/Facial-Auth/Includes/Device.php'; ?>
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