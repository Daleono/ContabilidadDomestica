<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
        include("../Controlador/Conexion.php"); //Se incluye el script que se conecta con la BBDD.
        include("../Modelo/ObjetoManejoGastos.php");    //Se incluye el objeto de Manejo de Gastos.
        include_once("IncCabecera.html");   //Se incluye la cabecera de la página
        $cantidad = new ManejoGastos($mi_conexion); //Se crea un nuevo objeto de ManejoGastos
    ?>

    <h1>Bienvenido a mi contabilidad doméstica. Actualmente hay <?php echo $cantidad->getCantidad()//Imprime la cantidad de registros en la BBDD.?> anotaciones.</h1>
</body>
</html>