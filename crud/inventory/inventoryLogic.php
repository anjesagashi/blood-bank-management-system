<?php
class Inventory {
    private $conn;
    private $table_name = "blood_inventory";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all inventory records with Center and Blood Group names
    public function getFullInventory() {
        $query = "SELECT bi.quantity_ml, bc.center_name, bg.group_name 
                  FROM " . $this->table_name . " bi
                  JOIN blood_centers bc ON bi.center_id = bc.id
                  JOIN blood_groups bg ON bi.blood_group_id = bg.id
                  ORDER BY bc.center_name ASC, bg.group_name ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get statistics for the top cards
    public function getInventoryStats() {
        $query = "SELECT 
                    SUM(quantity_ml) as total_volume, 
                    COUNT(DISTINCT center_id) as total_centers,
                    (SELECT COUNT(*) FROM " . $this->table_name . " WHERE quantity_ml < 2000) as low_stock_count
                  FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Optional: Get inventory for one specific center (Staff view)
    public function getInventoryByCenter($center_id) {
        $query = "SELECT bi.quantity_ml, bg.group_name 
                  FROM " . $this->table_name . " bi
                  JOIN blood_groups bg ON bi.blood_group_id = bg.id
                  WHERE bi.center_id = :center_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":center_id", $center_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>