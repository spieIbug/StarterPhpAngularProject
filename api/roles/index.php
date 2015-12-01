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
				if (!empty($_GET['user'])){
					include_once("Controller.php");
					$controller = new RolesController();
					$response = $controller->getUserRoles($user);
					echo json_encode($response);
				} else echo "[{\"error\":\"query params error\"}]" ;
			}
			else echo "[{\"error\":\"query params error\"}]" ;			
			break;
		}
		default :{
			echo "[{\"error\":\"service not avaiable\"}]" ;
			break;
		}
	}
?>
