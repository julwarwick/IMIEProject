<?php

class ProjectStatus {
   private $_idProjectStatus;
   private $_projectStatus;
   
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
    
    public function getIdProjectStatus() {
        return $this->_idProjectStatus;
    }

    public function getProjectStatus() {
        return $this->_projectStatus;
    }

    public function setIdProjectStatus($idProjectStatus) {
        $this->_idProjectStatus = $idProjectStatus;
    }

    public function setProjectStatus($projectStatus) {
        $this->_projectStatus = $projectStatus;
    }


}
