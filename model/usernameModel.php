<?php
class UsernameModel {
    private $PDO;

    public function __construct() {
        require_once("c://xampp/htdocs/proyecto/config/db.php");
        $con = new db();
        $this->PDO = $con->conexion();
    }

    public function insertar($nombre, $email, $sexo, $area_id, $boletin, $descripcion) {
        $stament = $this->PDO->prepare("INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion) VALUES (:nombre, :email, :sexo, :area_id, :boletin, :descripcion)");
        $stament->bindParam(":nombre", $nombre);
        $stament->bindParam(":email", $email);
        $stament->bindParam(":sexo", $sexo);
        $stament->bindParam(":area_id", $area_id);
        $stament->bindParam(":boletin", $boletin);
        $stament->bindParam(":descripcion", $descripcion);
        $resultado = ($stament->execute()) ? $this->PDO->lastInsertId() : false;
        echo $resultado;
        return $resultado;
    }

    public function asignarRoles($empleado_id, $roles) {
        $stament = $this->PDO->prepare("INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (:empleado_id, :rol_id)");
        foreach ($roles as $rol_id) {
            $stament->bindParam(":empleado_id", $empleado_id);
            $stament->bindParam(":rol_id", $rol_id);
            $stament->execute();
        }
    }
}
?>
