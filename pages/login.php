<?php 
/**
 * Login Page
 * User authentication form
 */

require_once __DIR__ . '/../scripts/login_post.php';
require_once __DIR__ . '/../includes/SessionManager.php';

// Redirect if already logged in
if (SessionManager::isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$statusMessage = SessionManager::getFlash('status');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body class="form-body">
    <div class="form-container">
        <!-- Login Section -->
        <div class="form-section">
            <div class="form-content">
                <p class="form-title">Welcome Back</p>
                
                <form class="form" method="post" action="login.php">
                    <!-- Display errors -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-error">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo htmlspecialchars($error); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Success message from registration -->
                    <?php if ($statusMessage): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($statusMessage); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-input"
                            required
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                        />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            required
                        />
                    </div>

                    <input
                        type="submit"
                        value="Log In"
                        name="login_user"
                        class="form-submit"
                    />
                </form>
                
                <div class="form-footer">
                    <p>
                        Don't have an account?
                        <a href="register.php" class="form-link">
                            Register here.
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Image Section -->
        <div class="image-section">
            <img
                class="form-image"
                src="../img/loginbg.png"
                alt="Login Background"
            />
        </div>
    </div>
    
    <!-- Scripts -->
    <script
        type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"
    ></script>
</body>
</html>