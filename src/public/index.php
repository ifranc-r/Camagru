<?php
echo "OK nginx → php-fpm<br>";
echo "PHP: " . phpversion() . "<br>"; 
echo "Route: " . ($_SERVER['REQUEST_URI'] ?? '/') . "<br>";