<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linggish";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengecek apakah data POST tersedia
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $first_name = $conn->real_escape_string($_POST['fname']);
    $last_name = $conn->real_escape_string($_POST['lname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $conn->real_escape_string($_POST['phone']);
    $city = $conn->real_escape_string($_POST['city']);
    $invite_code = isset($_POST['code']) ? $conn->real_escape_string($_POST['code']) : '';

    // Periksa apakah email sudah ada
    $check_email = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check_email->num_rows > 0) {
        echo "Email sudah digunakan. Silakan gunakan email lain.";
    } else {
        // Menyimpan data ke database
        $sql = "INSERT INTO users (first_name, last_name, email, password, phone, city, invite_code)
        VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$city', '$invite_code')";

        if ($conn->query($sql) === TRUE) {
            echo "Registrasi berhasil";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "No data received.";
}

$conn->close();
?>
