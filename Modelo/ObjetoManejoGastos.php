<?php
    include_once("ObjetoGasto.php");    //Incluye el objeto de un gasto.

    function cambiarFormatoFecha($fecha){   //Función para convertir una fecha con formato mes-día-año a día-mes-año
        $fecha = Date("d-m-Y", strtotime($fecha));
        return $fecha;
    }

    //Objeto que maneja varios objetos Gasto
    class ManejoGastos{
        private PDO $Conexion;  //Atributo del objeto. Necesita una conexión con el DDBB.

        //Constructor del objeto. Solo se almacena la conexión al atributo.
        function __construct($conexion){    
            $this->Conexion = $conexion;
        }

        //Función que recopila y regresa un array de todos los objetos Gasto que tiene la BBDD.
        public function getAll(){   
            $matriz = array();  //Crea un array.
            $contador = 0;  //Inicializa contador para controlar el array.
            $resultado = $this->Conexion->query("SELECT * FROM GASTOS ORDER BY FECHA"); //Con la conexión se realiza una consulta en la BBDD para mostrar todos los gastos ordenados por fecha.

            //While que se repite hasta que no se encuentren más datos.
            while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
                $gasto = new Gasto();   //Crea un objeto Gasto.
                $gasto->setCategoria($registro["CATEGORIA"]);   //Establece la categoría del objeto con la categoría del registro.
                $gasto->setDescripcion($registro["DESCRIPCION"]);   //Establece la descripción del objeto con la descripción del registro.
                $fecha = cambiarFormatoFecha($registro["FECHA"]);   //LLama una función para cambiar el formato de la fecha.
                $gasto->setFecha($fecha);   //Establece la fecha del objeto con la fecha del registro.
                $gasto->setId($registro["ID"]); //Establece la ID del objeto con la ID del registro.
                $gasto->setImporte($registro["IMPORTE"]);   //Establece la importe del objeto con del importe del registro.
                

                $matriz[$contador] = $gasto;    //El objeto gasto se almacena en el array $matriz.
                $contador++;    //El contador aumenta.
            }
            return $matriz; //Retorna el array.
        }

        //Función que obtiene un string para buscar una coincidencia en la descripción o categoría de cada registro en la BBDD y retornar esos registros por un array.
        public function getRegistro($dato){
            $dato = addslashes($dato);  //Función que añade diagonales invertidas para evitar inyección SQL.
            $matriz = array();  //Crea un array.
            $contador = 0;  //Inicializa contador para controlar el array.
            $resultado = $this->Conexion->query("SELECT * FROM GASTOS WHERE DESCRIPCION LIKE '%$dato%' OR CATEGORIA LIKE '%$dato%' ORDER BY FECHA"); //Manda la consulta SQL para seleccionar registros que contengan el string de entrado $dato en la descripción o categoría, ordenado por fecha.

            //While que se repite hasta que no se encuentren más datos.
            while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
                $gasto = new Gasto();   //Crea un objeto Gasto.
                $gasto->setCategoria($registro["CATEGORIA"]);   //Establece la categoría del objeto con la categoría del registro.
                $gasto->setDescripcion($registro["DESCRIPCION"]);   //Establece la descripción del objeto con la descripción del registro.
                $fecha = cambiarFormatoFecha($registro["FECHA"]);   //LLama una función para cambiar el formato de la fecha.
                $gasto->setFecha($fecha);      //Establece la fecha del objeto con la fecha del registro.
                $gasto->setId($registro["ID"]);     //Establece la ID del objeto con la ID del registro.
                $gasto->setImporte($registro["IMPORTE"]);   //Establece la importe del objeto con del importe del registro.

                $matriz[$contador] = $gasto;    //El objeto gasto se almacena en el array $matriz.
                $contador++;    //El contador aumenta.
            }
            return $matriz; //Retorna el array.
        }

        //Función que recibe un ID para buscar un registro cuya ID coincidencia con la entrada, retorna solo un objeto gasto.
        public function getRegistroID($id){
            $resultado = $this->Conexion->query("SELECT CATEGORIA, DESCRIPCION, FECHA, IMPORTE FROM GASTOS WHERE ID = '$id'"); //Manda una consulta SQL para seleccionar un registro cuya ID coincida con la entrada.

            $registro = $resultado->fetch(PDO::FETCH_ASSOC);   //Se guarda el registro como array. 
            $gasto = new Gasto();   //Crea nuevo objeto Gasto.
            $gasto->setCategoria($registro["CATEGORIA"]);      //Establece la categoría del objeto con la categoría del registro.
            $gasto->setDescripcion($registro["DESCRIPCION"]);       //Establece la descripción del objeto con la descripción del registro.
            $gasto->setFecha($registro["FECHA"]);   //Establece la fecha del objeto con la fecha del registro.
            $gasto->setImporte($registro["IMPORTE"]);   //Establece la importe del objeto con del importe del registro.

            return $gasto; //Retorna el objeto gasto.
        }

        //Función que retorna la cantidad de registros almacenados en la BBDD.
        public function getCantidad(){
            $contador = 0;  //Inicializa contador.
            $resultado = $this->Conexion->query("SELECT ID FROM GASTOS");   //Manda consulta SQL para leccionar la ID de toda la BBDD.

            //While que se repite hasta que no se encuentren más datos.
            while($resultado->fetch(PDO::FETCH_ASSOC))
                $contador++;    //Aumenta el contador por cada registro.
            return $contador;   //Regresa la variable contador
        }

        //Función que recibe el objeto y un ID, actualiza o inserta dependiendo el valor del ID.
        public function setSentencia(Gasto $gasto, $id){
            //Si el ID es inválida inserta un nuevo registro.
            if($id == 0)
                $sql = "INSERT INTO GASTOS(FECHA, IMPORTE, DESCRIPCION, CATEGORIA) VALUES('" . $gasto->getFecha() . "', '" . $gasto->getImporte() . "', '" . $gasto->getDescripcion() . "', '" . $gasto->getCategoria() . "')";
            //Si el ID es válido actualiza el registro cuya ID es igual a la entrada.
            else
                $sql = "UPDATE GASTOS SET FECHA = '" . $gasto->getFecha() . "', IMPORTE = '" . $gasto->getImporte() . "', DESCRIPCION = '" . $gasto->getDescripcion() . "', CATEGORIA = '" . $gasto->getCategoria() . "' WHERE ID = '" . $id . "'";$this->Conexion->exec($sql);
        }
    }
?>