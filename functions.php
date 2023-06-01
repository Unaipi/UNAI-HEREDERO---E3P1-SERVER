<?php

require_once (__DIR__."./db/Conexion.php");
function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);

    return $var;
}


// Función para obtener el rol del usuario
function obtenerRol($gmail)
{
    // Realizar la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e3p1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Escapar el valor para evitar inyección de SQL
    $gmail = $conn->real_escape_string($gmail);

    // Realizar la consulta para obtener el rol del usuario
    $query = "SELECT rola FROM erabiltzailea WHERE gmail = '$gmail'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Obtener el rol del usuario
        $row = $result->fetch_assoc();
        $rola = $row['rola'];

        // Cerrar la conexión a la base de datos
        $conn->close();

        return $rola;
    } else {
        // Cerrar la conexión a la base de datos
        $conn->close();

        return null;
    }
}