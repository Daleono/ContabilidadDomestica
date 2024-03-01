<?php
     //Script que realiza la conexión del documento PHP a la BD.
     //Este script se debe incluir al documento PHP.
     $mi_conexion = new PDO('mysql:host=localhost; dbname=contab', 'root', '');
     $mi_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>