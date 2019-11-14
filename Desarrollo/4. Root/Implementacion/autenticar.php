<?php
	require_once('./coneccion.php');
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	header('Content-Type: application/json');

	$request = json_decode(file_get_contents("php://input"), true);

	$requestEmail = $request['email'];


	$query = "SELECT email, password FROM users";
    
    $data = @mysqli_query($dbc, $query);
    
    $response = "false";

    while ($fila = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    	if($requestEmail == $fila['email']){
    		$response = "true"; 
    		break;
    	}
    }
    

    //$respuestaFinal = (object) $response
;/* Devolver JSON */
echo json_encode($response);