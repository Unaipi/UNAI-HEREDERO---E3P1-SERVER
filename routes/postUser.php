<?php

    require_once (__DIR__."/../controller/Controller.php");


    if (isset($_POST['name']) && isset($_POST['password']) )
    {
        //Si se reciben todos los datos por POST Creamos nuestro nuevo objeto
        $newUser['name']   = $_POST['name'];
        $newUser['password']    = password_hash($_POST['password'],PASSWORD_DEFAULT);

        //password_hash($password,PASSWORD_DEFAULT)

        //Añadimos el nuevo objeto a la BD
        
            $returnValue = $user->addNew($newUser);

            if ($returnValue == FALSE)
            {
                echo "Error en la introduccion de nuevo elemento en la BD";
            }
            else
            {
                //Devolvemos el resultado añadido de la BD con JSON
                echo json_encode($newUser);
            }
        
        
    }
    else
    {
        die ("Forbidden");
    }

?>