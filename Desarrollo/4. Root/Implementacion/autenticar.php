<?php
	require_once('./coneccion.php');
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	header('Content-Type: application/json');



	$request = json_decode(file_get_contents("php://input"), true);
	$requestpassword = $request['password'];

	$requestEmail = $request['email'];

	$peticion = '{"word":"' . $requestpassword .'","key":"key","type":"decode","response":""}';

	$espejo = "http://35.235.124.40:8000/";

        $ch = curl_init($espejo);
        //$payload = json_encode($peticion);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $peticion);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
		curl_close($ch);
		
		$result = json_decode($result,true);

	$query = "SELECT email, password FROM users";
    
    $data = @mysqli_query($dbc, $query);
    
    $response = "false";

    while ($fila = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    	if($requestEmail == $fila['email'] && $result['response'] == $fila['password']){
    		$response = "true"; 
    		break;
    	}
	}
	
    

    //$respuestaFinal = (object) $response
;/* Devolver JSON */
echo json_encode($response);
