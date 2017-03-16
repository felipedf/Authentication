<?php
namespace AppBundle\Entity;

class User {

    protected $loginName;
    protected $passwd;
    
    public function getLoginName() {
        return $this->loginName;
    }

    public function setLoginName($loginName) {
        return $this->loginName = $loginName;
    }
    
    public function getPasswd() {
        return $this->passwd;
    }
    
    public function setPasswd($passwd) {
        return $this->login = $passwd;
    }
    
}