<?php
require_once('./coneccion.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json');

$request = json_decode(file_get_contents("php://input"), true);

$requestemail = $request['email'];
$requestqiz1 = $request['qiz1'];
$requestqiz2 = $request['qiz2'];
$requestqiz3 = $request['qiz3'];

$query = "SELECT * FROM users WHERE email = '" . $requestemail . "'  AND p1 = '" . $requestqiz1 . "' AND P2 = '" . $requestqiz2 . "' AND P3 = '" . $requestqiz3 . "'";

$datos = array();

$data = @mysqli_query($dbc, $query);

while ($fila = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    $datos[$fila['id']] = array(
        'email'        => $fila['email'],
        'firstname'    => $fila['firstname'],
        'lastname'    => $fila['lastname'],
        'password'    => $fila['password'],
        'days_of_password_validity'    => $fila['days_of_password_validity'],
        'date_of_last_password_update'    => $fila['date_of_last_password_update'],
        'is_temporal_password'    => $fila['is_temporal_password'],
        'activation_key'    => $fila['activation_key'],
        'status'    => $fila['status'],
        'p1'    => $fila['p1'],
        'P2'    => $fila['P2'],
        'P3'    => $fila['P3']
    );
}
$respuestaFinal = (object) $datos;

mysqli_close($dbc);

/* Devolver JSON */
echo json_encode($respuestaFinal);