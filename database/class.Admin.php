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