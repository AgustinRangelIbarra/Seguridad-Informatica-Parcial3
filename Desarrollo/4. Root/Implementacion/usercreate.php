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
    




    /*
    String email = request.getParameter("email");
        String firstname = request.getParameter("firstname");
        String lastname = request.getParameter("lastname");
        String password = request.getParameter("password");
        String passwordConfirmation = request.getParameter("password-confirmation");
        String qiz1 = request.getParameter("qiz1");
        String qiz2 = request.getParameter("qiz2");
        String qiz3 = request.getParameter("qiz3");*/

