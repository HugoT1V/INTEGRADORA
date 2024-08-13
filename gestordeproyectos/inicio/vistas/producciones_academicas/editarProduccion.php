<?php
$controlador = new controladorProduccion();
if (isset($_GET['id_producciones_academicas'])) {
    $row = $controlador->consultar($_GET['id_producciones_academicas']);
} else {
    header('Location: consultaroproducciones.php');
}
if (isset($_POST['registrar'])) {
    $r = $controlador->editar(
        $_GET['id_producciones_academicas'],
        $_POST['nombre'],
        $_POST['fecha_publicacion'],
        $_POST['proyec_inv_gen'],
        $_POST['tipo']
    );

    if ($r) { ?>

        <!-- Modal de PRODUCCION MODIFICADO CON EXITO -->
        <div class="modal fade" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                    </div>
                    <div class="modal-body">La Producción Académica ha sido modificado exitosamente.</div>
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

                <!--En este form hay que modificar los nombres de cada input
            para que no se vaya a confundir, mejor si se le pone el nombre
            como esta en la base de datos, tambien hay que modificar el VALUE
            ya que deben de aparecer los datos que se hayan recogido, hay que
            modificarlo con los nombres en los que estan en la base de datos para no errarle-->
                <form action="" method="post" id="frmeditar_docente" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" placeholder="Ingresa el nombre de la Producción Académica"
                                    pattern=".{5,}" 
                                    oninvalid="this.setCustomValidity('El nombre solo debe contener letras y espacios, y tener entre 5 y 254 caracteres.')"
                                    oninput="this.setCustomValidity('')"
                                    autofocus required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="fecha_publicacion">Fecha de Publicación</label>
                                <input type="tel" class="form-control" id="fecha_publicacion" name="fecha_publicacion" value="<?php echo $row['fecha_publicacion']; ?>" placeholder="Ingresa la fecha de publicación"
                                    oninvalid="this.setCustomValidity('Por favor ingresa una fecha válida.')"
                                    oninput="this.setCustomValidity('')"
                                    required autocomplete="off">
                            </div>
                        </div>

                        <!--Aqui creamos un SELECT pero usando datos de consulta
                        de otra tabla, esto para que en las opciones
                        tenga coherencia con los datos que se encuentran
                        registrados en la tabla de proyectos de investigacion-->
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="proyec_inv_gen">Proyecto de Investigación del cual se generó</label>
                                <select class="form-control" id="proyec_inv_gen" name="proyec_inv_gen" required>
                                    <?php
                                    include '../../clases/conexion.php';
                                    $conexion = new conexion();
                                    $getproyecto1 = "SELECT * FROM proyecto_investigacion ORDER BY nombre";
                                    $getproyecto2 = $conexion->consultaRetorno($getproyecto1);

                                    while ($row_proyecto = mysqli_fetch_assoc($getproyecto2)) {
                                        $nombre_proyecto = $row_proyecto['nombre'];
                                    ?>
                                        <option value="<?php echo $nombre_proyecto; ?>" <?php echo ($nombre_proyecto == $row['proyec_inv_gen']) ? 'selected' : ''; ?>>
                                            <?php echo $nombre_proyecto; ?>
                                        </option>
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
                                    <option value="Revista" <?php echo ($row['tipo'] == 'Revista') ? 'selected' : ''; ?>>Revista</option>
                                    <option value="Libro" <?php echo ($row['tipo'] == 'Libro') ? 'selected' : ''; ?>>Libro</option>
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