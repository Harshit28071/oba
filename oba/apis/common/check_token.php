<?php
// Start the session
session_start();
// Check if username and token are set in the session
if (isset($_SESSION["s_username"]) && isset($_SESSION["s_token"])) {
    //Check Database Connection
    include('../../common/database.php');
    $db = new Database();
    $conn = $db->connect();
    // Prepare and execute a statement to check the username and token
    $stmt = $conn->prepare("SELECT username FROM user WHERE username = ? AND token = ?");
    $stmt->bind_param("ss", $_SESSION['username'], $_SESSION['token']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // Token and username match in the database
        // Update the session with the new token
        $_SESSION["s_token"] = $newToken;
        // Update the database with the new token
        $updateStmt = $conn->prepare("UPDATE user SET token = ? WHERE username = ?");
        $updateStmt->bind_param("ss", $newToken, $_SESSION['username']);
        $updateStmt->execute();
        $updateStmt->close();

        // Close the database connection
        $conn->close();
    } else {
        // Token or username does not match
        // Send a response to the UI
        echo "Your session has expired. Please login again.";
        // Redirect to the login page
        header("Location: ../../pages/admin/user_login.php");
        exit();
    }

    $stmt->close();
} else {
    // Username and token not set in the session
    echo "Username and token not set in the session.";
}
?>