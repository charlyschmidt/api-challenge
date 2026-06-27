<?php

$env = parse_ini_file(".env");

$pdo = new PDO(
        "mysql:host={$env['DB_HOST']};
        dbname={$env['DB_NAME']};
        charset=utf8",
        $env['DB_USER'],
        $env['DB_PASS']
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);