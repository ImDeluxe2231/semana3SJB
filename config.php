<?php
$host = 'localhost';
$dbname = 'gestion_academica';
$username = 'root';  
$clave = '';  
 try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $clave);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
}
?>