<?php
$apiUrl = "http://127.0.0.1:8000/api/productos"; 
$productos = file_get_contents($apiUrl); 
header('Content-Type: application/json'); 
echo $productos;
