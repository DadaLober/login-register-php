<?php 
/**
 * Dashboard Page
 * Protected page that requires user authentication
 */

require_once __DIR__ . '/../includes/SessionManager.php';

SessionManager::start();

// Redirect if not logged in
if (!SessionManager::isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    SessionManager::logout();
    header("Location: login.php");
    exit();
}

$username = SessionManager::getUsername();
$successMessage = SessionManager::getSuccess();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }
        
        .welcome-text {
            color: #34495e;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .username {
            color: #3498db;
            font-weight: bold;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            border: 1px solid #c3e6cb;
        }
        
        .logout-btn {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
            margin-top: 1rem;
        }
        
        .logout-btn:hover {
            background: #c0392b;
        }
        
        .app-info {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #ecf0f1;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Welcome to the Dashboard!</h1>
        
        <?php if ($successMessage): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($successMessage); ?>
            </div>
        <?php endif; ?>
        
        <div class="welcome-text">
            Hello, <span class="username"><?php echo htmlspecialchars($username); ?></span>!
        </div>
        
        <p>You have successfully logged into the secure area.</p>
        
        <a href="dashboard.php?logout=1" class="logout-btn">
            🚪 Logout
        </a>
    </div>
</body>
</html>