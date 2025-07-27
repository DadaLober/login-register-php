<?php
/**
 * Registration Processing Script
 * Handles user registration
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../includes/SessionManager.php';

class RegisterController
{
    private $userModel;
    private $errors = [];
    
    public function __construct()
    {
        $this->userModel = new User();
        SessionManager::start();
    }
    
    /**
     * Process registration form submission
     */
    public function processRegistration()
    {
        if (!isset($_POST['reg_user'])) {
            return;
        }
        
        // Sanitize input data
        $userData = $this->sanitizeFormData($_POST);
        
        // Validate user data
        $this->errors = $this->userModel->validateUserData($userData);
        
        // Check if user already exists
        if (empty($this->errors)) {
            if ($this->userModel->userExists($userData['username'], $userData['email'])) {
                $this->errors[] = "Email or Username already exists!";
            }
        }
        
        // If no errors, create the user
        if (empty($this->errors)) {
            $userId = $this->userModel->createUser(
                $userData['email'],
                $userData['username'],
                $userData['password']
            );
            
            if ($userId) {
                $this->handleSuccessfulRegistration();
            } else {
                $this->errors[] = "Registration failed. Please try again.";
            }
        }
        
        // Store errors in session for display
        if (!empty($this->errors)) {
            SessionManager::setErrors($this->errors);
        }
    }
    
    /**
     * Handle successful user registration
     */
    private function handleSuccessfulRegistration()
    {
        SessionManager::setFlash('status', 'Account Created Successfully!');
        $this->redirectTo('login.php');
    }
    
    /**
     * Sanitize form data
     */
    private function sanitizeFormData($data)
    {
        $sanitized = [];
        $fields = ['email', 'username', 'password', 'confirm_password'];
        
        foreach ($fields as $field) {
            $sanitized[$field] = isset($data[$field]) 
                ? trim(htmlspecialchars(strip_tags($data[$field]))) 
                : '';
        }
        
        return $sanitized;
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

// Initialize and process registration
$registerController = new RegisterController();
$registerController->processRegistration();

// Get errors for display
$errors = $registerController->getErrors();