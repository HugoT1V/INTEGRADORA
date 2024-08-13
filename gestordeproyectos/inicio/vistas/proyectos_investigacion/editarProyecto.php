<?php
    $controlador=new controladorProyecto();
    if(isset($_GET['id_proyecto_investigacion'])){
        $row=$controlador->consultar($_GET['id_proyecto_investigacion']);
    }else{
        header('Location: consultarproyectos.php');
    }
    if(isset($_POST['registrar'])){
        $r=$controlador->editar($_GET['id_proyecto_investigacion'], $_POST['nombre'],
        $_POST['fecha_inicio'], $_POST['descripcion']);

        if($r){?>

                <!-- Modal de PROYECTO MODIFICADO CON EXITO -->
        <div class="modal fade" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                    </div>
                    <div class="modal-body">El Proyecto de Investigación ha sido modificado exitosamente.</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal" id="aceptarBtn">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            /*
             Este script es para que se ejecute
            el modal, acuerdate de cambiar por
            el nombre del modal.
            Y tambien es para redireccionamiento
            */
            $(document).ready(function() {
                $('#modificarModal').modal('show');
                $('#aceptarBtn').on('click', function() {
                    window.location.href = '../inicio/?cargar=inicioProyecto';
                });
            });
        </script>
           <?php 
        }
    }
?>

<!-- Encabezado o Titulo -->
<h1 class="h3 mb-4 text-gray-800">Registrar Proyectos de Investigación</h1>
    <div class="container">
            <div class="contact__wrapper shadow-lg mt-n9">
            <div class="row no-gutters">
            <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">

            <!--En este form hay que modificar los nombres de cada input
            para que no se vaya a confundir, mejor si se le pone el nombre
            como esta en la base de datos, tambien hay que modificar el VALUE
            ya que deben de aparecer los datos que se hayan recogido, hay que
            modificarlo con los nombres en los que estan en la base de datos para no errarle-->
            <form action=""method="post" id="frmeditar_proyecto" class="contact-form">
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="form-group">
                            <label class="required-field" for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre'];?>" placeholder="Ingresa el nombre del Proyecto de Investigacion"
                                pattern=".{5,}" 
                                oninvalid="this.setCustomValidity('El nombre debe tener entre 5 y 250 caracteres.')"
                                oninput="this.setCustomValidity('')"
                                autofocus required autocomplete="off">
                    </div>
                </div>

                <div class="col-sm-6 mb-3">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $row['fecha_inicio'];?>" placeholder="Ingresa la fecha de inicio"
                            oninvalid="this.setCustomValidity('Por favor ingresa una fecha válida.')"
                            oninput="this.setCustomValidity('')"
                            required>
                    </div>
                </div>

                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label class="required-field" for="descripcion">Descripción</label>
                        <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresa la descripcion del Proyecto de Investigacion"
                            pattern=".{10,}" 
                            oninvalid="this.setCustomValidity('La descripción debe tener al menos 10 caracteres.')"
                            oninput="this.setCustomValidity('')" 
                            required autocomplete="off"><?php echo $row['descripcion'];?></textarea>
                    </div>
                </div>
                
                <div class="col-sm-12 mb-3">
                    <button type="submit" name="registrar" class="btn btn-primary" value="Registrar" >Registrar</button>
                </div>

            </form>
            </div>
                                    <!-- End Contact Form Wrapper -->

                                </div>
                            </div>
                        </div>