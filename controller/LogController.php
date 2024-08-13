<?php
// Startet die Session
//session_start();
//
//// Entfernt alle Session-Variablen
//session_unset();
//
//// Zerstört die Session
//session_destroy();
//
//// Leitet den USer zur Login-Seite weiter
//header("Location: ../view/login.php");
//exit();

 include "./model/User.php";
class LogController
{

    public function logout()
    {
        session_unset(); // Alle Session-Variablen löschen
        session_destroy(); // Die Session löschen

        header("location: index.php");
        exit();

//        // Optional: Cookies, die mit der Session verknüpft sind, löschen
//        if (ini_get('session.use_cookies')) {
//            $params = session_get_cookie_params();
//            setcookie(session_name(), '', time() - 42000,
//                $params['path'], $params['domain'],
//                $params['secure'], $params['httponly']
//            );
//        }
    }

    public function login()
    {


        if (!empty($_POST["email"]) && !empty($_POST["password"])) {


            $user = User::login($_POST['email'], $_POST['password']);

            if ($user instanceof User) {
                $_SESSION['u_id'] = $user->getUId();
                header("location: ") . BASE_URL;
                exit();
            } else {
                // Login fehlgeschlagen, Fehlermeldung anzeigen
                $_SESSION['error_message'] = "E-Mail oder Passwort ist falsch";
                header("location:  /online-shops/view/login.php");
                exit();
            }
        } else {
            // Nicht alle Felder wurden ausgefüllt
            $_SESSION['error_message'] = "Bitte füllen Sie alle Felder aus";
            header("location:  /online-shops/view/login.php");
            exit();
        }

    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Überprüfen, ob alle Felder ausgefüllt sind
            if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['password_ch'])) {
                // Überprüfen, ob die Passwörter übereinstimmen
                if ($_POST['password'] === $_POST['password_ch']) {
                    try {
                        // Benutzer erstellen
                        if (User::createUser($_POST['fname'], $_POST['lname'], $_POST['password'], $_POST['email'], $_POST['address'])) {
                            echo "Registrierung erfolgreich";
                            header("location:  /online-shops/view/login.php");
                            exit();
                        } else {
                            $_SESSION['error_message'] = "Fehler bei der Registrierung. Bitte versuchen Sie es erneut.";
                            header("location:  /online-shops/view/register.php");
                            exit();
                        }
                    } catch (Exception $e) {
                        $_SESSION['error_message'] = $e->getMessage();
                        header("location:  /online-shops/view/register.php");
                        exit();
                    }
                } else {
                    $_SESSION['error_message'] = "Passwörter stimmen nicht überein.";
                    header("location:  /online-shops/view/register.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Alle Felder müssen ausgefüllt werden.";
                header("location:  /online-shops/view/register.php");
                exit();
            }
        }
    }
}


