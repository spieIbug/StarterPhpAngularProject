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
				if ($this->databaseUtils->dbc != null){
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
				} else {
					$result = array(
						"erreur" => "base de donnees Offline!"
					);
				}				
			} catch (PDOException $e) {
				$result = array(
					"erreur" => "Une erreur de recupperation de droits s'est produite. Veuillez reessayer plus tard SVP!"
				);
			}
			return $result;
		}
		function login($user, $pwd){
			$result = array(
				"erreur" => "Aucun resultat ne correspond a votre demande!"
			);
			try {
				if ($this->databaseUtils->dbc != null){
					$stmt = $this->databaseUtils->dbc->prepare("SELECT u.id, u.login "
						."FROM users u "
						."WHERE "
						."u.login = :user "
						."AND u.pwd = :pwd "
						."AND u.flag=1");
					$stmt->bindParam('user', $user, PDO::PARAM_STR);
					$stmt->bindParam('pwd', $pwd, PDO::PARAM_STR);
					$stmt->execute();
					$result=$stmt->fetchAll(PDO::FETCH_ASSOC);	
					if (sizeof($result)!=1){
						$result = array(
							"erreur" => "Utilisateur non reconnu!"
						);
					} else {
						session_start();
						$_SESSION["user"]=$result[0]['login'];
					}					
				} else {
					$result = array(
						"erreur" => "base de donnees Offline!"
					);
				}				
			} catch (PDOException $e) {
				$result = array(
					"erreur" => "Une erreur de login s'est produite. Veuillez reessayer plus tard SVP!"
				);
			}
			return $result;
		}
		function logout($user){
			$result = array(
				"erreur" => "session non reconnue!"
			);
			session_start();
			if (isset($_SESSION["user"])){
				if ($_SESSION["user"]==$user){
					$_SESSION["user"]="";
					unset($_SESSION["user"]);
					$result = array(
						"info" => "vous avez ete deconnecte!"
					);
				}
			}
			return $result;
		}
	}
?>