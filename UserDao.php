<?php
class UserDao{
   
   private $_connect;
   
// constructeur
   public function __construct($pdo) {
       $this->setConnect($pdo);
   }
   
// ascesseur et mutateur des attributs de la classe UtilisateurDAO
   public function setConnect($pdo) {
       $this->_connect = $pdo;
   }
   
   public function getConnect() {
       return $this->_connect;
   }
   
// fonction pour ajouter un utilisateur dans la base de donnéés
   public function addUser(User $user) {
       $req = $this->_connect->prepare('INSERT INTO user SET loginUser=:loginUser, passwordUser=:passwordUser, surnameUser=:surnameUser, nameUser=:nameUser, dateBirthUser=:dateBirthUser, addressUser1=:addressUser1 , addressUser2=:addressUser2 , addressUser3=:addressUser3, postCodeUser=:postCodeUser , cityUser=:cityUser, phoneUser=:phoneUser, emailUser=:emailUser, availableUser=:availableUser, aboutUser=:aboutUser,avatarUser=:avatarUser, idClassYear=:idClassYear,  idProfile=:idProfile');
       $req->BindValue(':loginUser', $utilisateur->getLoginUser());
       $req->BindValue(':passwordUser', $utilisateur->getPasswordUser());
       $req->bindValue(':surnameUser', $utilisateur->getSurnameUser());
       $req->bindValue(':nameUser', $utilisateur->getNameUser());
       $req->bindValue(':dateBirthUser', $utilisateur->getDateBirthUser());
       $req->bindValue(':addressUser1', $utilisateur->getAddressUser1());
       $req->bindValue(':addressUser2', $utilisateur->getAddressUser2());
       $req->bindValue(':addressUser3', $utilisateur->getAddressUser3());
       $req->bindValue(':postCodeUser', $utilisateur->getPostCodeUser());
       $req->bindValue(':cityUser', $utilisateur->getCityUser());
       $req->bindValue(':phoneUser', $utilisateur->getPhoneUser());
       $req->bindValue(':emailUser', $utilisateur->getEmailUser());
       $req->bindValue(':availableUser', $utilisateur->getAvailableUser());
       $req->bindValue(':aboutUser', $utilisateur->getAboutUser());
       $req->bindValue(':avatarUser', $utilisateur->getAvatar());
       $req->bindValue(':idClassYear', $utilisateur->getIdClassYear());
       $req->bindValue(':idProfile', $utilisateur->getIdProfile());
       $req->execute();
   }
   
// fonction pour selectionner dans la base de donn��es un utilisateur via l'IdUser
   function getUser($idUser){
       $req = $this->_connect->query('SELECT * FROM user WHERE idUser ='.$idUser.';');
       $donnees = $req->fetch(PDO::FETCH_ASSOC);
       $req->closeCursor();
       return new User($donnees);
   }
   
// fonction pour selectionner dans la base de donn��es la liste de tous les utilisateurs
   function getListUser(){
       $user = array();
       $req = $this->_connect->query('SELECT * FROM user');
       while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
           $user [] = new User($donnees);
       }
       return $user;
   }
   
// fonction pour detruire un utilisateur dans la base de donn��e via son idUser
   function deleteUser($idUser){
       $req = $this->_connect->exec('DELETE FROM user WHERE idUser='.$idUser);
   }
   
// fonction pour modifier dans la base de donn��es la table utilisateur 
   function modifyUser(User $user){
       $req = $this->_connect->prepare('UPDATE user SET idUser=:idUser, loginUser=:loginUser, passwordUser=:passwordUser, surnameUser=:surnameUser, nameUser=:nameUser, dateBirthUser=:dateBirthUser, addressUser1=:adresseUser1 , adresseUser2=:adresseUser2 , addressUser3=:addressUser3, postCodeUser=:postCodeUser , cityUser=:cityUser, phoneUser=:phoneUser, emailUser=:emailUser, availableUser=:availableUser, aboutUser=:aboutUser, avatarUser=:avatarUser, idClassYear=:idClassYear, idProfile=:idProfile');
       $req->bindValue(':loginUser', $dto->getLoginUser(), PDO::PARAM_STR);
       $req->bindValue(':passwordUser', $dto->getPasswordUser(), PDO::PARAM_STR);
       $req->bindValue(':surnameUser', $dto->getSurnameUser(), PDO::PARAM_STR);
       $req->bindValue(':nameUser', $dto->getNameUser(), PDO::PARAM_STR);
       $req->bindValue(':dateBirthUser', $dto->getDateBirthUser(), PDO::PARAM_INT);
       $req->bindValue(':addressUser1', $dto->getAddressUser1(), PDO::PARAM_STR);
       $req->bindValue(':addressUser2', $dto->getAddressUser2(), PDO::PARAM_STR);
       $req->bindValue(':addressUser3', $dto->getAddressUser3(), PDO::PARAM_STR);
       $req->bindValue(':postCodeUser', $dto->getPostCodeUser(), PDO::PARAM_STR);
       $req->bindValue(':cityUser', $dto->getCityUser(), PDO::PARAM_STR);
       $req->bindValue(':phoneUser', $dto->getPhoneUser(), PDO::PARAM_STR);
       $req->bindValue(':emailUser', $dto->getEmailUser(), PDO::PARAM_STR);
       $req->bindValue(':availableUser', $dto->getAvailableUser(), PDO::PARAM_BOOL);
       $req->bindValue(':aboutUser', $dto->getAboutUser(), PDO::PARAM_STR);
       $req->bindValue(':avatarUser', $dto->getAvatarUser(), PDO::PARAM_INT);
       $req->bindVlue(':idClassYear', $dto->getIdClassYear(), PDO::PARAM_INT);
       $req->bindVlue(':idProfile', $dto->getIdProfile(), PDO::PARAM_INT);
   }
   
}
