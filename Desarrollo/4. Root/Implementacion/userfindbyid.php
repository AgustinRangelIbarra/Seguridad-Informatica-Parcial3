<?php
require_once('./coneccion.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json');

$request = json_decode(file_get_contents("php://input"), true);

$requestemail = $request['email'];

$query = "SELECT * FROM users WHERE email = '" . $requestemail . "'";

$datos = array();

$data = @mysqli_query($dbc, $query);

while ($fila = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    $datos[$fila['id']] = array(
        'email'        => $fila['email'],
        'firstname'    => $fila['firstname'],
        'lastname'    => $fila['lastname'],
        'days_of_password_validity'    => $fila['days_of_password_validity'],
        'date_of_last_password_update'    => $fila['date_of_last_password_update'],
        'is_temporal_password'    => $fila['is_temporal_password'],
        'activation_key'    => $fila['activation_key'],
        'status'    => $fila['status']
    );
}
$respuestaFinal = (object) $datos;

mysqli_close($dbc);

/* Devolver JSON */
echo json_encode($respuestaFinal);