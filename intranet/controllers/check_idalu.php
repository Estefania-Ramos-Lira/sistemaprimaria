<?php
//require "../config/Conexion.php";
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "123456789";
$database = "asistencia";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el IDALU del formulario
$idalu = $_POST['dataContent'];

// Consultar si el IDALU existe en la tabla "alumno"
$sql = "SELECT * FROM alumno WHERE idalu = '$idalu'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // El IDALU existe
    echo "exists";
} else {
    // El IDALU no existe
    echo "not_exists";
}

$conn->close();
?>