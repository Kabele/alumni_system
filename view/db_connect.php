<?php
    $dsn = 'mysql:host=localhost; dbname=rwuAlumniNetwork';
    $username = 'tonyf';
    $password = 'tonis111';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        exit();
    }
?>