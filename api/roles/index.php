<?php
	header('Content-type: application/json; charset=UTF-8');
	$method = "";
	if (isset($_POST)){
		extract($_POST);
	}
	if (isset($_PUT)){
		extract($_PUT);
	}
	if (isset($_DELETE)){
		extract($_DELETE);
	}
	if (isset($_GET)){
		extract($_GET);
	}
	switch($method){
		case "getUserRoles":{
			if (isset($_GET)) {
				if (!empty($_GET['user'])&&!empty($_GET['uid'])){
					include_once("Controller.php");
					$controller = new RolesController();
					$response = $controller->getUserRoles($user, $uid);
					echo json_encode($response);
				} else echo "[{\"error\":\"query params error\"}]" ;
			}
			else echo "[{\"error\":\"query params error\"}]" ;			
			break;
		}
		case "login":{
			$user = json_decode(file_get_contents('php://input')); // get data from json header
			if (isset($user)) {
				if (isset($user->user)&&isset($user->pwd)){
					include_once("Controller.php");
					$controller = new RolesController();
					$response = $controller->login($user->user,$user->pwd);
					echo json_encode($response);
				} else echo "[{\"error\":\"query params error\"}]" ;
			}
			else echo "[{\"error\":\"query params error\"}]" ;			
			break;
		}
		case "logout":{
			if (isset($_GET)) {
				if (!empty($_GET['user'])){
					include_once("Controller.php");
					$controller = new RolesController();
					$response = $controller->logout($user);
					echo json_encode($response);
				} else echo "[{\"error\":\"query params error\"}]" ;
			}
			else echo "[{\"error\":\"query params error\"}]" ;			
			break;
		}
		case"isLogged":{
			$user = json_decode(file_get_contents('php://input')); // get data from json header
			if (isset($user)) {
				if (isset($user->user)&&isset($user->uid)){
					include_once("Controller.php");
					$controller = new RolesController();
					$response = $controller->isLogged($user->user,$user->uid);
					echo json_encode($response);
				} else echo "[{\"error\":\"query params error #4\"}]" ;
			}
			else echo "[{\"error\":\"user not set\"}]" ;			
			break;
		}
		default :{
			echo "[{\"error\":\"service not avaiable\"}]" ;
			break;
		}
	}
?>
