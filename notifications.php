<?php
require_once 'includes/auth.php';

$page_title = 'Notifications';

include 'includes/header.php';
include 'includes/sidebar.php';

$uid = (int)$_SESSION['user_id'];

mysqli_query($conn, "UPDATE notifications SET is_read = 1 WHERE user_id = $uid");

$q = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id = $uid ORDER BY id DESC");
?>

<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h2>Notifications</h2>
            <p>All your latest system notifications</p>
        </div>
    </div>

    <div class="card-box">
        <h4>Notifications</h4>
        <hr>

        <?php if(mysqli_num_rows($q) > 0) { ?>
            <?php while($n = mysqli_fetch_assoc($q)) { ?>
                <div class="border-bottom py-3">
                    <b><?php echo htmlspecialchars($n['title']); ?></b>
                    <p class="mb-1 text-muted">
                        <?php echo htmlspecialchars($n['message']); ?>
                    </p>
                    <small><?php echo htmlspecialchars($n['created_at']); ?></small>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="text-muted mb-0">No notifications found.</p>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
