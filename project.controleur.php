<?php
	
	require_once "/../Modele/project.DAO.class.php";

	class ProjetsEnCoursController {
		private $dao;

		function __construct() {
        	$this->dao = new ProjectDAO();
        
    	}

		// Fonction qui renvoie le nombre de places disponibles
		public function calculePlaces($besoinVolontaires, $projectId) {
			$placesDispo = $this->dao->calculePlaces($besoinVolontaires, $projectId);
			return $placesDispo;
		}
	
		// Fonction qui renvoie un array de projets en cours
		public function projetsEnCours() {
			$listeProjets = ($this->dao->selectProjetsEnCours());
			include_once "/../Vue/userPage/projets en cours.vue.php";
		}
	}
?>
