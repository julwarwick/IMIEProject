<?php

class SkillLevelDao {

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
   }	// constructeur
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

 // fonction pour ajouter dans la base de donnéés  
   public function addSkillLevel(SkillLevel $skillLevel){
   	$req = $this->_connect->prepare('INSERT INTO skilllevel SET skillLevel=:skillLevel');
   	$req->BindValue(':skillLevel', $skillLevel->getSkillLevel());
  	$req->execute();
   }

// fonction pour selectionner dans la base de données
   function getSkillLevel($idSkillLevel){
       $req = $this->_connect->query('SELECT * FROM skilllevel WHERE idSkillLevel ='.$idSkillLevel.';');
       $donnees = $req->fetch(PDO::FETCH_ASSOC);
       $req->closeCursor();
       return new SkillLevel($donnees);
   }
   
// fonction pour selectionner dans la base de données la liste
   function getListSkillLevel(){
       $skillLevel = array();
       $req = $this->_connect->query('SELECT * FROM skilllevel');
       while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
           $skillLevel [] = new SkillLevel($donnees);
       }
       return $skillLevel;
   }
   
// fonction pour detruire un utilisateur dans la base de donnée via son id
   function deleteSkillLevel($idSkillLevel){
       $req = $this->_connect->exec('DELETE FROM user WHERE idSkillLevel='.$idSkillLevel);
   }

// fonction pour modifier dans la base de données la table utilisateur 
   function modifySkillLevel(SkillLevel $skillLevel){
       $req = $this->_connect->prepare('UPDATE skilllevel SET idSkillLevel=:idSkillLevel, skillLevel=:skillLevel');
       $req->bindValue(':skillLevel', $dto->getSkillLevel(), PDO::PARAM_STR);
    }
   
}
