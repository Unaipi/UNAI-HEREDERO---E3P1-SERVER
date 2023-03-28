<?php

require_once "ModelBase.php";

class User extends ModelBase
{
    function __construct()
    {
        $this->table_name = "users";

        parent::__construct();
    }
}

?>