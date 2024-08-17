<?php
require_once("c://xampp/htdocs/proyecto/view/head/head.php");

// Conectar a la base de datos
require_once("c://xampp/htdocs/proyecto/config/db.php");
$con = new db();
$PDO = $con->conexion();

// Obtener el ID del empleado de la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar el empleado por ID
$empleadoStmt = $PDO->prepare("
    SELECT e.id, e.nombre, e.email, e.sexo, e.area_id, e.boletin, e.descripcion
    FROM empleados e
    WHERE e.id = :id
");
$empleadoStmt->execute([':id' => $id]);
$empleado = $empleadoStmt->fetch(PDO::FETCH_ASSOC);

// Consultar las áreas
$areasStmt = $PDO->query("SELECT id, nombre FROM areas");
$areas = $areasStmt->fetchAll(PDO::FETCH_ASSOC);
$areasArray = array_column($areas, 'nombre', 'id'); // Convertir a array asociativo

?>

<h1>Editar empleado</h1>

<form action="update.php" method="POST" autocomplete="off" class="was-validated">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($empleado['id']); ?>">

    <div class="row mb-3">
        <label for="inputName" class="col-sm-2 col-form-label">Nombre completo *</label>
        <div class="col-sm-10">
            <input type="text" name="nombre" class="form-control" id="inputName" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email *</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo htmlspecialchars($empleado['email']); ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputSex" class="col-sm-2 col-form-label">Sexo *</label>
        <div class="col-sm-10">
            <div class="form-check">
                <input type="radio" name="sexo" class="form-check-input" id="radioMasculino" value="M" <?php echo $empleado['sexo'] == 'M' ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="radioMasculino">Masculino</label>
            </div>
            <div class="form-check mb-3">
                <input type="radio" name="sexo" class="form-check-input" id="radioFemenino" value="F" <?php echo $empleado['sexo'] == 'F' ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="radioFemenino">Femenino</label>
            </div>
        </div>            
    </div>

    <div class="row mb-3">
        <label for="selectArea" class="col-sm-2 col-form-label">Área *</label>
        <div class="col-sm-10">
            <select name="area_id" class="form-select" id="selectArea" required>
                <option value="" disabled>Seleccione una opción</option>
                <?php foreach ($areasArray as $areaId => $areaNombre): ?>
                    <option value="<?php echo $areaId; ?>" <?php echo $empleado['area_id'] == $areaId ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($areaNombre); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputDescripcion" class="col-sm-2 col-form-label">Descripción *</label>
        <div class="col-sm-10">
            <textarea name="descripcion" class="form-control" id="inputDescripcion" required><?php echo htmlspecialchars($empleado['descripcion']); ?></textarea>
        </div>            
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <div class="form-check mb-3">
                <input type="checkbox" name="boletin" class="form-check-input" id="boletinCheckbox" value="1" <?php echo $empleado['boletin'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="boletinCheckbox">Deseo recibir boletín informativo</label>
            </div>
        </div>            
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Actualizar</button>
            </div>
        </div>
    </div>
</form>

<?php
require_once("c://xampp/htdocs/proyecto/view/head/footer.php");
?>
