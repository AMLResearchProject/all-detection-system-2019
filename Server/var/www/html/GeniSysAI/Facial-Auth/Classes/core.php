<?php 

    class FacialAuth
    {
        private $_GeniSys = null;
        
        function __construct($_GeniSys)
        {
            $this->_GeniSys = $_GeniSys;
        }

        public function getAuthConfs()
        {
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT *
                FROM authConfs
            ");
            $pdoQuery->execute();
            $data=$pdoQuery->fetch(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 
            return $data;
        }

        public function updateFALocalID()
        {   
            if(!filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Device ID is required!"
                ];
            endif;

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE settings
                SET faID = :faID 
            ");
            $pdoQuery->execute([
                ':faID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT))
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;
                    
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                INSERT INTO accessConfs (
                    `id`,
                    `jid`,
                    `jdn`,
                    `jdl`,
                    `jdf`,
                    `jdz`,
                    `jdmu`,
                    `jdmp`,
                    `API`,
                    `MAC`,
                    `IP`,
                    `Port`,
                    `Graph`,
                    `Dlib`,
                    `TestingPath`,
                    `ValidPath`,
                    `Threshold`
                )  VALUES (
                    :id,
                    :jid,
                    :jdn,
                    :jdl,
                    :jdf,
                    :jdz,
                    :jdmu,
                    :jdmp,
                    :API,
                    :MAC,
                    :IP,
                    :Port,
                    :Graph,
                    :Dlib,
                    :TestingPath,
                    :ValidPath,
                    :Threshold
                )
            ");
            $pdoQuery->execute([
                ":id"=>1,
                ":jid"=>"",
                ":jdn"=>"",
                ":jdl"=>"",
                ":jdf"=>"",
                ":jdz"=>"",
                ":jdmu"=>"",
                ":jdmp"=>"",
                ":API"=>"",
                ":MAC"=>"",
                ":IP"=>"",
                ":Port"=>"",
                ":Graph"=>"",
                ":Dlib"=>"",
                ":TestingPath"=>"",
                ":ValidPath"=>"",
                ":Threshold"=>""
            ]);

            return [
                "Response"=>"OK",
                "Redirect"=>"/GeniSysAI/Facial-Auth/"
            ];
            
        }

        public function updateFALocal()
        {   
            if(!filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Device ID is required!"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'API', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Device stream address is required!"
                ];
            endif;

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE settings
                SET faID = :faID,
                faAddress = :faAddress 
            ");
            $pdoQuery->execute([
                ':faID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)),
                ':faAddress' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'API', FILTER_SANITIZE_STRING))
            ]);

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE authConfs
                SET jid = :jid,
                    jdn = :jdn,
                    jdl = :jdl,
                    jdf = :jdf,
                    jdz = :jdz,
                    jdmu = :jdmu,
                    jdmp = :jdmp,
                    API = :API,
                    NetworkPath = :NetworkPath,
                    MAC = :MAC,
                    IP = :IP,
                    Port = :Port,
                    Graph = :Graph,
                    Dlib = :Dlib,
                    TestingPath = :TestingPath,
                    ValidPath = :ValidPath,
                    Threshold = :Threshold
            ");
            $pdoQuery->execute([
                ':jid' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)),
                ':jdn' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jdn', FILTER_SANITIZE_STRING)),
                ':jdl' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jdl', FILTER_SANITIZE_NUMBER_INT)),
                ':jdf' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jdf', FILTER_SANITIZE_NUMBER_INT)),
                ':jdz' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jdz', FILTER_SANITIZE_NUMBER_INT)),
                ':jdmu' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jdmu', FILTER_SANITIZE_STRING)),
                ':jdmp' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jdmp', FILTER_SANITIZE_STRING)),
                ':API' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'API', FILTER_SANITIZE_STRING)),
                ':NetworkPath' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'NetworkPath', FILTER_SANITIZE_STRING)),
                ':MAC' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'MAC', FILTER_SANITIZE_STRING)),
                ':IP' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'IP', FILTER_SANITIZE_STRING)),
                ':Port' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Port', FILTER_SANITIZE_STRING)),
                ':Graph' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Graph', FILTER_SANITIZE_STRING)),
                ':Dlib' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Dlib', FILTER_SANITIZE_STRING)),
                ':TestingPath' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'TestingPath', FILTER_SANITIZE_STRING)),
                ':ValidPath' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'ValidPath', FILTER_SANITIZE_STRING)),
                ':Threshold' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'Threshold', FILTER_SANITIZE_STRING))
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;
            
            if(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT) != filter_input(INPUT_POST, 'deviceIDOld', FILTER_SANITIZE_NUMBER_INT)):
                    return [
                        "Response"=>"OK",
                        "Redirect"=>"/GeniSysAI/Facial-Auth/"
                    ];
            else:
                return [
                    "Response"=>"OK"
                ];
            endif;
            
        }
        
        private function apiCall($method, $endpoint, $data=[], $contentType, $noSecurity = true)
        {
            if(!$method):

                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Method input is required!"
                ];

            endif;
            if(!$endpoint):

                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Endpoint input is required!"
                ];

            endif;

            $url  = $this->_GeniSys->_confs['nluAddress'].$endpoint;
            $curl = curl_init($url);

            switch ($noSecurity):

                case true:

                    $headers = [
                        "Content-Type: ".$contentType,
                        "Content-Length: ".strlen(json_encode($data))
                    ];
                    break;

                default:

                    $headers = [
                        "Content-Type: ".$contentType,
                        "Content-Length: ".strlen(json_encode($data)),
                        "Authorization: Basic ". base64_encode(
                            $this->_GeniSys->_app.":".$this->_GeniSys->_helpers->createHMAC(
                                [$this->_GeniSys->_auth]))
                    ];
                    break;

            endswitch;
            
            switch ($method):

                case "POST":

                    switch ($contentType):

                        case "application/json":

                            curl_setopt($curl, CURLOPT_POST, 1);
                            $data ? curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)) : "";
                            break;

                        default:

                            curl_setopt($curl, CURLOPT_POST, 1);
                            $data ? curl_setopt($curl, CURLOPT_POSTFIELDS, $data) : "";
                            break;

                    endswitch;
                    break;

                case "PUT":
                    $data ? curl_setopt($curl, CURLOPT_PUT, 1) : "";
                    break;

                default:
                    $url = sprintf("%s?%s", $this->_GeniSys->_confs['nluAddress'].$endpoint, http_build_query($data));
                    break;

            endswitch;

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
    }

$_FacialAuth = new FacialAuth($_GeniSys); 

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="updateFALocalID"):
        die(json_encode($_FacialAuth->updateFALocalID()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="updateFAlocal"):
        die(json_encode($_FacialAuth->updateFALocal()));
endif;