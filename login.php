<?php
session_start();
require 'function.php';

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        //memeriksa login sebagai admin
        if($username === "admin" && $password === $row["password"]) {
            $_SESSION["login"] = true;
            header("Location: admin.php");
            exit;
        }

        // Memeriksa password tanpa enkripsi
        if($password === $row["password"]) {
            // Set session
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }
    }

    // Jika username tidak ditemukan atau password tidak cocok
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />

</head>

<body>

    <main>
        <article class="login" id="login">
            <div class="container">
                <div class="title">
                    <h1>Welcome To ThreeBib</h1>
                </div>

                <div class="form">
                    <h1>Login</h1>

                    <?php if(isset($error)) : ?>
                    <p style="color: red; font-style:italic;">Username/Password Salah</p>
                    <?php endif ; ?>

                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="username">Username :</label>
                                <input type="text" name="username" id="username" required>
                            </li>
                            <li>
                                <label for="password">Password :</label>
                                <input type="password" name="password" id="password" required>
                            </li>
                            <li>
                                <button type="submit" name="login">Login</button>
                            </li>
                        </ul>
                    </form>
                    <a href="registrasi.php">Belum punya akun?</a>
                </div>
            </div>
        </article>
    </main>
</body>

</html>