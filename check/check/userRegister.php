<?php
session_start();
include("config.php");

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai-nilai dari form dan melakukan sanitasi
    $first_name = mysqli_real_escape_string($conn, $_POST["fname"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["lname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $invite_code = mysqli_real_escape_string($conn, $_POST["code"]);

    // Menyimpan data ke database dengan prepared statement
    $stmt = $conn->prepare("INSERT INTO register (first_name, last_name, email, password, phone, city, invite_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $password, $phone, $city, $invite_code);

    if ($stmt->execute()) {
        // Jika pendaftaran berhasil, redirect ke halaman sukses atau ke halaman login
        header("Location: userRegister.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linggish Register</title>
    <link rel="stylesheet" href="../CSS/userRegister.css">
    <link href="https://fonts.googleapis.com/css2?family=Freeman&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="left-column">
        <h1>Learning Engglish is <br> very easy</h1>
        <p>Use your time to learn English easily with Linggish.</p>
        <img src="/gambar/logo-register.png" alt="logo">
    </div>
    <div class="right-column">
        <div class="container">
            <form action="userRegister.php " method="post">
                <label for="fname">First name:</label>
                <input type="text" name="fname" id="fname" required>
                
                <label for="lname">Last name:</label>
                <input type="text" name="lname" id="lname" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" minlength="8" required>

                <label for="phone">Phone number:</label>
                <input type="number" name="phone" id="phone" required>

                <label for="city">City:</label>
                <input type="text" name="city" id="city" required>

                <label for="code">Invite code (optional):</label>
                <input type="number" name="code" id="code">

                <div class="check">
                    <input type="checkbox" name="privacy" id="privacy">
                    <label for="privacy">By proceeding, I agree to Linggish's <a href="#">Terms of Use</a> and acknowledge that I have read the <a href="#">Privacy Policy.</a></label>
                    <br><br>

                    <input type="checkbox" name="agree" id="agree">
                    <label for="agree">I also agree that Linggish or its representatives may contact me by email, phone, or SMS (including by automated means) at the email address or number I provide, including for marketing puporse</label>
                    <br><br>
                </div>
                <input type="submit" value="Sign up to Linggish">
            </form>
            <p>Already have an account? <a href="/userLogin.html" target="_blank">Sign in</a></p>
        </div>
    </div>
</body>
</html>