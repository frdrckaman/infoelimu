<?php 
class User {
	private $_db,
	        $_data,
            $_getdata,
	        $_sessionName,
            $_sessionTableName,
            $_sessionTable,
	        $_cookieName,
            $_sms;
	        public $isLoggedIn;

	public function __construct($user = null){
      $this->_db = DB::getInstance();
      $this->_sessionName = config::get('session/session_name');
        $this->_sessionTable = config::get('session/session_table');
      $this->_cookieName = config::get('remember/cookie_name');

      if(!$user){
        if(Session::exists($this->_sessionName)){
         $user = Session::get($this->_sessionName);
            $this->_sessionTableName = Session::getTable($this->_sessionTable);
        if($this->findUser($user,$this->_sessionTableName)){
          $this->isLoggedIn = true;
        } else {

           }
        }
      } else {
      	$this->find($user);
      }
	}
    public function getSessionTable(){
        return $this->_sessionTableName;
    }

public function update($fields = array(),$id = null){
	
if(!$id && $this->isLoggedIn()){
$id = $this->data()->id;
}
	if(!$this->_db->update('tamongsco',$id,$fields)){
		throw new Exception('There is problem updating');
	}

}
    public function updateRecord($table,$fields=array(),$id = null){
        if(!$id && $this->isLoggedIn()){
            $id = $this->data()->id;
        }
        if(!$this->_db->update($table,$id,$fields)){
            throw new Exception('There is problem updating');
        }
    }

    public function deleteRecord($table,$field,$value){
        if(!$this->_db->delete($table, array($field, '=', $value))){
            throw new Exception('There is problem deleting');
        }
    }

