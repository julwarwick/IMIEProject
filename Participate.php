<?php

class Participate {
    private $_idUser;
    private $_idProject;
    
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
    
    public function getIdUser() {
        return $this->_idUser;
    }

    public function getIdProject() {
        return $this->_idProject;
    }

    public function setIdUser($idUser) {
        $this->_idUser = $idUser;
    }

    public function setIdProject($idProject) {
        $this->_idProject = $idProject;
    }
}
