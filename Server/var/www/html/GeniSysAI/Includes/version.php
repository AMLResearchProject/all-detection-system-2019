
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle fa-fw"></i> Server Components
                </div>
                <div class="panel-body">
                    
                    <div class="list-group">
                        <a class="list-group-item">
                            SERVER VERSION <span class="pull-right text-muted small"><em><?=$_GeniSys->_confs['version']; ?></em></span>
                        </a>
                    </div>
                    
                    <div class="list-group">
                        <a class="list-group-item">
                            NLU ENGINE <span class="pull-right text-muted small"><em><?=$_GeniSys->_confs['nluID'] ? "Setup Complete" : "Setup Required"; ?> | <?=$nluEngine && $nluEngine->ResponseData->onlineStatus == "ONLINE" ? "ONLINE" : "OFFLINE"; ?></em></span>
                        </a>
                    </div>
                    
                    <div class="list-group">
                        <a class="list-group-item">
                            ACCESS CAMERA <span class="pull-right text-muted small"><em><?=$_GeniSys->_confs['tassID'] ? "Setup Complete" : "Setup Required"; ?> | <?=$accessCamera && $accessCamera->ResponseData->onlineStatus == "ONLINE" ? "ONLINE" : "OFFLINE"; ?></em></span>
                        </a>
                    </div>
                    
                    <div class="list-group">
                        <a class="list-group-item">
                            FACIAL AUTH <span class="pull-right text-muted small"><em><?=$_GeniSys->_confs['faID'] ? "Setup Complete" : "Setup Required"; ?> | <?=$facialAuth && $facialAuth->ResponseData->onlineStatus == "ONLINE" ? "ONLINE" : "OFFLINE"; ?></em></span>
                        </a>
                    </div>
    
                </div>
            </div>