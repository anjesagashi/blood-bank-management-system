<?php 
class User {
    private $conn;
    private $users_table = 'users';
    private $donors_table = 'donors';
    private $centers_table = 'blood_centers';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registerDonors($uName, $email, $pass, $role, $fName, $lName, $bDate, $bType) {
        $query1 = "INSERT INTO {$this->users_table} (username, email, password, role_id) 
                   VALUES (:username, :email, :password, :role)";
        $stmt1 = $this->conn->prepare($query1);
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt1->execute([
            ':username' => $uName,
            ':email'    => $email,
            ':password' => $hashedPass,
            ':role'     => $role
        ]);

        $userId = $this->conn->lastInsertId();

        $query2 = "INSERT INTO {$this->donors_table} (id, first_name, last_name, birthdate, blood_group_id) 
                   VALUES (:id, :fname, :lname, :bdate, :btype)";
        $stmt2 = $this->conn->prepare($query2);
        
        return $stmt2->execute([
            ':id'    => $userId, 
            ':fname' => $fName,
            ':lname' => $lName,
            ':bdate' => $bDate,
            ':btype' => $bType
        ]);
    }

    public function registerBloodCenter($username, $email, $password, $role, $name, $city, $phone, $desc, $map, $img) {
    $query1 = "INSERT INTO {$this->users_table} (username, email, password, role_id) 
                   VALUES (:username, :email, :password, :role)";
        $stmt1 = $this->conn->prepare($query1);
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        $stmt1->execute([
            ':username' => $username,
            ':email'    => $email,
            ':password' => $hashedPass,
            ':role'     => $role
        ]);
         $userId = $this->conn->lastInsertId();
         $query2 = "INSERT INTO {$this->centers_table} (id, center_name, img_src, city, phone_number,description,map_link) 
                   VALUES (:id, :center_name, :img_src, :city, :phone_number, :description, :map_link)";
        $stmt2 = $this->conn->prepare($query2);
         return $stmt2->execute([
            ':id'    => $userId, 
            ':center_name' => $name,
            ':img_src' => $img,
            ':city' => $city,
            ':phone_number' => $phone,
            ':description' => $desc,
            ':map_link' => $map
        ]);
}
   public function createAdmin($username, $email, $password) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO {$this->users_table} (username, email, password, role_id) 
                    VALUES (:username, :email, :password, 1)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':email'    => $email,
                ':password' => $hashedPass
            ]);
            return true;
}
public function login($username, $password){
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user; 
    } else {
        return false;
    }
}


    public function getAllDonors() {
    
    $query = "SELECT u.id, d.first_name, d.last_name, u.email, d.birthdate, bg.group_name as blood_group 
            FROM users u 
            JOIN donors d ON u.id = d.id
            Join blood_groups bg ON bg.id = d.blood_group_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getAllCenters() {
    $sql = "SELECT * FROM {$this->centers_table}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getDonorById($id) {
    try {
        $sql = "SELECT u.id, u.email, 
                       d.first_name, d.last_name, d.birthdate, d.blood_group_id 
                FROM users u 
                JOIN donors d ON u.id = d.id 
                WHERE u.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Gabim në getDonorById: " . $e->getMessage());
        return null;
    }
}
public function getCenterById($id) {
    try {
        $sql = "SELECT u.username, u.email, bc.* FROM {$this->users_table} u
                INNER JOIN {$this->centers_table} bc ON u.id = bc.id 
                WHERE u.id = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Gabim te getCenterById: " . $e->getMessage());
        return null;
    }
}
public function getAdminById($id) {
    try {
        $sql = "SELECT id, username, email, role_id FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error in getAdminById: " . $e->getMessage());
        return false;
    }
}
public function editDonor($id, $fName, $lName, $email, $birthdate, $blood_id) {
    try {
        $sql1 = "UPDATE users SET email = :email WHERE id = :id";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute([
            ':email'   => $email,
            ':id'      => $id
        ]);
        $sql2 = "UPDATE donors SET 
                    first_name = :fname, 
                    last_name = :lname, 
                    birthdate = :bdate, 
                    blood_group_id = :bgroup 
                 WHERE id = :id";
        $stmt2 = $this->conn->prepare($sql2);
        
        return $stmt2->execute([
            ':fname'  => $fName,
            ':lname'  => $lName,
            ':bdate'  => $birthdate,
            ':bgroup' => $blood_id,
            ':id'     => $id
        ]);

    } catch (PDOException $e) {
        die("Gabim gjatë editimit: " . $e->getMessage());
    }
}
public function editProfile($id, $fName, $lName, $email, $birthdate, $blood_id, $password = null) {
    try {
        
        $sql1 = "UPDATE users SET email = :email WHERE id = :id";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute([':email' => $email, ':id' => $id]);

        if (!empty($password)) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $sqlPass = "UPDATE users SET password = :pass WHERE id = :id";
            $stmtPass = $this->conn->prepare($sqlPass);
            $stmtPass->execute([':pass' => $hashedPass, ':id' => $id]);
        }

       
        $sql2 = "UPDATE donors SET 
                    first_name = :fname, 
                    last_name = :lname, 
                    birthdate = :bdate, 
                    blood_group_id = :bgroup 
                 WHERE id = :id";
        $stmt2 = $this->conn->prepare($sql2);
        
        return $stmt2->execute([
            ':fname'  => $fName,
            ':lname'  => $lName,
            ':bdate'  => $birthdate,
            ':bgroup' => $blood_id,
            ':id'     => $id
        ]);

    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

public function updateAdminProfile($id, $username, $email, $password = null) {
    try {
        $query = "UPDATE users SET username = :username, email = :email";
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':id' => $id
        ];

        if (!empty($password)) {
            $query .= ", password = :password";
            $params[':password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $query .= " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    } catch (PDOException $e) {
        return false;
    }
}
public function updateCenterProfile($id, $username, $email, $center_name, $city, $phone, $description, $map_link, $password = null) {
    try {
        $this->conn->beginTransaction();

    
        $query1 = "UPDATE users SET username = :username, email = :email";
        if (!empty($password)) {
            $query1 .= ", password = :password";
        }
        $query1 .= " WHERE id = :id";

        $stmt1 = $this->conn->prepare($query1);
        $params1 = [
            ':username' => $username,
            ':email' => $email,
            ':id' => $id
        ];
        if (!empty($password)) {
            $params1[':password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $stmt1->execute($params1);

        $query2 = "UPDATE blood_centers SET 
                    center_name = :cname, 
                    city = :city, 
                    phone_number = :phone, 
                    description = :desc, 
                    map_link = :map 
                   WHERE id = :id";
        
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute([
            ':cname' => $center_name,
            ':city'  => $city,
            ':phone' => $phone,
            ':desc'  => $description,
            ':map'   => $map_link,
            ':id'    => $id
        ]);

        $this->conn->commit();
        return true;
    } catch (Exception $e) {
        $this->conn->rollBack();
        return false;
    }
}
public function editCenter($id, $username, $email, $name, $city, $phone, $desc, $map, $img) {
     try {
        $query1 = "UPDATE {$this->users_table} SET username = :username, email = :email WHERE id = :id";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->execute([
            ':username' => $username,
            ':email'    => $email,
            ':id'       => $id
        ]);

        $query2 = "UPDATE {$this->centers_table} SET 
                    center_name = :name, 
                    city = :city, 
                    phone_number = :phone, 
                    description = :desc, 
                    map_link = :map, 
                    img_src = :img 
                   WHERE id = :id";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute([
            ':name'  => $name,
            ':city'  => $city,
            ':phone' => $phone,
            ':desc'  => $desc,
            ':map'   => $map,
            ':img'   => $img,
            ':id'    => $id
        ]);
       return true;
         } catch (PDOException $e) {
        die("Gabim gjatë editimit: " . $e->getMessage());
    }
}
public function deleteUser($id) {
    try {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Gabim gjatë fshirjes: " . $e->getMessage());
        return false;
    }
}

public function countTotalDonors() {
    $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 2";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}
public function countTotalCenters() {
    $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 3";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

public function countTotalAdmins() {
    $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

}
?>