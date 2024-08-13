<?php
include_once __DIR__ . '/links_icon.php';
include "../model/Products.php";

//if (isset($_POST['p_id']) && isset($_POST['amount'])) {
//    $productId = (int)$_POST['p_id'];
//    $quantity = (int)$_POST['amount'];
//    Products::addProduct($productId, $quantity); // Add product to cart
//    include "cart.php"; // Redirect to cart page
//    exit();
//}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productview</title>
</head>
<style>
    body {
        background-image: url('./pics/background.PNG');
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
    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100vh;
        padding: 0 200px;
    }
    .product-container-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }
    .product-container-right {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
    }
    .product {
        text-align: center;
        color: white;
        width: 200px;
    }
    .product img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        display: block;
    }
    .product .placeholder {
        width: 100%;
        height: 200px;
        border: 2px dashed white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: white;
    }
    .product-name {
        margin-top: 10px;
        font-size: 20px;
    }
    .amount-button {
        display: flex;
        flex-direction: column;
    }
    .select-amount {
        border-radius: 5px;
        width: 150px;
        font-size: 16px;
    }
    .description {
        display: none;
        margin-top: 10px;
        background: #333;
        color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 200px;
        height: 100px;
        resize: none; /* verhindert das Vergrößern/Verkleinern */
    }
    .toggle-text {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 16px;
        color: white;
    }
    .toggle-text::after {
        content: '\25BC'; /* Unicode für Pfeil nach unten */
        margin-left: 5px;
        font-size: 12px;
    }
</style>
<body>
<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = (int)$_GET['id'];
    $product = Products::findbyId($productId);
}
?>
<?php if (isset($product)): ?>
    <form action="../index.php" method="post">
        <input type="hidden" name="action" value="addProduct">
            <div class="container">
                <div class="product-container-left">
                    <div class="product">
                        <input type="hidden" name="p_id" id="p_id" value="<?php echo $product->getPId() ?>">
                        <img src="<?php echo $product->getImage(); ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="placeholder" style="display:none;">kein Bild</div>
                        <div class="product-name"><?php echo $product->getPName() ?> </div>
                    </div>
                </div>
                <div class="product-container-right">
                    <div class="product mb-3">
                        <h3>Price : <?php echo $product->getPPrice() ?> €</h3>
                    </div>
                    <div class="product">
                        <label for="amount">Amount</label>
                        <select name="amount" id="amount" class="select-amount mb-3">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <div class="amount-button mb-3">
                            <button  class="btn btn-primary" type="submit">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product">
                        <div class="toggle-text" onclick="toggleDescription()">Productdetails</div>
                        <textarea id="description" style="width: 300px;" class="description" readonly> <?php echo $product->getDetails(); ?> </textarea>
                </div>
            </div>
    </form>
<?php endif; ?>
<script>
    function toggleDescription() {
        var description = document.getElementById('description');
        if (description.style.display === 'none' || description.style.display === '') {
            description.style.display = 'block';
        } else {
            description.style.display = 'none';
        }
    }
</script>
</body>
</html>

