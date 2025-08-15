<?php
// Start the session at the top of your config file so it's available everywhere
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Site URL and Title (Keep these as they are)
$sitURL = 'http://' . $_SERVER['HTTP_HOST'] . '/cocktails';
$SiteTitle = "Welcome to Classic Cocktails With A Twist Cafe";

// NEW DATABASE CONNECTION FUNCTION FOR RENDER (POSTGRESQL)
if (!function_exists('dbConnect')) {
    function dbConnect() {
        // This line reads the special DATABASE_URL from Render's environment variables
        $dbUrl = getenv('DATABASE_URL');

        if ($dbUrl === false) {
            die("DATABASE_URL environment variable not set. Cannot connect to database.");
        }

        // This code automatically gets the host, user, password, etc., from the URL
        $dbConfig = parse_url($dbUrl);

        $connection_string = sprintf("host=%s port=%s dbname=%s user=%s password=%s",
            $dbConfig['host'],
            $dbConfig['port'],
            ltrim($dbConfig['path'], '/'), // removes the leading slash
            $dbConfig['user'],
            $dbConfig['pass']
        );

        // This uses pg_connect, which is correct for PostgreSQL
        $connection = pg_connect($connection_string);

        if (!$connection) {
            die("Database Connection Error: Unable to connect to PostgreSQL.");
        }

        return $connection;
    }
}
?>