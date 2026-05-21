<?php

session_start();

require_once 'includes/db.php';

require_once 'includes/functions.php';


/* =========================================================
   DEFAULT ERROR
========================================================= */

$error = '';


/* =========================================================
   LOGIN PROCESS
========================================================= */

if (isset($_POST['login'])) {

    $email = clean($conn, $_POST['email']);

    $password = $_POST['password'];


    /* =====================================================
       CHECK USER
    ===================================================== */

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users 
         WHERE email = '$email'
         LIMIT 1"
    );


    if (mysqli_num_rows($query) == 1) {

        $user = mysqli_fetch_assoc($query);


        /* =================================================
           ACCOUNT STATUS
        ================================================= */

        if ($user['status'] != 'active') {

            $error = 'Your account is not approved yet.';
        }


        /* =================================================
           PASSWORD CHECK
        ================================================= */

        elseif ($password == $user['password']) {

            $_SESSION['user_id']   = $user['id'];

            $_SESSION['name']      = $user['name'];

            $_SESSION['email']     = $user['email'];

            $_SESSION['role']      = $user['role'];

            $_SESSION['parent_id'] = $user['parent_id'];


            /* =============================================
               AUDIT LOG
            ============================================= */

            log_audit(
                $conn,
                $user['id'],
                'Login',
                'User logged in successfully'
            );


            /* =============================================
               REDIRECT USER
            ============================================= */

            header(
                'Location: ' .
                $user['role'] .
                '/dashboard.php'
            );

            exit();
        }

        else {

            $error = 'Invalid password';
        }
    }

    else {

        $error = 'Invalid email';
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Inventory ERP</title>


    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Main CSS -->
    <link
        href="assets/css/style.css"
        rel="stylesheet"
    >

</head>

<body>

<div
    class="min-vh-100 d-flex align-items-center justify-content-center p-4"
    style="background: linear-gradient(135deg,#111827,#1f2937);"
>

    <div class="card-box" style="width:430px;">

        <!-- Logo / Title -->
        <h3 class="fw-bold mb-1">
            Inventory ERP
        </h3>

        <p class="text-muted">
            Login to continue
        </p>


        <!-- Error -->
        <?php if ($error) { ?>

            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>

        <?php } ?>


        <!-- Login Form -->
        <form method="POST">

            <label class="mb-1">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control mb-3"
                required
            >


            <label class="mb-1">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="form-control mb-3"
                required
            >


            <button
                type="submit"
                name="login"
                class="btn btn-success w-100 py-2"
            >
                Login
            </button>

        </form>


        <!-- Demo Accounts -->
        <hr>

        <small>
            <b>Admin:</b>
            admin@gmail.com / admin123
        </small>

        <br>

        <small>
            <b>Supplier:</b>
            supplier@gmail.com / 123456
        </small>

        <br>

        <small>
            <b>Distributor:</b>
            distributor@gmail.com / 123456
        </small>

        <br>

        <small>
            <b>Shop:</b>
            shop@gmail.com / 123456
        </small>

    </div>

</div>

</body>

</html>