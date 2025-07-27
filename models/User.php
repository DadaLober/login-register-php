<?php
/**
 * User Model - Handles all user-related database operations
 */

require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    /**
     * Authenticate user with username and password
     */
    public function authenticate($username, $password)
    {
        $hashedPassword = $this->hashPassword($password);
        
        $user = $this->db->fetchOne(
            Database::SELECT_USER_BY_CREDENTIALS,
            [$username, $hashedPassword],
            'ss'
        );
        
        return $user !== null ? $user : false;
    }
    
    /**
     * Check if user exists by username or email
     */
    public function userExists($username, $email)
    {
        $user = $this->db->fetchOne(
            Database::SELECT_USER_BY_USERNAME_OR_EMAIL,
            [$username, $email],
            'ss'
        );
        
        return $user !== null;
    }
    
    /**
     * Create a new user
     */
    public function createUser($email, $username, $password, $role = 0) 
    {
        $hashedPassword = $this->hashPassword($password);
        
        $affectedRows = $this->db->execute(
            Database::INSERT_NEW_USER,
            [$email, $username, $hashedPassword, $role],
            'sssi'
        );
        
        if ($affectedRows > 0) {
            return $this->db->getLastInsertId();
        }
        
        return false;
    }
    
    /**
     * Get user by ID
     */
    public function getUserById($userId)
    {
        return $this->db->fetchOne(
            Database::SELECT_USER_BY_ID,
            [$userId],
            'i'
        );
    }
    
    /**
     * Hash password using MD5 (maintaining compatibility with existing system)
     * Note: In production, consider using password_hash() with PASSWORD_DEFAULT
     */
    private function hashPassword($password)
    {
        return md5($password);
    }
    
    /**
     * Validate user input data
     */
    public function validateUserData($data)
    {
        $errors = [];
        
        // Validate email
        if (empty($data['email'])) {
            $errors[] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        // Validate username
        if (empty($data['username'])) {
            $errors[] = "Username is required";
        } elseif (strlen($data['username']) < 3) {
            $errors[] = "Username must be at least 3 characters long";
        }
        
        // Validate password
        if (empty($data['password'])) {
            $errors[] = "Password is required";
        } elseif (strlen($data['password']) < 6) {
            $errors[] = "Password must be at least 6 characters long";
        }
        
        // Validate password confirmation
        if (isset($data['confirm_password'])) {
            if ($data['password'] !== $data['confirm_password']) {
                $errors[] = "The two passwords do not match";
            }
        }
        
        return $errors;
    }
    
    /**
     * Sanitize user input data
     */
    public function sanitizeUserData($data)
    {
        $sanitized = [];
        
        foreach ($data as $key => $value) {
            $sanitized[$key] = $this->db->sanitize($value);
        }
        
        return $sanitized;
    }
}