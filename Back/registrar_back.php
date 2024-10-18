<?php

include("con_db.php");

if (isset($_POST['register'])) {
    if (strlen($_POST['email']) >= 1) {
        //se trae los valores del formulario
        $nombres = trim($_POST['nombres']);
        $apellidos = trim($_POST['apellidos']);
        $correo = trim($_POST['correo']);
        $clave = trim($_POST['clave']);
        $telefono = trim($_POST['telefono']);
        $dni = trim($_POST['dni']);
        $partido = trim($_POST['partido']);
        $localidad = trim($_POST['localidad']);
        $direccion = trim($_POST['direccion']);
        //arma la consulta
        $consulta = "INSERT INTO usuarios(dni, nombre, apellido, partido, localidad, direccion, telefono, mail, clave) VALUES ('$dni','$nombres','$apellidos','$partido','$localidad','$direccion','$telefono','$correo','$clave')";
        $resultado = mysqli_query($conex, $consulta);
    if ($resultado) {
    ?>
                <h3 class="ok">¡Te has inscripto correctamente!</h3>
<?php
            } else {
            ?>
                <h3 class="bad">¡Ups ha ocurrido un error!</h3>
            <?php
            }
        } else {
            ?>
            <h3 class="bad">¡Por favor complete los campos!</h3>
    <?php
        }
    }
mysqli_close($conexion);
?>