<?php

include_once "./model/Products.php";
include_once "./model/Bestellung.php";

class CartController {

    public function __construct() {
        // Session starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['buy'])) {
                $this->buyProducts();
            } elseif (isset($_POST['remove']) && isset($_POST['p_id'])) {
                $this->removeProductFromCart($_POST['p_id']);
            }
        }
    }

    private function buyProducts() {
        if (!isset($_SESSION['u_id'])) {
            header("Location: /online-shops/view/login.php");
            exit();
        } else {
            if (isset($_POST['quantities'])) {
                foreach ($_POST['quantities'] as $productId => $quantity) {
                    $_SESSION['cart'][$productId] = $quantity;
                }
            }

            $u_id = $_SESSION['u_id'];
            $orderNumber = Bestellung::randOrderNum();
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                Bestellung::createBestellung($u_id, $productId, $quantity, $orderNumber);
            }

            unset($_SESSION['cart']);
            header("Location: /online-shops/view/order.php");
            exit();
        }
    }

    private function removeProductFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        header("Location: /online-shops/view/cart.php");
        exit();
    }

    public function getCartProducts() {
        $products = [];
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $product = Products::findbyId($productId);
                if ($product) {
                    $products[] = [
                        'product' => $product,
                        'quantity' => $quantity
                    ];
                }
            }
        }
        return $products;
    }
}

