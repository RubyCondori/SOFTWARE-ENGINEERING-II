<?php
require_once __DIR__ . '/../config/Database.php';

class HotelModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function obtenerHotelesDestacados() {
        try {
            $stmt = $this->db->query(
                "SELECT h.*, i.Imagen 
                 FROM Hoteles h
                 LEFT JOIN Imagenes i ON h.Id = i.HotelId
                 WHERE h.Estatus = 1
                 GROUP BY h.Id
                 ORDER BY h.Calificacion DESC
                 LIMIT 6"
            );
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error en HotelModel: " . $e->getMessage());
            return [];
        }
    }
    
    public function eliminarHotel($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Hoteles WHERE Id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error eliminando hotel: " . $e->getMessage());
            return false;
        }
    }
}
?>