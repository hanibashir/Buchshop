<?php
/**
 * Database credentials. Assuming MySQL server with default setting (user 'root' with no password)
 */
const DSN = 'mysql:dbname=db_buchhandlung_verwaltung;host=localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';


try {
    $db_conn = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

