<?php
class Donation {
    private $conn;
    private $table_name = "donation_appointments";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createAppointment($donor_id, $center_id, $amount_ml) {
    try {
        $query = "INSERT INTO " . $this->table_name . " 
                  (donor_id, center_id, amount_ml, status_id) 
                  VALUES (:donor_id, :center_id, :amount_ml, 1)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":donor_id", $donor_id);
        $stmt->bindParam(":center_id", $center_id);
        $stmt->bindParam(":amount_ml", $amount_ml);

        return $stmt->execute(); 

    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        return false;
    }
}

  public function getPendingAppointments() {
    $query = "SELECT da.id, d.first_name, d.last_name, bg.group_name, bc.center_name 
              FROM donation_appointments da
              JOIN donors d ON da.donor_id = d.id
              JOIN blood_groups bg ON d.blood_group_id = bg.id
              JOIN blood_centers bc ON da.center_id = bc.id
              WHERE da.status_id = 1 
              ORDER BY da.created_at ASC";
    
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getDonationHistory() {
    $query = "SELECT da.id, d.first_name, d.last_name, bc.center_name, 
                     da.scheduled_date, da.amount_ml, s.status_name 
              FROM donation_appointments da
              JOIN donors d ON da.donor_id = d.id
              JOIN blood_centers bc ON da.center_id = bc.id
              JOIN appointment_statuses s ON da.status_id = s.id
              WHERE da.status_id != 1 
              ORDER BY da.scheduled_date DESC";
    
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function approveAppointment($id, $date) {
    try {
        $query = "UPDATE donation_appointments 
                  SET scheduled_date = :scheduled_date, status_id = 2 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':scheduled_date' => $date,
            ':id' => $id
        ]);
    } catch (PDOException $e) {
        return false;
    }
}

public function getTodaysAppointmentsByCenter($center_id) {
    $today = date('Y-m-d');
    $query = "SELECT da.id, d.first_name, d.last_name, bg.group_name, da.status_id 
              FROM donation_appointments da
              JOIN donors d ON da.donor_id = d.id
              JOIN blood_groups bg ON d.blood_group_id = bg.id
              WHERE da.center_id = :center_id 
              AND da.scheduled_date = :today
              AND da.status_id = 2"; 
    
    $stmt = $this->conn->prepare($query);
    $stmt->execute([
        ':center_id' => $center_id,
        ':today' => $today
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function updateAppointmentStatus($id, $status_id) {
    try {
        $this->conn->beginTransaction();
        $query = "UPDATE donation_appointments SET status_id = :status_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':status_id' => $status_id, ':id' => $id]);

        
        if ($status_id == 3) {
            
            $detailsQuery = "SELECT da.center_id, da.amount_ml, d.blood_group_id 
                             FROM donation_appointments da 
                             JOIN donors d ON da.donor_id = d.id 
                             WHERE da.id = :id";
            $detailsStmt = $this->conn->prepare($detailsQuery);
            $detailsStmt->execute([':id' => $id]);
            $donation = $detailsStmt->fetch(PDO::FETCH_ASSOC);

            if ($donation) {
                
                $inventoryQuery = "INSERT INTO blood_inventory (center_id, blood_group_id, quantity_ml) 
                                   VALUES (:center_id, :blood_group_id, :amount)
                                   ON DUPLICATE KEY UPDATE quantity_ml = quantity_ml + :amount2";
                
                $invStmt = $this->conn->prepare($inventoryQuery);
                $invStmt->execute([
                    ':center_id' => $donation['center_id'],
                    ':blood_group_id' => $donation['blood_group_id'],
                    ':amount' => $donation['amount_ml'],
                    ':amount2' => $donation['amount_ml']
                ]);
            }
        }

        $this->conn->commit();
        return true;
    } catch (Exception $e) {
        $this->conn->rollBack();
        return false;
    }
}

public function getMyAppointments($donor_id) {
    $query = "SELECT da.*, bc.center_name, bc.city, s.status_name 
              FROM donation_appointments da
              JOIN blood_centers bc ON da.center_id = bc.id
              JOIN appointment_statuses s ON da.status_id = s.id
              WHERE da.donor_id = :donor_id
              ORDER BY da.created_at DESC";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":donor_id", $donor_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>