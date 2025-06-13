<?php
class Database {
    private static $instancia = null;
    private $conexion;

  // Configuración MySQL/MariaDB
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasena = '';
    private $baseDatos = 'LaPescaEnLinea'; // nombre en minúsculas
    private $puerto = 3306;
    private $charset = 'utf8mb4';


    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};port={$this->puerto};dbname={$this->baseDatos};charset={$this->charset}";
            
            $this->conexion = new PDO(
                $dsn,
                $this->usuario,
                $this->contrasena,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            error_log("Error de conexión: " . $e->getMessage());
            die("Error al conectar con la base de datos");
        }
    }

    // Devuelve la instancia de la clase Database (Singleton)
    public static function getInstance() {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    // Devuelve la conexión PDO
    public function getConnection() {
        return $this->conexion;
    }
    
    // Evitar clonación y serialización
    private function __clone() {}
    public function __wakeup() {}


    
 
}