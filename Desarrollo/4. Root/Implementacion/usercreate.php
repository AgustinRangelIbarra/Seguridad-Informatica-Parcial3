<?php
    require_once('./coneccion.php');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header('Content-Type: application/json');


         $request = json_decode(file_get_contents("php://input"), true);

    $requestEmail = $request['email'];
    $requestfirstname= $request ['firstname'];
    $requestPassword = $request['password'];
    $requestlastname=$request['lastname'];
    $requestDaysOfPasswordValidity = $request['DaysOfPasswordValidity'];
    $requestisTemporalPassword = $request['isTemporalPassword'];
    $requestActivationKey = $request['ActivationKey'];
    $requestStatus = $request['Status'];
    $requestQiz1 = $request['Qiz1'];
    $requestQiz2 = $request['Qiz2'];
    $requestQiz3 = $request['Qiz3'];

    $query = "INSERT INTO users VALUES ('". $requestEmail ."', '".$requestPassword."', '".$requestfirstname."', '".$requestlastname."', '".$requestDaysOfPasswordValidity."', NOW(), '".$requestisTemporalPassword."', '".$requestActivationKey."', '".$requestStatus."','".$requestQiz1."','".$requestQiz2."','".$requestQiz3."')";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        if ($affected_rows == 1) {
            $respuestaFinal = "Successfully inserted";
        } else {
            $respuestaFinal = "There was an error inserting" . mysqli_error($response);
        }
        mysqli_stmt_close($stmt);
    

    mysqli_close($dbc);

    /* Devolver JSON */
    echo json_encode($respuestaFinal);


