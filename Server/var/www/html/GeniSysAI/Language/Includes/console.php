

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-commenting-o fa-fw"></i> Server NLU Console
                                <div class="pull-right">
                                    <div class="btn-group"></div>
                                </div>
                            </div>
                            <div class="panel-body">

                                <?php 
                                    if($_GeniSys->_confs["nluID"]): 
                                        if($nluEngine && $nluEngine->ResponseData->onlineStatus == "OFFLINE"):
                                            $geniSysConsole = "hide";
                                            $offlineMessage = "";
                                        elseif($nluEngine && $nluEngine->ResponseData->onlineStatus == "ONLINE"):
                                            $geniSysConsole = "";
                                            $offlineMessage = "hide";
                                        else:
                                            $geniSysConsole = "hide";
                                            $offlineMessage = "";
                                        endif;
                                ?>

                                    <div id="GeniSysChat" style="width: 100%; height: 250px; border: 1px solid #ccc; padding 5px; overflow: hidden; overflow-y: scroll;" class="<?=$geniSysConsole; ?>"></div>

                                    <form role="form" id="nluForm" append="true" appendid="GeniSysChat" class="<?=$geniSysConsole; ?>">

                                        <div class="form-group">
                                            <input type="text" id="humanInput" name="humanInput" class="form-control text-validate" placeholder="Communicate with GeniSysAI">
                                        </div>
                                        <input type="hidden" id="ftype" name="ftype" value="nluInteract" /> 

                                    </form>

                                    <div class="<?=$offlineMessage; ?>">

                                        <p>NLU Engine Offline!</p>
                                        
                                        <p><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Language/"><i class="fa fa-cogs"></i> Settings</a></p>                                            
                                    
                                    </div>

                                <?php 
                                    else:
                                ?>

                                    <p>You need to setup your NLU and iotJumpWay device before you can interact with your GeniSysAI using natural language.</p>

                                <?php 
                                    endif;
                                ?>

                            </div>
                        </div>