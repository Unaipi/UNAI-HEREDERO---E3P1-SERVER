<?php

require_once "ModelBase.php";

class User extends ModelBase
{
    function __construct()
    {
        $this->table_name = "erabiltzailea";

        parent::__construct();
    }
}

?>