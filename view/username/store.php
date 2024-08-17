<?php
require_once("c://xampp/htdocs/proyecto/controller/usernameController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $sexo = $_POST['sexo'];
    $area_id = $_POST['area_id'];
    $boletin = isset($_POST['boletin']) ? 1 : 0;
    $descripcion = trim($_POST['descripcion']);
    $roles = isset($_POST['roles']) ? $_POST['roles'] : [];

    // Validaciones del lado del servidor
    $errors = [];

    // Validar nombre
    if (!preg_match("/^[a-zA-Z\s]{3,}$/", $nombre)) {
        $errors[] = "El nombre debe tener al menos 3 caracteres y solo puede contener letras y espacios.";
    }

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Correo electrónico inválido.";
    }

    // Validar sexo
    if (!in_array($sexo, ['M', 'F'])) {
        $errors[] = "Sexo inválido.";
    }

    // Validar área
    if (!filter_var($area_id, FILTER_VALIDATE_INT)) {
        $errors[] = "Área inválida.";
    }

    // Validar descripción
    if (strlen($descripcion) < 10) {
        $errors[] = "La descripción debe tener al menos 10 caracteres.";
    }

    // Validar roles
    if (empty($roles)) {
        $errors[] = "Debe seleccionar al menos un rol.";
    }

    if (empty($errors)) {
        // No hay errores, proceder a guardar los datos
        $controller = new usernameController();
        $controller->guardar($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $roles);
    } else {
        // Mostrar errores
        foreach ($errors as $error) {
            echo "<p class='text-danger'>$error</p>";
        }
    }
}
?>
