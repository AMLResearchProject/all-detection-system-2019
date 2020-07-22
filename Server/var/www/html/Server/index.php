<?php session_start();

$pageDetails = [
    "PageID" => "Server"
];

include dirname(__FILE__) . '/../../Classes/Core/init.php';

include dirname(__FILE__) . '/../Server/Classes/core.php';

include dirname(__FILE__) . '/../GeniSysAI/Language/Classes/core.php';

include dirname(__FILE__) . '/../iotJumpWay/Classes/core.php';
include dirname(__FILE__) . '/../iotJumpWay/Classes/applications.php';

include dirname(__FILE__) . '/../People/Classes/core.php';

$_GeniSysAiUsers->checkSession();
$applications = $_iotJumpWayApplications->getApplicationsList();

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

            <?php include dirname(__FILE__) . '/../Includes/nav.php'; ?>

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">GeniSysAI Server Configuration</h1>
                    </div>
                </div>
                
                <div class="row"> 

                    <div class="col-lg-12"><?php include dirname(__FILE__) . '/../Server/Includes/top.php'; ?></div>

                    <div class="col-lg-8">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="col-lg-6" style="color: #fff !important;">
            
                                    <?php include dirname(__FILE__) . '/../Includes/Weather.php'; ?>                                
                                
                                </div>
                                <div class="col-lg-6">
            
                                    <?php include dirname(__FILE__) . '/../Includes/Time.php'; ?>  

                                </div>

                            </div>
                        </div>

                        <form role="form" id="form">

                        <?php 
                            if($_GeniSys->_confs["jumpwayAppID"]):
                        ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> GeniSysAI Server Configuration

                                    <div class="pull-right">
                                        <div class="btn-group">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel-body">

                                    <div class="form-group">

                                        <label>Server URL</label>
                                        <input type="text" id="domainString" name="domainString" class="form-control text-validate" value="<?=$_GeniSys->_confs['domainString'] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['domainString']) : ""; ?>">
                                        <p class="help-block">URL of your GeniSysAI's FQDN (Fully Qualified Domain Name). Can use local IP addresses and the IP configuration from the repo but it is not suggested as network encryption will not be possible.</p>

                                    </div>

                                    <div class="form-group">
                                        <label>Server Name</label>
                                        <input type="text" id="meta_title" name="meta_title" class="form-control text-validate" value="<?=$_GeniSys->_confs['meta_title'] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['meta_title']) : ""; ?>">
                                        <p class="help-block">Name of your GeniSysAI server, also used as the browser title.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>iotJumpWay User ID</label>
                                        <input type="text" id="jwUid" name="jwUid" class="form-control text-validate" value="<?=$_GeniSys->_confs["jwUid"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["jwUid"]) : ""; ?>">
                                        <p class="help-block">ID of your iotJumpWay user account.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>iotJumpWay Application Location</label>
                                        <input type="text" id="jumpwayLocation" name="jumpwayLocation" class="form-control text-validate" value="<?=$_GeniSys->_confs["jumpwayLocation"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["jumpwayLocation"]) : ""; ?>">
                                        <p class="help-block">ID of the iotJumpWay location ID that represents your iotJumpWay network. For information on how to set up your iotJumpWay location, visit the <a href="https://www.iotjumpway.com/developers/getting-started-locations" target="_BLANK">iotJumpWay Location Spaces guide</a>.</p>
                                    </div>

                                </div>
                                
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> GeniSysAI Core iotJumpWay Device
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <p>The core iotJumpWay device.</p>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Device</label>
                                        <input type="text" id="JumpWayDevice" name="JumpWayDevice" class="form-control text-validate" value="<?=$_GeniSys->_confs["jumpwayDevice"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["jumpwayDevice"]) : ""; ?>">
                                        <p class="help-block">ID of your core iotJumpWay device you are using for your GeniSysAI network.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Device Name</label>
                                        <input type="text" id="JumpWayDeviceName" name="JumpWayDeviceName" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayDeviceName"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayDeviceName"]) : ""; ?>">
                                        <p class="help-block">Name of your core iotJumpWay device.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Device Zone</label>
                                        <input type="text" id="JumpWayDeviceZone" name="JumpWayDeviceZone" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayDeviceZone"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayDeviceZone"]) : ""; ?>">
                                        <p class="help-block">Zone that your core iotJumpWay device is located in.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Device MQTT User</label>
                                        <input type="text" id="JumpWayDeviceMqttUser" name="JumpWayDeviceMqttUser" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayDeviceMqttUser"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayDeviceMqttUser"]) : ""; ?>">
                                        <p class="help-block">MQTT username of your core iotJumpWay device.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Device MQTT Password</label>
                                        <input type="text" id="JumpWayDeviceMqttPass" name="JumpWayDeviceMqttPass" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayDeviceMqttPass"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayDeviceMqttPass"]) : ""; ?>">
                                        <p class="help-block">MQTT password of your core iotJumpWay device.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> GeniSysAI Core iotJumpWay Application
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <p>The core iotJumpWay application is used by a Python script that is run as a service on your GeniSysAI server. The service will connect to your iotJumpWay application and listen for updates to devices on your network and/or allowing you to control your iotJumpWay devices and applications manually or autonomously. For information on how to set up your iotJumpWay application, visit the <a href="https://www.iotjumpway.com/developers/getting-started-applications" target="_BLANK">iotJumpWay Applications guide</a>.</p>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Application</label>
                                        <input type="text" id="jumpwayAppID" name="jumpwayAppID" class="form-control text-validate" value="<?=$_GeniSys->_confs["jumpwayAppID"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["jumpwayAppID"]) : ""; ?>">
                                        <p class="help-block">ID of your core iotJumpWay application you are using for your GeniSysAI network.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Application Name</label>
                                        <input type="text" id="JumpWayAppName" name="JumpWayAppName" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayAppName"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayAppName"]) : ""; ?>">
                                        <p class="help-block">Name of your core iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Application MQTT User</label>
                                        <input type="text" id="JumpWayMqttUser" name="JumpWayMqttUser" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayMqttUser"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayMqttUser"]) : ""; ?>">
                                        <p class="help-block">MQTT username for your iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Application MQTT Password</label>
                                        <input type="text" id="JumpWayMqttPass" name="JumpWayMqttPass" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayMqttPass"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayMqttPass"]) : ""; ?>">
                                        <p class="help-block">MQTT password for your core iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Application Public App Key</label>
                                        <input type="text" id="JumpWayAppPublic" name="JumpWayAppPublic" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayAppPublic"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayAppPublic"]) : ""; ?>">
                                        <p class="help-block">Public application key for your core iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Application Secret App Key</label>
                                        <input type="text" id="JumpWayAppSecret" name="JumpWayAppSecret" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayAppSecret"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayAppSecret"]) : ""; ?>">
                                        <p class="help-block">Secret application key for your core iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Core iotJumpWay Application MAC Address</label>
                                        <input type="text" id="JumpWayAppMAC" name="JumpWayAppMAC" class="form-control text-validate" value="<?=$_GeniSys->_confs["JumpWayAppMAC"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["JumpWayAppMAC"]) : ""; ?>">
                                        <p class="help-block">MAC address of the device that your core iotJumpWay application is running on.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> GeniSysAI Websockets iotJumpWay Application
                                    <div class="pull-right">
                                        <div class="btn-group"></div>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <p>The WebSockets iotJumpWay application is used by a GeniSysAI UI plugin to provide realtime MQTT messages in the browser. The plugin will connect to your iotJumpWay WebSockets application and listen for updates to devices on your network. For information on how to set up your core iotJumpWay application, visit the <a href="https://www.iotjumpway.com/developers/getting-started-applications" target="_BLANK">iotJumpWay Applications guide</a>.</p>

                                    <div class="form-group">
                                        <label>WebSockets iotJumpWay Application</label>
                                        <input type="text" id="WSapp" name="WSapp" class="form-control text-validate" value="<?=$_GeniSys->_confs["WSapp"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["WSapp"]) : ""; ?>">
                                        <p class="help-block">ID of your WebSockets iotJumpWay application you are using for your GeniSysAI network.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>WebSockets iotJumpWay Application MQTT User</label>
                                        <input type="text" id="WSMQTTuser" name="WSMQTTuser" class="form-control text-validate" value="<?=$_GeniSys->_confs["WSMQTTuser"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["WSMQTTuser"]) : ""; ?>">
                                        <p class="help-block">MQTT username for your WebSockets iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>WebSockets iotJumpWay Application MQTT Password</label>
                                        <input type="text" id="WSMQTTpass" name="WSMQTTpass" class="form-control text-validate" value="<?=$_GeniSys->_confs["WSMQTTpass"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["WSMQTTpass"]) : ""; ?>">
                                        <p class="help-block">MQTT password for your WebSockets iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>WebSockets iotJumpWay Application Public App Key</label>
                                        <input type="text" id="WSAppPub" name="WSAppPub" class="form-control text-validate" value="<?=$_GeniSys->_confs["WSAppPub"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["WSAppPub"]) : ""; ?>">
                                        <p class="help-block">Public application key for your WebSockets iotJumpWay application.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>WebSockets iotJumpWay Application Secret App Key</label>
                                        <input type="text" id="WSAppPriv" name="WSAppPriv" class="form-control text-validate" value="<?=$_GeniSys->_confs["WSAppPriv"] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["WSAppPriv"]) : ""; ?>">
                                        <p class="help-block">Secret application key for your WebSockets iotJumpWay application.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> GeniSysAI Server Database Settings

                                    <div class="pull-right">
                                        <div class="btn-group">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel-body">

                                    <div class="form-group">

                                        <label>phpMyAdmin Endpoint</label>
                                        <input type="text" id="phpmyadmin" name="phpmyadmin" class="form-control text-validate" value="<?=$_GeniSys->_confs['phpmyadmin'] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['phpmyadmin']) : ""; ?>">
                                        <p class="help-block">Endpoint of phpMyAdmin.</p>

                                    </div>

                                </div>
                                
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs fa-fw"></i> GeniSysAI Server API Settings

                                    <div class="pull-right">
                                        <div class="btn-group">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel-body">

                                    <div class="form-group">

                                        <label>API URL</label>
                                        <input type="text" id="apiURL" name="apiURL" class="form-control text-validate" value="<?=$_GeniSys->_confs['apiURL'] != "" ? $_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['apiURL']) : ""; ?>">
                                        <p class="help-block">URL of API server.</p>

                                    </div>

                                    <input type="hidden" id="ftype" name="ftype" value="updateServer" /> 
                                    <a class="btn btn-default" id="formSubmit">Submit</a>

                                </div>
                                
                            </div>

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
                                    
                                <div class="form-group">

                                    <?php
                                        $devices = $_iotJumpWayApplications->getApplicationList();
                                    ?>

                                    <label>Choose iotJumpWay Application</label>
                                    <select id="nluID" name="nluID" class="form-control select-validate">

                                        <option value="">CHOOSE DEVICE</option>
                                        <?php
                                            if(count($devices->ResponseData)):
                                                foreach($devices->ResponseData AS $deviceKey => $devVal):
                                        ?>

                                        <option value="<?=abs($devVal->id); ?>" <?=abs($devVal->id)==$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["nluID"]) ? " selected " : ""; ?>><?=abs($devVal->id); ?>: <?=$devVal->device; ?></option>

                                        <?php
                                                endforeach;
                                            else:
                                            endif;
                                        ?>

                                    </select>

                                    <input type="hidden" id="ftype" name="ftype" value="updateNLUdeviceID" /> 

                                </div>

                                <a class="btn btn-default" id="formSubmit">Submit</a>
                            
                            </div>
                        </div>

                        <?php 
                            endif;
                        ?>

                        </form>
                        
                    </div>
                    <div class="col-lg-4">

                        <?php  include dirname(__FILE__) . '/../Server/Includes/serverInfo.php'; ?>
                        <?php  include dirname(__FILE__) . '/../iotJumpWay/Includes/live.php'; ?>

                    </div>
                        
                </div>

            </div>
        
        </div>
        
        <?php  include dirname(__FILE__) . '/../Includes/Scripts.php'; ?>

        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/mqttws31.js" type="text/javascript"></script>
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/iotJumpWay.js" type="text/javascript"></script>
 
    </body>

</html> 