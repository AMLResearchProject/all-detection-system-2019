<?php 

    class _GeniSysAiUsers
    {
        private $_GeniSys = null;
        
        function __construct($_GeniSys, $_iotJumpWayApplications)
        {
            $this->_GeniSys = $_GeniSys;
            $this->_iotJumpWayApplications = $_iotJumpWayApplications;
        }

        public function checkBlock()
        {
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT ip 
                FROM bannedIPs 
                Where ip = :ip
                LIMIT 1
            ");
            $pdoQuery->execute([
                ":ip" => $this->_GeniSys->_helpers->getUserIP()
            ]);
            $ip=$pdoQuery->fetch(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            if(isset($ip["ip"])):
                die(header("Location: /Blocked"));
            endif;
        }

        public function checkSession()
        {
            $this->checkBlock();
            if(isset($_SESSION['GeniSysAiApp']['Active']) && $this->_GeniSys->_pageDetails["PageID"]=="Restricted"):
                die(header("Location: /Dashboard"));
            elseif(empty($_SESSION['GeniSysAiApp']['Active']) && $this->_GeniSys->_pageDetails["PageID"]=="Restricted"):
                
            elseif(isset($_SESSION['GeniSysAiApp']['Active']) && $this->_GeniSys->_pageDetails["PageID"]=="Login"):
                die(header("Location: /Dashboard"));
            elseif(empty($_SESSION['GeniSysAiApp']['Active']) && $this->_GeniSys->_pageDetails["PageID"]!="Login"):
                die(header("Location: /Login"));
            endif;
        }

        public function logHomeVisitor(){
                    
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                INSERT INTO homeVisitors (
                    `app`,
                    `ip`,
                    `browser`,
                    `language`,
                    `referrer`,
                    `uri`,
                    `time`
                )  VALUES (
                    :app,
                    :ip,
                    :browser,
                    :language,
                    :referrer,
                    :uri,
                    :time
                )
            ");
            $pdoQuery->execute([
                ':app' => $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAppID"]),
                ':ip' => $this->_GeniSys->_helpers->getUserIP(),
                ':browser' => $_SERVER['HTTP_USER_AGENT'],
                ':language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                ':referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "DIRECT",
                ':uri' => $_SERVER['REQUEST_URI'],
                ':time' => time()
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;
            
            return  [
                'Response'=>'OK',
                'ResponseMessage'=>'IP logged'
            ];

        }

        public function logBannedVisitor(){
                    
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                INSERT INTO bannedVisitors (
                    `app`,
                    `ip`,
                    `browser`,
                    `language`,
                    `referrer`,
                    `uri`,
                    `time`
                )  VALUES (
                    :app,
                    :ip,
                    :browser,
                    :language,
                    :referrer,
                    :uri,
                    :time
                )
            ");
            $pdoQuery->execute([
                ':app' => $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAppID"]),
                ':ip' => $this->_GeniSys->_helpers->getUserIP(),
                ':browser' => $_SERVER['HTTP_USER_AGENT'],
                ':language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                ':referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "DIRECT",
                ':uri' => $_SERVER['REQUEST_URI'],
                ':time' => time()
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;
            
            return  [
                'Response'=>'OK',
                'ResponseMessage'=>'IP logged'
            ];

        }

        public function login() 
        {
            $this->checkBlock();
            $_SESSION["Attempts"] = !isSet($_SESSION["Attempts"]) ? 0 : $_SESSION["Attempts"];
            
            if($this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["JumpWayAppPublic"]) == filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)):
                
                if($this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["JumpWayAppSecret"]) == filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)): session_regenerate_id();
            
                    $_SESSION['GeniSysAiApp']=[
                        "Active"=>true,
                        "AppId"=>$this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAppID"]),
                        "User"=>filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)
                    ];
                    
                    $pdoQuery = $this->_GeniSys->_secCon->prepare("
                        INSERT INTO logins (
                            `app`,
                            `ip`,
                            `browser`,
                            `language`,
                            `time`
                        )  VALUES (
                            :app,
                            :ip,
                            :browser,
                            :language,
                            :time
                        )
                    ");
                    $pdoQuery->execute([
                        ':app' => $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAppID"]),
                        ':ip' => $this->_GeniSys->_helpers->getUserIP(),
                        ':browser' => $_SERVER['HTTP_USER_AGENT'],
                        ':language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                        ':time' => time()
                    ]);
                    $pdoQuery->closeCursor();
                    $pdoQuery = null;

                    return  [
                        'Response'=>'OK',
                        'ResponseMessage'=>'Welcome',
                        'Redirect'=>'/Dashboard'
                    ];
            
                else:
                    
                    $pdoQuery = $this->_GeniSys->_secCon->prepare("
                        INSERT INTO loginsF (
                            `app`,
                            `ip`,
                            `browser`,
                            `language`,
                            `user`,
                            `time`
                        )  VALUES (
                            :app,
                            :ip,
                            :browser,
                            :language,
                            :user,
                            :time
                        )
                    ");
                    $pdoQuery->execute([
                        ':app' => $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAppID"]),
                        ':ip' => $this->_GeniSys->_helpers->getUserIP(),
                        ':browser' => $_SERVER['HTTP_USER_AGENT'],
                        ':language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                        ':user' => filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING),
                        ':time' => time()
                    ]);
                    $pdoQuery->closeCursor();
                    $pdoQuery = null;

                    $_SESSION["Attempts"] += 1;

                    if($_SESSION["Attempts"] >= 3):

                        $_SESSION["Attempts"] = 0;
                    
                        $pdoQuery = $this->_GeniSys->_secCon->prepare("
                            INSERT INTO bannedIPs (
                                `isSys`,
                                `ip`,
                                `timeAt`
                            )  VALUES (
                                :isSys,
                                :ip,
                                :timeAt
                            )
                        ");
                        $pdoQuery->execute([
                            ':isSys' => True,
                            ':ip' => $this->_GeniSys->_helpers->getUserIP(),
                            ':timeAt' => time()
                        ]);
                        $pdoQuery->closeCursor();
                        $pdoQuery = null;
                    
                        return  [
                            'Response'=>'OK',
                            'ResponseMessage'=>'Access Denied!',
                            'Redirect'=>'/Blocked',
                            'Sess'=>$_SESSION["Attempts"]
                        ];

                    endif;
                    
                    return  [
                        'Response'=>'FAILED',
                        'ResponseMessage'=>'Access Denied!',
                            'Sess'=>$_SESSION["Attempts"]
                    ];
                
                endif;
            
            else:
                
                $pdoQuery = $this->_GeniSys->_secCon->prepare("
                    INSERT INTO loginsF (
                        `app`,
                        `ip`,
                        `browser`,
                        `language`,
                        `time`
                    )  VALUES (
                        :app,
                        :ip,
                        :browser,
                        :language,
                        :time
                    )
                ");
                $pdoQuery->execute([
                    ':app' => $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayAppID"]), 
                    ':ip' => $this->_GeniSys->_helpers->getUserIP(),
                    ':browser' => $_SERVER['HTTP_USER_AGENT'],
                    ':language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                    ':time' => time()
                ]);
                $pdoQuery->closeCursor();
                $pdoQuery = null;
                
                return  [
                    'Response'=>'FAILED',
                    'ResponseMessage'=>'Access Denied'
                ];
            
            endif;

        }

        public function getUsers($params=[])
        {
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT * 
                FROM users 
                Where role = :role
            ");
            $pdoQuery->execute([
                ":role" => $params["Type"]
            ]);
            $response=$pdoQuery->fetchAll(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            if(count($response)):
                return  [
                    'Response'=>'OK',
                    'ResponseMessage'=>'Request completed',
                    'ResponseData'=> $response
                ];
            else:
                return  [
                    'Response'=>'FAILED',
                    'ResponseMessage'=>'Request failed'
                ];
            endif;
        }

        public function getUser($params=[])
        {

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT * 
                FROM users 
                WHERE id = :id  
            ");
            $pdoQuery->execute([
                ":id"=>$params['User']
            ]);
            $response=$pdoQuery->fetch(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            if($response["id"]):
                return  [
                    'Response'=>'OK',
                    'ResponseMessage'=>'Request completed',
                    'ResponseData'=> $response
                ];
            else:
                return  [
                    'Response'=>'FAILED',
                    'ResponseMessage'=>'Request failed'
                ];
            endif;
        }

        public function updateUser()
        { 
            if(!filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Person name is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Person username is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Person role is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Person email is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Person phone is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'GeniSysName', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Person GeniSys Name is required"
                ];
            endif;

            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                UPDATE users 
                SET name = :name,
                    username = :username,
                    GeniSysName = :GeniSysName,
                    role = :role,
                    email = :email,
                    phone = :phone,
                    jwAID = :jwAID,
                    jwMC = :jwMC,
                    jwMU = :jwMU,
                    jwMP = :jwMP,
                    lastUpdated = :lastUpdated
                WHERE id = :id  
            ");
            $pdoQuery->execute([
                ":name"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)),
                ":username"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)),
                ":GeniSysName"=>filter_input(INPUT_POST, 'GeniSysName', FILTER_SANITIZE_STRING),
                ":role"=>filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING),
                ":email"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)),
                ":phone"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING)),
                ":jwAID"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jwAID', FILTER_SANITIZE_STRING)),
                ":jwMC"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jwMC', FILTER_SANITIZE_STRING)),
                ":jwMU"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jwMU', FILTER_SANITIZE_STRING)),
                ":jwMP"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'jwMP', FILTER_SANITIZE_STRING)),
                ":lastUpdated"=>time(),
                ":id"=>filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)
            ]);
            $pdoQuery->closeCursor();
            $pdoQuery = null;

            if(isset($_FILES['profile']) && $_FILES['profile']['error'] != UPLOAD_ERR_NO_FILE):
                
                $maxSize = 1000000;
                $validExtensions = ['jpeg','jpg','png','gif'];
                $validTypes = ['image/jpeg', 'image/jpg', 'image/png','image/gif'];
                $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
                $mimetype = mime_content_type($_FILES['profile']['tmp_name']);

                if(!in_array($ext, $validExtensions)):
                    return  [
                        'Response'=>'FAILED',
                        'ResponseMessage'=>'Image upload failed. Invalid image extension'
                    ];
                endif;

                if(!in_array($mimetype, $validTypes)):
                    return  [
                        'Response'=>'FAILED',
                        'ResponseMessage'=>'Image upload failed. Invalid image mime type'
                    ];
                endif;

                $filename =  filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT).".".$ext;
                $file =  "/var/www/html/People/Images".filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING)."/".$filename;
                
                if (move_uploaded_file($_FILES['profile']['tmp_name'], $file)):
                    
                    $url = $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["tassAddress"])."Encode";
                    $response = $this->_GeniSys->_helpers->apiCall("POST", $url, ["file" => new CURLFile($file, "image/jpeg", "ToEncode")], "image/jpeg", []);
                    $encoded = json_decode($response, true);

                    if($encoded["Response"]=="OK"):
                    
                        $pdoQuery = $this->_GeniSys->_secCon->prepare("
                            UPDATE users
                            SET image = :image,
                                imageEnc = :imageEnc,
                                lastUpdated = :lastUpdated,
                            WHERE id = :id  
                        ");
                        $pdoQuery->execute([
                            ":image"=> $filename,
                            ":imageEnc"=>$this->_GeniSys->_helpers->oEncrypt(serialize($encoded["ResponseData"])),
                            ":lastUpdated"=>time(),
                            ":id"=>filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)
                       ]);
                        
                        $pdoQuery->closeCursor();
                        $pdoQuery = null;
                        return  [
                            'Response'=>'OK',
                            'ResponseMessage'=>'Request completed'
                        ];

                    else:
                        return  [
                            'Response'=>'FAILED',
                            'ResponseMessage'=>'File could not be encoded'
                        ];
                    endif;
                    
                    $pdoQuery = $this->_GeniSys->_secCon->prepare("
                        UPDATE users
                        SET image = :image,
                            lastUpdated = :lastUpdated
                        WHERE id = :id  
                    ");
                    $pdoQuery->execute([
                        ":image"=> $filename,
                        ":lastUpdated"=>time(),
                        ":id"=>filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)
                    ]);
                    
                    $pdoQuery->closeCursor();
                    $pdoQuery = null;
                    return  [
                        'Response'=>'OK',
                        'ResponseMessage'=>'Request completed'
                    ];

                else:
                    return  [
                        'Response'=>'FAILED',
                        'ResponseMessage'=>'File could not be uploaded'
                    ];
                endif;

            endif;
            
            return  [
                'Response'=>'OK',
                'ResponseMessage'=>'Request completed'
            ];
        }

        public function addUser()
        { 
            if(!filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Name is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Username is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'GeniSysName', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"GeniSys Name is required, a one word name that GeniSysAI will know you as."
                ];
            endif;
            
            if($this->checkGeniSysName(["GeniSysName" => filter_input(INPUT_POST, 'GeniSysName', FILTER_SANITIZE_STRING)])):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"GeniSys name taken"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Role is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Email is required"
                ];
            endif;

            if(!filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING)):
                return [
                    "Response"=>"FAILED",
                    "ResponseMessage"=>"Phone is required"
                ];
            endif;

            if(isset($_FILES['profile']['name'])):
                
                $maxSize = 1000000;
                $validExtensions = ['jpeg','jpg','png','gif'];
                $validTypes = ['image/jpeg', 'image/jpg', 'image/png','image/gif'];
                $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
                $mimetype = mime_content_type($_FILES['profile']['tmp_name']);

                if(!in_array($ext, $validExtensions)):
                    return  [
                        'Response'=>'FAILED',
                        'ResponseMessage'=>'Invalid image extension'
                    ];
                endif;

                if(!in_array($mimetype, $validTypes)):
                    return  [
                        'Response'=>'FAILED',
                        'ResponseMessage'=>'Invalid image mime type'
                    ];
                endif;
                    
                $pdoQuery = $this->_GeniSys->_secCon->prepare("
                    INSERT INTO users (
                        `isAdm`,
                        `name`,
                        `username`,
                        `GeniSysName`,
                        `role`,
                        `email`,
                        `phone`,
                        `image`,
                        `imageEnc`,
                        `lastUpdated`,
                        `jwAID`,
                        `jwMU`,
                        `jwMP`,
                        `jwAK`,
                        `jwAS`
                    )  VALUES (
                        :isAdm,
                        :name,
                        :username,
                        :GeniSysName,
                        :role,
                        :email,
                        :phone,
                        :image,
                        :imageEnc,
                        :lastUpdated,
                        :jwAID,
                        :jwMU,
                        :jwMP,
                        :jwAK,
                        :jwAS
                    )
                ");
                $pdoQuery->execute([
                    ":isAdm"=>filter_input(INPUT_POST, 'isAdm', FILTER_SANITIZE_NUMBER_INT),
                    ":name"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)),
                    ":username"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)),
                    ":GeniSysName"=>filter_input(INPUT_POST, 'GeniSysName', FILTER_SANITIZE_STRING),
                    ":role"=>filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING),
                    ":email"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)),
                    ":phone"=>$this->_GeniSys->_helpers->oEncrypt(filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING)),
                    ":image"=>"",
                    ":imageEnc"=>"",
                    ':lastUpdated' => time(),
                    ":jwAID"=>"",
                    ":jwMU"=>"",
                    ":jwMP"=>"",
                    ":jwAK"=>"",
                    ":jwAS"=>""
                ]);
                $user = $this->_GeniSys->_secCon->lastInsertId();

                $filename =  $user.".".$ext;
                $file =  "/var/www/html/People/Images/".filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING)."/".$filename;
                
                if (move_uploaded_file($_FILES['profile']['tmp_name'], $file)):
                    
                    $url = $this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["faAddress"])."Encode";
                    $response = $this->_GeniSys->_helpers->apiCall("POST", $url, ["file" => new CURLFile($file, "image/jpeg", "ToEncode")], "image/jpeg", []);
                    $encoded = json_decode($response, true);

                    if($encoded["Response"]=="OK"):
                        
                        $userApp = $this->_iotJumpWayApplications->createApplication([
                            "AccId"=>$this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jwUid"]),
                            "Location"=>$this->_GeniSys->_helpers->oDecrypt($this->_GeniSys->_confs["jumpwayLocation"])
                        ]);

                        if($userApp["Response"] == "OK"):
                    
                            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                                UPDATE users
                                SET image = :image,
                                    imageEnc = :imageEnc,
                                    lastUpdated = :lastUpdated,
                                    jwAID = :jwAID,
                                    jwMU = :jwMU,
                                    jwMP = :jwMP,
                                    jwAK = :jwAK,
                                    jwAS = :jwAS
                                WHERE id = :id  
                            ");
                            $pdoQuery->execute([
                                ":image"=> $filename,
                                ":imageEnc"=>$this->_GeniSys->_helpers->oEncrypt(serialize($encoded["Data"])),
                                ":lastUpdated"=>time(),
                                ":jwAID"=>$this->_GeniSys->_helpers->oEncrypt($userApp["ResponseMA"]),
                                ":jwMU"=>$this->_GeniSys->_helpers->oEncrypt($userApp["ResponseMU"]),
                                ":jwMP"=>$this->_GeniSys->_helpers->oEncrypt($userApp["ResponseMP"]),
                                ":jwAK"=>$this->_GeniSys->_helpers->oEncrypt($userApp["ResponseApiKey"]),
                                ":jwAS"=>$this->_GeniSys->_helpers->oEncrypt($userApp["ResponseApiSec"]),
                                ":id"=>$user
                            ]);
                            
                            $pdoQuery->closeCursor();
                            $pdoQuery = null;
                            return  [
                                'Response'=>'OK',
                                'ResponseMessage'=>'Request completed',
                                'Redirect'=>$user
                            ];
                        
                        else:
                            return  [
                                'Response'=>'FAILED',
                                'ResponseMessage'=>'Could not create iotJumpWay application'
                            ];
                        endif;

                    else:
                        return  [
                            'Response'=>'FAILED',
                            'ResponseMessage'=>'File could not be encoded'
                        ];
                    endif;

                else:
                    return  [
                        'Response'=>'FAILED',
                        'ResponseMessage'=>'File could not be uploaded'
                    ];
                endif;

            else:
                return  [
                    'Response'=>'FAILED',
                    'ResponseMessage'=>'File does not exist'
                ];
            endif;

            return  [
                'Response'=>'FAILED',
                'ResponseMessage'=>'Request failed with unknown reason'
            ];
        }

        public function checkGeniSysName($params = [])
        {
            $pdoQuery = $this->_GeniSys->_secCon->prepare("
                SELECT GeniSysName  
                FROM users 
                WHERE GeniSysName = :GeniSysName  
            ");
            $pdoQuery->execute([
                ":GeniSysName"=>$params['GeniSysName']
            ]);
            $response=$pdoQuery->fetch(PDO::FETCH_ASSOC);
            $pdoQuery->closeCursor();
            $pdoQuery = null; 

            if($response["GeniSysName"]):
                return True;
            else:
                return False;
            endif;
            
        }
    }

$_GeniSysAiUsers = new _GeniSysAiUsers($_GeniSys, $_iotJumpWayApplications);

if(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING)):
    die(json_encode($_GeniSysAiUsers->login()));
endif;

if(filter_input(INPUT_POST, 'ftype', FILTER_SANITIZE_STRING)=="updateUser"):
    die(json_encode($_GeniSysAiUsers->updateUser()));
endif; 