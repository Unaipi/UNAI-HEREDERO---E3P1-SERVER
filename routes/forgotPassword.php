<?php

    require_once (__DIR__."/../controller/Controller.php");


    if (isset($_POST['gmail']) && isset($_POST['pasahitza']) )
    {

        $fuser['gmail'] = $_POST['gmail'];
        $fuser['pasahitza']    = $_POST['pasahitza'];

        $userSend['gmail']   = "";
        $userSend['pasahitza']   = "";
        $userSend['error']   = "";

        
            
            if($fuser['gmail'] == "" || $fuser['pasahitza'] == "")
            {
                $userSend['error'] = "Not all the fields were entered";
            }
            else
            {
  
                $resultArray = $user->getAllByColumn("gmail", $fuser['gmail']);

                if($resultArray == null)
                {
                    $userSend['error'] = ["Invalid gmail"];
                }
                else 
                {
                    $hashedpass = password_hash($fuser['pasahitza'], PASSWORD_DEFAULT);
                    $resultArray = $user->changePassDB($hashedpass, $fuser['gmail']);                    
                }
            }
           
            
        $json_user = json_encode($userSend);

        echo $json_user;
            
        
        
    }
    else
    {
        die ("Forbidden");
    }

?>