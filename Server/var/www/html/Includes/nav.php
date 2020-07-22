 
    
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Dashboard"><i class="fa fa-superpowers fa-fw"></i> GeniSysAI IntelliLan Home Network</a>
                    
                </div>
                
                <div class="navbar-right">
                    <span id="date_time"></span>
                </div>
    
                <div class="navbar-default sidebar" id="hideNav" role="navigation">
                    <div class="sidebar-nav navbar-collapse"> 
                        <ul class="nav" id="side-menu"> 
                            <li>
                                <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Dashboard">&nbsp;&nbsp;<i class="fa fa-home fa-fw"></i>&nbsp;Dashboard</a>
                            </li>
                            <li>
                                <a href="#">&nbsp;&nbsp;<i class="fa fa-server fa-fw"></i> Server<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Server/">&nbsp;&nbsp;<i class="fa fa-cogs fa-fw"></i>&nbsp;&nbsp;&nbsp;Server Configuration</a></li>
                                    <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["phpmyadmin"]); ?>/" target="_BLANK">&nbsp;&nbsp;<i class="fa fa-database fa-fw"></i>&nbsp;&nbsp;&nbsp;Server Database</a></li>
                                    <li>    
                                        <a href="#">&nbsp;&nbsp;<i class="fa fa-lock fa-fw"></i>&nbsp;&nbsp;Server Security<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Server/Security/GateWay">&nbsp;&nbsp;<i class="fa fa-minus-circle fa-fw"></i>&nbsp;&nbsp;&nbsp;GateWay</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Server/Security/Logins">&nbsp;&nbsp;<i class="fa fa-sign-in fa-fw"></i>&nbsp;&nbsp;&nbsp;Logins</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Server/Security/Logins-Failed">&nbsp;&nbsp;<i class="fa fa-sign-in fa-fw"></i>&nbsp;&nbsp;&nbsp;Failed Logins</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Server/Security/Blocked">&nbsp;&nbsp;<i class="fa fa-ban fa-fw"></i>&nbsp;&nbsp;&nbsp;Blocked IPs</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Server/Security/Blocked-Attempts">&nbsp;&nbsp;<i class="fa fa-ban fa-fw"></i>&nbsp;&nbsp;&nbsp;Blocked Attempts</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">&nbsp;&nbsp;<i class="fa fa-superpowers fa-fw"></i> GeniSysAI<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">&nbsp;&nbsp;<i class="fa fa-address-card fa-fw"></i>&nbsp;&nbsp; Facial Authentication<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Facial-Auth/">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-cogs"></i> Configuration</a></li> 
                                        </ul>
                                    </li>
                                    <li>    
                                        <a href="#">&nbsp;&nbsp;<i class="fa fa-video-camera fa-fw"></i>&nbsp;&nbsp; Server Camera<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Server-Camera/">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-cogs"></i> Configuration</a></li> 
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">&nbsp;&nbsp;<i class="fa fa-comment fa-fw"></i>&nbsp;&nbsp; NLU Engine<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                             <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Language/">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-cogs"></i> Configuration</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">&nbsp;&nbsp;<i class="fa fa-wifi fa-fw"></i> Smart Home<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/">&nbsp;&nbsp;<i class="fa fa-cogs fa-fw"></i>&nbsp;&nbsp;&nbsp;IoT Configuration</a></li>
                                    <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/Console">&nbsp;&nbsp;<i class="fa fa-terminal fa-fw"></i>&nbsp;&nbsp;IoT Console</a></li>
                                    <li><a href="https://www.iotjumpway.com/console/" target="_BLANK">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i>&nbsp;&nbsp;iotJumpway</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">&nbsp;&nbsp;<i class="fa fa-usb fa-fw"></i> Extensions<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">&nbsp;&nbsp;<i class="fa fa-plus-square fa-fw"></i>&nbsp;&nbsp; ALL Detection System<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> About</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/Configuration">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-cogs"></i> Configuration</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/Data/Augmentation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> Augmentation</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/Data/Testing">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> Test Data</a></li>
                                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Extensions/ALL/Classifier">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> Classifier</a></li>
                                            <li><a href="https://www.facebook.com/AMLResearchProject" target="_BLANK">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> Facebook</a></li>
                                            <li><a href="https://github.com/AMLResearchProject" target="_BLANK">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> Github</a></li>
                                            <li><a href="https://devmesh.intel.com/projects/aml-acute-myeloid-leukemia-detection-system" target="_BLANK">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> DevMesh</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">&nbsp;&nbsp;<i class="fa fa-plus-square fa-fw"></i>&nbsp;&nbsp; IDC Research<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li><a href="https://github.com/BreastCancerAI" target="_BLANK">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> Github</a></li>
                                            <li><a href="https://www.facebook.com/BreastCancerAI" target="_BLANK">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i> Facebook</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/About">&nbsp;&nbsp;<i class="fa fa-info-circle fa-fw"></i>&nbsp;&nbsp;&nbsp;About</a></li> 
                            <li><a href="https://github.com/GeniSysAI/" target="_BLANK">&nbsp;&nbsp;<i class="fa fa-github-square fa-fw"></i>&nbsp;&nbsp;GitHub</a></li>
                            <li><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Logout">&nbsp;&nbsp;<i class="fa fa-power-off fa-fw"></i>&nbsp;&nbsp;&nbsp;Log out</a></li>
                        </ul> 

                    </div> 
                </div>
            </nav>