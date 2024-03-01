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
            include_once("../Modelo/ObjetoManejoGastos.php");   //Se incluye el objeto de ManejoGastos
            include_once("../Controlador/Conexion.php");    //Se incluye el script que conecta con la BBDD.
        ?>
        <p>Ha escogido la opción <b>Ver</b></p>

        <?php
            try{
                $datos = new ManejoGastos($mi_conexion);    //Se crea una nueva instancia del objeto ManejoGastos.
                $tabla_datos = $datos->getAll();    //Se obtienen todos los datos almacenados en la BBDD.

                //Si NO está vacio el array entonces imprimir una tabla con FECHA, DESCRIPCIÓN, IMPORTE y CATEGORÍA para ingresar todos los registros.
                if(!empty($tabla_datos)){
                    //Imprime el header de la tabla
                    echo "<table>";
                        echo "<tr>";
                            echo "<th>FECHA</th>";
                            echo "<th>DESCRIPCIÓN</th>";
                            echo "<th>IMPORTE</th>";
                            echo "<th>CATEGORÍA</th>";
                            echo "<th></th>";
                        echo "</tr>";
                        //Por cada registro se imprime una fila con la información del registro.
                        foreach($tabla_datos as $valor){
                            echo "<tr>";
                                $id = $valor->getId();
                                echo "<td align='center'>" . $valor->getFecha() . "</td>";
                                echo "<td align='center'>" . $valor->getDescripcion() . "</td>";
                                echo "<td align='center'>" . $valor->getImporte() . "</td>";
                                echo "<td align='center'>" . $valor->getCategoria() . "</td>";
                                echo "<td align='center'><a href='Modificar.php?id=$id'>Modificar</a></td>";
                            echo "</tr>";
                        }
                    echo "<table>";            
                //Si está vacío el array entonces solo mostrar un mensaje de "No hay datos".
                }else
                    echo "No hay datos por mostrar";
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }

            include_once("IncPie.html");    //Incluir script del pie de página
        ?>  
    </body>
</html>