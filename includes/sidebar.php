<?php
$role = $_SESSION['role'] ?? '';

function nav($href,$icon,$text){
    global $base_url;
    echo '<a class="nav-link" href="'.$base_url.$href.'">
            <i class="'.$icon.'"></i>
            <span>'.$text.'</span>
          </a>';
}
?>

<aside class="sidebar">

    <div class="brand">
        <i class="fa-solid fa-boxes-stacked"></i>
        <span>Inventory ERP</span>
    </div>

    <div class="user-mini">
        <div class="avatar">
            <?php echo strtoupper(substr($_SESSION['name'] ?? 'U',0,1)); ?>
        </div>

        <div>
            <b><?php echo $_SESSION['name']; ?></b>
            <small><?php echo ucfirst($role); ?></small>
        </div>
    </div>

    <nav>

    <?php

    if($role=='admin'){

        nav('admin/dashboard.php','fa-solid fa-chart-line','Dashboard');

        nav('admin/users.php','fa-solid fa-users','Users');

        nav('admin/approvals.php','fa-solid fa-user-check','Supplier Approval');

        nav('admin/products.php','fa-solid fa-box','Products');

        nav('admin/warehouses.php','fa-solid fa-warehouse','Warehouses');

        nav('admin/reports.php','fa-solid fa-chart-pie','Reports');

        nav('admin/audit_logs.php','fa-solid fa-clock-rotate-left','Audit Logs');

    }

    elseif($role=='supplier'){

        nav('supplier/dashboard.php','fa-solid fa-chart-line','Dashboard');

        nav('supplier/products.php','fa-solid fa-box','Products');

        nav('supplier/purchases.php','fa-solid fa-cart-plus','Purchases');

        nav('supplier/transfer.php','fa-solid fa-truck-arrow-right','Transfer Stock');

        nav('supplier/distributors.php','fa-solid fa-people-carry-box','Distributors');

        nav('supplier/reports.php','fa-solid fa-chart-pie','Reports');

    }

    elseif($role=='distributor'){

        nav('distributor/dashboard.php','fa-solid fa-chart-line','Dashboard');

        nav('distributor/stock.php','fa-solid fa-boxes','My Stock');

        nav('distributor/shops.php','fa-solid fa-store','Shops');

        nav('distributor/transfer.php','fa-solid fa-truck-arrow-right','Transfer to Shop');

        nav('distributor/reports.php','fa-solid fa-chart-pie','Reports');

    }

    elseif($role=='shop'){

        nav('shop/dashboard.php','fa-solid fa-chart-line','Dashboard');

        nav('shop/stock.php','fa-solid fa-boxes','Stock');

        nav('shop/sales.php','fa-solid fa-cash-register','Sales Billing');

        nav('shop/invoices.php','fa-solid fa-file-invoice','Invoices');

        nav('shop/reports.php','fa-solid fa-chart-pie','Reports');

    }

    nav('notifications.php','fa-solid fa-bell','Notifications');

    nav('logout.php','fa-solid fa-right-from-bracket','Logout');

    ?>

    </nav>

</aside>

<main class="main">

<header class="topbar">
    <h5><?php echo $page_title ?? 'Dashboard'; ?></h5>
    <div><?php echo date('d M Y'); ?></div>
</header>

<section class="content">