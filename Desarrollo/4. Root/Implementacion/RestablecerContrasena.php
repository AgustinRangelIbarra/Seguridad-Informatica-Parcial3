<?php
	require_once('./coneccion.php');
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	header('Content-Type: application/json');

	$request = json_decode(file_get_contents("php://input"), true);

	//Mismos campos que el archivo de java
	$requestEmail = $request['email'];
	$newpassword = $request['newpass'];
	
	//$requestPassword = $request['password'];
	//--------------------------


	$query = "UPDATE users SET password='" . $newpassword ."' where email='" . $requestEmail . "' ";  
	/* MODIFICAR EL QUERY PARA UN UPDATE*/
    
    $response = @mysqli_query($dbc, $query);
    if ($response == TRUE) {
        $respuestaFinal = "Successfully updated";
    } else {
        $respuestaFinal = "There was an error updating" . mysqli_error($response);
    }
    

    //$respuestaFinal = (object) $response
;/* Devolver JSON */
echo json_encode($response);