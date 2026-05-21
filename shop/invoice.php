<?php

require_once '../includes/auth.php';

require_role('shop');

$page_title = 'Invoice';

$id  = (int)($_GET['id'] ?? 0);

$uid = (int)$_SESSION['user_id'];


/* =========================================================
   FETCH SALE
========================================================= */

$sale_query = mysqli_query(
    $conn,
    "SELECT *
     FROM sales
     WHERE id = $id
     AND shop_id = $uid"
);

$sale = mysqli_fetch_assoc($sale_query);


/* =========================================================
   SALE NOT FOUND
========================================================= */

if (!$sale) {
    die("Invoice not found");
}


/* =========================================================
   FETCH SALE ITEMS
========================================================= */

$items = mysqli_query(
    $conn,
    "SELECT 
        sale_items.*,
        products.name,
        products.sku,
        products.barcode
     FROM sale_items
     JOIN products 
        ON products.id = sale_items.product_id
     WHERE sale_items.sale_id = $id"
);


include '../includes/header.php';

include '../includes/sidebar.php';

?>


<div class="invoice-box">

    <!-- Invoice Header -->
    <div class="d-flex justify-content-between">

        <div>
            <h2>Tax Invoice</h2>

            <p>
                Enterprise Inventory ERP <br>
                GSTIN: 09ABCDE1234F1Z5
            </p>
        </div>

        <div class="text-end">

            <h5>
                <?php echo htmlspecialchars($sale['invoice_no']); ?>
            </h5>

            <p>
                <?php echo htmlspecialchars($sale['created_at']); ?>
            </p>

        </div>

    </div>

    <hr>


    <!-- Customer Details -->
    <p>
        <b>Customer:</b>
        <?php echo htmlspecialchars($sale['customer_name']); ?>
        <br>

        <b>Phone:</b>
        <?php echo htmlspecialchars($sale['customer_phone']); ?>
    </p>


    <!-- Invoice Items -->
    <div class="table-responsive">

        <table class="table">

            <thead>

                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Barcode</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>GST%</th>
                    <th>Total</th>
                </tr>

            </thead>

            <tbody>

                <?php while ($item = mysqli_fetch_assoc($items)) { ?>

                    <tr>
                        <td>
                            <?php echo htmlspecialchars($item['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($item['sku']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($item['barcode']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($item['qty']); ?>
                        </td>

                        <td>
                            ₹<?php echo money($item['rate']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($item['gst_percent']); ?>%
                        </td>

                        <td>
                            ₹<?php echo money($item['line_total']); ?>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>


    <!-- Invoice Total -->
    <div class="text-end">

        <p>
            Subtotal:
            ₹<?php echo money($sale['subtotal']); ?>
        </p>

        <p>
            GST:
            ₹<?php echo money($sale['gst_total']); ?>
        </p>

        <h4>
            Grand Total:
            ₹<?php echo money($sale['grand_total']); ?>
        </h4>

    </div>


    <!-- Action Buttons -->
    <button
        onclick="window.print()"
        class="btn btn-dark no-print"
    >
        Print / Save as PDF
    </button>

    <a
        href="invoices.php"
        class="btn btn-light no-print"
    >
        Back
    </a>

</div>

<?php include '../includes/footer.php'; ?>