<?php

require_once (__DIR__.'/../functions.php');
require_once (__DIR__.'/../controller/Controller.php');

if(isset($_POST['gmail']) && isset($_POST['pasahitza']))
{
    $gmail = sanitizeString($_POST['gmail']);
    $pasahitza = sanitizeString($_POST['pasahitza']);
    $userSend['gmail'] = "";
    $userSend['pasahitza'] = "";
    $userSend['error'] = "";

    if($gmail == "" || $pasahitza == "")
    {
        $userSend['error'] = "Not all the fields were entered";
    }
    else
    {
        $resultArray = $user->getAllByColumn("gmail", $gmail);

        if($resultArray == null)
        {
            $userSend['error'] = 'Gmail not correct';
        }
        else
        {
            if(password_verify($pasahitza, $resultArray[0]['pasahitza']))
            {
                $userSend = array();
                foreach ($resultArray as $row)
                {
                    unset($row['pasahitza']);

                    // Obtener el rol del usuario
                    $rola = obtenerRol($row['gmail']);

                    $row['rola'] = $rola;

                    $userSend[] = $row;
                }
            }
            else
            {
                $userSend['error'] = "Password not correct";
            }
        }
    }

    $json_user = json_encode($userSend);
    echo $json_user;
}
else
{
    die("Forbidden");
}

 ?>