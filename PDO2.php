<?php

/**
 * Classe implémentant le singleton pour PDO
 * @author Savageman
 */

class PDO2 extends PDO {

	private static $_instance;

	/* Constructeur : héritage public obligatoire par héritage de PDO */
	public function __construct( ) {
	
	}
	// End of PDO2::__construct() */

	/* Singleton */
	public static function getInstance() {
	
		if (!isset(self::$_instance)) {
			
			try {
			
				self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
			
			} catch (PDOException $e) {
			
				echo $e;
			}
		} 
		return self::$_instance; 
	}
}
        $pdo = PDO2::getInstance();
        var_dump ($pdo);

// end of file */