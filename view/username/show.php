<?php
require_once("c://xampp/htdocs/proyecto/config/db.php");

// Obtener el ID del empleado desde la URL
$empleado_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($empleado_id > 0) {
    // Conectar a la base de datos
    $con = new db();
    $PDO = $con->conexion();

    // Consultar los datos del empleado
    $empleadoStmt = $PDO->prepare("SELECT * FROM empleados WHERE id = :id");
    $empleadoStmt->bindParam(':id', $empleado_id, PDO::PARAM_INT);
    $empleadoStmt->execute();
    $empleado = $empleadoStmt->fetch(PDO::FETCH_ASSOC);

    // Consultar los roles del empleado
    $rolesStmt = $PDO->prepare("
        SELECT r.nombre 
        FROM roles r
        INNER JOIN empleado_rol er ON r.id = er.rol_id
        WHERE er.empleado_id = :id
    ");
    $rolesStmt->bindParam(':id', $empleado_id, PDO::PARAM_INT);
    $rolesStmt->execute();
    $roles = $rolesStmt->fetchAll(PDO::FETCH_COLUMN);
} else {
    die("ID de empleado no válido.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Empleado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalles del Empleado</h1>

        <?php if ($empleado): ?>
            <div class="card">
                <div class="card-header">
                    Empleado: <?php echo htmlspecialchars($empleado['nombre']); ?>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($empleado['email']); ?></p>
                    <p><strong>Sexo:</strong> <?php echo $empleado['sexo'] == 'M' ? 'Masculino' : 'Femenino'; ?></p>
                    <p><strong>Área:</strong> <?php echo htmlspecialchars($empleado['area_id']); ?></p>
                    <p><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($empleado['descripcion'])); ?></p>
                    <p><strong>Boletín:</strong> <?php echo $empleado['boletin'] ? 'Sí' : 'No'; ?></p>

                    <h4>Roles:</h4>
                    <ul>
                        <?php foreach ($roles as $role): ?>
                            <li><?php echo htmlspecialchars($role); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <p>Empleado no encontrado.</p>
        <?php endif; ?>

        <a href="/proyecto/index.php" class="btn btn-primary mt-3">Volver a la lista</a>
    </div>
</body>
</html>
