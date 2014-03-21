<?php


class ProjectWiki {
    private $_idProjectWiki;
    private $_textWiki;
    private $_dateAdded;
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
    
    public function getIdProjectWiki() {
        return $this->_idProjectWiki;
    }

    public function getTextWiki() {
        return $this->_textWiki;
    }

    public function getDateAdded() {
        return $this->_dateAdded;
    }

    public function getIdUser() {
        return $this->_idUser;
    }

    public function getIdProject() {
        return $this->_idProject;
    }

    public function setIdProjectWiki($idProjectWiki) {
        $this->_idProjectWiki = $idProjectWiki;
    }

    public function setTextWiki($textWiki) {
        $this->_textWiki = $textWiki;
    }

    public function setDateAdded($dateAdded) {
        $this->_dateAdded = $dateAdded;
    }

    public function setIdUser($idUser) {
        $this->_idUser = $idUser;
    }

    public function setIdProject($idProject) {
        $this->_idProject = $idProject;
    }

}
