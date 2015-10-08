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
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function getUsername(){
        return $this->username;
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