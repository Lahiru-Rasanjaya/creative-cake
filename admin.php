<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creative Cakes</title>
    <link rel="icon" href="./img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F5F7FF;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-card {
            position: relative;
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
        }

        .login-header {
            background-color: #4A90E2;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            position: relative;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            color: #fff;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-button:hover {
            color: #ff4444;
        }

        .login-body {
            padding: 30px;
        }

        .login-body .form-control {
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-primary {
            background-color: #4A90E2;
            border-color: #4A90E2;
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #3a78c2;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
        }

        .login-footer a {
            text-decoration: none;
            color: #4A90E2;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-card {
                margin: 0 15px;
            }

            .login-header {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 576px) {
            .login-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="card login-card">
        <div class="login-header">
            Welcome Back!
            <button class="close-button" aria-label="Close" onclick="closeLoginForm()">&times;</button>
        </div>

        <?php
        $message = isset($_GET['message']) ? urldecode($_GET['message']) : '';
        $msgType = isset($_GET['type']) ? $_GET['type'] : '';
        ?>

        <?php if ($message): ?>
            <div id="alertBox" class="alert 
                                <?php echo $msgType === 'success' ? 'alert-success' : 'alert-danger'; ?> 
                                alert-dismissible fade show mx-4 mt-4 mb-0" role="alert" style="position: relative;">
                <span><?php echo htmlspecialchars($message); ?></span>
                <!-- Bootstrap Close Button aligned to the right and vertically centered -->
                <p id="closeAlert" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                    x
                </p>
            </div>
        <?php endif; ?>

        <div class="card-body login-body">
            <form action="./backend/login.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
        <div class="card-footer login-footer">
            <small>Copyright © 2024.<a href="#">hashcode</a>, All Rights Reserved.</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to close the login form
        function closeLoginForm() {
            window.location.href = './index.php';
        }

        // Script to Handle Close Button and Hide Message 
        const alertBox = document.getElementById('alertBox');
        const closeAlert = document.getElementById('closeAlert');


        if (closeAlert) {
            closeAlert.addEventListener('click', function() {
                alertBox.style.display = 'none';
                // Prevent the message from reappearing after reload
                const url = new URL(window.location.href);
                url.searchParams.delete('message');
                url.searchParams.delete('type');
                window.history.replaceState(null, null, url);
            });
        }
    </script>
</body>

</html>