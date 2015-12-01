<?php
	include_once("../utils/DatabaseUtils.php");
	class RolesController {
		private $databaseUtils = null;
		function __construct(){
			$this->databaseUtils = new DatabaseUtils();
		}
		function getUserRoles($user){
			$result = array(
				"erreur" => "Aucun resultat ne correspond a votre demande!"
			);
			try {
				$stmt = $this->databaseUtils->dbc->prepare("SELECT r.id, r.libelle "
					."FROM roles r, users u, users_roles usr "
					."WHERE "
					."u.login = :user "
					."AND u.id = usr.user_id "
					."AND r.id = usr.role_id "
					."AND r.flag=1 "
					."AND u.flag=1 "
					."AND usr.flag=1 ");
				$stmt->bindParam('user', $user, PDO::PARAM_STR);
				$stmt->execute();
				$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				$result = array(
					"erreur" => "Une erreur de recupperation de droits s'est produite. Veuillez reessayer plus tard SVP!"
				);
			}
			return $result;
		}
	}
?>