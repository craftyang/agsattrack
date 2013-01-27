<?php

class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    return intval($user->role) == 1;
  }
 
  // Load user model.
  protected function loadUser($id=null) {
        if($this->_model===null) {
            if($id!==null) {
                $this->_model=User::model()->findByPk($id);
            }
        }
        return $this->_model;
    }
}