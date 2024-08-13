<?php
include __DIR__ . '/links_icon.php';
require_once '../model/Bestellung.php';
include "../model/User.php";
$u_id = $_SESSION['u_id'];
$bestellungen = Bestellung::findOrderNum($u_id);
$name = User::findbyUser($u_id)->getFname() . ' ' . User::findbyUser($u_id)->getLname();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Bestellungen</title>
    <style>
        body {
            display: flex;
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
            width: 80%;
            background: rgba(120, 120, 120);
            padding: 10px;
            margin: 10px 0;
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

    </style>
</head>
<body>
<div class="container">
    <h1>Bestellungen von  <?php echo $name; ?></h1>
    <?php if (empty($bestellungen)){ ?>
    <p>Keine Bestellungen gefunden.</p>
    <?php }
    else{ ?>
        <div class="product-container">
        <?php
        if (!empty($_SESSION['u_id'])) {
            foreach ($bestellungen as $bestellung): {
                ?>
                <div class="cart-item">
                    <div class="cart-item-details">
                        <p>BestellNummer: <?php echo $bestellung->getOrdernum(); ?></p>
                        <p>Datum: <?php echo $bestellung->getDatum(); ?></p>
                        <h5><a href="orderdetails.php?ordernum=<?php echo $bestellung->getOrdernum(); ?>">Details anzeigen</a></h5>
                    </div>
                </div>
                <?php
            } endforeach;
        }
    }
    ?>
    </div>
</div>
</body>
</html>
