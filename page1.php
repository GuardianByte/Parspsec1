<?php
$conn = new mysqli("localhost", "appuser", "password123", "appdb");
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // VULNERABLE: Direct string concatenation - susceptible to SQL injection
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    try {
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            echo "Login success!";
        } else {
            echo "Login failed!";
        }
    } catch (Exception $e) {
        echo "SQL Error: " . $e->getMessage();
    }
}
$conn->close();
?>
