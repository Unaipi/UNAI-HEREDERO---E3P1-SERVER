<?php

require_once (__DIR__."./db/Conexion.php");
function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);

    return $var;
}


function obtenerRol($gmail)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e3p1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    $gmail = $conn->real_escape_string($gmail);

    $query = "SELECT rola FROM erabiltzailea WHERE gmail = '$gmail'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rola = $row['rola'];

        $conn->close();

        return $rola;
    } else {
        $conn->close();

        return null;
    }
}