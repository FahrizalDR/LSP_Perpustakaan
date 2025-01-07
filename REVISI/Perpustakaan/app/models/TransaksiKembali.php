<?php
class TransaksiKembali {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllTransKembali() {
        $query = "SELECT * FROM viewTransKembali";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }    
}
?>