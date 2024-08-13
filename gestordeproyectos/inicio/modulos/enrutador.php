<?php
    class enrutador{
        public function cargarVista($vista){
            if(@$_SESSION['validada']== 1){
                switch($vista){
                    case "crearDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;
                    
                    case "editarDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "consultaParametro":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "eliminarDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "inicioDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "crearProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;
                    
                    case "editarProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "consultaParametro":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "eliminarProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "inicioProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "crearProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;
                    
                    case "editarProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "consultaParametro":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "eliminarProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "inicioProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "cerrar":
                        session_destroy();
                        echo "
                        <script languaje='JavaScript'>
                        
                        window.location.href='../index.html';
                        </script>";
                        break;
                    
                    default:
                        include_once('vistas/error.php');
                }
            }else{
                include_once('../index.html');
            }
        }

        public function validarGet($variable){
            if(isset($variable)){
                return true;
            }else{
                if(@$_SESSION['validada'] == 1)
                    include_once('vistas/docentes/inicioDocente.php');
                
                else
                echo "
                <script languaje='JavaScript'>
                
                window.location.href='../index.html';
                </script>";
                
            }
        }
    }
?>