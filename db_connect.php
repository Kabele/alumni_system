<?php
    $dsn = 'mysql:host=localhost; dbname=rwuAlumniNetwork';
    $db_user = 'tonyf';
    $db_pass = 'tonis111';

    try {
        $db = new PDO($dsn, $db_user, $db_pass);
		     array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        exit();
    }
?>