<?php
	require_once('./coneccion.php');
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	header('Content-Type: application/json');

	$request = json_decode(file_get_contents("php://input"), true);

	$requestEmail = $request['email'];
	$requestPassword = $request['password'];
	$respuestaFinal;

	$query = "SELECT email, password FROM users";
    
    $data = @mysqli_query($dbc, $query);
    
	$datos['response'] = array(
		'email'        	=> $requestEmail,
		'password'    	=> $requestPassword,
		'access'		=> 'false');
	$datos['otraClave'] = 'OtroValor';

	$response = @mysqli_query($dbc, $query);
	while ($fila = mysqli_fetch_array($response, MYSQLI_ASSOC)) {
		if($requestEmail == $fila['email'] && $requestPassword == $fila['password']){
			$datos['response']['access'] = 'true';			
			break;
		}
	}

	$respuestaFinal = (object) $datos;
	
/* Devolver JSON */
echo json_encode($respuestaFinal);