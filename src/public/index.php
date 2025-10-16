<?php
require __DIR__ . '/../db.php';

var_dump($_ENV['DB_USER'] ?? null);
var_dump($_ENV['DB_PASS'] ?? null);