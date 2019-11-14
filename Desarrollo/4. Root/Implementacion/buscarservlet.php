<?php
require_once('./coneccion.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json');

$request = json_decode(file_get_contents("php://input"), true);

$requestCriteria = $request['criteria'];

$query = "SELECT * FROM products WHERE name LIKE '%" . $requestCriteria ."%'";

$datos = array();

$data = @mysqli_query($dbc, $query);

while ($fila = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    $datos[$fila['id']] = array(
        'id'        => $fila['id'],
        'name'    => $fila['name'],
        'description'    => $fila['description'],
        'brand'    => $fila['brand'],
        'price'    => $fila['price'],
        'quantity'    => $fila['quantity'],
        'image'    => $fila['image']
    );
}
$respuestaFinal = (object) $datos;

mysqli_close($dbc);

/* Devolver JSON */
echo json_encode($respuestaFinal);