<?php
//
//include "./controller/ProductController.php";
//include "./controller/CartController.php";
//
//$action = $_POST['action'] ?? 'view';
//
//
//$produktController = new ProductController();
//$warenkorbController = new CartController();
//
//// Aktion überprüfen und entsprechende Methode aufrufen
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    if ($action === 'addProduct') {
//        $produktController->addProductToCart();
//    } elseif ($action === 'buyit') {
//        $warenkorbController->handleRequest();
//    } elseif ($action === 'empty') {
//        $warenkorbController->handleRequest();
//    } elseif ($action === 'productview'){
//
//    }
//}else {
//    include "./view/view.php"; // Pfad zur HTML-Datei anpassen
//}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Definiere die Standardaktion
$action = $_GET['action'] ?? 'view'; // Alternativ könnte dies 'home' oder eine andere Standardaktion sein

// Lese die POST-Daten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
}

// Die Pfade zu den Controllern definieren
$controllerPath = './controller/';
$viewPath = './view/';

// Bestimme den Controller basierend auf der Aktion
switch ($action) {
    case 'cart':
        include $controllerPath . 'CartController.php';
        $cartController = new CartController();
        $cartController->handleRequest();
        $cartProducts = $cartController->getCartProducts();
//        include $viewPath . 'cart.php';
        break;

    case 'addProduct':
        include $controllerPath . 'ProductController.php';
        $productController = new ProductController();
        $productController->addProductToCart();
        break;

    case 'logout':
        include $controllerPath . 'LogController.php';
        $logoutController = new LogController();
        $logoutController->logout();
        break;
    case 'login':
        include $controllerPath . 'LogController.php';
        $loginController = new LogController();
        $loginController->login();
        break;
    case 'register':
        include $controllerPath . 'LogController.php';
        $registerController = new LogController();
        $registerController->register();
        break;
    default:
        include './view/view.php';
        break;
}

