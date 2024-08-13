<?php
$controlador = new controladorProduccion();
if (isset($_POST['registrar'])) {
    $r = $controlador->crear(
        $_POST['nombre'],
        $_POST['fecha_publicacion'],
        $_POST['proyec_inv_gen'],
        $_POST['tipo']
    );
    if ($r) {
?>

        <!-- Modal de PRODUCCION REGISTRADO CON EXITO -->
        <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                    </div>
                    <div class="modal-body">La Producción Académica ha sido registrado exitosamente.</div>
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
                    window.location.href = '../inicio/?cargar=inicioProduccion';
                });
            });
        </script>
<?php

    }
}
?>



<!-- Encabezado o Titulo -->
<h1 class="h3 mb-4 text-gray-800">Registrar Producciones Académicas</h1>
<div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters">
            <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">

                <form action="" method="post" id="frmproduccion" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre de la Producción Académica"
                                    pattern=".{5,}" 
                                    oninvalid="this.setCustomValidity('El nombre solo debe contener letras y espacios, y tener entre 5 y 254 caracteres.')"
                                    oninput="this.setCustomValidity('')"
                                    autofocus required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="fecha_publicacion">Fecha de Publicación</label>
                                <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" placeholder="Ingresa la fecha de publicacion"
                                    oninvalid="this.setCustomValidity('Por favor ingresa una fecha válida.')"
                                    oninput="this.setCustomValidity('')"
                                    required>
                            </div>
                        </div>

                        <!--Aqui creamos un SELECT pero usando datos de consulta
                        de otra tabla, esto para que en las opciones
                        tenga coherencia con los datos que se encuentran
                        registrados en la tabla de proectos de investigacion-->
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="proyec_inv_gen">Proyecto de Investigación del cual se generó</label>
                                <select class="form-control" id="proyec_inv_gen" name="proyec_inv_gen" required>
                                    <?php
                                    include '../../clases/conexion.php';
                                    $conexion = new conexion();
                                    $getproyecto1 = "SELECT * FROM proyecto_investigacion ORDER BY nombre";
                                    $getproyecto2 = $conexion->consultaRetorno($getproyecto1);

                                    while ($row = mysqli_fetch_array($getproyecto2)) {
                                        $id = $row['id_proyecto_investigacion'];
                                        $nombre = $row['nombre'];
                                        $fecha_inicio = $row['fecha_inicio'];
                                        $descripcion = $row['descripcion'];

                                    ?>
                                        <option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="Revista">Revista</option>
                                    <option value="Libro">Libro</option>
                                </select>
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