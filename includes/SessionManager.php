<?php
/**
 * Session Management Class
 * Handles all session-related operations
 */

class SessionManager
{
    /**
     * Start session if not already started
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            
            // Set session timeout
            if (defined('SESSION_LIFETIME')) {
                ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
            }
        }
    }
    
    /**
     * Set session variable
     */
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }
    
    /**
     * Get session variable
     */
    public static function get($key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }
    
    /**
     * Check if session variable exists
     */
    public static function has($key)
    {
        self::start();
        return isset($_SESSION[$key]);
    }
    
    /**
     * Remove session variable
     */
    public static function remove($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    /**
     * Destroy entire session
     */
    public static function destroy()
    {
        self::start();
        session_destroy();
        session_unset();
    }
    
    /**
     * Check if user is logged in
     */
    public static function isLoggedIn()
    {
        return self::has('username') && !empty(self::get('username'));
    }
    
    /**
     * Get logged in username
     */
    public static function getUsername()
    {
        return self::get('username');
    }
    
    /**
     * Login user
     */
    public static function login($username)
    {
        self::set('username', $username);
        self::set('login_time', time());
    }
    
    /**
     * Logout user
     */
    public static function logout()
    {
        self::remove('username');
        self::remove('login_time');
        self::destroy();
    }
    
    /**
     * Set flash message
     */
    public static function setFlash($key, $message)
    {
        self::set("flash_$key", $message);
    }
    
    /**
     * Get and remove flash message
     */
    public static function getFlash($key)
    {
        $message = self::get("flash_$key");
        self::remove("flash_$key");
        return $message;
    }
    
    /**
     * Set success message
     */
    public static function setSuccess($message)
    {
        self::setFlash('success', $message);
    }
    
    /**
     * Get success message
     */
    public static function getSuccess()
    {
        return self::getFlash('success');
    }
    
    /**
     * Set error messages
     */
    public static function setErrors($errors)
    {
        self::set('errors', $errors);
    }
    
    /**
     * Get error messages
     */
    public static function getErrors()
    {
        $errors = self::get('errors', []);
        self::remove('errors');
        return $errors;
    }
}