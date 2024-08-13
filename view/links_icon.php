<?php
include_once __DIR__ . '/../config/config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .dropdown-toggle.arrow {
            background-color: transparent;
            border: none;
            box-shadow: none;
        }
        .dropdown-toggle.arrow:focus {
            box-shadow: none;
        }
        .dropdown-toggle.arrow::after {
            display: none; /* Versteckt den Pfeil */
        }
    </style>
</head>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page !== 'cart.php') { ?>
<div style="position: absolute; top: 30px; right: 150px;">
    <a href="<?php echo BASE_URL; ?>view/cart.php">
        <i class="bi bi-cart" style="font-size: 2rem; color: white;"></i>
    </a>
</div>
<?php }
if (isset($_SESSION['u_id'])) {
?>
    <div class="dropdown" style="position: absolute; top: 25px; right: 80px;">
        <a class="btn btn-secondary dropdown-toggle arrow" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle" style="font-size: 2rem; color: white;"></i></a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="<?php echo BASE_URL; ?>view/showorder.php">meine Bestellung</a>
            </li>
            <li>
<!--                <a class="dropdown-item" href="--><?php //echo BASE_URL; ?><!--controller/logout.php">LOGOUT</a>-->
                <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?action=logout">LOGOUT</a>
            </li>
        </ul>
    </div>
<?php
}
else {
    ?>
    <div class="dropdown" style="position: absolute; top: 25px; right: 80px;">
        <a class="btn btn-secondary dropdown-toggle arrow" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle" style="font-size: 2rem; color: white;"></i></a>
        <ul class="dropdown-menu">
           <li>
               <a class="dropdown-item" href="<?php echo BASE_URL; ?>view/login.php">LOGIN</a>
           </li>
        </ul>
    </div>
<?php
}
?>
<div style="position: absolute; top: 42px; left: 80px;">
    <a href="<?php echo BASE_URL; ?>view/view.php" style="color: white;">Home</a>
</div>

