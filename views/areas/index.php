<?php include_once '../../includes/header.php' ?>
<div class="container">
    <h1 class="text-center">Formulario de Areas</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="area_id" id="area_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="area_nombre">Nombre del Area</label>
                    <input type="text" name="area_nombre" id="area_nombre" class="form-control" required>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-secondary w-100">Cancelar</button>
                </div>
                <div class="col">
                    <button type="reset" id="btnLimpiar" class="btn btn-secondary w-100">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 table-responsive">
            <h2 class="text-center">Listado de Areas</h2>
            <table class="table table-bordered table-hover" id="tablaAreas">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">No hay Areas Registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script defer src="/tarea3_carpio_guerra_is2/src/js/funciones.js"></script>
<script defer src="/tarea3_carpio_guerra_is2/src/js/areas/index.js"></script>
<?php include_once '../../includes/footer.php' ?>