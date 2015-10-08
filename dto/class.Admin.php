<?php
class Admin {
    // Fields
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $password;

    // Getter
    public function getId(){
        return $this->id;
    }
    public function getFirstname(){
        return htmlentities(utf8_encode($this->firstname), ENT_QUOTES, 'UTF-8');
    }
    public function getLastname(){
        return htmlentities(utf8_encode($this->lastname), ENT_QUOTES, 'UTF-8');
    }
    public function getUsername(){
        return htmlentities(utf8_encode($this->username), ENT_QUOTES, 'UTF-8');
    }
    public function getPassword(){
        $pw = $this->password;
        $this->password = null;
        unset($this->password);
        return $pw;
    }

    // Setter
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    public function setUsername($username){
        $this->username = $username;
    }
}