<?php
// Start the session at the top of your config file so it's available everywhere
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Site URL and Title
$sitURL = 'http://' . $_SERVER['HTTP_HOST'] . '/cocktails';
$SiteTitle = "Welcome to Classic Cocktails With A Twist Cafe";

// Database configuration
$dbConfig = [
    'main' => [
        'host' => 'db',
        'user' => 'VaibhavSoni',
        'pass' => 'Vaibhav@532',
        'name' => 'cocktails_db',
    ],
];

// Function to connect to a specific database
if (!function_exists('dbConnect')) {
    function dbConnect($dbType) {
        global $dbConfig;

        if (isset($dbConfig[$dbType])) {
            $db = $dbConfig[$dbType];
            
            // Create the database connection
            $connection = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
            
            if (!$connection) {
                die("Database Connection Error (" . $dbType . "): " . mysqli_connect_error());
            }
            return $connection;
        } else {
            die("Invalid database type specified: " . $dbType);
        }
    }
}
?>