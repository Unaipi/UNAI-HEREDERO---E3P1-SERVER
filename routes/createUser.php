<?php

// Verifica si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos enviados por la solicitud POST
  $gmail = $_POST['gmail'];
  $pasahitza = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT);
  $rola = $_POST['rola'];

  // Verificar si el correo electrónico tiene el formato correcto
  if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
    echo 'El correo electrónico no tiene un formato válido.';
    exit;
  }

  // Conectarse a la base de datos (ajusta estos valores según tu configuración)
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'e3p1';

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar la conexión
  if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
  }

  // Consulta SQL para verificar si el correo electrónico ya existe en la base de datos
  $sql = "SELECT * FROM erabiltzailea WHERE gmail = '$gmail'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo 'El correo electrónico ya existe en la base de datos.';
    exit;
  }

  // Consulta SQL para insertar el nuevo usuario en la base de datos
  $sql = "INSERT INTO erabiltzailea (gmail, pasahitza, rola) VALUES ('$gmail', '$pasahitza', '$rola')";

  // Ejecutar la consulta
  if ($conn->query($sql) === TRUE) {
    echo 'valid';
  } else {
    echo 'not valid ' . $conn->error;
  }

  // Cerrar la conexión
  $conn->close();
}
?>
