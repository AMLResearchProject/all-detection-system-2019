<?php session_start();

$pageDetails = [
    "PageID" => "NLU"
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
$device  = $_GeniSys->_confs['nluID'] ? $_iotJumpWayDevices->getDevice($_GeniSys->_confs['nluID']) : null;
$devices = $_iotJumpWayDevices->getDeviceList();

$testData = glob("Data/Test/*.jpg");

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
            .classifyALL:hover
            {
                opacity: 0.3;
            }
            .classifyALL
            {
                width: 100%;
            }
        </style>

    </head>
    <body>
    
        <div id="wrapper">

            <?php include dirname(__FILE__) . '/../../Includes/nav.php'; ?>

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">AML & ALL AI RESEARCH PROJECT</h1>
                    </div>
                    <div class="col-lg-12"><?php include dirname(__FILE__) . '/../../Server/Includes/top.php'; ?></div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-info-circle fa-fw"></i> ACUTE LYMPHOBLASTIC LEUKEMIA DETECTION SYSTEM 2019
                                <div class="pull-right">
                                    <div class="btn-group">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <p>The Acute Lymphoblastic Leukemia Detection System is an open source extension of the <a href="https://github.com/GeniSysAI/" traget="_BLANK">GeniSysAI</a> Artificial Intelligence Network that allows you to upload ALL test data and run classifications to detect positive and negative examples.</p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-info-circle fa-fw"></i> ACUTE LYMPHOBLASTIC LEUKEMIA IMAGE DATABASE FOR IMAGE PROCESSING
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">
                                
                                <p>The <a href="https://homes.di.unimi.it/scotti/all/" target="_BLANK">Acute Lymphoblastic Leukemia Image Database for Image Processing</a> dataset is used for this project. The dataset was created by <a href="https://homes.di.unimi.it/scotti/" target="_BLANK">Fabio Scotti</a>, Associate Professor Dipartimento di Informatica, Università degli Studi di Milano. Big thanks to Fabio for his research and time put in to creating the dataset and documentation, it is one of his personal projects. You will need to follow the steps outlined <a href="https://homes.di.unimi.it/scotti/all/#download" target="_BLANK">on THIS link</a> to gain access to the dataset.</p>
                                
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-image fa-fw"></i> TEST DATASET
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <?=count($testData) ? "<a id=\"classifyALLMulti\" style=\"cursor: pointer;\"><i class=\"fa fa-arrow-right\"></i> CLASSIFY TEST DATASET</a>" : "" ; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body" id="dataset">

                                <div style="height: 500px !important; overflow-x: hidden !important;">

                                    <?php
                                        if(!count($testData)):
                                            echo "<p>There is currently no test data available. You can upload test data on the <a href=\"Data/Testing\" style=\"cursor: pointer;\">Data</a> page.</p>";
                                        else:
                                            foreach($testData as $image):
                                                $imgParts = pathinfo($image);
                                                echo "<div class=\"col-lg-3\" style=\"padding: 0 !important; margin: 0px !important;\"><img src='" . $image . "' alt='" . $imgParts['filename'] . "' title='" . $imgParts['filename'] . "' class='classifyALL' style='cursor: pointer;'/></div>";
                                            endforeach;
                                        endif;
                                    ?>

                                </div>

                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4">

                        <?php  include dirname(__FILE__) . '/../../iotJumpWay/Includes/live.php'; ?>

                        <div class="panel panel-default hide" id="classificationLive">
                            <div class="panel-heading">
                                <i class="fa fa-globe fa-fw"></i> ALL CLASSIFIER
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div id="status" class="panel-body scrollerSmaller" style="width: 100%;">
                            
                                <div class="col-lg-12" id="coreLoader" style="text-align: center;">
                                    <h3>PROCESSING</h3>
                                    <img src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/Images/Site/loader.gif" style="width: 59px; margin: auto auto !important;" />
                                </div>
                                
                                <div class="col-lg-12 hide" id="coreResults" style="text-align: center;">
                                    <h3>RESULTS</h3>
                                    <p><strong>FILES:</strong> <span id="files"></span><br />
                                    <strong>CORRECT:</strong> <span id="correct"></span><br />
                                    <strong>INCORRECT:</strong> <span id="incorrect"></span><br />
                                    <strong>FALSE POSITIVES:</strong> <span id="fp"></span><br />
                                    <strong>FALSE NEGATIVES:</strong> <span id="fn"></span></p>
                                </div>
                            
                                <div class="col-lg-5">
                                    <img id="classificationContainer" src="" style="width: 100%;" />
                                </div>
                                <div class="col-lg-7">

                                    <div id="classificationInfo" style="margin-top: 5% !important; margin-bottom: 5% !important;">
                                        <strong><span id="fileName"></span></strong><br />
                                        <p><span id="classification"></span><br />
                                        <span id="confidence"></span><br /><br />
                                        <span id="validation"></span></p>
                                    </div>
                                    <img id="classificationLoader" src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/Images/Site/loader.gif" style="margin-top: 5% !important; margin-bottom: 5% !important;" />

                                </div>
                                <div class="col-lg-6"></div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <?php  include dirname(__FILE__) . '/../../Includes/Scripts.php'; ?>
        
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/mqttws31.js" type="text/javascript"></script>
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Live/classes/iotJumpWay.js" type="text/javascript"></script>
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/Classes/Core.js" type="text/javascript"></script>
 
    </body>
</html> 