
                        
                        <div class="panel panel-default">
                
                            <div class="panel-heading">
                
                                <i class="fa fa-info-circle fa-fw"></i> iotJumpWay Information
                
                            </div>
                            
                            <div class="panel-body">

                                <div class="list-group">
                                    <a class="list-group-item">
                                        LOCATION <span class="pull-right text-muted small"><em><?=$_GeniSys != null ? $_GeniSys->_confs["jumpwayAppID"] != "" ? "#".$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["jumpwayLocation"]) : "Setup Required" : "Setup Required"; ?></em></span>
                                    </a>
                                </div>
                                <div class="list-group">
                                    <a class="list-group-item">
                                        APPLICATION (Core) <span class="pull-right text-muted small"><em><?=$_GeniSys != null ? $_GeniSys->_confs["jumpwayAppID"] != "" ? "#".$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["jumpwayAppID"]) : "Setup Required" : "Setup Required"; ?></em></span>
                                    </a>
                                </div>
                                <div class="list-group">
                                    <a class="list-group-item">
                                        APPLICATION (WebSockets) <span class="pull-right text-muted small"><em><?=$_GeniSys != null ? $_GeniSys->_confs["WSapp"] != "" ? "#".$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["WSapp"]) : "Setup Required" : "Setup Required"; ?></em></span>
                                    </a>
                                </div>                                
                                <div class="list-group">
                                    <a class="list-group-item">
                                        DEVICE <span class="pull-right text-muted small"><em><?=$_GeniSys != null ? $_GeniSys->_confs["jumpwayDevice"] != "" ? "#".$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["jumpwayDevice"]) : "Setup Required" : "Setup Required"; ?></em></span>
                                    </a>
                                </div>
                                
                            </div>

                        </div>