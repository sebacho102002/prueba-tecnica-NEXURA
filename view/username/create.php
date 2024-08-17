<?php


require_once("c://xampp/htdocs/proyecto/view/head/head.php");

// Conectar a la base de datos para obtener los roles
require_once("c://xampp/htdocs/proyecto/config/db.php");
$con = new db();
$PDO = $con->conexion();
$rolesQuery = $PDO->query("SELECT * FROM roles");
?>

<h1>Crear empleado</h1>
<div class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
    Los campos con asteriscos (*) son obligatorios
</div>
<br>

<form action="store.php" method="POST" autocomplete="off" class="was-validated">
    <div class="row mb-3">
        <label for="inputName" class="col-sm-2 col-form-label">Nombre completo *</label>
        <div class="col-sm-10">
            <input type="text" name="nombre" class="form-control" id="inputName" placeholder="Nombre completo del empleado" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email *</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Correo electrónico" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputSex" class="col-sm-2 col-form-label">Sexo *</label>
        <div class="col-sm-10">
            <div class="form-check">
                <input type="radio" name="sexo" class="form-check-input" id="radioMasculino" value="M" required>
                <label class="form-check-label" for="radioMasculino">Masculino</label>
            </div>
            <div class="form-check mb-3">
                <input type="radio" name="sexo" class="form-check-input" id="radioFemenino" value="F" required>
                <label class="form-check-label" for="radioFemenino">Femenino</label>
                <div class="invalid-feedback">Selecciona una opción</div>
            </div>
        </div>            
    </div> 

    <div class="row mb-3">
        <label for="selectArea" class="col-sm-2 col-form-label">Área *</label>
        <div class="col-sm-10">
            <select name="area_id" class="form-select" id="selectArea" required>
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Administración</option>
                <option value="2">Ventas</option>
                <option value="3">Producción</option>
                <option value="4">Calidad</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputDescripcion" class="col-sm-2 col-form-label">Descripción *</label>
        <div class="col-sm-10">
            <textarea name="descripcion" class="form-control" id="inputDescripcion" placeholder="Descripción de la experiencia del empleado" required></textarea>
            <div class="invalid-feedback">Rellena el campo</div>
        </div>            
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <div class="form-check mb-3">
                <input type="checkbox" name="boletin" class="form-check-input" id="boletinCheckbox" value="1">
                <label class="form-check-label" for="boletinCheckbox">Deseo recibir boletín informativo</label>
            </div>
        </div>            
    </div>

    <div class="row mb-3">
            <label for="inputRoles" class="col-sm-2 col-form-label">Roles *</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" name="roles[]" type="checkbox" value="1" id="rolDesarrollador">
                    <label class="form-check-label" for="rolDesarrollador">
                        Profesional de proyectos - Desarrollador
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="roles[]" type="checkbox" value="2" id="rolGerente">
                    <label class="form-check-label" for="rolGerente">
                        Gerente estratégico
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="roles[]" type="checkbox" value="3" id="rolAuxiliar">
                    <label class="form-check-label" for="rolAuxiliar">
                        Auxiliar administrativo
                    </label>
                </div>                    
            </div>            
        </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </div>
    </div>
</form>

<?php
require_once("c://xampp/htdocs/proyecto/view/head/footer.php");
?>

