<?php

    require_once (__DIR__."/../controller/Controller.php");


    if (isset($_POST['gmail']) && isset($_POST['pasahitza']) )
    {
        $newUser['gmail'] = $_POST['gmail'];
        $newUser['pasahitza'] = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT);

        if (filter_var($newUser['gmail'], FILTER_VALIDATE_EMAIL)) {

            $returnValue = $user->addNew($newUser);

            if ($returnValue == false) {
                echo "Error en la introducción de un nuevo elemento en la base de datos";
            } else {

                echo json_encode($newUser);
            }
        } else {

    $errorResponse = [
        
        'error' => 'La dirección de correo electrónico no es válida'
    ];
    $userSend['error'] = "Not all the fields were entered";
    echo json_encode($errorResponse);
    
}
        
        
    }
    else
    {
        die ("Forbidden");
    }

?>

