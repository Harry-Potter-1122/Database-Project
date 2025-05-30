<?php
session_start();
include('../connection.php');

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);  // sanitize input

    $query = "SELECT * FROM admin WHERE name='$username' AND password='$password'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['admin'] = $username;
        header("Location: form.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Login</h2>
        <form method="POST" class="w-50 mx-auto bg-secondary p-4 rounded">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label>Username:</label>
                <input type="text" name="username" class="form-control" required />
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" required />
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>