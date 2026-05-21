<?php

require_once '../includes/auth.php';

require_role('shop');

$page_title = 'Invoices';

$uid = (int)$_SESSION['user_id'];


/* =========================================================
   FETCH INVOICES
========================================================= */

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM sales
     WHERE shop_id = $uid
     ORDER BY id DESC"
);


include '../includes/header.php';

include '../includes/sidebar.php';

?>


<div class="card-box">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="mb-0">
            Invoices
        </h4>

    </div>


    <!-- Invoice Table -->
    <div class="table-responsive">

        <table class="table table-bordered align-middle">

            <thead>

                <tr>
                    <th>Invoice No</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th width="120">Action</th>
                </tr>

            </thead>

            <tbody>

                <?php if (mysqli_num_rows($query) > 0) { ?>

                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>

                        <tr>

                            <td>
                                <?php echo htmlspecialchars($row['invoice_no']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['customer_name']); ?>
                            </td>

                            <td>
                                ₹<?php echo money($row['grand_total']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['created_at']); ?>
                            </td>

                            <td>

                                <a
                                    href="invoice.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-dark btn-sm"
                                >
                                    Open
                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>

                        <td colspan="5" class="text-center text-muted">

                            No invoices found.

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<?php include '../includes/footer.php'; ?>