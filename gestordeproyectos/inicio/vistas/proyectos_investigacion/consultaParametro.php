<!-- Encabezado o Titulo -->
<!--Este div es para lo del PDF --><div class="d-flex justify-content-between align-items-center">
<h1 class="h3 mb-4 text-gray-800">Proyectos de Investigación</h1>
                        <a href="../../../../../bienvenida/gestordeproyectos/fpdf/reporte_proyectos.php" target="_blank" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa fa-file-pdf"></i>
                            </span>
                            <span class="text">Generar Reporte en PDF</span>
                        </a>
                    </div>


<!--Descripcion despues del Titulo-->
<p class="mb-4">En este apartado puedes generar reportes en PDF, realizar consultas por nombre, modificar
    y eliminar registros de Proyectos de Investigación.
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
        <h6 class="m-0 font-weight-bold text-primary">Proyectos de Investigación Registrados</h6>
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
                        <th>Fecha de Inicio</th>
                        <th>Descripción</th>
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
                        $fecha_inicio = $row ['fecha_inicio'];

                        // Crear un objeto DateTime a partir de la fecha
                        $datetime = new DateTime($fecha_inicio);

                        // Formatear la fecha en el formato día/mes/año
                        $fecha_formateada = $datetime->format('d/m/Y');
                        ?>
                        <!--Aqui se insertan los datos de la tabla
                            usando la variable que recogio los datos de la consulta-->
                        <tr>
                            <td><?php echo $row['id_proyecto_investigacion']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $fecha_formateada; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td>
                                <!--Este es el boton de EDITAR-->
                                <a href=?cargar=editar&id=<?php echo $row['id_proyecto_investigacion']; ?> class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                            </td>

                            <td>
                                <!--Este es el boton de ELIMINAR-->
                                <a  onClick='confirmar(<?php echo $row['id_proyecto_investigacion']; ?> )' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                        
                </tbody>
            </table>

<script src="js/jquery.js"></script>

<script language="javascript">
        function confirmar(id_proyecto_investigacion){
            confirmar=confirm("Realmente deseas eliminar el registro?");
            if(confirmar)
            {

            window.location.href='?cargar=eliminar&id_proyecto_investigacion='+id_proyecto_investigacion;
            alert('Registro eliminado...');

            }
            else{
                document.location="index.php";
            }
            }
</script>