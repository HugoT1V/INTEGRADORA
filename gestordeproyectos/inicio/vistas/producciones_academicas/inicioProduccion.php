<?php
//$controlador = new controladorEstudiante();
$produccion = new Produccion();
if (isset($_POST)) {
    $buscar = @$_POST['buscar'];
    $resultado = $produccion->filtrar($buscar);
} else {
    $resultado = $produccion->listar();
}
?>

<!-- Encabezado o Titulo -->
<!--Este div es para lo del PDF --><div class="d-flex justify-content-between align-items-center">
<h1 class="h3 mb-4 text-gray-800">Producciones Académicas</h1>
                        <a href="../../../../../bienvenida/gestordeproyectos/fpdf/reporte_producciones.php" target="_blank" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa fa-file-pdf"></i>
                            </span>
                            <span class="text">Generar Reporte en PDF</span>
                        </a>
                    </div>


<!--Descripcion despues del Titulo-->
<p class="mb-4">En este apartado puedes generar reportes en PDF, realizar consultas por nombre, modificar
    y eliminar registros de Producciones Académicas.
</p>



<!-- Cuadro de Busqueda -->
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST" action="">
    <div class="input-group">
        <!--Aqui en el input uso el AUTOCOMPLETE="OFF" para evitar
        que me de sugerencias de respuestas, cosa que no deberia de ser-->
        <input type="buscar" name="buscar" class="form-control bg-light border-0 small shadow search" placeholder="Buscar por nombre..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>


<!-- Tabla de Ejemplo -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Producciones Académicas Registradas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <!--Aqui estan los nombres de las columnas
                    estan son las que aparecen en la aplicacion-->
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha de Publicación</th>
                        <th>Proyecto de Investigación del cual se generó</th>
                        <th>Tipo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /*
                        Aqui se recogen los datos de la consulta en
                        una variable
                        */
                        while($row = mysqli_fetch_assoc($resultado)): 
                        /* Las siguientes lineas de codigo
                            es para acomodar la fehca en 
                            dias/mes/año
                        */
                        $fecha_publicacion = $row['fecha_publicacion'];

                        // Crear un objeto DateTime a partir de la fecha
                        $datetime = new DateTime($fecha_publicacion);

                        // Formatear la fecha en el formato día/mes/año
                        $fecha_formateada = $datetime->format('d/m/Y');
                        ?>
                        <!--Aqui se insertan los datos de la tabla
                            usando la variable que recogio los datos de la consulta-->
                        <tr>
                            <td><?php echo $row['id_producciones_academicas']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $fecha_formateada; ?></td>
                            <td><?php echo $row['proyec_inv_gen']; ?></td>              
                            <td><?php echo $row['tipo']; ?></td>
                            <td>
                                <!--Este es el boton de EDITAR-->
                                <a href=?cargar=editarProduccion&id_producciones_academicas=<?php echo $row['id_producciones_academicas'];
                                ?> class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                            </td>

                            <td>
                                <!--Este es el boton de ELIMINAR-->
                                <a  onClick='confirmar(<?php echo $row['id_producciones_academicas']; ?> )' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                        
                </tbody>
            </table>


<script src="js/jquery.js"></script>
<script src="js/sweetalert.min.js"></script>


<script languaje = "javascript">
    function confirmar(id_producciones_academicas){
        var MyId = id_producciones_academicas;
        swal({
            title:"¿Estas seguro de eliminar el registro?",
            text: "Ya no podrás recuperarlo",
            type:"warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, borrar",
            closeOnConfirm: false
        },
        function(){
            window.location.href='?cargar=eliminarProduccion&id_producciones_academicas='+MyId;
        });
    }
</script>