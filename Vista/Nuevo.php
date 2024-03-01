<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once("IncCabecera.html");   //Se incluye la cabecera
    ?>
    <p>Ha escogido la opción <b>Añadir</b></p>
    <form action="../Controlador/Transaccion.php" method="post">
        <p align="center">
            <label>Fecha</label>
            <input type="date" name="fecha">
            <label>Fecha actual</label>
            <input type="checkbox" name="fecha_check">
            <input type="hidden" name="id" value="0">
        </p>
        <p align="center">
            <label>Importe</label>
            <input type="number" step=0.01 name="importe">
        </p>
        <p align="center">
            <label>Descripción</label>
            <textarea name="descripcion"></textarea>
        </p>
        <p align="center">
            <label>Categoría</label>
            <input type="text" name="categoria">
        </p>
        <br>
        <p align="center">
            <input type="submit" name="enviar" value="Guardar Datos">
        </p>
    </form>
    <?php
        //Si al cargar la página ya se tiene el valor de la categoría entonces guardar ese valor y la fecha en variables y mostrar un mensaje de nuevo gasto añadido.
        if(isset($_GET["categoria"])){  
            $categoria = $_GET["categoria"];
            $fecha = $_GET["fecha"];
            echo "Gasto de $categoria añadido, con fecha del $fecha";
        }
        include_once("IncPie.html");    //Incluye el pie de página.
    ?>
</body>
</html>