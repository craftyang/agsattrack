<?php

class UserIdentity extends CUserIdentity {
    private $_id;

    public function authenticate() {
        
        $record = User::model()->findByAttributes(array('username'=>$this->username));
         
        if ($record === null) {
            $this->errorCode=self::ERROR_USERNAME_INVALID;    
        } else {
            $salt = $record->salt;
            $storedPassword = $record->password;
            $checkPassword =  $salt . sha1($salt . $this->password);   

            if ($checkPassword === $storedPassword) {
                $this->_id=$record->id;
                $this->setState('name', $record->name);
                $this->errorCode=self::ERROR_NONE;                
            } else {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;    
            }
        }

        return !$this->errorCode;
    }

 
    public function getId() {
        return $this->_id;
    }
}