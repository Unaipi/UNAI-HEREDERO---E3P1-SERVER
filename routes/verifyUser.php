<?php

require_once (__DIR__.'/../functions.php');
require_once (__DIR__.'/../controller/Controller.php');

if(isset($_POST['name']) && isset($_POST['password']))
{
        $name   = sanitizeString($_POST['name']);
        $password   = sanitizeString($_POST['password']);

        $userSend['name']   = "";
        $userSend['password']   = "";
        $userSend['error']   = "";


    if($name == "" || $password == "")
    {
        $userSend['error'] = "Not all the fields were entered";
    }
    else
    {
        $resultArray = $user->getAllBy2Columns("name", $name, "password", $password);
        
        if($resultArray == null)
        {
            $userSend['error'] = "Invalid login attempt";
        }
        else
        {
            $userSend['name']   = $name;
            $userSend['password']   = $password;
        }

    }

    echo json_encode($userSend);
}
else
{
     die ("Forbidden");
}

 ?>