<?php


class LocationClass {
    
    private $_idLocationClass;
    private $_cityLocationClass;
    
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
    
    public function getIdLocationClass() {
        return $this->_idLocationClass;
    }

    public function getCityLocationClass() {
        return $this->_cityLocationClass;
    }

    public function setIdLocationClass($idLocationClass) {
        $this->_idLocationClass = $idLocationClass;
    }

    public function setCityLocationClass($cityLocationClass) {
        $this->_cityLocationClass = $cityLocationClass;
    }
}
