<?php
session_start();
include("config.php");

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai-nilai dari form dan melakukan sanitasi
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Memeriksa keberadaan pengguna dalam database
    $sql = "SELECT * FROM register WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Pengguna ditemukan, atur sesi dan redirect ke halaman menu pengguna
        $_SESSION['email'] = $email;
        header("Location: userMenu.php");
        exit();
    } else {
        echo "Email atau password salah. Silakan coba lagi.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linggish Login</title>
    <link rel="stylesheet" href="../CSS/userLogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freeman&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="left-column">
            <div class="top">
                <img src="/gambar/logo1_mRg_icon.ico" alt="logo">
                <h4>Log in / Sign Up On Linggish</h4>
            </div>
            <div class="down">
                <form action="userLogin.php" method="post">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="users@gmail.com" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" minlength="8" placeholder="********" required>
                    
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                    <label for="forgot"><a href="#">Forgot Password?</a></label>
                    
                    <input type="submit" value="Log in" src="/userMenu.html">
                </form>
                <div class="icon">
                    <p>or connect with</p>
                    <a href="#"><img src="/gambar/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="/gambar/search.png" alt="google"></a>
                    <a href="#"><img src="/gambar/instagram.png" alt="instagram"></a>
                    <a href="#"><img src="/gambar/twitter.png" alt="X"></a>
                </div>
                <div class="sign-up">
                    <p>Don't have an account? <a href="/userRegister.html" target="_blank">Sign up</a></p>
                </div>
            </div>
        </div>
        <div class="right-column">
            <h1>Linggish</h1>
            <p style="color: #000;">English language tutoring, or English language tutoring, is an additional education program designed to enhance English language skills. With a structured curriculum and intensive guidance, students can achieve success in English language exams. This tutoring also provides various learning resources and a supportive environment to boost students' confidence.</p>
            <a href="/Home.html"><button type="button">Read More</button></a>
        </div>
    </div>
</body>
</html>