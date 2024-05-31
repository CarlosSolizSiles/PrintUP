<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "printup";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM usuarios WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $expires = date("U") + 1800;

        $sql = "INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $token, $expires);
        $stmt->execute();

        $resetLink = "http://localhost/printup/logeo/reset_password.php?token=$token"; // Cambia "tu_proyecto" por la carpeta de tu proyecto
        $subject = "Recuperación de Contraseña - PrintUP";
        $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: $resetLink";
        $headers = "From: no-reply@localhost";

        // Enviar el correo electrónico
        mail($email, $subject, $message, $headers);

        header("Location: request_password_reset.php?success=Correo enviado. Revisa tu bandeja de entrada.");
    } else {
        header("Location: request_password_reset.php?error=Correo electrónico no encontrado.");
    }

    $stmt->close();
    $conn->close();
}
?>
