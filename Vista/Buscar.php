<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once("IncCabecera.html");   //Se incluye el script para agregar la cabecera.
    ?>
    <p>Ha escogido la opción <b>Buscar</b></p>
    <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <p>
            <label>Introduzca una palabra clave:
                <input type="text" name="buscar">
            </label>
        </p>
        <p>
            <input type="submit" name="enviando" value="Buscar">
        </p>
    </form>
    <?php
        if(isset($_POST["enviando"]) && $_POST["buscar"] != NULL){  //Revisa si ya se mandó la busqueda y no es vacía.
            include_once("../Modelo/ObjetoManejoGastos.php");   //Se incluye el código del objeto ManejoGastos
            include_once("../Controlador/Conexion.php");    //Se incluye el script para realizar una conexión con MySQl
            try{
                $buscar = $_POST["buscar"]; //Se guarda lo introducido por el usuario a una variable.
                $datos = new ManejoGastos($mi_conexion);    //Se crea una instancia de un objeto ManejoGasto.
                $tabla_datos = $datos->getRegistro($buscar);    //En una variable se guarda una búsqueda a la columna de categoría y descirpción en la BBDD.

                //Si se encuentra lo que el usuario busca entonces muestra una tabla con el registro.
                if(!empty($tabla_datos)){   
                    echo "<table>";
                    echo "<tr>";
                        echo "<th>FECHA</th>";
                        echo "<th>DESCRIPCIÓN</th>";
                        echo "<th>IMPORTE</th>";
                        echo "<th>CATEGORÍA</th>";
                        echo "<th></th>";
                    echo "</tr>";
                    //Repetir cada vez que se encontró un registro que el usuario buscaba.
                    foreach($tabla_datos as $registro){
                        $id = $registro->getId();   //En una variable se muestra el ID del Gasto.
                        echo "<tr>";
                            echo "<td align='center'>" . $registro->getFecha() ."</td>";    //Se muestra la fecha del objeto Gasto.
                            echo "<td align='center'>" . $registro->getDescripcion() ."</td>";  //Se muestra la descripción del objeto Gasto.
                            echo "<td align='center'>" . $registro->getImporte() ."</td>";  //Se muestra el importe del objeto Gasto.
                            echo "<td align='center'>" . $registro->getCategoria() ."</td>";    //Se muestra la categoría del objeto Gasto.
                            echo "<td align='center'><a href='Modificar.php?id=$id'>Modificar</a></td>";    //Link para mandar por medio del URL el ID del objeto.
                        echo "<tr>";
                    }
                    echo "</table>";
                }
                //Si no se encontraron registros entonces mostrar "No se encontraron datos".
                else
                    echo "No se encontraron datos";
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }

        include_once("IncPie.html");    //Se incluye el script del pie de página.
    ?>
</body>
</html>