<?php

include "./view/links_icon.php";
include "./model/Products.php";

class ProductController {

    public function __construct() {
        // Session starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addProductToCart() {
        if (isset($_POST['p_id']) && isset($_POST['amount'])) {
            $productId = (int)$_POST['p_id'];
            $quantity = (int)$_POST['amount'];
            Products::addProduct($productId, $quantity); // Produkt zum Warenkorb hinzufügen
            header("Location: /modeshops/view/cart.php");
            exit();

        }
    }

    public function getProductById($productId) {
        return Products::findById($productId); // Stelle sicher, dass findById korrekt funktioniert
    }

}
