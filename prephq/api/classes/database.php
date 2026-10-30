<?php
class Database
{
    private $server_name = 'localhost';
    private $database_username = 'u733794648_prephq';
    private $database_password = 'PrepHq@123';
    private $database_name = 'u733794648_prephq';
    private $connection = null;
    
    private function connect(): void
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        if ($this->connection->connect_error) {
            throw new Exception('Database connection failed: ' . $this->connection->connect_error);
        }
        $this->connection->set_charset('utf8mb4');
    }
    
    private function close(): void
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
    


    public function register($user)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8mb4');
    
        $sql = $this->connection->prepare(
            'INSERT INTO user (`name`, `lastname`, `username`, `password`, `email`, `status`, `created_date`) 
             VALUES (?,?,?,?,?,?,?)'
        );
    
        // Use password_hash() for secure storage
        // $hashedPassword = password_hash($user['password'], PASSWORD_BCRYPT);
        $hashedPassword = $user['password'];
    
        $sql->bind_param(
            'sssssis',
            $user['name'],
            $user['lastname'],
            $user['username'],
            $hashedPassword,
            $user['email'],
            $user['status'],
            $user['created_date']
        );
    
        if ($sql->execute()) {
            $id = $this->connection->insert_id;
            $sql->close();
            $this->connection->close();
            return $id;
        }
    
        $sql->close();
        $this->connection->close();
        return false;
    }

    public function generateConfirmCode($user_id)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8');

        $sql = $this->connection->prepare(
            'INSERT INTO `accountconfirm`(`user_id`, `code`) VALUES(?,?) 
             ON DUPLICATE KEY UPDATE code=?, created_at=CURRENT_TIMESTAMP'
        );

        $code = rand(11111, 99999);
        $sql->bind_param('iss', $user_id, $code, $code);

        if ($sql->execute()) {
            $sql->close();
            $this->connection->close();
            return $code;
        }

        $sql->close();
        $this->connection->close();
        return false;
    }

   public function validateAndUseConfirmCode($email, $code)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8mb4');
    
        // Expire old codes
        $expireStmt = $this->connection->prepare("UPDATE accountconfirm SET status='EXPIRED' WHERE expires_at < NOW() AND status='PENDING'");
        $expireStmt->execute();
        $expireStmt->close();
    
        $sql = $this->connection->prepare(
            'SELECT id, status, expires_at FROM accountconfirm WHERE email=? AND code=? LIMIT 1'
        );
        $sql->bind_param('ss', $email, $code);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
    
        if (!$row) {
            $sql->close();
            $this->connection->close();
            return false;
        }
        // Not pending or expired
        if ($row['status'] !== 'PENDING' || strtotime($row['expires_at']) < time()) {
            $sql->close();
            $this->connection->close();
            return false;
        }
    
        // Delete OTP on successful confirmation
        $del = $this->connection->prepare("DELETE FROM accountconfirm WHERE email=?");
        $del->bind_param('s', $email);
        $del->execute();
        $del->close();
    
        $sql->close();
        $this->connection->close();
        return true;
    }
    
   public function createConfirmCodeForEmail($email, $ttlMinutes = 5)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8mb4');
    
        $code = strval(rand(11111, 99999));
        $now = date('Y-m-d H:i:s');
        $expires = date('Y-m-d H:i:s', time() + $ttlMinutes * 60);
    
        $sql = $this->connection->prepare(
            'INSERT INTO accountconfirm (email, code, created_at, expires_at, status, attempts) 
             VALUES (?, ?, ?, ?, "PENDING", 0)
             ON DUPLICATE KEY UPDATE code=VALUES(code), created_at=VALUES(created_at), expires_at=VALUES(expires_at), status="PENDING", attempts=0'
        );
        $sql->bind_param('ssss', $email, $code, $now, $expires);
    
        if ($sql->execute()) {
            $sql->close();
            $this->connection->close();
            return $code;
        }
        $sql->close();
        $this->connection->close();
        return false;
    }
    
    public function validateConfirmCode(string $email, string $code): array
    {
        $this->connect();
    
        $exp = $this->connection->prepare("
            UPDATE accountconfirm
            SET status = 'EXPIRED'
            WHERE expires_at < NOW() AND status = 'PENDING'
        ");
        $exp->execute();
        $exp->close();
    
        $sql = $this->connection->prepare("
            SELECT id, status, expires_at
            FROM accountconfirm
            WHERE email=? AND code=?
            LIMIT 1
        ");
        $sql->bind_param('ss', $email, $code);
        $sql->execute();
        $res = $sql->get_result();
        $row = $res->fetch_assoc();
        $sql->close();
    
        if (!$row) {
            $this->close();
            return ['valid' => false, 'reason' => 'Invalid code'];
        }
        if ($row['status'] !== 'PENDING') {
            $this->close();
            return ['valid' => false, 'reason' => 'Code already used or expired'];
        }
        if (strtotime($row['expires_at']) < time()) {
            $upd = $this->connection->prepare("UPDATE accountconfirm SET status='EXPIRED' WHERE id=?");
            $upd->bind_param('i', $row['id']);
            $upd->execute();
            $upd->close();
            $this->close();
            return ['valid' => false, 'reason' => 'Code expired'];
        }
    
        $this->close();
        return ['valid' => true];
    }
    
    public function deleteConfirmCode(string $email): bool
    {
        $this->connect();
    
        $del = $this->connection->prepare("DELETE FROM accountconfirm WHERE email=?");
        $del->bind_param('s', $email);
        $ok = $del->execute();
        $del->close();
    
        $this->close();
        return $ok;
    }

   public function activeUser($user_id)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8');
    
        $sql = $this->connection->prepare(
            'UPDATE user SET status=1 WHERE id=?'
        );
        $sql->bind_param('i', $user_id);
        if ($sql->execute()) {
            $sql->close();
            $this->connection->close();
            return true;
        }
        $sql->close();
        $this->connection->close();
        return false;
    }

    public function loginUser($identifier, $password)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8');
        $sql = $this->connection->prepare(
            'SELECT * FROM `user` WHERE username=? OR email=? LIMIT 1'
        );
        $sql->bind_param('ss', $identifier, $identifier);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) {
                $sql->close();
                $this->connection->close();
                return $user;
            }
        }
        $sql->close();
        $this->connection->close();
        return false;
    }

    public function getUserByUsernameOrEmail($username)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8');
        $sql = $this->connection->prepare(
            'SELECT DISTINCT * FROM `user` WHERE username=? OR email=?'
        );
        $sql->bind_param('ss', $username, $username);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $sql->close();
            $this->connection->close();
            return $user;
        }
        $sql->close();
        $this->connection->close();
        return false;
    }

    public function updateUser($user)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8');
    
        if (!isset($user['id'])) {
            return false; // no id = cannot update
        }
    
        $id = $user['id'];
        unset($user['id']); // Remove id from fields to update
    
        // Prepare fields and types for bind_param
        $fields = [];
        $types = '';
        $values = [];
    
        // Optional password handling
        if (isset($user['password']) && !empty($user['password'])) {
            $fields[] = "`password` = ?";
            $types .= 's';
            $values[] = $user['password'];
            unset($user['password']);
        }
    
        // Add all other fields dynamically
        foreach ($user as $key => $value) {
            // Sanitize field names to avoid injection
            if (preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
                $fields[] = "`$key` = ?";
                $types .= 's'; // Assuming all fields are strings; adjust if needed
                $values[] = $value;
            }
        }
    
        if (empty($fields)) {
            // Nothing to update
            return false;
        }
    
        $setStr = implode(', ', $fields);
        $sqlStr = "UPDATE `user` SET $setStr WHERE id = ?";
    
        $stmt = $this->connection->prepare($sqlStr);
        if (!$stmt) {
            error_log("Prepare failed: " . $this->connection->error);
            return false;
        }
    
        // Add the id param
        $types .= 'i';
        $values[] = $id;
    
        // Bind params dynamically
        $stmt->bind_param($types, ...$values);
    
        $result = $stmt->execute();
    
        if (!$result) {
            error_log("Execute failed: " . $stmt->error);
        }
    
        $stmt->close();
        $this->connection->close();
    
        return $result;
    }
    
    public function getUserById($user_id) {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        if ($this->connection->connect_error) {
            throw new Exception('Database connection failed: ' . $this->connection->connect_error);
        }
        $this->connection->set_charset('utf8mb4');
    
        $sql = $this->connection->prepare("SELECT id, profile_image, resume, resume_date FROM user WHERE id = ? LIMIT 1");
        if (!$sql) {
            $this->connection->close();
            return false;
        }
        $sql->bind_param('i', $user_id);
        $sql->execute();
        $result = $sql->get_result();
        $user = $result->fetch_assoc();
    
        $sql->close();
        $this->connection->close();
    
        return $user ?: false;
    }


    public function saveContactMessage($contact)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8');
    
        $sql = $this->connection->prepare(
            'INSERT INTO `contact_messages` (`firstname`, `lastname`, `countryCode`, `phone`, `email`, `message`) VALUES (?, ?, ?, ?, ?, ?)'
        );
    
        $sql->bind_param(
            'ssssss',
            $contact['firstname'],
            $contact['lastname'],
            $contact['countryCode'],
            $contact['phone'],
            $contact['email'],
            $contact['message']
        );
    
        if ($sql->execute()) {
            $insert_id = $this->connection->insert_id;
            $sql->close();
            $this->connection->close();
            return $insert_id;
        }
    
        $sql->close();
        $this->connection->close();
        return false;
    }
    
    public function saveNewsletterSubscriber($email)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8');
        
        // First: Check if email already subscribed
        $check = $this->connection->prepare(
            'SELECT id FROM newsletter_subscribers WHERE email = ?'
        );
        $check->bind_param('s', $email);
        $check->execute();
        $check->store_result();
    
        if ($check->num_rows > 0) {
            $check->close();
            $this->connection->close();
            return 'exists'; // <-- return status for duplicate
        }
        $check->close();
    
        // Proceed to insert new email
        $sql = $this->connection->prepare(
            'INSERT INTO newsletter_subscribers (email, status, subscribed_at) VALUES (?, ?, ?)'
        );
    
        $status = 1;
        $subscribed_at = date('Y-m-d H:i:s');
        $sql->bind_param('sis', $email, $status, $subscribed_at);
    
        if ($sql->execute()) {
            $insert_id = $this->connection->insert_id;
            $sql->close();
            $this->connection->close();
            return $insert_id;
        }
    
        $sql->close();
        $this->connection->close();
        return false;
    }
    public function getAllDatabaseData()
    {
        $this->connect(); // Use existing connect() to open DB
        
        $tablesResult = $this->connection->query("SHOW TABLES");
        if (!$tablesResult) {
            $this->close();
            return false;
        }
    
        $allData = [];
        while ($tableRow = $tablesResult->fetch_array()) {
            $table = $tableRow[0];
            $tableData = [];
    
            $query = $this->connection->query("SELECT * FROM `$table`");
            if ($query) {
                while ($row = $query->fetch_assoc()) {
                    $tableData[] = $row;
                }
            }
            $allData[$table] = $tableData;
        }
    
        $this->close();
    
        return $allData;
    }
  // Admin Login Methods
    public function loginAdmin($adminname, $password)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8mb4');
        
        $sql = $this->connection->prepare(
            'SELECT id, adminname, email, password FROM `admin` WHERE adminname = ? LIMIT 1'
        );
        $sql->bind_param('s', $adminname);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            // Verify password (plain text comparison as per existing pattern)
            if ($password === $admin['password']) {
                $sql->close();
                $this->connection->close();
                return $admin;
            }
        }
        
        $sql->close();
        $this->connection->close();
        return false;
    }

    public function generateAndUpdateAdminToken($admin_id)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8mb4');
        
        // Generate a secure random token (UUID v4 or random string)
        $token = bin2hex(random_bytes(32)); // 64 character hex string
        
        $sql = $this->connection->prepare(
            'UPDATE `admin` SET token = ? WHERE id = ?'
        );
        $sql->bind_param('si', $token, $admin_id);
        
        if ($sql->execute()) {
            $sql->close();
            $this->connection->close();
            return $token;
        }
        
        $sql->close();
        $this->connection->close();
        return false;
    }

    public function getAdminById($admin_id)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8mb4');
        
        $sql = $this->connection->prepare(
            'SELECT id, adminname, email, token FROM `admin` WHERE id = ? LIMIT 1'
        );
        $sql->bind_param('i', $admin_id);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $sql->close();
            $this->connection->close();
            return $admin;
        }
        
        $sql->close();
        $this->connection->close();
        return false;
    }

    public function verifyAdminToken($token)
    {
        $this->connection = new mysqli(
            $this->server_name,
            $this->database_username,
            $this->database_password,
            $this->database_name
        );
        $this->connection->set_charset('utf8mb4');
        
        $sql = $this->connection->prepare(
            'SELECT id, adminname, email FROM `admin` WHERE token = ? LIMIT 1'
        );
        $sql->bind_param('s', $token);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $sql->close();
            $this->connection->close();
            return $admin;
        }
        
        $sql->close();
        $this->connection->close();
        return false;
    }
     // ================= INSERT JOB =================
