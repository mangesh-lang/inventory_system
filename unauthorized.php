<?php

include 'includes/header.php';

?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card-box text-center">

                <div class="mb-3">

                    <i
                        class="fa-solid fa-triangle-exclamation"
                        style="font-size:60px;color:#dc3545;"
                    ></i>

                </div>

                <h2 class="mb-3">
                    Unauthorized Access
                </h2>

                <p class="text-muted mb-4">
                    You do not have permission to access this page.
                </p>

                <a
                    href="login.php"
                    class="btn btn-danger px-4"
                >
                    Back to Login
                </a>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>