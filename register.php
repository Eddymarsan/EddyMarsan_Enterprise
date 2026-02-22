<?php
include "config.php";

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users (full_name,email,password) 
                  VALUES ('$name','$email','$password')");

    echo "<script>alert('Registration Successful!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Create Account</h2>

<form method="POST" onsubmit="return validateForm()">
    <input type="text" name="name" id="name" placeholder="Full Name" required>
    <input type="email" name="email" id="email" placeholder="Email" required>
    <input type="password" name="password" id="password" placeholder="Password" required>
    <button name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>
</div>

<script>
function validateForm(){
    let password = document.getElementById("password").value;

    if(password.length < 6){
        alert("Password must be at least 6 characters");
        return false;
    }
    return true;
}
</script>

</body>
</html>