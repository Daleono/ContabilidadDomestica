<?php
    //Objeto Gasto.
    class Gasto{
        //ATRIBUTOS DEL OBJETO. Representan los elementos de un registro.
        private int $Id;
        private string $Fecha;
        private float $Importe;
        private string $Descripcion;
        private string $Categoria;

        //FUNCIONES DEL OBJETO.
        public function getId(){    //Regresa el id del objeto Gasto.
            return $this->Id;
        }

        public function setId($id){ //Establece el id del objeto Gasto.
            $this->Id = $id;
        }


        public function getFecha(){ //Regresa la fecha del objeto Gasto.
            return $this->Fecha;
        }

        public function setFecha($fecha){ //Establece la fecha del objeto Gasto.
            $this->Fecha = $fecha;
        }


        public function getImporte(){   //Regresa el importe del objeto Gasto.
            return $this->Importe;
        }

        public function setImporte($importe){   //Estable el importe del objeto Gasto.
            $this->Importe = $importe;
        }


        public function getDescripcion(){   //Regresa la descripción del objeto Gasto.
            return $this->Descripcion;
        }

        public function setDescripcion($descripcion){   //Establece la descripción del objeto Gasto.
            $this->Descripcion = $descripcion;
        }


        public function getCategoria(){ //Regresa la categoría del objeto Gasto.
            return $this->Categoria;
        }

        public function setCategoria($categoria){   //Establece la categoría del objeto Gasto.
            $this->Categoria = $categoria;
        }
    }
?>