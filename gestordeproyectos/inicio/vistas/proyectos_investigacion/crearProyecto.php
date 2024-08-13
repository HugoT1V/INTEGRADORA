<?php
$controlador = new controladorProyecto();
if (isset($_POST['registrar'])) {
    $r = $controlador->crear(
        $_POST['nombre'],
        $_POST['fecha_inicio'],
        $_POST['descripcion']
    );
    if ($r) {
?>

        <!-- Modal de PROYECTO DE INVESTIGACION REGISTRADO CON EXITO -->
        <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                    </div>
                    <div class="modal-body">El Proyecto de Investigación ha sido registrado exitosamente.</div>
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
                el nombre del modal
                */
            $(document).ready(function() {
                $('#registroModal').modal('show');
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

                <form action="" method="post" id="frmproyecto" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre del Proyecto de Investigacion" autofocus 
                                    pattern=".{5,}" 
                                    oninvalid="this.setCustomValidity('El nombre debe tener entre 5 y 250 caracteres.')"
                                    oninput="this.setCustomValidity('')"
                                    required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingresa la fecha de inicio"
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
                                    required autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <button type="submit" name="registrar" class="btn btn-primary" value="Registrar">Registrar</button>
                        </div>

                </form>
            </div>
            <!-- End Contact Form Wrapper -->

        </div>
    </div>
</div>