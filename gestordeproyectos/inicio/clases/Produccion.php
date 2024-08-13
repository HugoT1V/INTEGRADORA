<?php
    include_once('conexion.php');

    class Produccion{
        //atributos
        private $id_producciones_academicas;
        private $nombre;
        private $fecha_publicacion;
        private $proyec_inv_gen;
        private $tipo;
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
            $sql="SELECT * FROM producciones_academicas";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function filtrar($valor){
            $sql="SELECT * FROM producciones_academicas WHERE nombre LIKE '%$valor%'";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function crear(){
            $sql="INSERT INTO producciones_academicas(nombre,fecha_publicacion,proyec_inv_gen,tipo)
                VALUES ('{$this->nombre}', '{$this->fecha_publicacion}', '{$this->proyec_inv_gen}',
                 '{$this->tipo}')";

                $this->con->consultaSimple($sql);
                return true;
        }

        public function eliminar(){
            $sql="DELETE FROM producciones_academicas WHERE id_producciones_academicas='{$this->id_producciones_academicas}'";
            $resultado=$this->con->consultaSimple($sql);
        }

        public function consultar(){
            $sql="SELECT * FROM producciones_academicas WHERE id_producciones_academicas='{$this->id_producciones_academicas}'";
            $resultado=$this->con->consultaRetorno($sql);
            $row=mysqli_fetch_assoc($resultado);

            //set
            $this->id_producciones_academicas=$row['id_producciones_academicas'];
            $this->nombre=$row['nombre'];
            $this->fecha_publicacion=$row['fecha_publicacion'];
            $this->proyec_inv_gen=$row['proyec_inv_gen'];
            $this->tipo=$row['tipo'];
            return $row;
        }

        public function editar(){
            $sql="UPDATE producciones_academicas SET nombre='{$this->nombre}', fecha_publicacion='{$this->fecha_publicacion}',
            proyec_inv_gen='{$this->proyec_inv_gen}', tipo='{$this->tipo}'
            WHERE id_producciones_academicas='{$this->id_producciones_academicas}'";
            $this->con->consultaSimple($sql);
            return true;
        }
    }
?>