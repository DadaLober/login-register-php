<?php 
/**
 * Registration Page
 * User registration form
 */

require_once __DIR__ . '/../scripts/register_post.php';
require_once __DIR__ . '/../includes/SessionManager.php';

// Redirect if already logged in
if (SessionManager::isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <!-- SweetAlert CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css"
    />
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body class="form-body">
    <div class="form-container">
        <!-- Register Section -->
        <div class="form-section">
            <div class="form-content">
                <p class="form-title">Join Us</p>
                
                <form class="form" method="post" action="register.php">
                    <!-- Display errors -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-error">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo htmlspecialchars($error); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            required
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                        />
                    </div>
                    
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
                            minlength="6"
                        />
                        <small class="form-help">Password must be at least 6 characters long</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <input
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            class="form-input"
                            required
                            minlength="6"
                        />
                    </div>

                    <input
                        type="submit"
                        value="Register"
                        name="reg_user"
                        class="form-submit"
                    />
                </form>
                
                <div class="form-footer">
                    <p>
                        Already have an account?
                        <a href="login.php" class="form-link">
                            Log in here.
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Image Section -->
        <div class="image-section">
            <img
                class="form-image"
                src="../img/registerbg.png"
                alt="Registration Background"
            />
        </div>
    </div>
    
    <!-- Scripts -->
    <script
        type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"
    ></script>
    
    <!-- Client-side password validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            
            form.addEventListener('submit', function(e) {
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    confirmPassword.focus();
                }
            });
            
            confirmPassword.addEventListener('input', function() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords do not match');
                } else {
                    confirmPassword.setCustomValidity('');
                }
            });
        });
    </script>
</body>
</html>