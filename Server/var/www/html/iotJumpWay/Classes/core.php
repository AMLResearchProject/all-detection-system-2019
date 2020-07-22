<?php 

    class iotJumpWay
    {
        private $_GeniSys = null;
        
        function __construct($_GeniSys)
        {
            $this->_GeniSys = $_GeniSys;
        }

        public function updateJumpWay() 
        { 
            if(!filter_input(INPUT_POST, 'jumpwayAPI', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay API URL is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'jumpwayLocation', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay location is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'JumpWayAppID', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay application ID is required"
                ];
            endif;  

            if(!filter_input(INPUT_POST, 'JumpWayAppName', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay application name is required"
                ];
            endif; 

            if(!filter_input(INPUT_POST, 'JumpWayAppPublic', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay public API key is required"
                ];
            endif; 

            if(!filter_input(INPUT_POST, 'JumpWayAppSecret', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay private API key is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'JumpWayAppMAC', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay MQTT device MAC address is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'JumpWayDevice', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device ID is required"
                ];
            endif; 

            if(!filter_input(INPUT_POST, 'JumpWayDeviceName', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device name is required"
                ];
            endif; 

            if(!filter_input(INPUT_POST, 'JumpWayDeviceZone', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device zone is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'JumpWayDeviceMqttUser', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device MQTT user is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'JumpWayDeviceMqttPass', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay device MQTT password is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'WSapp', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay WebSocket App ID is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'WSapp', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay WebSocket App MQTT user is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'WSMQTTpass', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay WebSocket App MQTT password is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'WSAppPub', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay WebSocket App Public key is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'WSAppPriv', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"iotJumpWay WebSocket App Private key is required"
                ];
            endif;

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE settings
                SET jumpwayAPI = :jumpwayAPI,
                    jumpwayLocation = :jumpwayLocation,
                    jumpwayAppID = :jumpwayAppID,
                    JumpWayAppName = :JumpWayAppName,
                    JumpWayAppPublic = :JumpWayAppPublic,
                    JumpWayAppSecret = :JumpWayAppSecret,
                    JumpWayMqttUser = :JumpWayAppMqttUser,
                    JumpWayMqttPass = :JumpWayAppMqttPass,
                    JumpWayAppMAC =:JumpWayAppMAC,
                    JumpWayDevice =:JumpWayDevice,
                    JumpWayDeviceName = :JumpWayDeviceName,
                    JumpWayDeviceZone = :JumpWayDeviceZone,
                    JumpWayDeviceMqttUser = :JumpWayDeviceMqttUser,
                    JumpWayDeviceMqttPass = :JumpWayDeviceMqttPass,
                    WSapp = :WSapp,
                    WSMQTTuser = :WSMQTTuser,
                    WSMQTTpass = :WSMQTTpass,
                    WSAppPub = :WSAppPub,
                    WSAppPriv = :WSAppPriv
                    
            ");
            $pdoQuery->execute([
                ':jumpwayAPI' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jumpwayAPI', FILTER_SANITIZE_STRING)),
                ':jumpwayLocation' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jumpwayLocation', FILTER_SANITIZE_STRING)),
                ':jumpwayAppID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppID', FILTER_SANITIZE_STRING)),
                ':JumpWayAppName' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppName', FILTER_SANITIZE_STRING)),
                ':JumpWayAppPublic' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppPublic', FILTER_SANITIZE_STRING)),
                ':JumpWayAppSecret' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppSecret', FILTER_SANITIZE_STRING)),
                ':JumpWayAppMqttUser' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayMqttUser', FILTER_SANITIZE_STRING)),
                ':JumpWayAppMqttPass' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayMqttPass', FILTER_SANITIZE_STRING)),
                ':JumpWayAppMAC' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppMAC', FILTER_SANITIZE_STRING)),
                ':JumpWayDevice' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDevice', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceName' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceName', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceZone' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceZone', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceMqttUser' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceMqttUser', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceMqttPass' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceMqttPass', FILTER_SANITIZE_STRING)),
                ':WSapp' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSapp', FILTER_SANITIZE_STRING)),
                ':WSMQTTuser' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSMQTTuser', FILTER_SANITIZE_STRING)),
                ':WSMQTTpass' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSMQTTpass', FILTER_SANITIZE_STRING)),
                ':WSAppPub' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSAppPub', FILTER_SANITIZE_STRING)),
                ':WSAppPriv' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSAppPriv', FILTER_SANITIZE_STRING))
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;

            return [
                "Response"=>"OK",
                "ResponseMessage"=>"iotJumpWay settings updated"
            ];
        }
    }

$_iotJumpWay = new iotJumpWay($_GeniSys);

if(filter_input(
    INPUT_POST,
    'ftype',
    FILTER_SANITIZE_STRING)=="updateJumpWay"):
        die(json_encode($_iotJumpWay->updateJumpWay()));
endif; 