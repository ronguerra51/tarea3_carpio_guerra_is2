<?php include_once '../../includes/header.php' ?>

<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?> 

<?php
require '../../models/Empleado.php';
require '../../models/Area.php';

$empleadoModel = new Empleados();
$areaModel = new obtenerAreas();

$empleados = $empleadoModel->obtenerEmpleados();
$areas = $areaModel->obtenerAreas();
?>

<div class="container mt-5">
    <h1 class="text-center">ASIGNACIÓN DE AREAS</h1>
    <div class="row justify-content-center">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form>
            <div class="row mb-4">
                <div class="col">
                    <label for="empleado_id" class="form-label">EMPLEADO</label>
                    <select name="empleado_id" id="empleado_id" class="form-select">
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($empleados as $empleado) : ?>
                            <option value="<?= htmlspecialchars($empleado['empleado_id']) ?>"><?= htmlspecialchars($empleado['empleado_nombre']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="area_id" class="form-label">AREAS</label>
                    <select name="area_id" id="area_id" class="form-select">
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($areas as $area) : ?>
                            <option value="<?= htmlspecialchars($area['area_id']) ?>"><?= htmlspecialchars($area['area_nombre']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnAsignar" class="btn btn-primary w-100">Asignar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
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
</div>
<div class="row justify-content-center">
    <div class="col-lg-8 table-responsive">
        <h2 class="text-center">TABLA DE AREAS CON SU PUESTO</h2>
        <table class="table table-bordered table-hover" id="tablaAsignacionArea">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>Area</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5">No hay Empleados con Areas Registrados</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script defer src="/tarea3_carpio_guerra_is2/src/js/funciones.js"></script>
<script defer src="/tarea3_carpio_guerra_is2/src/js/asignacionarea/index.js"></script>

<?php include_once '../../includes/footer.php' ?>
