<?php session_start();

$pageDetails = [
    "PageID" => "Login"
];

include dirname(__FILE__) . '/../Classes/Core/init.php';

include dirname(__FILE__) . '/Server/Classes/core.php';

include dirname(__FILE__) . '/GeniSysAI/Language/Classes/core.php';

include dirname(__FILE__) . '/iotJumpWay/Classes/core.php';
include dirname(__FILE__) . '/iotJumpWay/Classes/applications.php';

include dirname(__FILE__) . '/People/Classes/core.php';

$_GeniSysAiUsers->checkSession();

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
        <meta name="description" content="The GeniSysAI network is an open source Artificial Intelligence Assistant Network of Computer Vision, Natural Linguistics, Internet of Things devices and applications to create an automated, intelligent smart home.">
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
        </style>

    </head>
    <body>
    
        <div id="wrapper">

            <div class="container">

                <div class="row">

                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sign In To GeniSysAI Network</h3>
                            </div>
                            <div class="panel-body">

                                <form role="form" id="Login">
                                    <fieldset>
                                        <div class="form-group">
                                            <input id="username" type="name" class="form-control username-validate" name="username" placeholder="App Public Key" value="" >
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control password-validate" name="password" placeholder="App Private Key" value="" autocomplete="false">
                                            <input id="login" type="hidden" class="" name="login" value="1">
                                        </div>
                                        <a id="formSubmit" class="btn btn-lg btn-success btn-block">Login</a>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php  include dirname(__FILE__) . '/Includes/FrontScripts.php'; ?>
 
    </body>

</html> 