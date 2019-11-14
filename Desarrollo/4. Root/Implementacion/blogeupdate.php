<?php
require_once('./coneccion.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json');

	$request = json_decode(file_get_contents("php://input"), true);

	//Mismos campos que el archivo de java
	$requestid = $request['id'];
	$requestblogentryvalue = $request['blog-entry-value'];
	
	//$requestPassword = $request['password'];
	//--------------------------


	$query = "UPDATE blog_entries SET entry_value = '" . $requestblogentryvalue . "' WHERE id = " . $requestid;  
	/* MODIFICAR EL QUERY PARA UN UPDATE*/
    
    $response = @mysqli_query($dbc, $query);
    if ($response == TRUE) {
        $respuestaFinal = "Successfully updated";
    } else {
        $respuestaFinal = "There was an error updating" . mysqli_error($response);
    }
    

/* Devolver JSON */
echo json_encode($respuestaFinal);