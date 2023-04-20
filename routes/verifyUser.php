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
         $resultArray = $user ->getAllByColumn("name",$name);

         if($resultArray == null)
         {
             $userSend['error'] ='Name erroneo';
         }
         else
         {
            $hash ='$2y$10$QJ7GcWeP9N7RXWWGepnTb.H9mTNFbhzf4NLD1J6ZSypgdo9V0ZUXa';

             if(password_verify($password, $hash))
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
            $userSend ['error'] = "Error password";
            echo password_verify(password_verify($password, $hash));
            //echo $resultArray[0]['password'];


            
            } 
         }
    }
//     {
//         $resultArray = $user->getAllBy2Columns("name", $name, "password", $password);
        
//         if($resultArray == null)
//         {
//             $userSend['error'] = "Invalid login attempt";
//         }
//         else
//         {
//             $userSend['name']   = $name;
//             $userSend['password']   = $password;
//         }

//     }

    $json_user = json_encode($userSend);
    echo $json_user;
}
else
{
     die ("Forbidden");
}

 ?>