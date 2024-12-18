<?php
$user = "root";
$password = "";
$host = "localhost";
$dbname = "simple_site";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, $options);