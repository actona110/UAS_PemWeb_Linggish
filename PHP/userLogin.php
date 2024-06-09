<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linggish";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            // Successful login
            echo "Login successful!";
            // Redirect to user menu or set session variables
        } else {
            // Invalid password
            echo "Invalid password!";
        }
    } else {
        // No user found with that email
        echo "No user found with that email!";
    }
    $stmt->close();
}

$conn->close();
?>
