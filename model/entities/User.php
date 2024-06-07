<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id;
    private $nickName;
    private $mail;
    private $password;
    private $accountDate;
    private $role;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nickName
     */ 
    public function getNickName(){
        return $this->nickName;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */ 
    public function setNickName($nickName){
        $this->nickName = $nickName;

        return $this;
    }

    public function __toString() {
        return $this->nickName;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail(){
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail){
        $this->mail = $mail;
        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(){
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of accountDate
     */ 
    public function getaccountDate(){
        return $this->accountDate;
    }

    /**
     * Set the value of accountDate
     *
     * @return  self
     */ 
    public function setaccountDate($accountDate){
        $this->accountDate = $accountDate;
        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole(){
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;
        return $this;
    }



}