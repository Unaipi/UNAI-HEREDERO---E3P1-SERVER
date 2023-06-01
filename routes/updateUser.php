<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $currentGmail = $_POST['currentGmail'];
  $gmail = $_POST['gmail'];
  $pasahitza = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT);
  $rola = $_POST['rola'];


  if (empty($gmail) || empty($pasahitza) || empty($rola)) {
    echo 'Todos los campos deben estar llenos.';
    exit;
  }

  if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
    echo 'El correo electrónico no tiene un formato válido.';
    exit;
  }

  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'e3p1';

  $conn = new mysqli($servername, $username, $password, $dbname);


  if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
  }


  $sql = "SELECT * FROM erabiltzailea WHERE gmail = '$gmail'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo 'El correo electrónico ya existe en la base de datos.';
    exit;
  }

  
  $sql = "UPDATE erabiltzailea SET gmail ='$gmail', pasahitza='$pasahitza', rola='$rola' WHERE gmail='$currentGmail'";


  // Ejecutar la consulta
  if ($conn->query($sql) === TRUE) {
    echo 'valid';
  } else {
    echo 'not valid ' . $conn->error;
  }

  $conn->close();
}

?>
