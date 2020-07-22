<?php 

    class iotJumpWayDevices
    {
        private $_GeniSys = null;
        
        function __construct($_GeniSys)
        {
            $this->_GeniSys = $_GeniSys;
        }
        
        private function apiCall($method, $endpoint, $data)
        {
            $curl = curl_init();
            $url  = $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAPI"])."/REST/".$endpoint;
            switch ($method):

                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);
                    $data ? curl_setopt($curl, CURLOPT_POSTFIELDS, $data) : "";
                    break;

                case "PUT":
                    $data ? curl_setopt($curl, CURLOPT_PUT, 1) : "";
                    break;

                default:
                    $url = sprintf("%s?%s", $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAPI"])."/REST/".$endpoint, http_build_query($data));

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

        public function getDeviceList() 
        {
            return json_decode($this->apiCall("POST","Devices/0_1_0/getDevices",[]));
        }

        public function getDevice($device) 
        {
            return json_decode($this->apiCall("POST","Devices/0_1_0/getDevice",[
                "Device" => $device
            ]));
        }

        public function createDevice($params = []) 
        {
            return json_decode($this->apiCall("POST","Devices/0_1_0/createDevice", $params));
        }

        public function getDevices($params = []) 
        {

            foreach($params->ResponseData AS $key => $array):                
                    
                $pdoQuery = $this->_GeniSys->_secCon->prepare("
                    INSERT INTO devices (
                        `jwId`,
                        `dName`,
                        `jwLcn`,
                        `jwZn`,
                        `added`,
                        `updated`
                    )  VALUES (
                        :jwId,
                        :dName,
                        :jwLcn,
                        :jwZn,
                        :added,
                        :updated
                    )
                ");
                $pdoQuery->execute([
                    ":jwId"=> $array->id,
                    ":dName"=>$array->device,
                    ":jwLcn"=>$this->_GeniSys->_helpers->oEncrypt($array->lcnid),
                    ":jwZn"=>$this->_GeniSys->_helpers->oEncrypt($array->zneid),
                    ":added"=>time(),
                    ":updated"=>time()
                ]);

            endforeach;

            print_r("DONE MOFO");
        }
    }


$_iotJumpWayDevices = new iotJumpWayDevices($_GeniSys);