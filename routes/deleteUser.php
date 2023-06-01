<?php
// Verifica si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener el identificador único del elemento a eliminar
  $gmail = $_POST['gmail'];

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

  // Consulta SQL para eliminar el elemento de la base de datos utilizando una consulta preparada
  $sql = "DELETE FROM erabiltzailea WHERE gmail = ?";
  
  // Preparar la consulta
  $stmt = $conn->prepare($sql);
  
  // Vincular los parámetros y ejecutar la consulta
  $stmt->bind_param("s", $gmail);
  
  if ($stmt->execute()) {
    echo 'Elemento eliminado correctamente';
  } else {
    echo 'Error al eliminar el elemento: ' . $stmt->error;
  }

  // Cerrar la conexión
  $stmt->close();
  $conn->close();
}
?>
