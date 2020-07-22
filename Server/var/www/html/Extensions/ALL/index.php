<?php session_start();

$pageDetails = [
    "PageID" => "About"
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
$device  = $_GeniSys->_confs['nluID'] ? $_iotJumpWayDevices->getDevice($_GeniSys->_helpers->oDecrypt($_GeniSys->_confs['nluID'])) : null;
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
                    </div>
                    <div class="col-lg-12"><?php include dirname(__FILE__) . '/../../Server/Includes/top.php'; ?></div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-info-circle fa-fw"></i> ACUTE MYELOID & LYMPHOBLASTIC LEUKEMIA AI RESEARCH PROJECT
                                <div class="pull-right">
                                    <div class="btn-group">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                
                                <p>The <a href="https://www.petermossamlallresearch.com/" target="_BLANK">Peter Moss Acute Myeloid & Lyphoblastic Leukemia AI Research Project</a> is an open source and free project with the goals of researching and developing Artificial Intelligence to help detect Acute Myeloid Leukemia and Acute Lymphoblastic Leukemia.</p>
                                
                                <p>The project is an <a href="https://www.leukemiaresearchassociation.ai/" target="_BLANK">Asociacion De Investigacion En Inteligencia Artificial Para La Leucemia Peter Moss</a> research project.</p>
 
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-info-circle fa-fw"></i> ACUTE MYELOID & LYMPHOBLASTIC LEUKEMIA AI RESEARCH PROJECT TEAM
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">

                                <ul>
                                    <li>Adam Milton-Barker - President, Founder & Lead Developer.</li>
                                    <li>Virginia Mijes Martin - Secretary, Co-Founder & Marketing Lead.</li>
                                    <li>Javier Lopez Alonso - Treasurer, Co-Founder & R&D.</li>
                                    <li>Amita Kapoor - Student Program Team & R&D.</li>
                                    <li>Rishabh Banga - Student Program Team & R&D.</li>
                                    <li>Salvatore Raieli - Bioinformatics & Immunology AI R&D.</li>
                                    <li>Estela Cabezas - Biotechnology R&D.</li>
                                </ul>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-info-circle fa-fw"></i> ACUTE LYMPHOBLASTIC LEUKEMIA DETECTION SYSTEM 2019
                                <div class="pull-right">
                                    <div class="btn-group">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="col-lg-2"><img src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/Team/Adam-Milton-Barker.jpg" style="width: 100%;"/></div>
                                <div class="col-lg-10">

                                    <p>The Acute Lymphoblastic Leukemia Detection System 2019 is an open source extension of the <a href="https://github.com/GeniSysAI/" traget="_BLANK">GeniSysAI</a> Artificial Intelligence Network that allows you to upload ALL test data and run classifications to detect positive and negative examples.</p>
                                
                                    <p>The AML/ALL Detection System has been developed by Adam Milton-Barker based on two of his previous open source projects, <a href="https://github.com/GeniSysAI/" traget="_BLANK">GeniSysAI</a> & <a href="https://github.com/BreastCancerAI" traget="_BLANK">BreastCancerAI (IDC Classifier)</a>.</p>
                                    
                                    <p>Adam is a <a href="https://www.bigfinite.com" traget="_BLANK">Bigfinite</a> IoT Network Engineer & <a href="https://software.intel.com/en-us/intel-software-innovators" traget="_BLANK">Intel Software Innovator</a> in the fields of AI, IoT & VR.</p>
                                
                                </div>

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
                                <i class="fa fa-info-circle fa-fw"></i> ACUTE LYMPHOBLASTIC LEUKEMIA IMAGE DATABASE FOR IMAGE PROCESSING
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <p><a href="http://www.ijcte.org/vol10/1198-H0012.pdf" target="_BLANK">Leukemia Blood Cell Image Classification Using Convolutional Neural Network</a> by T. T. P. Thanh, Caleb Vununu, Sukhrob Atoev, Suk-Hwan Lee, and Ki-Ryong Kwon proposes a number of data augmentation techniques for use with the <a href="https://homes.di.unimi.it/scotti/all/" target="_BLANK">Acute Lymphoblastic Leukemia Image Database for Image Processing</a> dataset. The AML/ALL Detection System uses augmentation methods from the paper including grayscaling, histogram equalization, horizontal and vertical reflection and gaussian blur. Using these techniques it was possible to increase a dataset from 49 positive and 49 negative images to 683 positive and 683 negative, with more augmentation methods to experiment with.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
        
                        <?php  include dirname(__FILE__) . '/../../GeniSysAI/Language/Includes/console.php'; ?>
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