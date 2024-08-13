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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Höhe des Viewports */
        }

        .headline {
            font-size: 70px;
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.5); /* Halbtransparenter Hintergrund */
            width: 400px;
        }

        .form-container .input-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 1rem;
            margin-top: 5px;
        }

        .form-container .btn {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: green;
            color: white;
            font-size: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container p {
            text-align: center;
            color: white;
        }

        .form-container a {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1 class="headline">LOGIN</h1>
    <form action="../index.php" method="post">
        <input type="hidden" name="action" value="login">
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <div class="input-group">
                <span style="color: white">email</span>
                <input type="text" name="email">
            </div>
        </div>
        <div class="mb-3">
            <div class="input-group">
                <span style="color: white">password</span>
                <input type="password" name="password">
            </div>
        </div>
        <div class="input-group">
            <button type="submit" class="btn btn-success" id="logged_in">Login</button>
        </div>
        <p class="textcolor">no account? <a href="register.php">create account</a></p>
    </form>
</div>
</body>
</html>
