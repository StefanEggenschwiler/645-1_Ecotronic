<?php
class Admin

{
    private $id;
    private $firstname;
    private $lastname;
    private $username;

    public function __construct($id, $firstname, $lastname, $username)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
    }

    //getter
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

    //setter
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