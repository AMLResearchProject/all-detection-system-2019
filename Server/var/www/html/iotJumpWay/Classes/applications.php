<?php 

    class iotJumpWayApplications
    {
        private $_GeniSys = null;
        
        function __construct($_GeniSys)
        {
            $this->_GeniSys = $_GeniSys;
        }
        
        private function apiCall($method, $endpoint, $data)
        {
            $curl = curl_init();
            $url  = $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAPI"])."/API/REST/".$endpoint;

            switch ($method):
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);
                    $data ? curl_setopt($curl, CURLOPT_POSTFIELDS, $data) : "";
                    break;
                case "PUT":
                    $data ? curl_setopt($curl, CURLOPT_PUT, 1) : "";
                    break;
                default:
                    $url = sprintf("%s?%s", $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAPI"])."/API/REST/".$endpoint, http_build_query($data));
            endswitch;

			$secret = $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["JumpWayAppSecret"]);
			$secretHash = $this->_GeniSys->_helpers->createHMAC([$secret],$secret);
            
            $headers = [
                'Authorization: Basic '. base64_encode($this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAppID"]).":".$secretHash)
            ];

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }

        public function getApplicationsList() 
        {
            return json_decode($this->apiCall("POST","Applications/0_1_0/getApplications",[]));
        }

        public function getApplication($Application) 
        {
            return json_decode($this->apiCall("POST","Applications/0_1_0/getApplication",[
                "Application" => $Application
            ]));
        }

        public function createApplication($data = []) 
        {
            return json_decode($this->apiCall("POST","Applications/0_1_0/createApplication", $data), True);
        }
    }


$_iotJumpWayApplications = new iotJumpWayApplications($_GeniSys);