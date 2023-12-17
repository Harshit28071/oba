<?php
// Establish a database connection (replace with your database details)
$host = 'localhost';
$dbname = 'oba';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Receive username and password from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the received password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Query the database to check if username and password match
$query = "SELECT * FROM user WHERE username = ? LIMIT 1";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1,$username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
   $row = $stmt->fetch();
 if (password_verify($password, $row['password'])) {
        // Username and password match
        $token = bin2hex(random_bytes(32)); // Generate a random token
        $tokenCreationTime = date("Y-m-d H:i:s"); // Current timestamp
        // Store token and creation time in the database
        $insertQuery = "UPDATE  user SET token = ? ,token_creation_time = ? WHERE id = ?";
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->bindParam(1, $token);
        $insertStmt->bindParam(2, $tokenCreationTime);
        $insertStmt->bindParam(3, $row['id']);
        $insertStmt->execute();

        // Send success response to frontend
        //echo json_encode(["token" => $token]);
    } else {
        // Invalid username or password
        echo json_encode(["error" => "Invalid username or password"]);
    }
} else {
    // Username not found
    echo json_encode(["error" => "Invalid username or password"]);
}
// Close the database connection
$stmt = null;
$pdo  = null;
echo json_encode(["token" => $token]);
?>