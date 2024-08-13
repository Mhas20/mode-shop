<?php
include_once __DIR__ . '/../model/Products.php';

class ProductViewController {
    private $product;

    public function __construct($productId) {
        $this->product = Products::findbyId($productId);
    }

    public function handlePostRequest() {
        if (isset($_POST['p_id']) && isset($_POST['amount'])) {
            $productId = (int)$_POST['p_id'];
            $quantity = (int)$_POST['amount'];
            Products::addProduct($productId, $quantity); // Add product to cart
            header("Location: cart.php"); // Redirect to cart page
            exit();
        }
    }

    public function getProduct() {
        return $this->product;
    }
}