public function addJob($job_data)
{
    $this->connect();

    $sql = $this->connection->prepare(
        "INSERT INTO jobs 
        (position, company, min_year, max_year, location, deadline, description, date_posted, apply_link)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    if(!$sql) return false;

    $date_posted = date('Y-m-d H:i:s'); // FIXED datetime format ✔

    // 2 integers + 7 strings → ssiisssss
    $sql->bind_param(
        "ssiisssss",
        $job_data['position'],
        $job_data['company'],
        $job_data['min_year'],
        $job_data['max_year'],
        $job_data['location'],
        $job_data['deadline'],
        $job_data['description'],
        $date_posted,
        $job_data['apply_link']  // ✔ Now saved successfully
    );

    if($sql->execute()) return $this->connection->insert_id;

    return false;
}

// ================= GET SINGLE JOB =================
public function getJobDetailsById($id)
{
    $this->connect();

    $query = "SELECT id, position, company, min_year, max_year, location, deadline,
                    description, apply_link, date_posted
              FROM jobs WHERE id=? LIMIT 1";

    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) return false;

    $row = $result->fetch_assoc();

    return [
        "id"          => $row["id"],
        "jobPosition" => $row["position"],
        "company"     => $row["company"],
        "location"    => $row["location"],
        "deadline"    => date("d-m-Y h:i A", strtotime($row["deadline"])),
        "description" => $row["description"],
        "apply_link"  => $row["apply_link"],
        "experience"  => [
            "min" => $row["min_year"],
            "max" => $row["max_year"]
        ],
        "posted_on"   => date("d-m-Y", strtotime($row["date_posted"]))
    ];
}



