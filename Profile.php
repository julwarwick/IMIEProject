<?php

class Profile {
   private $_idProfile;
   private $_nameProfile;
   
   public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }
    
    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
        
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    public function getIdProfile() {
        return $this->_idProfile;
    }

    public function getNameProfile() {
        return $this->_nameProfile;
    }

    public function setIdProfile($idProfile) {
        $this->_idProfile = $idProfile;
    }

    public function setNameProfile($nameProfile) {
        $this->_nameProfile = $nameProfile;
    }

}
