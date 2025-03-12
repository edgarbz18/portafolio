<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "u875190719_Edgar_BZ";
$password = "19283756401Bz1819EE@";
$dbname = "u875190719_usuariosBlog";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$name = $_POST['name'];
$age = $_POST['age'];
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Establecer el encabezado de respuesta a JSON
header('Content-Type: application/json');

$checkUserSql = "SELECT * FROM Usuarios WHERE usuario = ?";
$stmt = $conn->prepare($checkUserSql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Devolver un JSON con un mensaje de error
    echo json_encode(['status' => 'error', 'message' => 'El nombre de usuario ya está registrado. Elige otro.']);
} else {
    $sql = "INSERT INTO Usuarios (nombre, edad, usuario, contraseña) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $name, $age, $user, $pass);

    if ($stmt->execute()) {
        // Devolver un JSON de éxito
        echo json_encode(['status' => 'success', 'message' => 'Registro exitoso']);
    } else {
        // Devolver un mensaje de error en caso de fallo en la inserción
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }
}

$stmt->close();
$conn->close();
?>
