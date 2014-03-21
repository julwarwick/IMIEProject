<?php

class Skill {
    private $_idSkill;
    private $_nameSkill;
    private $_idSkillParent;
    private $_dateSubmitSkill;
    private $_validatedSubmitSkill;
    private $_idSubmitUser;
    
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
    
    public function getIdSkill() {
        return $this->_idSkill;
    }

    public function getNameSkill() {
        return $this->_nameSkill;
    }

    public function getIdSkillParent() {
        return $this->_idSkillParent;
    }

    public function getDateSubmitSkill() {
        return $this->_dateSubmitSkill;
    }

    public function getValidatedSubmitSkill() {
        return $this->_validatedSubmitSkill;
    }

    public function getIdSubmitUser() {
        return $this->_idSubmitUser;
    }

    public function setIdSkill($idSkill) {
        $this->_idSkill = $idSkill;
    }

    public function setNameSkill($nameSkill) {
        $this->_nameSkill = $nameSkill;
    }

    public function setIdSkillParent($idSkillParent) {
        $this->_idSkillParent = $idSkillParent;
    }

    public function setDateSubmitSkill($dateSubmitSkill) {
        $this->_dateSubmitSkill = $dateSubmitSkill;
    }

    public function setValidatedSubmitSkill($validatedSubmitSkill) {
        $this->_validatedSubmitSkill = $validatedSubmitSkill;
    }

    public function setIdSubmitUser($idSubmitUser) {
        $this->_idSubmitUser = $idSubmitUser;
    }

}
