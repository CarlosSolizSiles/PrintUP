<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password !== $confirm_password) {
        header("Location: reset_password.php?token=$token&error=Las contraseñas no coinciden.");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "printup";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM password_resets WHERE token = ? AND expires >= ?";
    $stmt = $conn->prepare($sql);
    $current_time = date("U");
    $stmt->bind_param("si", $token, $current_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row["email"];

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET Contrasena = ? WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();

        $sql = "DELETE FROM password_resets WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        header("Location: inicio.php?success=Contraseña actualizada correctamente.");
    } else {
        header("Location: reset_password.php?token=$token&error=Token inválido o expirado.");
    }

    $stmt->close();
    $conn->close();
}
?>