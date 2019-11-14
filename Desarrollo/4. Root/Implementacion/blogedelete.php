<?php
require_once('./coneccion.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json');

$request = json_decode(file_get_contents("php://input"), true);

$requestid = $request['id'];

$query = "DELETE FROM blog_entries where id = " . $requestid;

$response = @mysqli_query($dbc, $query);
if ($response == TRUE) {
    $respuestaFinal = "Successfully deleted";
} else {
    $respuestaFinal = "There was an error deleting" . mysqli_error($response);
}

mysqli_close($dbc);

/* Devolver JSON */
echo json_encode($respuestaFinal);