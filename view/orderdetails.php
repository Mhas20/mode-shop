
<?php
require_once '../model/Bestellung.php';
require_once '../model/Products.php';
include "links_icon.php";

if (!isset($_GET['ordernum'])) {
    die('OrderNum nicht angegeben.');
}

$ordernum = (int)$_GET['ordernum'];

$bestellungen = Bestellung::orderDetails($ordernum);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestelldetails</title>
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
            padding: 20px;

        }
        .product-container{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 50px;
            width: 80%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            overflow-y: auto;
            max-height: 600px;
            padding: 20px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            width: 90%;
            background: rgba(120, 120, 120);
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
        }
        .cart-item img {
            width: 140px;
            height: auto;
            border-radius: 10px;
        }
        .cart-item-details {
            flex: 1;
            margin-left: 10px;
        }
        .image-container {
            display: inline-block;
            position: relative;
            width: 300px; /* Bildbreite */
            height: 200px; /* Bildhöhe */
            border: 2px solid black; /* Rahmen */
        }

    </style>
</head>
<body>
<h1 style="text-align: center; color: white">Details für Bestell-Nummer: <?php echo $ordernum; ?></h1>
<div class="container">
    <div class="product-container">
        <?php
            foreach ($bestellungen as $bestellung):
                foreach ($bestellung->getProdukte() as $produkt):
                    ?>
                    <div class="cart-item">
                        <img class="image-container" src="<?php echo $produkt->getImage(); ?>" alt="Produktbild">
                        <div class="cart-item-details">
                            <p>Produkt-Nr.: <?php echo $produkt->getPId(); ?></p>
                            <p><?php echo $produkt->getPName(); ?></p>
                            <p>
                                EinzelPreis: <?php echo $produkt->getPPrice(); ?> €
                                <span style="margin-left: 30px">Anzahl: <?php echo $bestellung->getAmount(); ?> Stck</span>
                            </p>
                            <p>Gesamtpreis: <?php echo ($produkt->getPPrice()*$bestellung->getAmount()) ?> €</p>
                            <p>Details: <?php echo $produkt->getDetails(); ?></p>
                        </div>
                    </div>
                    <?php
                endforeach;
             endforeach;

        ?>
    </div>
</div>
</body>
</html>
