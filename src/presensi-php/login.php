<?php
$err = $_GET['err_code'] ?? null;
$err_message = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomTwo - Login</title>
    <?php include("config/bootstrap-style.php") ?>
</head>

<body class="bg-primary-subtle" data-bs-theme="light">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="w-100" style="max-width: 500px;">

            <div class="card shadow border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-3">
                        <img src="https://placehold.co/300x90?text=Logo" alt="Universitas AMIKOM Yogyakarta" class="img-fluid">
                        <p class="text-body-secondary small mt-3 mb-0">
                            Please log in with your AmikomTwo Email and password
                        </p>
                    </div>

                    <hr class="mb-4">

                    <?php
                    if ($err) {
                        switch ($err) {
                            case 'invalid_creds':
                                $err_message = "Email or password is incorrect.";
                                break;
                            case 'not_logged_in':
                                $err_message = "Please log in to access this page.";
                                break;
                            case 'not_satisfied':
                                $err_message = "Please fill all the required fields.";
                                break;
                            case 'account_deleted':
                                $err_message = "Your account has been successfully deleted. Goodbye!";
                                break;
                            default:
                                $err_message = "An unknown error occurred.";
                        }
                    }
                    ?>

                    <?php if ($err_message): ?>
                    <div class="alert theme-danger" role="alert" style="margin-bottom: 1em;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo $err_message; ?>
                    </div>
                    <?php endif; ?>

                    <form action="actions/auth_login.php" method="post">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="email" class="form-control" name="email" placeholder="AmikomTwo Email" aria-label="AmikomTwo Email" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" required>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="notRobot" required>
                            <label class="form-check-label" for="notRobot">
                                I'm not a robot
                            </label>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 fw-semibold">
                            Login <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </main>

    <?php include("config/bootstrap-script.php") ?>
</body>

</html>