<?php
include_once('clases/Docente.php');
include_once('clases/Proyecto.php');
include_once('clases/Produccion.php');

//Clase para docentes
class controladorDocente{

    //atributos
    private $docente;

    //metodos
    public function __construct(){
        $this->docente=new Docente();

    }
    public function index(){
        $resultado=$this->docente->listar();
        return $resultado;
    }
    public function crear($nombre, $telefono, $lider, $correo,
    $contrasena){
        $this->docente->set("nombre",$nombre);
        $this->docente->set("telefono",$telefono);
        $this->docente->set("lider",$lider);
        $this->docente->set("correo",$correo);
        $this->docente->set("contrasena",$contrasena);


        $resultado=$this->docente->crear();
        return $resultado;
    }

    public function eliminar($id_docente){
        $this->docente->set("id_docente", $id_docente);
        $this->docente->eliminar();
    }

    public function consultar($id_docente){
        $this->docente->set("id_docente", $id_docente);
        $datos=$this->docente->consultar();
        return $datos;
    }

    public function editar($id_docente, $nombre, $telefono, $lider, $correo,
    $contrasena){
        $this->docente->set("nombre",$nombre);
        $this->docente->set("telefono",$telefono);
        $this->docente->set("lider",$lider);
        $this->docente->set("correo",$correo);
        $this->docente->set("contrasena",$contrasena);

        $resultado=$this->docente->editar();
        return $resultado;
    }
    }

//Clase para proyectos
class controladorProyecto{

    //atributos
    private $proyecto;

    //metodos
    public function __construct(){
        $this->proyecto=new Proyecto();

    }
    public function index(){
        $resultado=$this->proyecto->listar();
        return $resultado;
    }
    public function crear($nombre, $fecha_inicio,
    $descripcion){
        $this->proyecto->set("nombre",$nombre);
        $this->proyecto->set("fecha_inicio",$fecha_inicio);
        $this->proyecto->set("descripcion",$descripcion);


        $resultado=$this->proyecto->crear();
        return $resultado;
    }

    public function eliminar($id_proyecto_investigacion){
        $this->proyecto->set("id_proyecto_investigacion", $id_proyecto_investigacion);
        $this->proyecto->eliminar();
    }

    public function consultar($id_proyecto_investigacion){
        $this->proyecto->set("id_proyecto_investigacion", $id_proyecto_investigacion);
        $datos=$this->proyecto->consultar();
        return $datos;
    }

    public function editar($id_proyecto_investigacion, $nombre, $fecha_inicio,
    $descripcion){
        $this->proyecto->set("nombre",$nombre);
        $this->proyecto->set("fecha_inicio",$fecha_inicio);
        $this->proyecto->set("descripcion",$descripcion);

        $resultado=$this->proyecto->editar();
        return $resultado;
    }
    }

//Clase para producciones
class controladorProduccion{

    //atributos
    private $produccion;

    //metodos
    public function __construct(){
        $this->produccion=new Produccion();

    }
    public function index(){
        $resultado=$this->produccion->listar();
        return $resultado;
    }
    public function crear($nombre, $fecha_publicacion,
    $proyec_inv_gen, $tipo){
        $this->produccion->set("nombre",$nombre);
        $this->produccion->set("fecha_publicacion",$fecha_publicacion);
        $this->produccion->set("proyec_inv_gen",$proyec_inv_gen);
        $this->produccion->set("tipo",$tipo);


        $resultado=$this->produccion->crear();
        return $resultado;
    }

    public function eliminar($id_producciones_academicas){
        $this->produccion->set("id_producciones_academicas", $id_producciones_academicas);
        $this->produccion->eliminar();
    }

    public function consultar($id_producciones_academicas){
        $this->produccion->set("id_producciones_academicas", $id_producciones_academicas);
        $datos=$this->produccion->consultar();
        return $datos;
    }

    public function editar($id_producciones_academicas, $nombre, $fecha_publicacion,
    $proyec_inv_gen, $tipo){
        $this->produccion->set("nombre",$nombre);
        $this->produccion->set("fecha_publicacion",$fecha_publicacion);
        $this->produccion->set("proyec_inv_gen",$proyec_inv_gen);
        $this->produccion->set("tipo",$tipo);

        $resultado=$this->produccion->editar();
        return $resultado;
    }
    }
?>