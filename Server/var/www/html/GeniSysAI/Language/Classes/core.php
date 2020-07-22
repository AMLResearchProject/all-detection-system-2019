<?php 

    class NLU
    {
        private $_GeniSys = null;
        
        function __construct($_GeniSys)
        {
            $this->_GeniSys = $_GeniSys;
        }

        public function getAIConf()
        {
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT fqdn,
                    ip,
                    port,
                    mac,
                    Activation,
                    Threshold,
                    logsPath,
                    TFLearn_Logs,
                    TFLearn_LogsLevel,
                    TFLearn_ModelPath,
                    TFLearn_ModelInfo,
                    Regression,
                    FcLayers,
                    FcUnits,
                    Epochs,
                    BatchSize,
                    ShowMetric,
                    EntityExtractor,
                    MitieLocation,
                    MitieModelLocation,
                    EntitiesDat,
                    MitieThreshold,
                    deviceLocation,
                    deviceFloor,
                    deviceZone,
                    device,
                    deviceMuser,
                    deviceMpass,
                    deviceName
                FROM nluConfs
            ");
            $pdoQuery->execute();
            $data=$pdoQuery->fetch(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 
            return $data;
        }

        public function updateNLUdeviceID()
        {   
            if(!filter_input(INPUT_POST, 'nluID', FILTER_SANITIZE_NUMBER_INT)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Device ID is required"
                ];
            endif;

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE settings
                SET nluID = :nluID 
            ");
            $pdoQuery->execute([
                ':nluID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT))
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;
                    
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                INSERT INTO nluConfs (
                    `fqdn`,
                    `ip`,
                    `port`,
                    `mac`,
                    `Activation`,
                    `Threshold`,
                    `logsPath`,
                    `TFLearn_Logs`,
                    `TFLearn_LogsLevel`,
                    `TFLearn_ModelPath`,
                    `TFLearn_ModelInfo`,
                    `Regression`,
                    `FcLayers`,
                    `FcUnits`,
                    `Epochs`,
                    `BatchSize`,
                    `ShowMetric`,
                    `EntityExtractor`,
                    `MitieLocation`,
                    `MitieModelLocation`,
                    `EntitiesDat`,
                    `MitieThreshold`,
                    `deviceLocation`,
                    `deviceFloor`,
                    `deviceZone`,
                    `device`,
                    `deviceMuser`,
                    `deviceMpass`,
                    `deviceName`
                )  VALUES (
                    :fqdn,
                    :ip,
                    :port,
                    :mac,
                    :Activation,
                    :Threshold,
                    :logsPath,
                    :TFLearn_Logs,
                    :TFLearn_LogsLevel,
                    :TFLearn_ModelPath,
                    :TFLearn_ModelInfo,
                    :Regression,
                    :FcLayers,
                    :FcUnits,
                    :Epochs,
                    :BatchSize,
                    :ShowMetric,
                    :EntityExtractor,
                    :MitieLocation,
                    :MitieModelLocation,
                    :EntitiesDat,
                    :MitieThreshold,
                    :deviceLocation,
                    :deviceFloor,
                    :deviceZone,
                    :device,
                    :deviceMuser,
                    :deviceMpass,
                    :deviceName
                )
            ");
            $pdoQuery->execute([
                ":fqdn"=>"",
                ":ip"=>"",
                ":port"=>"",
                ":mac"=>"",
                ":Activation"=>"",
                ":Threshold"=>"",
                ":logsPath"=>"",
                ":TFLearn_Logs"=>"",
                ":TFLearn_LogsLevel"=>"",
                ":TFLearn_ModelPath"=>"",
                ":TFLearn_ModelInfo"=>"",
                ":Regression"=>"",
                ":FcLayers"=>"",
                ":FcUnits"=>"",
                ":Epochs"=>"",
                ":BatchSize"=>"",
                ":ShowMetric"=>"",
                ":EntityExtractor"=>"",
                ":MitieLocation"=>"",
                ":MitieModelLocation"=>"",
                ":EntitiesDat"=>"",
                ":MitieThreshold"=>"",
                ":deviceLocation"=>"",
                ":deviceFloor"=>"",
                ":deviceZone"=>"",
                ":device"=>"",
                ":deviceMuser"=>"",
                ":deviceMpass"=>"",
                ":deviceName"=>""
            ]);    

            return [
                "Response"=>"OK",
                "Redirect"=>"/Language/"
            ];
        }

        public function updateNLUdevice()
        {    
            if(!filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device ID is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'deviceLocation', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device location ID is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'deviceZone', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device zone ID is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'fqdn', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU FQDN is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU local IP address is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'port', FILTER_SANITIZE_NUMBER_INT)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU local port is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'mac', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU Mac address is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'Activation', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU activation function is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'Threshold', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU threshold is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'TFLearn_Logs', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU TFlean logs path is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'TFLearn_LogsLevel', FILTER_SANITIZE_NUMBER_INT)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU TFlean logs level is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'TFLearn_ModelPath', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU TFlean model path is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'TFLearn_ModelInfo', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU TFlean model info path is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'Regression', FILTER_VALIDATE_BOOLEAN)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU regression choice is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'EntityExtractor', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU entity extractor is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'MitieLocation', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU Mitie lib location is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'MitieModelLocation', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU Mitie model location is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'EntitiesDat', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU Mitie dat file path is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'MitieThreshold', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"NLU Mitie threshold is required"
                ];
            endif;

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE settings
                SET nluID = :nluID,
                    nluAddress = :nluAddress 
            ");
            $pdoQuery->execute([
                ':nluID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)),
                ':nluAddress' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'fqdn', FILTER_SANITIZE_STRING))
            ]);

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE nluConfs
                SET fqdn = :fqdn,
                    ip = :ip,
                    port = :port,
                    mac = :mac,
                    Activation = :Activation,
                    Threshold = :Threshold,
                    logsPath = :logsPath,
                    TFLearn_Logs = :TFLearn_Logs,
                    TFLearn_LogsLevel = :TFLearn_LogsLevel,
                    TFLearn_ModelPath = :TFLearn_ModelPath,
                    TFLearn_ModelInfo = :TFLearn_ModelInfo,
                    Regression = :Regression,
                    FcLayers = :FcLayers,
                    FcUnits = :FcUnits,
                    Epochs = :Epochs,
                    BatchSize = :BatchSize,
                    ShowMetric = :ShowMetric,
                    EntityExtractor = :EntityExtractor,
                    MitieLocation = :MitieLocation,
                    MitieModelLocation = :MitieModelLocation,
                    EntitiesDat = :EntitiesDat,
                    MitieThreshold = :MitieThreshold,
                    deviceLocation = :deviceLocation,
                    deviceFloor = :deviceFloor,
                    deviceZone = :deviceZone,
                    device = :device,
                    deviceMuser = :deviceMuser,
                    deviceMpass = :deviceMpass,
                    deviceName = :deviceName
            ");
            $pdoQuery->execute([
                ':fqdn' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'fqdn', FILTER_SANITIZE_STRING)),
                ':ip' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING)),
                ':port' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'port', FILTER_SANITIZE_NUMBER_INT)),
                ':mac' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'mac', FILTER_SANITIZE_STRING)),
                ':Activation' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Activation', FILTER_SANITIZE_STRING)),
                ':Threshold' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Threshold', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)),
                ':logsPath' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'logsPath', FILTER_SANITIZE_STRING)),
                ':TFLearn_Logs' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'TFLearn_Logs', FILTER_SANITIZE_STRING)),
                ':TFLearn_LogsLevel' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'TFLearn_LogsLevel', FILTER_SANITIZE_NUMBER_INT)),
                ':TFLearn_ModelPath' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'TFLearn_ModelPath', FILTER_SANITIZE_STRING)),
                ':TFLearn_ModelInfo' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'TFLearn_ModelInfo', FILTER_SANITIZE_STRING)),
                ':Regression' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Regression', FILTER_VALIDATE_BOOLEAN)),
                ':FcLayers' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'FcLayers', FILTER_SANITIZE_NUMBER_INT)),
                ':FcUnits' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'FcUnits', FILTER_SANITIZE_NUMBER_INT)),
                ':Epochs' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Epochs', FILTER_SANITIZE_NUMBER_INT)),
                ':BatchSize' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'BatchSize', FILTER_SANITIZE_NUMBER_INT)),
                ':ShowMetric' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'ShowMetric', FILTER_VALIDATE_BOOLEAN)),
                ':EntityExtractor' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'EntityExtractor', FILTER_SANITIZE_STRING)),
                ':MitieLocation' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'MitieLocation', FILTER_SANITIZE_STRING)),
                ':MitieModelLocation' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'MitieModelLocation', FILTER_SANITIZE_STRING)),
                ':EntitiesDat' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'EntitiesDat', FILTER_SANITIZE_STRING)),
                ':MitieThreshold' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'MitieThreshold', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)),
                ':deviceLocation' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceLocation', FILTER_SANITIZE_STRING)),
                ':deviceFloor' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceFloor', FILTER_SANITIZE_STRING)),
                ':deviceZone' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceZone', FILTER_SANITIZE_STRING)),
                ':device' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_STRING)),
                ':deviceMuser' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceMuser', FILTER_SANITIZE_STRING)),
                ':deviceMpass' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceMpass', FILTER_SANITIZE_STRING)),
                ':deviceName' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceName', FILTER_SANITIZE_STRING))
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            return [
                "Response"=>"OK"
            ];
            
        }
        
        public function talkToNLU()
        {  
            if(!filter_input(INPUT_POST, 'humanInput', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Human input is required"
                ];
            endif;

            $response = $this->_GeniSys->_helpers->apiCall("POST",  $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["nluAddress"])."Infer", ["query" => filter_input(INPUT_POST, 'humanInput', FILTER_SANITIZE_STRING), "uId" => 1], "application/json", [], false);
            
            return $response;
        }
    }

$_NLU = new NLU($_GeniSys); 

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING) == "updateNLUdeviceID"):
    die(json_encode($_NLU->updateNLUdeviceID()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING) == "updateNLUdevice"):
    die(json_encode($_NLU->updateNLUdevice()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING) == "nluInteract"):
    die($_NLU->talkToNLU());
endif;