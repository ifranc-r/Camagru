<?php
$dsn = 'mysql:host='. $_ENV['DB_HOST'] .';dbname='. $_ENV['DB_NAME'] .';charset=utf8mb4';
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);