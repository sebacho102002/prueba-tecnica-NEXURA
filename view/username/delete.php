<?php
require_once("c://xampp/htdocs/proyecto/config/db.php");
$con = new db();
$PDO = $con->conexion();

// Obtener el ID del empleado de la URL(nuevo)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar la consulta para eliminar el empleado
    $deleteStmt = $PDO->prepare("DELETE FROM empleados WHERE id = :id");
    $deleteStmt->execute([':id' => $id]);

    header("Location: /proyecto/index.php");
    exit();
} else {
    echo "ID de empleado no válido.";
}
?>
