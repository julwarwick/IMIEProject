<?php

class SkillDao {

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

 // fonction pour ajouter dans la base de donnéés  
   public function addSkill(Skill $skill){
   	$req = $this->_connect->prepare('INSERT INTO skill SET nameSkill=:nameSkill, idSkillParent=:idSkillParent, dateSubmitSkill=:dateSubmitSkill, validatedSubmitSkill=:validatedSubmitSkill, idSubmit=:idSubmitUser');
   	$req->BindValue(':nameSkill', $skill->getNameSkill());
   	$req->BindValue(':idSkillParentSkill', $skill->getIdSkillParent());
   	$req->BindValue(':dateSubmitSkill', $skill->getDateSubmitSkill());
   	$req->BindValue(':validatedSubmitSkill', $skill->getValidatedSubmitSkill());
   	$req->BindValue(':idSubmitUser', $skill->getidSubmitUser());
  	$req->execute();
   }

// fonction pour selectionner dans la base de données
   function getSkill($idSkill){
       $req = $this->_connect->query('SELECT * FROM skill WHERE idSkill ='.$idSkill.';');
       $donnees = $req->fetch(PDO::FETCH_ASSOC);
       $req->closeCursor();
       return new Skill($donnees);
   }
   
// fonction pour selectionner dans la base de données la liste
   function getListSkill(){
       $skill = array();
       $req = $this->_connect->query('SELECT * FROM skill');
       while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
           $skill [] = new Skill($donnees);
       }
       return $skill;
   }
   
// fonction pour detruire un utilisateur dans la base de donnée via son id
   function deleteSkill($idSkill){
       $req = $this->_connect->exec('DELETE FROM user WHERE idSkill='.$idSkill);
   }

// fonction pour modifier dans la base de données la table utilisateur 
   function modifySkill(Skill $skill){
       $req = $this->_connect->prepare('UPDATE skill SET idSkill=:idSkill, nameSkill=:nameSkill, idSkillParent=:idSkillParent, dateSubmitSkill=:dateSubmitSkill, validatedSubmitSkill=:validatedSubmitSkill, idSubmitUser=:idSubmitUser');
       $req->bindValue(':nameSkill', $dto->getNameSkill(), PDO::PARAM_STR);
       $req->bindValue(':idSkillParent', $dto->getIdSkillParent(), PDO::PARAM_STR);
       $req->bindValue(':dateSubmitSkill', $dto->getDateSubmitSkill(), PDO::PARAM_STR);
       $req->bindValue(':validatedSubmitSkill', $dto->getValidatedSubmitSkill(), PDO::PARAM_STR);
       $req->bindValue(':idSubmitUser', $dto->getIdSubmitUser(), PDO::PARAM_INT);
   }
   
}
