<?php

class Project {
    private $_idProject;
    private $_nameProject;
    private $_descriptionProject;
    private $_startDateProject;
    private $_deadLineProject;
    private $_volunteersProject;
    private $_idProjectStatus;
    private $_idCreateUser;
    private $_dateCreate;
    private $_validatedProject;
    private $_idChefUser;
    
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
    
    public function getIdProject() {
        return $this->_idProject;
    }

    public function getNameProject() {
        return $this->_nameProject;
    }

    public function getDescriptionProject() {
        return $this->_descriptionProject;
    }

    public function getStartDateProject() {
        return $this->_startDateProject;
    }

    public function getDeadLineProject() {
        return $this->_deadLineProject;
    }

    public function getVolunteersProject() {
        return $this->_volunteersProject;
    }

    public function getIdProjectStatus() {
        return $this->_idProjectStatus;
    }

    public function getIdCreateUser() {
        return $this->_idCreateUser;
    }

    public function getDateCreate() {
        return $this->_dateCreate;
    }

    public function getValidatedProject() {
        return $this->_validatedProject;
    }

    public function getIdChefUser() {
        return $this->_idChefUser;
    }

    public function setIdProject($idProject) {
        $this->_idProject = $idProject;
    }

    public function setNameProject($nameProject) {
        $this->_nameProject = $nameProject;
    }

    public function setDescriptionProject($descriptionProject) {
        $this->_descriptionProject = $descriptionProject;
    }

    public function setStartDateProject($startDateProject) {
        $this->_startDateProject = $startDateProject;
    }

    public function setDeadLineProject($deadLineProject) {
        $this->_deadLineProject = $deadLineProject;
    }

    public function setVolunteersProject($volunteersProject) {
        $this->_volunteersProject = $volunteersProject;
    }

    public function setIdProjectStatus($idProjectStatus) {
        $this->_idProjectStatus = $idProjectStatus;
    }

    public function setIdCreateUser($idCreateUser) {
        $this->_idCreateUser = $idCreateUser;
    }

    public function setDateCreate($dateCreate) {
        $this->_dateCreate = $dateCreate;
    }

    public function setValidatedProject($validatedProject) {
        $this->_validatedProject = $validatedProject;
    }

    public function setIdChefUser($idChefUser) {
        $this->_idChefUser = $idChefUser;
    }

}
