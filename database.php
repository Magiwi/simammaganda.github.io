<?php
// Database configuration
class Database {
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;
    private $connection;

    public function __construct() {
        // Parse DATABASE_URL environment variable
        $databaseUrl = getenv('DATABASE_URL');
        if ($databaseUrl) {
            $parsed = parse_url($databaseUrl);
            $this->host = $parsed['host'];
            $this->port = $parsed['port'] ?? 5432;
            $this->database = ltrim($parsed['path'], '/');
            $this->username = $parsed['user'];
            $this->password = $parsed['pass'];
        } else {
            // Fallback to individual environment variables
            $this->host = getenv('PGHOST') ?: 'localhost';
            $this->port = getenv('PGPORT') ?: 5432;
            $this->database = getenv('PGDATABASE') ?: 'momento_coffee';
            $this->username = getenv('PGUSER') ?: 'postgres';
            $this->password = getenv('PGPASSWORD') ?: '';
        }
    }

    public function connect() {
        if ($this->connection === null) {
            try {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->database}";
                $this->connection = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->connection;
    }

    public function createTables() {
        $connection = $this->connect();
        
        // Create users table
        $userTable = "
            CREATE TABLE IF NOT EXISTS users (
                id SERIAL PRIMARY KEY,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                phone VARCHAR(20),
                is_active BOOLEAN DEFAULT TRUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";
        
        // Create user_addresses table
        $addressTable = "
            CREATE TABLE IF NOT EXISTS user_addresses (
                id SERIAL PRIMARY KEY,
                user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
                street VARCHAR(255) NOT NULL,
                city VARCHAR(100) NOT NULL,
                state VARCHAR(50) NOT NULL,
                zip_code VARCHAR(10) NOT NULL,
                country VARCHAR(100) DEFAULT 'United States',
                is_default BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";
        
        // Create orders table
        $orderTable = "
            CREATE TABLE IF NOT EXISTS orders (
                id SERIAL PRIMARY KEY,
                user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
                order_number VARCHAR(50) UNIQUE NOT NULL,
                status VARCHAR(50) DEFAULT 'pending',
                subtotal DECIMAL(10,2) NOT NULL,
                tax DECIMAL(10,2) NOT NULL,
                shipping DECIMAL(10,2) NOT NULL,
                total DECIMAL(10,2) NOT NULL,
                shipping_address TEXT NOT NULL,
                payment_method VARCHAR(50) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";
        
        // Create order_items table
        $orderItemsTable = "
            CREATE TABLE IF NOT EXISTS order_items (
                id SERIAL PRIMARY KEY,
                order_id INTEGER REFERENCES orders(id) ON DELETE CASCADE,
                product_id INTEGER NOT NULL,
                product_name VARCHAR(255) NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                quantity INTEGER NOT NULL,
                total DECIMAL(10,2) NOT NULL
            )
        ";
        
        try {
            $connection->exec($userTable);
            $connection->exec($addressTable);
            $connection->exec($orderTable);
            $connection->exec($orderItemsTable);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Failed to create tables: " . $e->getMessage());
        }
    }
}
?>