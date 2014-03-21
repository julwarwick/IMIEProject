<?php

class SkillLevel {
    private $_idSkillLevel;
    private $_skillLevel;
    
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

    public function getSkillLevel() {
        return $this->_skillLevel;
    }

    public function setIdSkillLevel($idSkillLevel) {
        $this->_idSkillLevel = $idSkillLevel;
    }

    public function setSkillLevel($skillLevel) {
        $this->_skillLevel = $skillLevel;
    }

}
