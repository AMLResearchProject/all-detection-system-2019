<?php 

	class ALL
	{
		private $_GeniSys = null;
		
		function __construct($_GeniSys)
		{
			$this->_GeniSys = $_GeniSys;
		}

		public function updateALLlocalID()
		{
			if(!filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)):
				return [
					"Response"=>"FAILED",
					"ResponseMessage"=>"ALL/ALL Device ID is required!"
				];
			endif;

			$pdoQuery = $this->_GeniSys->_secCon->prepare("
				UPDATE settings
				SET amlID = :amlID 
			");
			$pdoQuery->execute([
				':amlID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT))
			]);
			$pdoQuery->closeCursor();
			$pdoQuery = null;

			return [
				"Response"=>"OK",
				"Redirect"=>"/Extensions/ALL/Settings" 
			];
			
		}

		public function updateALLlocal()
		{   
			if(!filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)):
				return [
					"Response"=>"FAILED",
					"ResponseMessage"=>" Vision iotJumpWay Device is required!"
				];
			endif;

			if(!filter_input(INPUT_POST, 'ALLAddress', FILTER_SANITIZE_STRING)):
				return [
					"Response"=>"FAILED",
					"ResponseMessage"=>"Device stream address is required!"
				];
			endif;

			$pdoQuery = $this->_GeniSys->_secCon->prepare("
				UPDATE settings
				SET amlID = :amlID,
				amlAddress = :ALLAddress 
			");
			$pdoQuery->execute([
				':amlID' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT)),
				':ALLAddress' => $this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'ALLAddress', FILTER_SANITIZE_STRING))
			]);
			$pdoQuery->closeCursor();
			$pdoQuery = null;
			
			if(filter_input(INPUT_POST, 'deviceID', FILTER_SANITIZE_NUMBER_INT) != filter_input(INPUT_POST, 'deviceIDOld', FILTER_SANITIZE_NUMBER_INT)):
					return [
						"Response"=>"OK",
						"Redirect"=>"/Extensions/ALL/Configuration"
					];
			else:
				return [
					"Response"=>"OK"
				];
			endif;
			
		}
		
		private function apiCall($method, $url, $data=[], $contentType, $headers = [])
		{
			if(!$method):
				return [
					"Response"=>"FAILED",
					"ResponseMessage"=>"Method input is required!"
				];
			endif;
			
			if(!$url):
				return [
					"Response"=>"FAILED",
					"ResponseMessage"=>"URL input is required!"
				];
			endif;
			
			if(!$contentType):
				return [
					"Response"=>"FAILED",
					"ResponseMessage"=>"Content-Type input is required!"
				];
			endif;
			
			$curl = curl_init($url);
			
			switch ($method):

				case "POST":

					switch ($contentType):

						case "application/json":
							curl_setopt($curl, CURLOPT_POST, true);
							$data ? curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)) : "";
							break;

						default:
							curl_setopt($curl, CURLOPT_POST, true);
							$data ? curl_setopt($curl, CURLOPT_POSTFIELDS, $data) : "";
							break;

					endswitch;
					break;

				case "PUT":
					$data ? curl_setopt($curl, CURLOPT_PUT, 1) : "";
					break;

				default:
					$url = sprintf("%s?%s", $url, http_build_query($data));
					break;

			endswitch;

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

			$result = curl_exec($curl);
			curl_close($curl);
			return $result;
		}
			
		private function startClassification() 
		{
			$pdoQuery = $this->_GeniSys->_secCon->prepare("
				INSERT INTO aml_classifications (
					`timeStart`
				)  VALUES (
					:timeStart
				)
			");
			$pdoQuery->execute([
				":timeStart" => time()
			]);
			$pdoQuery->closeCursor();
			$pdoQuery = null;

			return $this->_GeniSys->_secCon->lastInsertId();
		}
			
		private function insertClassficationData($classification, $file, $results) 
		{
			$pdoQuery = $this->_GeniSys->_secCon->prepare("
				INSERT INTO aml_classifications_data (
					`classification`,
					`filename`,
					`response`,
					`confidence`
				)  VALUES (
					:classification,
					:filename,
					:response,
					:confidence
				)
			");
			$pdoQuery->execute([
				":classification" => $classification,
				":filename" => $file,
				":response" => $results["aClassification"],
				":confidence" => $results["Confidence"]
			]);
			$pdoQuery->closeCursor();
			$pdoQuery = null;
		}
			
		private function endClassfication($classification, $processed) 
		{
			$pdoQuery = $this->_GeniSys->_secCon->prepare("
				UPDATE aml_classifications
				SET timeEnd = :timeEnd,
				timeTotal = timeEnd - timeStart,
				processed = :processed 
				WHERE id = :id 
			");
			$pdoQuery->execute([
				":timeEnd" => time(),
				":processed" => $processed,
				":id" => $classification
			]);
			$pdoQuery->closeCursor();
			$pdoQuery = null;
		}
			
		public function classify() 
		{
			$results = [];
			$url = $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["amlAddress"])."/Inference";

			$classification = $this->startClassification();

			$file = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
			$response = $this->apiCall("POST", $url, ["file" => new CURLFile($file, "image/jpeg", "ToClassify")], "image/jpeg", []);
			$results["Data"]=json_decode($response, true);
			$results["File"]=$file;

			$this->insertClassficationData($classification, $file, $results["Data"]);
			$this->endClassfication($classification, 1);

			return  [
				"Response"=>"OK",
				"ResponseMessage"=>"Request completed",
				"ResponseData"=>$results
			];
		}
			
		public function classifyMulti() 
		{
			$results = [];
			$url = $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["amlAddress"])."/Inference";

			$classification = $this->startClassification();

			$i=0;
			$testData = glob("Data/Test/*.jpg");
			foreach($testData AS $file):
				$response = $this->apiCall("POST", $url, ["file" => new CURLFile($file, "image/jpeg", "ToClassify")], "image/jpeg", []);
				$results[$i]["Data"]=json_decode($response, true);
				$results[$i]["File"]=$file;
				$this->insertClassficationData($classification, $file, $results[$i]["Data"]);
				$i++;
			endforeach;

			$this->endClassfication($classification, $i);

			return  [
				'Response'=>'OK',
				'ResponseMessage'=>'Request completed',
				'ResponseData'=>$results
			];
		}
			
		public function deletALLData() 
		{
			$testData = glob("Test/*.jpg");
			foreach($testData as $image):
				unlink($_SERVER['DOCUMENT_ROOT'] . "/Extensions/ALL/Data/" . $image);
			endforeach;

			return  [
				'Response'=>'OK',
				'ResponseMessage'=>'Request completed'
			];
		}
	}

$_ALL = new ALL($_GeniSys); 

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="Classify"):
	die(json_encode($_ALL->classify()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="ClassifyMulti"): 
	die(json_encode($_ALL->classifyMulti()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="DeleteALL"):
	die(json_encode($_ALL->deletALLData()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="updateALLdeviceID"):
	die(json_encode($_ALL->updateALLlocalID()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="updatALLdevice"):
	die(json_encode($_ALL->updateALLlocal()));
endif;