    public function sendSMS($to,$textMessage){
        if ($to <> '') {
            $from = 'Info-Elimu';
            $messageId = null;
            $text = $textMessage;
            $notifyUrl = null;
            $notifyContentType = null;
            $callbackData = null;
            $username = 'infoelimu';
            $password = 'viSH1#5*';

            $postUrl = "https://api.infobip.com/sms/1/text/advanced";

            // creating an object for sending SMS
            $destination = array("messageId" => $messageId,
                "to" => $to);

            $message = array("from" => $from,
                "destinations" => array($destination),
                "text" => $text,
                "notifyUrl" => $notifyUrl,
                "notifyContentType" => $notifyContentType,
                "callbackData" => $callbackData);

            $postData = array("messages" => array($message));
            $postDataJson = json_encode($postData);

            $ch = curl_init();
            $header = array("Content-Type:application/json", "Accept:application/json");

            curl_setopt($ch, CURLOPT_URL, $postUrl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // response of the POST request
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $responseBody = json_decode($response);
            curl_close($ch);
            if ($httpCode >= 200 && $httpCode < 300) {

            }
        }
    }

    public function validateBundle($message,$noUser,$bundleId){
        $noWords = $this->countWords($message,$noUser);
        if($noWords <= $this->checkBundle($bundleId)[0]['sms']){
            return true;
        }
    }
    public function countWords($message,$noUser){
        return ceil((mb_strlen($message))/160) * $noUser;
    }
    public function checkBundle($id){
        $sms = $this->_db->getValue('bundle_usage','id',$id);
        return $sms;
    }
    public function countSms($message){
        return ceil((mb_strlen($message))/160);
    }
    public function grade($score){
        $grade = null;
        switch($score){
            case $score >= 81.0 && $score <= 100:
                $grade = 'A';
                break;
            case $score >= 61.0 && $score <= 80.9:
                $grade = 'B';
                break;
            case $score >= 41.0 && $score <= 60.9:
                $grade = 'C';
                break;
            case $score >= 21.0 && $score <= 40.9:
                $grade = 'D';
                break;
            case $score >= 0 && $score <= 20.9:
                $grade = 'F';
                break;
        }
        return $grade;
    }
    public function gradeO($score){
        $grade = null;
        switch($score){
            case $score >= 75.0 && $score <= 100:
                $grade = 'A';
                break;
            case $score >= 65.0 && $score <= 74.9:
                $grade = 'B';
                break;
            case $score >= 45.0 && $score <= 64.9:
                $grade = 'C';
                break;
            case $score >= 30.0 && $score <= 44.9:
                $grade = 'D';
                break;
            case $score >= 0 && $score <= 29.9:
                $grade = 'F';
                break;
        }
        return $grade;
    }
    public function gradeA($score){
        $grade = null;
        switch($score){
            case $score >= 80.0 && $score <= 100:
                $grade = 'A';
                break;
            case $score >= 70.0 && $score <= 79.9:
                $grade = 'B';
                break;
            case $score >= 60.0 && $score <= 69.9:
                $grade = 'C';
                break;
            case $score >= 50.0 && $score <= 59.9:
                $grade = 'D';
                break;
            case $score >= 49.0 && $score <= 49.9:
                $grade = 'E';
                break;
            case $score >= 35.0 && $score <= 39.9:
                $grade = 'S';
                break;
            case $score >= 0 && $score <= 34.9:
                $grade = 'F';
                break;
        }
        return $grade;
    }

    public function updateSubject($table,$fields=array(),$id = null){
        if(!$id && $this->isLoggedIn()){
            $id = $this->data()->id;
        }
        if(!$this->_db->updateSubject($table,$id,$fields)){
            throw new Exception('There is problem updating');
        }
    }

	public function create($fields = array()){
     if(!$this->_db->insert('tamongsco',$fields)){
     	throw new Exception('There is a problem creating Account');
     }
	}
    public function createRecord($table,$fields = array()){
        if(!$this->_db->insert($table,$fields)){
            throw new Exception('There is a problem creating Account');
        }return true;
    }
	
	public function find($user = null){
      if($user){
        $field = (is_numeric($user)) ? 'id' : 'email';
        $data = $this->_db->get('tamongsco',array($field,'=',$user));

        if($data->count()){
        	$this->_data=$data->first();
         return true;
        }
      }
	}
    public function findUser($user = null,$table){
        if($user){
            $field = (is_numeric($user)) ? 'id' : 'email_address';
            $data = $this->_db->get($table,array($field,'=',$user));

            if($data->count()){
                $this->_data=$data->first();
                return true;
            }
        }
    }

    public function loginUser($username=null,$password=null,$table){
        if(!$username && !$password && $this->exists()){
            Session::put($this->_sessionName,$this->data()->id);
        } else {
            $userId = $this->_db->get($table,array('phone_number','=',$username));
            //print_r($userId->first()->id);
            $user = $this->findUser($userId->first()->id,$table);
            if($user){
                if($this->data()->password === Hash::make($password,$this->data()->salt)){
                    Session::put($this->_sessionName,$this->data()->id);
                    Session::putSession($this->_sessionTable,$table);
                    return true;
                }
            }
        }
        return false;
    }

  public function login($username=null,$password=null,$remember = false){
   
    if(!$username && !$password && $this->exists()){
    Session::put($this->_sessionName,$this->data()->id);
    } else {
    	 $user = $this->find($username);
   if($user){
   	if($this->data()->password === Hash::make($password,$this->data()->salt)){
       Session::put($this->_sessionName,$this->data()->id);
       if($remember){
         $hash = Hash::unique();
         $hashCheck = $this->_db->get('user_session',array('user_id','=',$this->data()->id));

         if(!$hashCheck->count()){
           $this->_db->insert('user_session' ,array(
              'user_id' => $this->data()->id,
              'hash' =>$hash
           	));
         }else {
         	$hash = $hashCheck->first()->hash;
         }
         Cookie::put($this->_cookieName,$hash,config::get('remember/cookie_expiry'));
       }
       return true;
   	}
   }
}
    return false;  	  	   
  }

  public function exists(){
  	return (!empty($this->_data)) ? true : false;
  }
  public function logout(){

  	$this->_db->delete('user_session', array('user_id', '=', $this->data()->id));

  	Session::delete($this->_sessionName);
  	Cookie::delete($this->_cookieName);
  }
  public function data(){
  	return $this->_data;
  }
    public function sms(){
        return $this->_sms;
    }
  public function isLoggedIn(){
  	return $this->isLoggedIn;
  }
    public function selectAll($table){
       if($result = $this->_db->getAll($table)){
           $this->_getdata = $result;
       } else throw new Exception('There is a problem getting the values');
    }
    public function getData(){
        return $this->_getdata;
    }
  public function getInfo($table){
      $override = new OverideData();
      return $override->getData($table);
  }
}