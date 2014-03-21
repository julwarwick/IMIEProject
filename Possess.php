<?php

class Possess {
   private $_idSkillLevel;
   private $_idSkill;
   private $_idUser;
   
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
    
    public function getIdSkillLevel() {
        return $this->_idSkillLevel;
    }

    public function getIdSkill() {
        return $this->_idSkill;
    }

    public function getIdUser() {
        return $this->_idUser;
    }

    public function setIdSkillLevel($idSkillLevel) {
        $this->_idSkillLevel = $idSkillLevel;
    }

    public function setIdSkill($idSkill) {
        $this->_idSkill = $idSkill;
    }

    public function setIdUser($idUser) {
        $this->_idUser = $idUser;
    }
     
}
