<?php

class User {
    private $_idUser;
    private $_loginUser;
    private $_passwordUser;
    private $_surnameUser;
    private $_nameUser;
    private $_dateBirthUser;
    private $_addressUser1;
    private $_addressUser2;
    private $_addressUser3;
    private $_postCodeUser;
    private $_cityUser;
    private $_emailUser;
    private $_phoneUser;
    private $_availableUser;
    private $_aboutUser;
    private $_avatarUser;
    private $_idClassYear;
    private $_idProfile;
    
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

    public function getLoginUser() {
        return $this->_loginUser;
    }

    public function getPasswordUser() {
        return $this->_passwordUser;
    }

    public function getSurnameUser() {
        return $this->_surnameUser;
    }

    public function getNameUser() {
        return $this->_nameUser;
    }

    public function getDateBirthUser() {
        return $this->_dateBirthUser;
    }

    public function getAddressUser1() {
        return $this->_addressUser1;
    }

    public function getAddressUser2() {
        return $this->_addressUser2;
    }

    public function getAddressUser3() {
        return $this->_addressUser3;
    }

    public function getPostCodeUser() {
        return $this->_postCodeUser;
    }

    public function getCityUser() {
        return $this->_cityUser;
    }

    public function getEmailUser() {
        return $this->_emailUser;
    }

    public function getPhoneUser() {
        return $this->_phoneUser;
    }

    public function getAvailableUser() {
        return $this->_availableUser;
    }

    public function getAboutUser() {
        return $this->_aboutUser;
    }

    public function getAvatarUser() {
        return $this->_avatarUser;
    }

    public function getIdClassYear() {
        return $this->_idClassYear;
    }

    public function getIdProfile() {
        return $this->_idProfile;
    }
    public function setIdUser($idUser) {
        $this->_idUser = $idUser;
    }

    public function setLoginUser($loginUser) {
        $this->_loginUser = $loginUser;
    }

    public function setPasswordUser($passwordUser) {
        $this->_passwordUser = $passwordUser;
    }

    public function setSurnameUser($surnameUser) {
        $this->_surnameUser = $surnameUser;
    }

    public function setNameUser($nameUser) {
        $this->_nameUser = $nameUser;
    }

    public function setDateBirthUser($dateBirthUser) {
        $this->_dateBirthUser = $dateBirthUser;
    }

    public function setAddressUser1($addressUser1) {
        $this->_addressUser1 = $addressUser1;
    }

    public function setAddressUser2($addressUser2) {
        $this->_addressUser2 = $addressUser2;
    }

    public function setAddressUser3($addressUser3) {
        $this->_addressUser3 = $addressUser3;
    }

    public function setPostCodeUser($postCodeUser) {
        $this->_postCodeUser = $postCodeUser;
    }

    public function setCityUser($cityUser) {
        $this->_cityUser = $cityUser;
    }

    public function setEmailUser($emailUser) {
        $this->_emailUser = $emailUser;
    }

    public function setPhoneUser($phoneUser) {
        $this->_phoneUser = $phoneUser;
    }

    public function setAvailableUser($availableUser) {
        $this->_availableUser = $availableUser;
    }

    public function setAboutUser($aboutUser) {
        $this->_aboutUser = $aboutUser;
    }

    public function setAvatarUser($avatarUser) {
        $this->_avatarUser = $avatarUser;
    }

    public function setIdClassYear($idClassYear) {
        $this->_idClassYear = $idClassYear;
    }

    public function setIdProfile($idProfile) {
        $this->_idProfile = $idProfile;
    }

}
