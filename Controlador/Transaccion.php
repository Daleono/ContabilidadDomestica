<?php    
    //Controla el flujo de datos escritos por el usuario, ya sean gastos nuevos o modificados.
    try{
        include_once("../Modelo/ObjetoGasto.php");  //Incluye el objeto de un gasto.
        include_once("../Modelo/ObjetoManejoGastos.php");   //Incluye el objeto que maneja el flujo de gastos.
        include_once("Conexion.php");   //Incluye el script que realiza la conexión al BBDD.

        $establecer = new ManejoGastos($mi_conexion);   //Crea instancia del objeto ManejoGastos.
        $gasto = new Gasto();   //Crea instancia del objeto de un Gasto.

        $categoria = $_POST["categoria"];   //Recibe por POST la categoria que el usuario escribió.
        $id = $_POST["id"]; //Recibe por POST la id que recibe de Modificar.php

        if(isset($_POST["fecha_check"])){   //Si se activó el check de la fecha actual, el objeto Gasto guarda la fecha actual con la función setFecha().
            $fecha = Date("Y-m-d");
            $gasto->setFecha($fecha);
        }

        elseif($_POST["fecha"] != ""){  //Si NO está activó el check de fecha actual y se introdujo una fecha entonces el objeto Gasto guarda la fecha con la función setFecha().
            $fecha = $_POST["fecha"];
            $gasto->setFecha(htmlentities(addslashes($fecha), ENT_QUOTES));
        }

        else{   //Si NO se activó el check de fecha actual NI se introdujo una fecha entonces el objeto Gasto guarda "-" con la función setFecha().
            $fecha = "-";
            $gasto->setFecha(htmlentities(addslashes($fecha), ENT_QUOTES));
        }

        $gasto->setImporte(htmlentities(addslashes($_POST["importe"]), ENT_QUOTES));    //Se guarda el valor de importe que el usuario agregó.
        $gasto->setDescripcion(htmlentities(addslashes($_POST["descripcion"]), ENT_QUOTES));    //Se guarda el valor de la descripción que el usuario agregó.
        $gasto->setCategoria(htmlentities(addslashes($categoria), ENT_QUOTES)); //Se guarda el valor de la categoría que el usuario agregó.

        $establecer->setSentencia($gasto, $id); //Se crea una sentencia: create o update, dependiendo del valor de $id
        $fecha = cambiarFormatoFecha($fecha);   //Se utiliza una función guardada en el script de ObjetoManejoGastos.
        
        if($id == 0)    //Si $id es igual a 0, el usuario creó un nuevo Gasto, se manda la categoría y la fecha por GET a Nuevo.php.
            header("location: ../Vista/Nuevo.php?categoria=$categoria&fecha=$fecha");
        else    //Si NO, el usuarió modificó un Gasto, se manda la categoría y la fecha por GET a Modificar.php.
            header("location: ../Vista/Modificar.php?id=$id&categoria=$categoria&fecha=$fecha");
    }
    catch(Exception $e){
        die ("Error:" . $e->getMessage());  //Si ocurre algún error imprimir error.
    }
?>