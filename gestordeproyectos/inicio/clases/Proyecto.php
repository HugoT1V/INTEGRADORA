<?php
    include_once('conexion.php');

    class Proyecto{
        //atributos
        private $id_proyecto_investigacion;
        private $nombre;
        private $fecha_inicio;
        private $descripcion;
        private $con;

        //metodos
        public function __construct(){
            $this->con=new conexion();
        }

        public function set($atributo, $contenido){
            $this->$atributo=$contenido;
        }

        public function get($atributo){
            return $this->$atributo;
        }

        public function listar(){
            $sql="SELECT * FROM proyecto_investigacion";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function filtrar($valor){
            $sql="SELECT * FROM proyecto_investigacion WHERE nombre LIKE '%$valor%'";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function crear(){
            $sql="INSERT INTO proyecto_investigacion(nombre,fecha_inicio,descripcion)
                VALUES ('{$this->nombre}', '{$this->fecha_inicio}', '{$this->descripcion}')";

                $this->con->consultaSimple($sql);
                return true;
        }

        public function eliminar(){
            $sql="DELETE FROM proyecto_investigacion WHERE id_proyecto_investigacion='{$this->id_proyecto_investigacion}'";
            $resultado=$this->con->consultaSimple($sql);
        }

        public function consultar(){
            $sql="SELECT * FROM proyecto_investigacion WHERE id_proyecto_investigacion='{$this->id_proyecto_investigacion}'";
            $resultado=$this->con->consultaRetorno($sql);
            $row=mysqli_fetch_assoc($resultado);

            //set
            $this->id_proyecto_investigacion=$row['id_proyecto_investigacion'];
            $this->nombre=$row['nombre'];
            $this->fecha_inicio=$row['fecha_inicio'];
            $this->descripcion=$row['descripcion'];
            return $row;
        }

        public function editar(){
            $sql="UPDATE proyecto_investigacion SET nombre='{$this->nombre}', fecha_inicio='{$this->fecha_inicio}',
            descripcion='{$this->descripcion}'
            WHERE id_proyecto_investigacion='{$this->id_proyecto_investigacion}'";
            $this->con->consultaSimple($sql);
            return true;
        }
    }
?>