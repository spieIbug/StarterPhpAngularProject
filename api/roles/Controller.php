<?php
	include_once(__DIR__."/../utils/DatabaseUtils.php");
	class RolesController {
		private $databaseUtils = null;
		function __construct(){
			$this->databaseUtils = new DatabaseUtils();
		}
		function getUserRoles($user, $uid){
			session_start();
			$result = array(
				"erreur" => "Aucun resultat ne correspond a votre demande!"
			);
			if (isset($_SESSION['uid'])){
				if ($_SESSION['uid']== $uid){
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
				} else {
					$result = array(
						"erreur" => "Session non reconnue"
					);
				}
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
						$uid = uniqid('login_');
						$_SESSION['uid']= $uid;
						$result[0]['uid'] = $uid;
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
		function logout($uid){
			$result = array(
				"erreur" => "session non reconnue!"
			);
			session_start();
			if (isset($_SESSION["uid"])){
				if ($_SESSION["uid"]==$uid){
					$_SESSION["user"]="";
					$_SESSION["uid"]="";
					unset($_SESSION["user"]);
					unset($_SESSION["uid"]);
					$result = array(
						"info" => "vous avez ete deconnecte!"
					);
				}
			}
			return $result;
		}
		function isLogged($user, $uid){
			session_start();
			$result = array(
				"erreur" => "Utilisateur non reconnue!"
			);
			if (isset($_SESSION['uid'])&&isset($_SESSION['user'])){
				if (($_SESSION['uid']== $uid)&&($_SESSION['user']== $user)){
					$result = array(
						"status" => "true"
					);
				} else {
					$result = array(
						"status" => "false"
					);
				}
			}			
			return $result;
		}
	}
?>