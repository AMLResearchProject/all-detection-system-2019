<?php session_start();

$pageDetails = [
    "PageID" => "Testing"
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
            .classifyALLn:hover
            {
                opacity: 0.3;
            }
            .classifyALLn
            {
                width: 100%;
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
                                <i class="fa fa-info-circle fa-fw"></i> ALL DETECTION SYSTEM 2019 TEST DATA
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <a id="deleteAML" style="cursor: pointer;"><i class="fa fa-trash"></i> DELETE</a> | <a id="uploadAML" style="cursor: pointer;"><i class="fa fa-upload"></i> UPLOAD</a> 
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body"><p>Here you can manage the test data used with the Acute Lymphoblastic Leukemia Detection System 2019.</p></div>
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
                                <i class="fa fa-image fa-fw"></i> CURRENT TEST DATASET
                                <div class="pull-right">
                                    <div class="btn-group">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body" id="dataset">

                                <div id="uploadTemp" class="hide">

                                    <?php echo "<p>There is currently no test data available. <a id=\"uploadAML\" style=\"cursor: pointer;\"><i class=\"fa fa-upload\"></i> UPLOAD DATA</a></p>"; ?>
                                
                                </div>

                                <div id="datasetHolder" style="height: 500px; overflow-x: hidden;">

                                    <?php
                                        $testData = glob("Test/*.jpg");
                                        if(!count($testData)):
                                            echo "<p>There is currently no test data available. <a id=\"uploadAML\" style=\"cursor: pointer;\"><i class=\"fa fa-upload\"></i> UPLOAD DATA</a></p>";
                                        else:
                                            foreach($testData as $image):
                                                $imgParts = pathinfo($image);
                                                echo "<div class=\"col-lg-3\" style=\"padding: 0 !important; margin: 0px !important;\"><img src='" . $image . "' alt='" . $imgParts['filename'] . "' title='" . $imgParts['filename'] . "' class='classifyALLn' /></div>";
                                            endforeach;
                                        endif;
                                    ?>
                                
                                </div>
                            
                                <div class="col-lg-12 hide" id="coreLoader" style="text-align: center;">
                                    <h3>PROCESSING</h3>
                                    <img src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Media/Images/Site/loader.gif" style="width: 59px; margin: auto auto !important;" />
                                </div>

                                <form action="uploader" target="uploaderFrame" enctype="multipart/form-data" method="POST" id="dropzone" style="position:relative; padding-bottom: 50px !important; border: 0 !important; display: none;">
                                    <input type="file" multiple="" id="fileSelector" name="fileSelector[]"  accept="image/*">
                                </form>
							
                                <iframe id="uploaderFrame" name="uploaderFrame" height="100" width="300" frameborder="0" scrolling="no" class="hide"></iframe>

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
        <script src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/Classes/Core.js" type="text/javascript"></script>
 
    </body>
</html> 