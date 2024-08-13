<?php
include "../model/User.php";
include_once __DIR__ . '/links_icon.php';
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Fehlermeldung löschen, nachdem sie angezeigt wurde
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Login</title>
    <style>
        body {
            background-image: url('pics/background.PNG');
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
        }
        .headline {
            font-size: 70px;
            color: white;
            text-align: center;
            margin-top: 20px;
        }
        .textcolor {
            color: white;
        }
        .form-container {
            padding: 20px;
            border-radius: 10px;
            position: absolute;
            top: 350px;
            left: 700px;
            width: 400px;
        }
        .form-container .input-group {
            margin-bottom: 20px;
        }
        .form-container input[type="text"] {
            width: 100%;
            font-size: 1rem;
        }
        .form-container input[type="password"] {
            width: 100%;
            font-size: 1rem;
        }
        .form-container .btn {
            width: 100%;
        }
        .form-container p {
            text-align: center;
        }
    </style>
</head>
<body>
<h1 class="headline">LOGIN</h1>
<form action="../index.php" method="post">
    <input type="hidden" name="action" value="login">
    <div class="form-container">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
        <div class="mb-3">
            <div class="input-group-prepend">
                <span style="color: white">Email</span>
            </div>
            <input type="text"  name="email">
        </div>
        <div class="mb-3">
            <div class="input-group-prepend">
                <span style="color: white">Passwort</span>
            </div>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn btn-success" id="logged_in">Login</button>
        </div>
        <p class="textcolor">Noch kein Konto? <a href="register.php">Registrierung</a></p>
    </div>
</form>
</body>
</html>