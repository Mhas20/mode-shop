<?php
include_once __DIR__ . '/links_icon.php';
include_once "../model/Products.php";
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Warenkorb</title>
    <style>
        body {
            background-image: url('./pics/background.PNG');
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            color: white;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }
        .product-container{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px; /* Abstand zwischen den Produkten */
            margin-top: 50px;
            max-width: 1200px; /* Maximale Breite des Containers */
            margin-left: auto;
            margin-right: auto;
            overflow-y: auto; /* Falls benötigt, fügt eine vertikale Scrollleiste hinzu */
            max-height: 600px; /* Maximale Höhe des Containers */
            padding: 10px; /* Innenabstand für den Container */
            width: 80%;
            border-radius: 10px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            width: 80%;
            height: 50%;
            background: rgba(120, 120, 120);
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
        }
        .cart-item img {
            width: 100px;
            height: auto;
            border-radius: 10px;
        }
        .cart-item-details {
            flex: 1;
            margin-left: 10px;
        }
        .quantity-input {
            width: 50px;
            text-align: center;
        }
        .amount-show {
            display: flex;
            align-items: center;

        }
        .btn-success {
            display: flex;
            align-items: center;
            border-radius: 10px;
            width: 180px;
            height: 40px;
            justify-content: center;
        }
        .btn-danger {
            display: flex;
            align-items: center;
            border-radius: 10px;
            width: 100px;
            height: 40px;
            justify-content: center;
        }

    </style>
</head>
<body>
<form action="../index.php" method="post">
    <input type="hidden" name="action" value="cart">
    <div class="container">
        <h1>CART</h1>
        <div class="product-container">

            <?php
            $counter = 1;
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    $product = Products::findbyId($productId);
                    ?>
                        <div class="cart-item">
                            <img src="<?php echo $product->getImage(); ?>" alt="Produktbild">
                            <div class="cart-item-details">
                                <h2><?php echo $product->getPName(); ?></h2>
                                <h4 id="price<?php echo $counter; ?>"><?php echo $product->getPPrice() ?> €</h4>
                                <h3 id="total<?php echo $counter; ?>"><?php echo $product->getPPrice() * $quantity; ?> €</h3>
                            </div>
                            <div class="amount-show">
                                Amount:
                                <input name="quantities[<?php echo $productId; ?>]" id="quantity<?php echo $counter; ?>" type="text" class="form-control quantity-input" value="<?php echo $quantity ?>" min="1" readonly>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="changeQuantity('quantity<?php echo $counter; ?>', <?php echo $counter; ?>, 1)">&#708;</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="changeQuantity('quantity<?php echo $counter; ?>', <?php echo $counter; ?>, -1)">&#709;</button>
                            </div>
                            <?php $counter++; ?>
                            <form action="../index.php" method="post">
                                <input type="hidden" name="action" value="cart">
                                <input type="hidden" name="p_id" value="<?php echo $productId; ?>">
                                <button type="submit" name="remove" class="btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>

                    <?php
                }
                ?>
        </div>
                <div id="grand-total-container">
                    <h2 id="grand-total"></h2>
                </div>
                <div>
                    <button type="submit" name="buy" class="btn-success btn-sm"><h4>SHOP NOW</h4></button>
                </div>
                <?php
            } else {
                echo "<p>Ihr Warenkorb ist leer.</p>";
            }
            ?>
    </div>
</form>
<script>
    function changeQuantity(inputId, counter, change) {

        const input = document.querySelector('#' + inputId);
        let currentValue = parseInt(input.value);
        currentValue += change;
        if (currentValue < 1) {
            currentValue = 1;
        }
        input.value = currentValue;


        const priceElement = document.querySelector('#price' + counter);
        const totalElement = document.querySelector('#total' + counter);

        const price = parseFloat(priceElement.innerHTML.replace(' €', ''));
        const total = price * currentValue;

        totalElement.innerHTML = 'Total: ' + total.toFixed(2) + ' €';
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        let grandTotal = 0;
        for (let i = 1; i < <?php echo $counter; ?>; i++) {

            const itemTotal = parseFloat(document.querySelector('#total' + i).innerHTML.replace('Total: ', '').replace(' €', ''));
            grandTotal += itemTotal;
        }

        document.querySelector('#grand-total').innerHTML = 'Grand Total: ' + grandTotal.toFixed(2) + ' €';
    }

    document.addEventListener('DOMContentLoaded', calculateGrandTotal);

</script>

</body>
</html>

