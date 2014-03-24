<?php

include_once "connexionBase.inc.php";
require "project.DTO.class.php";


class ProjectDAO {

	// Fonction qui renvoie un array de tous les projets de la base avec leur avancement
	public function liste($condition) {
		//Connexion à la base
		$pdo = connexionBase("imieproject","myparam");
		// Ecriture du texte la requête
		$rqt = 'SELECT idProject, nameProject, descriptionProject, startDateProject, deadLineProject, volunteersProject, project.idProjectStatus, projectStatus, dateCreate, validatedProject FROM project INNER JOIN projectstatus ON project.idProjectStatus = projectstatus.idProjectStatus'.$condition.';';
		// Exécution de la requête
		$result = $pdo->query($rqt);
		// Si l'exécution renvoie false (cela n'a pas marché), on affiche un message d'erreur
		if(!$result) {
			$mes_erreur=$pdo->errorInfo();
			echo "Lecture impossible";
			// fermeture de la connexion
			$pdo = null;
		}
		// Si l'exécution marche, on crée un array où on stocke toutes les lignes du resultat obtenu de la base
		else {
			$lista = array();
			while ($ligne = $result->fetchObject()) {
				$projectStatus = new ProjectStatusDTO();
				$projectStatus->setId($ligne->idProjectStatus);
				$projectStatus->setName($ligne->projectStatus);
				$id = $ligne->idProject;
				$name = $ligne->nameProject;
				$description = $ligne->descriptionProject;
				$status = $projectStatus;
				$startDate = $ligne->startDateProject;
				$endDate = $ligne->deadLineProject;
				$creationDate = $ligne->dateCreate;
				$volunteersNumber = $ligne->volunteersProject;
				$validated = $ligne->validatedProject;
				//$chef = $ligne->idUserChef;
				//$creator = $ligne->idUserInitiateur;
				$project = new ProjectDTO();
				$project->setDescription($description);
				$project->setCreationDate($creationDate);
				$project->setVolunteersNumber($volunteersNumber);
				$project->setValidated($validated);
				//$project->setCreator($creator);
				$project->setName($name);
				$project->setId($id);
				$project->setStartDate($startDate);
				$project->setEndDate($endDate);
				//$project->setChef($chef);
				$project->setStatus($status);
				$lista[] = $project;
			}
			// fermeture de la connexion
			$pdo = null;
			// on libère la mémoire occupée par le resultat obtenu
			$result->closeCursor();
			return $lista;
		}	
	}

	// On passe en parametre un identifiant de projet et la fonction renvoie le nombre de participants de cet projet 
	public function numProjectMembers($projectId) {
		$projectMembers = $this->liste(" WHERE idProject =".$projectId);
		$number = count($projectMembers);
		return $number;
	}

	// On passe en parametre un identifiant de projet et la fonction renvoie le nombre de places disponibles 
	public function calculePlaces($besoinVolontaires, $projectId) {
		$placesDispo = $besoinVolontaires - $this->numProjectMembers($projectId);
		return $placesDispo;
	}

	// fonction qui renvoie un array des projets en cours qui ont été validés
	public function selectProjetsEnCours() {
		$listeProjets = ($this->liste(" WHERE validatedProject=1 AND startDateProject <= CURDATE()"));
		return $listeProjets;
	}

	// fonction qui renvoie un array des projets en attente de validation
	public function selectProjetsEnAttente() {
		$listeProjets = ($this->liste(" WHERE validatedProject=0"));
		return $listeProjets;
	}


