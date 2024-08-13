<?php
 include "./model/User.php";
class LogController
{

    public function logout()
    {
        session_unset(); // Alle Session-Variablen löschen
        session_destroy(); // Die Session löschen

        header("location: index.php");
        exit();
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
                header("location:  /modeshops/view/login.php");
                exit();
            }
        } else {
            // Nicht alle Felder wurden ausgefüllt
            $_SESSION['error_message'] = "Bitte füllen Sie alle Felder aus";
            header("location:  /modeshops/view/login.php");
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
                            header("location:  /modeshops/view/login.php");
                            exit();
                        } else {
                            $_SESSION['error_message'] = "Fehler bei der Registrierung. Bitte versuchen Sie es erneut.";
                            header("location:  /modeshops/view/register.php");
                            exit();
                        }
                    } catch (Exception $e) {
                        $_SESSION['error_message'] = $e->getMessage();
                        header("location:  /modeshops/view/register.php");
                        exit();
                    }
                } else {
                    $_SESSION['error_message'] = "Passwörter stimmen nicht überein.";
                    header("location:  /modeshops/view/register.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Alle Felder müssen ausgefüllt werden.";
                header("location:  /modeshops/view/register.php");
                exit();
            }
        }
    }
}


