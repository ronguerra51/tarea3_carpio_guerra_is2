<?php include_once '../../includes/header.php' ?>

<?php
require '../../models/Empleado.php';
require '../../models/Puesto.php';

$empleadoModel = new Empleados();
$puestoModel = new obtenerPuestos();

$empleados = $empleadoModel->obtenerEmpleados(); // Asegúrate de que este método devuelve un array de empleados
$puestos = $puestoModel->obtenerPuestos(); // Asegúrate de que este método devuelve un array de puestos
?>

<div class="container mt-5">
    <h1 class="text-center">ASIGNACIÓN DE PUESTOS</h1>
    <div class="row justify-content-center">
        <?php if ($error) : ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="../../controladores/asignacion/guardar.php" method="POST" class="col-lg-8 border bg-light p-4 rounded shadow">
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
                    <label for="puesto_id" class="form-label">PUESTO</label>
                    <select name="puesto_id" id="puesto_id" class="form-select">
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($puestos as $puesto) : ?>
                            <option value="<?= htmlspecialchars($puesto['puesto_id']) ?>"><?= htmlspecialchars($puesto['puesto_nombre']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">ASIGNAR</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8 table-responsive">
        <h2 class="text-center">TABLA DE EMPLEADOS CON SU PUESTO</h2>
        <table class="table table-bordered table-hover" id="tablaAsignacionPuesto">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5">No hay Empleados con Puestos Registrados</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script defer src="/tarea3_carpio_guerra_is2/src/js/funciones.js"></script>
<script defer src="/tarea3_carpio_guerra_is2/src/js/asignacionpuesto/index.js"></script>
<?php include_once '../../includes/footer.php' ?>