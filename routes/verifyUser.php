<?php

require_once (__DIR__.'/../functions.php');
require_once (__DIR__.'/../controller/Controller.php');

if(isset($_POST['name']) && isset($_POST['lastName']))
{
        $name   = sanitizeString($_POST['name']);
        $lastName   = sanitizeString($_POST['lastName']);

        $userSend['name']   = "";
        $userSend['lastName']   = "";
        $userSend['error']   = "";


    if($name == "" || $lastName == "")
    {
        $userSend['error'] = "Not all the fields were entered";
    }
    else
    {
        $resultArray = $user->getAllBy2Columns("name", $name, "lastName", $lastName);
        
        if($resultArray == null)
        {
            $userSend['error'] = "Invalid login attempt";
        }
        else
        {
            $userSend['name']   = $name;
            $userSend['lastName']   = $lastName;
        }

    }

    echo json_encode($userSend);
}
else
{
     die ("Forbidden");
}

 ?>