// ============== GET ALL JOBS ==================
public function getAllJobs()
{
    $this->connect();

    // fixed `discription` to `description`
    $query = "SELECT id, position, company, location, deadline, description, apply_link 
              FROM jobs ORDER BY id DESC";

    $result = $this->connection->query($query);

    if($result->num_rows == 0) return false;

    $data = [];
    while($row = $result->fetch_assoc()){
        $row["deadline"] = date("d-m-Y", strtotime($row["deadline"]));
        $data[] = $row;
    }

    return $data;
}
// ============== Delete job by id ==================

public function deleteJob($id)
{
    $this->connect();

    $stmt = $this->connection->prepare("DELETE FROM jobs WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->affected_rows > 0; 
}

// ================= UPDATE JOB =====================
public function editJob($job_data)
{
    $this->connect();

    if (!isset($job_data['id']) || empty($job_data['id'])) {
        return false;
    }

    $id = $job_data['id'];
    unset($job_data['id']);

    $fields = [];
    $types = "";
    $values = [];

    foreach ($job_data as $key => $value) {
        if (preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
            $fields[] = "`$key` = ?";
            $types .= (is_int($value)) ? "i" : "s";
            $values[] = $value;
        }
    }

    if (empty($fields)) return false;

    $query = "UPDATE jobs SET ".implode(", ", $fields)." WHERE id=?";
    $stmt = $this->connection->prepare($query);

    $types .= "i";
    $values[] = $id;

    $stmt->bind_param($types, ...$values);

    $stmt->execute();
    $affected = $stmt->affected_rows;
    $stmt->close();

    return $affected > 0;
}


   
    
}