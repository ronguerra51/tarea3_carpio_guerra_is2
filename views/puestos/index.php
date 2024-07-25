<?php include_once '../../includes/header.php' ?>
<div class="container">
    <h1 class="text-center">Formulario de Puestos</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="puesto_id" id="puesto_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="puesto_nombre">Nombre del Puesto</label>
                    <input type="text" name="puesto_nombre" id="puesto_nombre" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="puesto_sueldo">Sueldo</label>
                    <input type="text" name="puesto_sueldo" id="puesto_sueldo" class="form-control" required>
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
            <h2 class="text-center">Listado de Puestos</h2>
            <table class="table table-bordered table-hover" id="tablaPuestos">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Sueldo</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">No hay Puestos Registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script defer src="/tarea3_carpio_guerra_is2/src/js/funciones.js"></script>
<script defer src="/tarea3_carpio_guerra_is2/src/js/puestos/index.js"></script>
<?php include_once '../../includes/footer.php' ?>