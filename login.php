<?php
session_start();
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "fish_auction"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === 'admin' && $password === '1234') {
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = 0;
        $_SESSION["username"] = 'Admin';
        $_SESSION["role"] = 'admin';
        header("Location: dashboard.html");
        exit();
    } else {
        $sql = "SELECT id, username, password, role FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if (password_verify($password, $row["password"])) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["role"] = $row["role"];
                    header("Location: dashboard.html");
                    exit();
                } else {
                    echo "Invalid password.";
                }
            }
        } else {
            echo "No user found with that email.";
        }
    }
}

$conn->close();
?>
