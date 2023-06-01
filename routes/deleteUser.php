<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $gmail = $_POST['gmail'];

  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'e3p1';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
  }

  $sql = "DELETE FROM erabiltzailea WHERE gmail = ?";
  
  $stmt = $conn->prepare($sql);

  $stmt->bind_param("s", $gmail);
  
  if ($stmt->execute()) {
    echo 'Elemento eliminado correctamente';
  } else {
    echo 'Error al eliminar el elemento: ' . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
