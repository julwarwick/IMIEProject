<?php


class Notification {
    private $_idNotification;
    private $_textNotification;
    private $_sendDate;
    private $_idSender;
    private $_idReceiver;
    
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
    
    public function getIdNotification() {
        return $this->_idNotification;
    }

    public function getTextNotification() {
        return $this->_textNotification;
    }

    public function getSendDate() {
        return $this->_sendDate;
    }

    public function getIdSender() {
        return $this->_idSender;
    }

    public function getIdReceiver() {
        return $this->_idReceiver;
    }

    public function setIdNotification($idNotification) {
        $this->_idNotification = $idNotification;
    }

    public function setTextNotification($textNotification) {
        $this->_textNotification = $textNotification;
    }

    public function setSendDate($sendDate) {
        $this->_sendDate = $sendDate;
    }

    public function setIdSender($idSender) {
        $this->_idSender = $idSender;
    }

    public function setIdReceiver($idReceiver) {
        $this->_idReceiver = $idReceiver;
    }
}
