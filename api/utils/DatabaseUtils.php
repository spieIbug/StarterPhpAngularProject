<?php
	/**
	 * @author Maamar Yacine MEDDAH
	 * Classe de parametres de la conf du logiciel, tout ce qui concerne la connexion à la bd, et ça création
	 * 
	 */
	class DatabaseUtils {
		public $dbc;
		public function __construct(){
			try {
				$dsn = "mysql:dbname=asp;host=127.0.0.1";
				$this->dbc = new PDO($dsn, "root", "");
			} catch (PDOException $e) {
				echo "{\"etat\" :\"0\", \"message\" :\"Erreur de connexion à la base de données\"}";
			}
		}
	}
?>