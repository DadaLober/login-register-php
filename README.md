# Login & Register Authentication System

A lightweight PHP authentication system with user login and registration. Built with PHP and MySQL.

### About This Project
A basic auth system I built during college and updated with better practices. Handles user registration, login, and sessions.

## Project Structure

```
login-register-php/
├── config/
│   ├── config.php        # Configuration
│   └── database.php      # Database connection
├── includes/
│   └── SessionManager.php # Session handling
├── models/
│   └── User.php          # User model
├── scripts/
│   ├── login_post.php    # Login handler
│   └── register_post.php # Registration handler
├── pages/
│   ├── landing.php
│   ├── login.php
│   ├── register.php
│   └── dashboard.php     # Protected page
├── css/
│   └── style.css
├── js/
│   └── particle-animation.js
├── img/
│   └── [background images]
├── .env                  # Environment variables
├── index.php            # Entry point
├── tblusers.sql         # Database schema
└── README.md            # This file
```

## Features

- User registration and login
- Session management
- Form validation
- Responsive design
- Environment configuration

## Technologies Used

- PHP 7.4+
- MySQL
- HTML5 & CSS3
- JavaScript

## Getting Started

### Prerequisites

-   PHP 7.4 or higher
-   MySQL/MariaDB database server
-   Apache web server (optional)
-   Web browser with JavaScript enabled

### Installation & Setup

1. **Clone the repository**

    ```bash
    git clone https://github.com/DadaLober/login-register-php.git && cd login-register-php
    ```

2. **Set up MySQL database**

    ```bash
    # Start MySQL service
    sudo systemctl start mysql

    # Access MySQL command line
    mysql -u root -p
    ```

    ```sql
    CREATE DATABASE appdb;
    USE appdb;
    SOURCE tblusers.sql;
    EXIT;
    ```

3. **Configure environment variables**

    ```bash
    # Create .env file with your database credentials
    touch .env
    ```

    Add the following to your `.env` file:

    ```env
    DB_HOST=localhost
    DB_USERNAME=root
    DB_PASSWORD=your_mysql_password
    DB_NAME=appdb
    SESSION_LIFETIME=3600
    ```

4. **Start the PHP development server**

    ```bash
    php -S localhost:8000
    ```

5. **Access the application**

    ```
    Open your browser and navigate to: http://localhost:8000
    ```

### Configuration Options

The application supports the following environment variables:

| Variable           | Description                | Default     |
| ------------------ | -------------------------- | ----------- |
| `DB_HOST`          | Database host              | `localhost` |
| `DB_USERNAME`      | Database username          | `root`      |
| `DB_PASSWORD`      | Database password          | ` ` (empty) |
| `DB_NAME`          | Database name              | `appdb`     |
| `SESSION_LIFETIME` | Session timeout in seconds | `3600`      |

### Database Setup

The application requires a MySQL database with the following structure:

```sql
CREATE TABLE `tblusers` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_email` varchar(255) NOT NULL,
  `col_username` varchar(255) NOT NULL,
  `col_password` varchar(255) NOT NULL,
  `col_role` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

## License

This project is licensed under the MIT License. See the LICENSE file for details.
