<?php
    include_once('conexion.php');

    class Docente{
        //atributos
        private $id_docente;
        private $nombre;
        private $telefono;
        private $lider;
        private $correo;
        private $contrasena;
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
            $sql="SELECT id_docente,nombre,telefono,lider,correo,(SELECT OLD_PASSWORD(contrasena)) AS codificado FROM docentes";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function filtrar($valor){
            $sql="SELECT id_docente,nombre,telefono,lider,correo,(SELECT OLD_PASSWORD(contrasena)) AS codificado FROM docentes WHERE nombre LIKE '%$valor%'";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function crear(){
            $sql="INSERT INTO docentes(nombre,telefono,lider,correo,contrasena)
                VALUES ('{$this->nombre}', '{$this->telefono}', '{$this->lider}',
                 '{$this->correo}', '{$this->contrasena}')";

                $this->con->consultaSimple($sql);
                return true;
        }

        public function eliminar(){
            $sql="DELETE FROM docentes WHERE id_docente='{$this->id_docente}'";
            $resultado=$this->con->consultaSimple($sql);
        }

        public function consultar(){
            $sql="SELECT * FROM docentes WHERE id_docente='{$this->id_docente}'";
            $resultado=$this->con->consultaRetorno($sql);
            $row=mysqli_fetch_assoc($resultado);

            //set
            $this->id_docente=$row['id_docente'];
            $this->nombre=$row['nombre'];
            $this->telefono=$row['telefono'];
            $this->lider=$row['lider'];
            $this->correo=$row['correo'];
            $this->contrasena=$row['contrasena'];
            return $row;
        }

        public function editar(){
            $sql="UPDATE docentes SET nombre='{$this->nombre}', telefono='{$this->telefono}',
            lider='{$this->lider}', correo='{$this->correo}', contrasena='{$this->contrasena}'
            WHERE id_docente='{$this->id_docente}'";
            $this->con->consultaSimple($sql);
            return true;
        }
    }
?>