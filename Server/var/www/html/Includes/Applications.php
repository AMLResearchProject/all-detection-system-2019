
                    
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-superpowers fa-fw"></i> Server Network Applications
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">

                                <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/Server/" class="coreButtons">
                                    <div>
                                        <i class="fa fa-server fa-4x"></i><br />
                                        <strong>Server</strong>
                                    </div>
                                </a>
                                <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/<?=$_GeniSys->_confs["phpmyadmin"]; ?>" class="coreButtons" target="_BLANK">
                                    <div>
                                        <i class="fa fa-database fa-4x"></i><br />
                                        <strong>Database</strong>
                                    </div>
                                </a>
                                <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/iotJumpWay/" class="coreButtons">
                                    <div>
                                        <i class="fa fa-th fa-4x"></i><br />
                                        <strong>iotJumpWay</strong>
                                    </div>
                                </a>
                                <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Facial-Auth/" class="coreButtons">
                                    <div>
                                        <i class="fa fa-address-card fa-4x"></i><br />
                                        <strong>Facial Auth</strong>
                                    </div>
                                </a>
                                <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Server-Camera/" class="coreButtons">
                                    <div>
                                        <i class="fa fa-video-camera fa-4x"></i><br />
                                        <strong>Server Camera</strong>
                                    </div>
                                </a>  
                                <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Language/" class="coreButtons">
                                    <div>
                                        <i class="fa fa-comment fa-4x"></i><br />
                                        <strong>Language</strong>
                                    </div>
                                </a> 

                            </div>
                        </div>