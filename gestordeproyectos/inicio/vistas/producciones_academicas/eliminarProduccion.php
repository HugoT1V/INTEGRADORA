<?php
    $controlador=new controladorProduccion();
    if(isset($_GET['id_producciones_academicas'])){
        $row=$controlador->consultar($_GET['id_producciones_academicas']);
    }else{?>

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
    $controlador->eliminar($_GET['id_producciones_academicas']);
    ?>
            <!-- Modal de éxito -->
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                        </div>
                        <div class="modal-body">Producción Académica eliminada correctamente.</div>
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
                    $('#eliminarModal').modal('show');
                    $('#aceptarBtn').on('click', function() {
                        window.location.href = '../inicio/?cargar=inicioProduccion';
                    });
                });
            </script>
        <?php
    ?>
