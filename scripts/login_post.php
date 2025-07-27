<?php
/**
 * Login Processing Script
 * Handles user login authentication
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../includes/SessionManager.php';

class LoginController
{
    private $userModel;
    private $errors = [];
    
    public function __construct()
    {
        $this->userModel = new User();
        SessionManager::start();
    }
    
    /**
     * Process login form submission
     */
    public function processLogin()
    {
        if (!isset($_POST['login_user'])) {
            return;
        }
        
        $username = $this->sanitizeInput($_POST['username'] ?? '');
        $password = $this->sanitizeInput($_POST['password'] ?? '');
        
        // Validate input
        if (empty($username)) {
            $this->errors[] = "Username is required";
        }
        
        if (empty($password)) {
            $this->errors[] = "Password is required";
        }
        
        // If no validation errors, attempt authentication
        if (empty($this->errors)) {
            $user = $this->userModel->authenticate($username, $password);
            
            if ($user) {
                $this->loginUser($user);
            } else {
                $this->errors[] = "Invalid username or password";
            }
        }
        
        // Store errors in session for display
        if (!empty($this->errors)) {
            SessionManager::setErrors($this->errors);
        }
    }
    
    /**
     * Login the authenticated user
     */
    private function loginUser($user)
    {
        SessionManager::login($user['col_username']);
        SessionManager::setSuccess("Welcome back, " . $user['col_username'] . "!");
        $this->redirectTo('dashboard.php');
    }
    
    /**
     * Sanitize user input
     */
    private function sanitizeInput($input)
    {
        return trim(htmlspecialchars(strip_tags($input)));
    }
    
    /**
     * Redirect to specified location
     */
    private function redirectTo($location)
    {
        header("Location: " . $location);
        exit();
    }
    
    /**
     * Get current errors
     */
    public function getErrors()
    {
        return SessionManager::getErrors();
    }
}

// Initialize and process login
$loginController = new LoginController();
$loginController->processLogin();

// Get errors for display
$errors = $loginController->getErrors();