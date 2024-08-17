<?php
class usernameController {
    private $model;

    public function __construct() {
        require_once("c://xampp/htdocs/proyecto/model/UsernameModel.php");
        $this->model = new UsernameModel();
    }

    public function guardar($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $roles) {
        $id = $this->model->insertar($nombre, $email, $sexo, $area_id, $boletin, $descripcion);
        if ($id !== false) {
            $this->model->asignarRoles($id, $roles);
            return header("Location: show.php?id=" . $id);
        } else {
            return header("Location: create.php");
        }
    }
}
?>
