<?php
/**
 * Configuration file for the application
 * Loads environment variables and defines constants
 */

class Config
{
    private static $env = [];
    
    /**
     * Load environment variables from .env file
     */
    public static function loadEnv($filePath = '.env')
{
        if (!file_exists($filePath)) {
            throw new Exception('.env file not found');
        }
        
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // Skip comments
            }
            
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            // Remove quotes if present
            $value = trim($value, '"\'');
            
            self::$env[$name] = $value;
            putenv("$name=$value");
        }
    }
    
    /**
     * Get environment variable value
     */
    public static function get($key, $default = null)
    {
        return self::$env[$key] ?? getenv($key) ?: $default;
    }
    
    /**
     * Get database configuration
     */
    public static function getDbConfig()
    {
        return [
            'host' => self::get('DB_HOST', 'localhost'),
            'username' => self::get('DB_USERNAME', 'root'),
            'password' => self::get('DB_PASSWORD', ''),
            'database' => self::get('DB_NAME', 'appdb')
        ];
    }
}

// Load environment variables
try {
    Config::loadEnv(__DIR__ . '/../.env');
} catch (Exception $e) {
    die('Configuration error: ' . $e->getMessage());
}

// Define application constants
define('SESSION_LIFETIME', Config::get('SESSION_LIFETIME', 3600));