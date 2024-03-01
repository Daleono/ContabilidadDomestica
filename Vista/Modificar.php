<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once("IncCabecera.html");   //Se incluye el script de la cabecera.
        include_once("../Modelo/ObjetoManejoGastos.php");   //Se incluye el objeto de manejo de gastos.
        include_once("../Controlador/Conexion.php");    //Se incluye el script de conexió.
        $id = $_GET["id"];  //Se recibe información por medio del URL.
        $dato = new ManejoGastos($mi_conexion); //Se crea una nueva instancia del objeto ManejoGastos.
        $obj = $dato->getRegistroID($id);   //Se almacena un registro utilizando el ID pasado por la URL.
        
    ?>
    <p>Ha escogido la opción <b>Modificar</b></p>
    <form action="../Controlador/Transaccion.php" method="post">
        <p align="center">
            <label>Fecha</label>
            <input type="date" value="<?php echo $obj->getFecha();  //Se muestra la fecha del objeto Gasto en un input.?>" name="fecha">
            <label>Fecha actual</label>
            <input type="checkbox" name="fecha_check">
            <input type="hidden" name="id" value="<?php echo $id; //Se muestra el ID del objeto Gasto en un input.?> ">
        </p>
        <p align="center">
            <label>Importe</label>
            <input type="number" value="<?php echo $obj->getImporte();  //Se muestra el importe del objeto Gasto en un input.?>" step=0.01 name="importe">
        </p>
        <p align="center">
            <label>Descripción</label>
            <textarea name="descripcion"><?php echo $obj->getDescripcion(); //Se muestra la descripción del objeto Gasto en un input.?></textarea>
        </p>
        <p align="center">
            <label>Categoría</label>
            <input type="text" value="<?php echo $obj->getCategoria();  //Se muestra la categoría del objeto Gasto en un input.?>" name="categoria">
        </p>
        <br>
        <p align="center">
            <input type="submit" name="enviar" value="Guardar Datos">
        </p>
    </form>
    <?php
        //Si se recibe la categoría por URL es porque el usuario a modificado un registro entonces muestra un texto de Gasto actualizado.
        if(isset($_GET["categoria"])){
            $categoria = $_GET["categoria"];
            $fecha = $_GET["fecha"];
            echo "Gasto ACTUALIZADO. Categoria: $categoria , Fecha: $fecha";
        }
        include_once("IncPie.html");    //Incluye el script de pie de página.
    ?>
</body>
</html>