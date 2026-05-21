<?php

require_once 'includes/auth.php';


/* =========================================================
   GET PRODUCT ID
========================================================= */

$id = (int)($_GET['id'] ?? 0);


/* =========================================================
   FETCH PRODUCT
========================================================= */

$query = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE id = $id"
);

$product = mysqli_fetch_assoc($query);


/* =========================================================
   PRODUCT NOT FOUND
========================================================= */

if (!$product) {
    die("Product not found");
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Barcode - <?php echo htmlspecialchars($product['name']); ?></title>


    <!-- Barcode Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap"
        rel="stylesheet"
    >


    <style>

        body{
            margin:0;
            padding:40px;
            font-family:Arial, sans-serif;
            background:#f4f6f9;
            text-align:center;
        }

        .barcode-container{
            background:#fff;
            width:400px;
            margin:auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .barcode-title{
            margin-bottom:20px;
        }

        .barcode-text{
            font-family:'Libre Barcode 39', monospace;
            font-size:80px;
            letter-spacing:5px;
            margin:20px 0;
        }

        .barcode-number{
            font-size:18px;
            color:#555;
        }

        .print-btn{
            margin-top:20px;
            padding:12px 25px;
            border:none;
            background:#111827;
            color:#fff;
            border-radius:6px;
            cursor:pointer;
            font-size:15px;
        }

        .print-btn:hover{
            background:#000;
        }

        @media print{

            .print-btn{
                display:none;
            }

            body{
                background:#fff;
            }

            .barcode-container{
                box-shadow:none;
                border:none;
            }

        }

    </style>

</head>

<body>

    <div class="barcode-container">

        <h2 class="barcode-title">
            <?php echo htmlspecialchars($product['name']); ?>
        </h2>

        <div class="barcode-text">
            *<?php echo htmlspecialchars($product['barcode']); ?>*
        </div>

        <div class="barcode-number">
            <?php echo htmlspecialchars($product['barcode']); ?>
        </div>

        <button
            class="print-btn"
            onclick="window.print()"
        >
            Print Barcode
        </button>

    </div>

</body>

</html>