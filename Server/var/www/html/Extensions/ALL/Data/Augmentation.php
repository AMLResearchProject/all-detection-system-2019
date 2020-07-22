<?php session_start();

$pageDetails = [
    "PageID" => "Augmentation"
];

include dirname(__FILE__) . '/../../../../Classes/Core/init.php';

include dirname(__FILE__) . '/../../../iotJumpWay/Classes/core.php';
include dirname(__FILE__) . '/../../../iotJumpWay/Classes/devices.php';
include dirname(__FILE__) . '/../../../iotJumpWay/Classes/applications.php';

include dirname(__FILE__) . '/../../../Extensions/ALL/Classes/Core.php';

include dirname(__FILE__) . '/../../../Server/Classes/core.php';
include dirname(__FILE__) . '/../../../People/Classes/core.php';

include dirname(__FILE__) . '/../../../GeniSysAI/Language/Classes/core.php';

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

        <style>
            .classifyAML:hover
            {
                opacity: 0.3;
            }
        </style>

    </head>
    <body>
    
        <div id="wrapper">

            <?php include dirname(__FILE__) . '/../../../Includes/nav.php'; ?>

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">AML & ALL AI RESEARCH PROJECT</h1>
                    </div>
                    <div class="col-lg-12"><?php include dirname(__FILE__) . '/../../../Server/Includes/top.php'; ?></div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-info-circle fa-fw"></i> ALL DETECTION SYSTEM 2019 DATA AUGMENTATION
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">
                                
                                <p>The Acute Lymphoblastic Leukemia Detection System 2019 uses the <a href="https://homes.di.unimi.it/scotti/all/" target="_BLANK">Acute Lymphoblastic Leukemia Image Database for Image Processing</a> dataset and data augmentation methods proposed in the <a href="http://www.ijcte.org/vol10/1198-H0012.pdf" target="_BLANK">Leukemia Blood Cell Image Classification Using Convolutional Neural Network</a> by T. T. P. Thanh, Caleb Vununu, Sukhrob Atoev, Suk-Hwan Lee, and Ki-Ryong Kwon.</p>
                                
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-image fa-fw"></i> ALL DETECTION SYSTEM 2019 AUGMENTATION TUTORIAL 
                                <div class="pull-right"></div>
                            </div>
                            <div class="panel-body">

                                    <p>To follow a complete tutorial on how to use data augmentation to increase the amount of training and testing data, follow the <a href="https://github.com/AMLResearchProject/ALL-Detection-System-2019" target="_BLANK">ALL Detection System 2019 Data Augmentation</a> tutorial to run the program in Jupyter Notebook or locally.</p>

                            </div>
                        </div>
							
                    </div>
                    <div class="col-lg-4">
        
                        <?php  include dirname(__FILE__) . '/../../../iotJumpWay/Includes/live.php'; ?>

                    </div>
                </div>
            </div>
        </div>
        
        <?php  include dirname(__FILE__) . '/../../../Includes/Scripts.php'; ?>

        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/mqttws31.js" type="text/javascript"></script>
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/iotJumpWay.js" type="text/javascript"></script>
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/AML/Classes/Core.js" type="text/javascript"></script>
 
    </body>
</html> 