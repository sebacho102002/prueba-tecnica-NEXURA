<?php
require_once("c://xampp/htdocs/proyecto/view/head/head.php");

// Conectar a la base de datos
require_once("c://xampp/htdocs/proyecto/config/db.php");
$con = new db();
$PDO = $con->conexion();

// Consultar todos los empleados
$empleadosStmt = $PDO->query("
    SELECT e.id, e.nombre, e.email, e.sexo, e.area_id, e.boletin
    FROM empleados e
");
$empleados = $empleadosStmt->fetchAll(PDO::FETCH_ASSOC);

// Consultar las áreas para mostrar nombres en lugar de IDs
$areasStmt = $PDO->query("SELECT id, nombre FROM areas");
$areas = $areasStmt->fetchAll(PDO::FETCH_ASSOC);
$areasArray = array_column($areas, 'nombre', 'id'); // Convertir a array asociativo

?>

<a href="/proyecto/view/username/create.php" class="btn btn-primary">Crear</a>
<script src="https://kit.fontawesome.com/85ee506e40.js" crossorigin="anonymous"></script>

<table class="table">
<thead>
    <tr>
      <th scope="col">
        <i class="fa-solid fa-person"></i> Nombre
      </th>
      <th scope="col">
      <i class="fa-solid fa-at"></i>  Email
      </th>
      <th scope="col">
      <i class="fa-solid fa-venus-mars"></i> Sexo
      </th>
      <th scope="col">
      <i class="fa-solid fa-briefcase"></i> Área
      </th>
      <th scope="col">
      <i class="fa-solid fa-envelope"></i> Boletín
      </th>
      <th scope="col">
        Modificar
      </th>
      <th scope="col">Eliminar</th>
    </tr>
</thead>

  <tbody>
    <?php foreach ($empleados as $empleado): ?>
      <tr>
        <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
        <td><?php echo htmlspecialchars($empleado['email']); ?></td>
        <td><?php echo $empleado['sexo'] == 'M' ? 'Masculino' : 'Femenino'; ?></td>        
        <td><?php echo htmlspecialchars($empleado['area_id']); ?></td>
        <td><?php echo $empleado['boletin'] ? 'Sí' : 'No'; ?></td>
        <td>
          <a href="/proyecto/view/username/edit.php?id=<?php echo $empleado['id']; ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i></a>
        </td>
        <td>        
          <a href="/proyecto/view/username/delete.php?id=<?php echo $empleado['id']; ?>" class="btn" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');"><i class="fa-solid fa-trash"></i></a>
        </td>
        

      </tr>
    <?php endforeach; ?>

  </tbody>
</table>

<?php
require_once("c://xampp/htdocs/proyecto/view/head/footer.php");
?>
