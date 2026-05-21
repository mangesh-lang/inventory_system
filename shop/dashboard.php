<?php

require_once '../includes/auth.php';

require_role('shop');

$page_title = 'Shop Dashboard';

include '../includes/header.php';

include '../includes/sidebar.php';


/* =========================================================
   USER ID
========================================================= */

$uid = (int)$_SESSION['user_id'];


/* =========================================================
   DASHBOARD COUNTS
========================================================= */

$products_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM products
     WHERE created_by = $uid
     OR supplier_id = $uid"
);

$products = mysqli_fetch_assoc($products_query)['total'] ?? 0;


$stock_query = mysqli_query(
    $conn,
    "SELECT COALESCE(SUM(quantity), 0) AS total
     FROM stock
     WHERE owner_id = $uid"
);

$stock = mysqli_fetch_assoc($stock_query)['total'] ?? 0;


$sales_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM sales
     WHERE shop_id = $uid"
);

$sales = mysqli_fetch_assoc($sales_query)['total'] ?? 0;


$low = low_stock_count($conn, $uid);

?>


<!-- Stats Cards -->
<div class="row g-4">

    <div class="col-md-3">

        <div class="card-box stat">

            <div>
                <p class="text-muted mb-1">Products</p>
                <h3><?php echo $products; ?></h3>
            </div>

            <div class="icon">
                <i class="fa fa-box"></i>
            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card-box stat">

            <div>
                <p class="text-muted mb-1">Stock Qty</p>
                <h3><?php echo $stock; ?></h3>
            </div>

            <div class="icon">
                <i class="fa fa-boxes"></i>
            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card-box stat">

            <div>
                <p class="text-muted mb-1">Sales</p>
                <h3><?php echo $sales; ?></h3>
            </div>

            <div class="icon">
                <i class="fa fa-receipt"></i>
            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card-box stat">

            <div>
                <p class="text-muted mb-1">Low Stock</p>
                <h3><?php echo $low; ?></h3>
            </div>

            <div class="icon">
                <i class="fa fa-triangle-exclamation"></i>
            </div>

        </div>

    </div>

</div>


<!-- Analytics Section -->
<div class="row g-4 mt-1">

    <div class="col-lg-8">

        <div class="card-box">

            <h5>Chart Analytics</h5>

            <canvas id="mainChart" height="105"></canvas>

        </div>

    </div>


    <div class="col-lg-4">

        <div class="card-box">

            <h5>System Flow</h5>

            <p>
                Admin → Supplier → Distributor → Shop → Customer
            </p>

            <p class="text-muted">
                Stock transfer automatically reduces sender stock
                and increases receiver stock.
            </p>

        </div>

    </div>

</div>


<!-- Chart JS -->
<script>

    new Chart(
        document.getElementById('mainChart'),
        {
            type: 'bar',

            data: {
                labels: [
                    'Products',
                    'Stock',
                    'Sales',
                    'Low Stock'
                ],

                datasets: [
                    {
                        label: 'Summary',

                        data: [
                            <?php echo $products; ?>,
                            <?php echo $stock; ?>,
                            <?php echo $sales; ?>,
                            <?php echo $low; ?>
                        ]
                    }
                ]
            }
        }
    );

</script>

<?php include '../includes/footer.php'; ?>