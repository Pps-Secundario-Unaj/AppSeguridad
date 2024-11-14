<?php
include("con_db.php");

if (isset($_POST['boton_inc'])) {
    if (strlen($_POST['direccion']) >= 1 && strlen($_POST['observacion']) >= 1 && strlen($_POST['tipo']) >= 1) {
        $dni_usuario='12345678';
        $tipo_victima = trim($_POST['tipo_incidente']);
        $observacion = trim($_POST['observaciones']);
        $tipo = trim($_POST['tipo']);
        $otro_desc = trim($_POST['otros_desc']);
        $ubicacion = trim($_POST['ubicacion']);
        $direccion = trim($_POST['direccion']);
        $partido = trim($_POST['partido']);
        $localidad = trim($_POST['localidad']);

        $cons = "INSERT INTO incidentes (dni_usuario, tipo_victima, observacion, tipo, otro_desc, ubicacion, partido, localidad,direccion) VALUES('$dni_usuario','$tipo_victima','$observacion','$tipo','$otro_desc','$ubicacion','$partido','$localidad','$direccion')";
        $res = mysqli_query($conexion, $cons);
        if ($res) {
?>
            <h3 class="ok">¡Haz declarado un incidente correctamente!</h3>
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