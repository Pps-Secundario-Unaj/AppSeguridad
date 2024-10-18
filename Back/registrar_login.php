<?php

include("con_db.php");

if (isset($_POST['boton_login'])) {
    if (strlen($_POST['nombres']) >= 1 && strlen($_POST['password']) >= 1) {
        //se trae los valores del formulario
        $usuario=trim($_POST['nombres']);
        $pass=trim($_POST['password']);

        //arma la consulta
        $consulta = "SELECT dni,mail,clave FROM usuarios WHERE mail='$usuario'";
        $resultado = mysqli_query($conex, $consulta);
    }

    if ($resultado) {
        if ($resultado['clave']=$pass) {
    ?>
            <h3 class="ok">¡Has iniciado sesión!</h3>
<?php
            } else {
            ?>
                <h3 class="bad">¡La clave ingresada es incorrecta!</h3>
            <?php
            }
        } else {
            ?>
            <h3 class="bad">¡No existe ningún usuario registrado con ese mail!</h3>
    <?php
        }
    }
mysqli_close($conexion);
?>