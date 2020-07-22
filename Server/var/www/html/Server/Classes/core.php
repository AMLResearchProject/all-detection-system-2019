<?php 

    class Server
    {
        private $_GeniSys = null;
        
        function __construct($_GeniSys)
        {
            $this->_GeniSys = $_GeniSys;
        }

        public function updateServer() 
        {   
            if(!filter_input(INPUT_POST, 'meta_title', FILTER_SANITIZE_STRING)):

                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Server name is required"
                ];

            endif;

            if(!filter_input(
                INPUT_POST,
                'domainString',
                FILTER_SANITIZE_STRING)):

                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Server URL is required"
                ];

            endif;

            if(!filter_input(
                INPUT_POST,
                'phpmyadmin',
                FILTER_SANITIZE_STRING)):

                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"phpmyadmin endpoint is required"
                ];

            endif;

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE settings
                SET jwUid = :jwUid,
                    jumpwayAPI = :jumpwayAPI,
                    jumpwayLocation = :jumpwayLocation,
                    jumpwayAppID = :jumpwayAppID,
                    JumpWayAppName = :JumpWayAppName,
                    JumpWayAppPublic = :JumpWayAppPublic,
                    JumpWayAppSecret = :JumpWayAppSecret,
                    JumpWayMqttUser = :JumpWayMqttUser,
                    JumpWayMqttPass = :JumpWayMqttPass,
                    JumpWayAppMAC = :JumpWayAppMAC,
                    JumpWayDevice = :JumpWayDevice,
                    JumpWayDeviceName = :JumpWayDeviceName,
                    JumpWayDeviceZone = :JumpWayDeviceZone,
                    JumpWayDeviceMqttUser = :JumpWayDeviceMqttUser,
                    JumpWayDeviceMqttPass = :JumpWayDeviceMqttPass,
                    WSapp = :WSapp,
                    WSMQTTuser = :WSMQTTuser,
                    WSMQTTpass = :WSMQTTpass,
                    WSAppPub = :WSAppPub,
                    WSAppPriv = :WSAppPriv,
                    phpmyadmin = :phpmyadmin,
                    meta_title = :meta_title,
                    domainString = :domainString,
                    apiURL = :apiURL
            ");
            $pdoQuery->execute([
                ':jwUid' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jwUid', FILTER_SANITIZE_NUMBER_INT)),
                ':jumpwayAPI' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jumpwayAPI', FILTER_SANITIZE_STRING)),
                ':jumpwayLocation' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jumpwayLocation', FILTER_SANITIZE_STRING)),
                ':jumpwayAppID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jumpwayAppID', FILTER_SANITIZE_STRING)),
                ':JumpWayAppName' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppName', FILTER_SANITIZE_STRING)),
                ':JumpWayAppPublic' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppPublic', FILTER_SANITIZE_STRING)),
                ':JumpWayAppSecret' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppSecret', FILTER_SANITIZE_STRING)),
                ':JumpWayMqttUser' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayMqttUser', FILTER_SANITIZE_STRING)),
                ':JumpWayMqttPass' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayMqttPass', FILTER_SANITIZE_STRING)),
                ':JumpWayDevice' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDevice', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceName' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceName', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceZone' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceZone', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceMqttUser' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceMqttUser', FILTER_SANITIZE_STRING)),
                ':JumpWayDeviceMqttPass' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayDeviceMqttPass', FILTER_SANITIZE_STRING)),
                ':JumpWayAppMAC' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'JumpWayAppMAC', FILTER_SANITIZE_STRING)),
                ':WSapp' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSapp', FILTER_SANITIZE_STRING)),
                ':WSMQTTuser' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSMQTTuser', FILTER_SANITIZE_STRING)),
                ':WSMQTTpass' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSMQTTpass', FILTER_SANITIZE_STRING)),
                ':WSAppPub' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSAppPub', FILTER_SANITIZE_STRING)),
                ':WSAppPriv' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'WSAppPriv', FILTER_SANITIZE_STRING)),
                ':phpmyadmin' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'phpmyadmin', FILTER_SANITIZE_STRING)),
                ':meta_title' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'meta_title', FILTER_SANITIZE_STRING)),
                ':domainString' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'domainString', FILTER_SANITIZE_STRING)),
                ':apiURL' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'apiURL', FILTER_SANITIZE_STRING))
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;

            return [
                "Response"=>"OK",
                "ResponseMessage"=>"Server settings updated"
            ];
        }

        public function getLogins()
        {
            
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT * 
                FROM logins
                ORDER BY id DESC
            ");
            $pdoQuery->execute();
            $response=$pdoQuery->fetchAll(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            return $response;
        }

        public function getFailedLogins()
        {
            
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT * 
                FROM loginsF
                ORDER BY id DESC
            ");
            $pdoQuery->execute();
            $response=$pdoQuery->fetchAll(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            return $response;
        }

        public function getGateWayVisitors()
        {
            
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT * 
                FROM homeVisitors
                ORDER BY id DESC
            ");
            $pdoQuery->execute();
            $response=$pdoQuery->fetchAll(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            return $response;
        }

        public function getBlockedIPs()
        {
            
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT * 
                FROM bannedIPs
                ORDER BY id DESC
            ");
            $pdoQuery->execute();
            $response=$pdoQuery->fetchAll(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            return $response;
        }

        public function getBlockedVisitors()
        {
            
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT * 
                FROM bannedVisitors
                ORDER BY id DESC
            ");
            $pdoQuery->execute();
            $response=$pdoQuery->fetchAll(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            return $response;
        }
    }

$_Server = new Server($_GeniSys);

if(filter_input(
    INPUT_POST,
    'ftype',
    FILTER_SANITIZE_STRING)=="updateServer"):
        die(json_encode($_Server->updateServer()));
endif;