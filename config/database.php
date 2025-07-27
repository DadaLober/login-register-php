<?php
/**
 * Database connection and query management
 */

require_once __DIR__ . '/config.php';

class Database
{
    private static $instance = null;
    private $connection;
    
    // SQL Queries as constants for better organization
    const SELECT_USER_BY_CREDENTIALS = "SELECT * FROM tblusers WHERE col_username = ? AND col_password = ?";
    const SELECT_USER_BY_USERNAME_OR_EMAIL = "SELECT * FROM tblusers WHERE col_username = ? OR col_email = ? LIMIT 1";
    const INSERT_NEW_USER = "INSERT INTO tblusers (col_email, col_username, col_password, col_role) VALUES (?, ?, ?, ?)";
    const SELECT_USER_BY_ID = "SELECT * FROM tblusers WHERE user_id = ?";
    
    private function __construct()
    {
        $this->connect();
    }
    
    /**
     * Get singleton instance of Database
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Establish database connection
     */
    private function connect()
    {
        $config = Config::getDbConfig();
        
        $this->connection = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database']
        );
        
        if ($this->connection->connect_error) {
            $this->handleConnectionError();
        }
        
        $this->connection->set_charset("utf8mb4");
    }
    
    /**
     * Handle connection errors
     */
    private function handleConnectionError()
    {
        die("Database connection failed. Please try again later.");
    }
    
    /**
     * Get the mysqli connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * Prepare and execute a statement
     */
    public function executeQuery($query, $params = [], $types = '')
    {
        $stmt = $this->connection->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->connection->error);
        }
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        return $stmt;
    }
    
    /**
     * Get a single row result
     */
    public function fetchOne($query, $params = [], $types = '')
    {
        $stmt = $this->executeQuery($query, $params, $types);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }
    
    /**
     * Get multiple rows result
     */
    public function fetchAll($query, $params = [], $types = '')
    {
        $stmt = $this->executeQuery($query, $params, $types);
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }
    
    /**
     * Execute insert/update/delete query
     */
    public function execute($query, $params = [], $types = '')
    {
        $stmt = $this->executeQuery($query, $params, $types);
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }
    
    /**
     * Get last insert ID
     */
    public function getLastInsertId()
    {
        return $this->connection->insert_id;
    }
    
    /**
     * Sanitize input data
     */
    public function sanitize($data)
    {
        return $this->connection->real_escape_string(trim($data));
    }
    
    /**
     * Close connection
     */
    public function close()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}