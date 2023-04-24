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
        
         $resultArray = $user->getAllByColumn("name", $name);

         if($resultArray == null)
         {
             $userSend['error'] ='Username not correct';
         }
         else
         {  

             if(password_verify($password, $resultArray[0]['password']))
             {
                 $userSend = array();
                 foreach ($resultArray as $row)
                 {
                     
                     unset($row['password']);
                     $userSend[] = $row;
                }
             }
            else
            {
                $userSend ['error'] = "Password not correct";
                
            } 
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