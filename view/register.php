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
        }

        .headline {
            font-size: 70px;
            color: white;
            text-align: center;
            margin-top: 20px;
        }


        .form-container {
            padding: 20px;
            border-radius: 10px;
            position: absolute;
            top: 250px;
            left: 650px;
            width: 400px;
        }

        .form-container input[type="text"] {
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
    <h1 class="headline">Register</h1>

    <form action="../index.php" method="post">
        <input type="hidden" name="action" value="register">
        <div class="form-container">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <div class="input-group-prepend">
                    <span style="color: white">Vorname</span>
                </div>
                <input type="text" class="form-control"  name="fname">
            </div>
            <div class="mb-3">
                <div class="input-group-prepend">
                    <span style="color: white">Nachname</span>
                </div>
                <input type="text" class="form-control" name="lname">
            </div>
            <div class="mb-3">
                <div class="input-group-prepend">
                    <span style="color: white">Adresse</span>
                </div>
                <input type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <div class="input-group-prepend">
                    <span type="email" style="color: white">Email</span>
                </div>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <div class="input-group-prepend">
                    <span style="color: white">Passwort</span>
                </div>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <div class="input-group-prepend">
                    <span style="color: white">Passwort wiederholen</span>
                </div>
                <input type="password" class="form-control" name="password_ch">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">registrieren</button>
            </div>
        </div>
    </form>
</body>
</html>

