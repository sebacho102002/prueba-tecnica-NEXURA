<?php
require_once("c://xampp/htdocs/proyecto/config/db.php");

$con = new db();
$PDO = $con->conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $area_id = isset($_POST['area_id']) ? intval($_POST['area_id']) : 0;
    $boletin = isset($_POST['boletin']) ? 1 : 0;
    $descripcion = $_POST['descripcion'];

    $updateStmt = $PDO->prepare("
        UPDATE empleados
        SET nombre = :nombre,
            email = :email,
            sexo = :sexo,
            area_id = :area_id,
            boletin = :boletin,
            descripcion = :descripcion
        WHERE id = :id
    ");
    $updateStmt->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':sexo' => $sexo,
        ':area_id' => $area_id,
        ':boletin' => $boletin,
        ':descripcion' => $descripcion,
        ':id' => $id
    ]);
    header("Location: /proyecto/view/username/index.php");
    exit();
}
?>
