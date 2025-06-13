<?php
class Usuario {
    private $conexion;

    public function __construct() {
        // Conexión a la base de datos
        $this->conexion = new mysqli("localhost", "root", "", "LaPescaEnLinea");
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function registrar($nombre, $email, $password) {
        // Validar que los datos no estén vacíos
        if (empty($nombre) || empty($email) || empty($password)) {
            return "Todos los campos son obligatorios.";
        }

        // Validar formato del email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "El correo electrónico no es válido.";
        }

        // Encriptar la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Verificar si el email ya existe
        $stmt = $this->conexion->prepare("SELECT Id FROM Usuarios WHERE Email = ?");
        if (!$stmt) {
            return "Error en la consulta: " . $this->conexion->error;
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return "El correo ya está registrado.";
        }
        $stmt->close();

        // Insertar usuario
        $stmt = $this->conexion->prepare("INSERT INTO Usuarios (Nombre, Email, Password, Estatus) VALUES (?, ?, ?, 1)");
        if (!$stmt) {
            return "Error en la consulta: " . $this->conexion->error;
        }
        $stmt->bind_param("sss", $nombre, $email, $passwordHash);

        if ($stmt->execute()) {
            $stmt->close();
            return "Registro exitoso.";
        } else {
            $error = $stmt->error;
            $stmt->close();
            return "Error al registrar: " . $error;
        }
    }

    public function __destruct() {
        // Cerrar la conexión a la base de datos
        $this->conexion->close();
    }
}
?>