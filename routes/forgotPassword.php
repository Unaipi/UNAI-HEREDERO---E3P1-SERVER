<?php

    require_once (__DIR__."/../controller/Controller.php");


    if (isset($_POST['name']) && isset($_POST['password']) )
    {

        $fuser['name'] = $_POST['name'];
        $fuser['password']    = $_POST['password'];

        $userSend['name']   = "";
        $userSend['password']   = "";
        $userSend['error']   = "";

        
            
            if($fuser['name'] == "" || $fuser['password'] == "")
            {
                $userSend['error'] = "Not all the fields were entered";
            }
            else
            {
  
                $resultArray = $user->getAllByColumn("name", $fuser['name']);
                //$userSend['error']="";

                if($resultArray == null)
                {
                    $userSend['error'] = ["Invalid name"];
                }
                else 
                {
                    $hashedpass = password_hash($fuser['password'], PASSWORD_DEFAULT);
                    $resultArray = $user->changePassDB($hashedpass, $fuser['name']);
                    //$userSend['correct'] = ["Changed Pass"];
                    
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