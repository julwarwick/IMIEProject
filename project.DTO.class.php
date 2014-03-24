<?php
require "projectStatus.DAO.class.php";
require "UserDao.php";

class ProjectDTO {
	// Attributs de la classe
	private $id;
	private $name;
	private $description;
	private $startDate;
	private $endDate;
	private $creationDate;
	private $volunteersNumber;
	private $validated;
	private $status;
	private $chef;
	private $creator;
	private $members = array();

	// Getteurs et setteurs

	public function setId($pId) {
		$this->id = $pId;
	}

	public function getId() {
		return $this->id;
	}

	public function setName($pName) {
		$this->name = $pName;
	}

	public function getName() {
		return $this->name;
	}

	public function setDescription($pDescription) {
		$this->description = $pDescription;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setCreationDate($pCreationDate) {
		$this->creationDate = $pCreationDate;
	}

	public function getCreationDate() {
		return $this->creationDate;
	}

	public function setVolunteersNumber($pVolunteersNumber) {
		$this->volunteersNumber = $pVolunteersNumber;
	}

	public function getVolunteersNumber() {
		return $this->volunteersNumber;
	}		

	public function setValidated($pValidated) {
		$this->validated = $pValidated;
	}

	public function getValidated() {
		return $this->validated;
	}

	public function setStartDate($pStartDate) {
		$this->startDate = $pStartDate;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function setEndDate($pEndDate) {
		$this->endDate = $pEndDate;
	}


	public function getEndDate() {
		return $this->endDate;
	}

	public function setChef(User $pChef) {
		$this->chef = $pChef;
	}

	public function getChef() {
		return $this->chef;
	}		

	public function setStatus(ProjectStatusDTO $pStatus) {
		$this->status = $pStatus;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setCreator(User $pCreator) {
		$this->creator = $pCreator;
	}

	public function getCreator() {
		return $this->creator;
	}


	public function addMember(User $pMember) {
		$this->members[] = $pMember;
	}

	/*
	public function removeMember(User $pMember) {
		unset $this->members[] = $pMember;
	}
	*/

	public function getMembers() {
		return $this->members;
	}		
		
}

?>
