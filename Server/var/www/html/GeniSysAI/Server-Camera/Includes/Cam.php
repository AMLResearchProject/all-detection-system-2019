

                                        <?php 
                                            if($_GeniSys->_confs["tassAddress"]): 
                                                if($accessCamera && $accessCamera->ResponseData->onlineStatus == "OFFLINE"):
                                                    $accessCam = "hide";
                                                    $offlineMessage = "";
                                                elseif($accessCamera && $accessCamera->ResponseData->onlineStatus == "ONLINE"):
                                                    $accessCam = "";
                                                    $offlineMessage = "hide";
                                                else:
                                                    $accessCam = "hide";
                                                    $offlineMessage = "";
                                                endif; 
                                        ?>
                                            <img src="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["tassAddress"]); ?>/<?=time(); ?>.mjpg"  style="width: 100%;" class="<?=$accessCam; ?>" />

                                            <div class="<?=$offlineMessage; ?>">

                                                <p>Local Access Camera Offline!</p>
                                                
                                                <p><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Server-Camera/"><i class="fa fa-cogs"></i> Settings</a></p>                                            
                                            
                                            </div>

                                        <?php else: ?>

                                            <p>You need to setup your <a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Server-Camera/">Local Access Camera device</a> before you can use the GeniSysAI server access camera.</p>
                                                
                                            <p><a href="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["domainString"]); ?>/GeniSysAI/Server-Camera/"><i class="fa fa-cogs"></i> Settings</a></p>
                                            
                                        <?php endif; ?>