	// Fonction qui prend en parametre un projet (DAO) et insert ce dernier dans la base
	public function create(ProjectDTO $pProject) {
		//Connexion à la base
		$pdo = connexionBase("imieproject","myparam");
		// Préparation de la requête
		$rqtPrep = $pdo->prepare("INSERT INTO project (nameProject, descriptionProject, startDateProject, deadLineProject, volunteersProject, idProjectStatus, dateCreate, validatedProject, idChefUser, idCreateUser) VALUES
		(:name, :description, :startDate, :endDate, :volunteersNumber, :status, :creationDate, :validated, :chef, :creator);");
		// Définition des paramètres de la requête
		$name = $pProject->getName();
		$description = $pProject->getDescription();
		$startDate = $pProject->getStartDate();
		$endDate = $pProject->getEndDate();
		$volunteersNumber = $pProject->getVolunteersNumber();
		//$status = $pProject->getStatus();
		// Quand on crée un projet, par défaut, l'identifiant de l'avancement du projet est 1, c'est à dire 0%
		$status = 1;
		$creationDate = $pProject->getCreationDate();
		//$validated = $pProject->getValidated();
		// Quand on crée un projet, par défaut, il n'est pas validé 
		$validated = 0;
		$chef = $pProject->getChef();
		$creator = $pProject->getCreator();
		// Liaison des paramètres et la requête
		$rqtPrep->bindParam(':name', $name, PDO::PARAM_STR);
		$rqtPrep->bindParam(':description', $description, PDO::PARAM_STR);
		$rqtPrep->bindParam(':startDate', $startDate, PDO::PARAM_STR);
		$rqtPrep->bindParam(':endDate', $endDate, PDO::PARAM_STR);
		$rqtPrep->bindParam(':volunteersNumber', $volunteersNumber, PDO::PARAM_INT);
		$rqtPrep->bindParam(':status', $status, PDO::PARAM_INT);
		$rqtPrep->bindParam(':creationDate', $creationDate, PDO::PARAM_STR);
		$rqtPrep->bindParam(':validated', $validated, PDO::PARAM_INT);
		$rqtPrep->bindParam(':chef', $chef, PDO::PARAM_INT);
		$rqtPrep->bindParam(':creator', $creator, PDO::PARAM_INT);
		// Exécution de la requête
		$nblignes = $rqtPrep->execute();
		// Si le nombre des lignes affectée est différent de 1, allors on affiche un message d'erreur
		if ($nblignes!=1) {
			$messErreur = $rqtPrep->errorInfo();
			echo "Insertion inpossible, code " . $rqtPrep->errorCode() . $messErreur[2];
		}
		// Fermeture de la connexion
		$pdo = null;

	}

	// fonction qui prend en parametre un projet (DTO) et met à jour tous les champs dans la base du projet ayant le même identifiant du projet passé en parametre
	public function modify(ProjectDTO $pProject) {
		//Connexion à la base
		$pdo = connexionBase("imieproject","myparam");
		// Préparation de la requête
		$rqtPrep = $pdo->prepare("UPDATE project SET nameProject=:name, descriptionProject=:description, startDateProject=:startDate, deadLineProject=:endDate, volunteersProject=:volunteersNumber, idProjectStatus=:status,
		dateCreate=:creationDate, validatedProject=:validated, idChefUser=:chef, idCreateUser=:creator WHERE idProject =" . $pProject->getId() . ";");
		// Définition des paramètres de la requête
		$name = $pProject->getName();
		$description = $pProject->getDescription();
		$startDate = $pProject->getStartDate();
		$endDate = $pProject->getEndDate();
		$volunteersNumber = $pProject->getVolunteersNumber();
		$status = $pProject->getStatus();
		$creationDate = $pProject->getCreationDate();
		$validated = $pProject->getValidated();
		$chef = $pProject->getChef();
		$creator = $pProject->getCreator();
		// Liaison des paramètres et la requête
		$rqtPrep->bindParam(':name', $name, PDO::PARAM_STR);
		$rqtPrep->bindParam(':description', $description, PDO::PARAM_STR);
		$rqtPrep->bindParam(':startDate', $startDate, PDO::PARAM_STR);
		$rqtPrep->bindParam(':endDate', $endDate, PDO::PARAM_STR);
		$rqtPrep->bindParam(':volunteersNumber', $volunteersNumber, PDO::PARAM_INT);
		$rqtPrep->bindParam(':status', $status, PDO::PARAM_INT);
		$rqtPrep->bindParam(':creationDate', $creationDate, PDO::PARAM_STR);
		$rqtPrep->bindParam(':validated', $validated, PDO::PARAM_INT);
		$rqtPrep->bindParam(':chef', $chef, PDO::PARAM_INT);
		$rqtPrep->bindParam(':creator', $creator, PDO::PARAM_INT);
		// Exécution de la requête
		$nblignes = $rqtPrep->execute();
		// Si le nombre des lignes affectée est différent de 1, allors on affiche un message d'erreur
		if ($nblignes!=1) {
			$messErreur = $pdo->errorInfo();
			echo "Erreur : " . $pdo->errorCode() . $messErreur[2];
		}
		// Fermeture de la connexion
		$pdo = null;
	}


	// fonction qui prend en parametre un identiant de projet et renvoie toutes les données concernantes le projet sous forme d'objet (ProjectDTO)
	public function getProjectStatusAndMembers ($idProject) {
		//Connexion à la base
		$pdo = connexionBase("imieproject","myparam");
		//var_dump($pdo);
		// Ecriture du texte la requête
		$rqt = ("SELECT project.idProject AS projectId, nameProject, descriptionProject, startDateProject, deadLineProject, volunteersProject, project.idProjectStatus AS projectStatusId, projectStatus, dateCreate, validatedProject, idChefUser, idCreateUser, participate.idUser AS userParticipates, surnameUser, nameUser FROM project INNER JOIN projectstatus ON project.idProjectStatus = projectStatus.idProjectStatus INNER JOIN participate ON participate.idProject = project.idProject INNER JOIN user ON participate.idUser = user.idUser WHERE project.idProject =".$idProject.";");
		// Exécution de la requête
		$result = $pdo->query($rqt);
		// Si l'exécution renvoie false (cela n'a pas marché), on affiche un message d'erreur
		if(!$result) {
			$mes_erreur=$pdo->errorInfo();
			echo "Lecture impossible";
			// Fermeture de la connexion
			$pdo = null;
		}
		else {
			// Si l'exécution marche, on parcour la ligne du resultat obtenu de la base
			// j'instancie un nouveau Projet
			$project = new ProjectDTO();
			while ($ligne = $result->fetchObject()) {
				// Je recupère les données de la requête et j'instancie un objet de type ProjectStatusDTO
				$projectStatus = new ProjectStatusDTO();
				$statusId = $ligne->projectStatusId;
				$statusName = $ligne->projectStatus;
				$projectStatus->setId($statusId);
				$projectStatus->setName($statusName);
				// J'utilise l'identifiant du chef de projet pour recuperer ses infos dans la base et instancier un objet de type User
				$dao = new UserDao($pdo);
				$chefId = $ligne->idChefUser;
				$chef = $dao->getUser($chefId);
				// J'utilise l'identifiant du createur du projet pour recuperer ses infos dans la base et instancier un objet de type User
				$dao = new UserDao($pdo);
				$creatorId = $ligne->idCreateUser;
				$creator = $dao->getUser($creatorId);
				// a chaque tour de la boucle, j'utilise l'identifiant de chaque membre du projet pour recuperer ses infos dans la base et
				// instancier un objet de type User
				$member = new UserDao($pdo);
				$memberId = $ligne->userParticipates;
				$member = $dao->getUser($memberId);
				// Je recupère les données de la requête et je renseigne les attribut de l'objet ProjectDTO crée en dehors de la boucle
				$projectId = $ligne->projectId;
				$projectName = $ligne->nameProject;
				$description = $ligne->descriptionProject;
				$startDate = $ligne->startDateProject;
				$endDate = $ligne->deadLineProject;
				$creationDate = $ligne->dateCreate;
				$volunteersNumber = $ligne->volunteersProject;
				$validated = $ligne->validatedProject;
				$project->setId($projectId);
				$project->setName($projectName);
				$project->setDescription($description);
				// La variable $projectStatus est un objet de type ProjectStatusDTO
				$project->setStatus($projectStatus);
				$project->setCreationDate($creationDate);
				$project->setStartDate($startDate);
				$project->setVolunteersNumber($volunteersNumber);
				$project->setValidated($validated);
				$project->setEndDate($endDate);
				// La variable $chef est un objet de type User
				$project->setChef($chef);
				// La variable $creator est un objet de type User
				$project->setCreator($creator);
				// J'ajoute l'objet $member (de type User) à l'array members (attribut de la classe ProjectDTO)
				$project->addMember($member);
			}

			// Fermeture de la connexion
			$pdo = null;
			// Libreation de la mémoire occupée par le resultat obtenu
			$result->closeCursor();
			// La fonction renvoie le projet trouvé
			return $project;
		}
	}	
	

	// fonction qui prend en parametre l'identifiant d'un projet et qui retorune le projet (sous forme d'objet ProjectDTO) dans la base ayant le même identifiant
	// je garde cette fonction pour le moment mais je crois qu'elle est obsolète --> getProjectStatusAndMembers est plus complète
	public function getProject($idProject) {
		//Connexion à la base
		$pdo = connexionBase("imieproject","myparam");
		// Ecriture du texte la requête
		$rqt = ("SELECT idProject, nameProject, descriptionProject, startDateProject, deadLineProject, volunteersProject, idProjectStatus, dateCreate, validatedProject, idChefUser, idCreateUser FROM project WHERE idProject=".$idProject.";");
		// Exécution de la requête
		$result = $pdo->query($rqt);
		// Si l'exécution renvoie false (cela n'a pas marché), on affiche un message d'erreur
		if(!$result) {
			$mes_erreur=$pdo->errorInfo();
			echo "Lecture impossible";
			// Fermeture de la connexion
			$pdo = null;
		}
		else {
			// Si l'exécution marche, on parcour la ligne du resultat obtenu de la base
			while ($ligne = $result->fetchObject()) {
				$id = $ligne->idProject;
				$name = $ligne->nameProject;
				$description = $ligne->descriptionProjet;
				$startDate = $ligne->startDateProject;
				$endDate = $ligne->deadLineProject;
				$creationDate = $ligne->dateCreate;
				$volunteersNumber = $ligne->volunteersProject;
				$validated = $ligne->validatedProject;
				$project = new ProjectDTO();
				$project->setId($projectId);
				$project->setName($projectName);
				$project->setDescription($description);
				$project->setCreationDate($creationDate);
				$project->setStartDate($startDate);
				$project->setVolunteersNumber($volunteersNumber);
				$project->setValidated($validated);
				$project->setEndDate($endDate);	
			}
			// Fermeture de la connexion
			$pdo = null;
			// Libreation de la mémoire occupée par le resultat obtenu
			$result->closeCursor();
			// La fonction renvoit le projet trouvé
			return $project;
		}


	}

	// fonction qui prend en parametre un projet (sous forme d'objet ProjectDTO) et efface le projet dans la base ayant le même identifiant du projet passé en parametre
	function delete(ProjectDTO $pProject) {
		//Connexion à la base
		$pdo = connexionBase("imieproject","myparam");
		// Ecriture du texte la requête
		$rqt = ("DELETE FROM projets WHERE idProjet=".$pProject->getId().";");
		// Exécution de la requête
		$nblignes = $pdo->exec($rqt);
		// Si le nombre des lignes affectée est différent de 1, allors on affiche un message d'erreur
		if ($nblignes!=1) {
			$messErreur = $pdo->errorInfo();
			echo "Erreur : " . $pdo->errorCode() . $messErreur[2];
		}
		// Fermeture de la connexion
		$pdo = null;
	}
}

?>
