<?php
include __DIR__ . '/links_icon.php';
include_once "../model/User.php";

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
    <title>Register</title>
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

        .form-container .btn {
            width: 100%;
            font-size: 1rem;
            display: flex;
            border-radius: 10px;
            justify-content: center;
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
        }

        .form-container .mb-3 {
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 1rem;
        }

        .form-container span {
            color: white;
            font-size: 1rem;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1 class="headline">Register</h1>
    <form action="../index.php" method="post">
        <input type="hidden" name="action" value="register">
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <span>firstname</span>
            <input type="text" name="fname">
        </div>
        <div class="mb-3">
            <span>lastname</span>
            <input type="text" name="lname">
        </div>
        <div class="mb-3">
            <span>address</span>
            <input type="text" name="address">
        </div>
        <div class="mb-3">
            <span>email</span>
            <input type="text" name="email">
        </div>
        <div class="mb-3">
            <span>password</span>
            <input type="password" name="password">
        </div>
        <div class="mb-3">
            <span>password confirm</span>
            <input type="password" name="password_ch">
        </div>
        <div>
            <button type="submit" class="btn btn-success">register</button>
        </div>
    </form>
</div>
</body>
</html>

