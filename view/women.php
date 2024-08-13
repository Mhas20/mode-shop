<?php
include_once "links_icon.php";
include "../model/Products.php";
$pro = Products::findAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Women</title>
    <title>WOMEN</title>
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
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 180px; /* Abstand zwischen den Produkten */
            margin-top: 50px;
            max-width: 1200px; /* Maximale Breite des Containers */
            margin-left: auto;
            margin-right: auto;
            overflow-y: auto; /* Falls benötigt, fügt eine vertikale Scrollleiste hinzu */
            max-height: 600px; /* Maximale Höhe des Containers */
            padding: 10px; /* Innenabstand für den Container */
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
    </style>
</head>
<body>
    <h1 class="headline">WOMEN's WEAR</h1>
    <div class="product-container">
            <?php foreach ($pro as $product) {
                if ($product->getRole() == 'w') {?>
                    <div class="product">
                        <a href="productview.php?id=<?php echo $product->getPId(); ?>">
                            <img src="<?php echo $product->getImage(); ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="placeholder" style="display:none;">kein Bild</div>
                            <div class="product-name"><?php echo $product->getPName(); ?></div>
                        </a>
                    </div>
                <?php }
            } ?>
    </div>
</body>
</html>
