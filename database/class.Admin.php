<?php
class Admin

{
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $password;

    public function __construct($id, $firstname, $lastname, $username, $password)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
    }

    //getter
    public function getId(){
        return $this->firstname;
    }
    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->firstname;
    }
    public function getUsername(){
        return $this->firstname;
    }
    public function getPassword(){
        return $this->firstname;
    }

    //setter
    public function setId($id){
        $this->id = $id;
    }
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function setPassword($password){
        $this->password = $password;
    }
}