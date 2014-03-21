<?php


class ClassYear {
    private $_idClassYear;
    private $_nameClassYear;
    private $_idLocationClass;
    
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

    public function getIdClassYear() {
        return $this->_idClassYear;
    }

    public function getNameClassYear() {
        return $this->_nameClassYear;
    }

    public function getIdLocationClass() {
        return $this->_idLocationClass;
    }

    public function setIdClassYear($idClassYear) {
        $this->_idClassYear = $idClassYear;
    }

    public function setNameClassYear($nameClassYear) {
        $this->_nameClassYear = $nameClassYear;
    }

    public function setIdLocationClass($idLocationClass) {
        $this->_idLocationClass = $idLocationClass;
    }
}
