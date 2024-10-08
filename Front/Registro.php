<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/registro.css">
</head>
<body>
    <form class="form-register" method="post">
        <h4>Formulario para Registrarse</h4>
        <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
        <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido">
        <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
        <input class="controls" type="password" name="clave" id="clave" placeholder="Ingrese su Contraseña">
        <input class="controls" type="tel" name="telefono" id="telefono" placeholder="Ingrese su Teléfono">
        <input class="controls" type="text" name="direccion" id="direccion" placeholder="Ingrese su Dirección">
        <input class="controls" type="text" name="dni" id="dni" placeholder="Ingrese su DNI">
        <label for="partido">Partido:</label>
        <select id="partido" name="partido" class="controls">
            <option value="quilmes" selected>Quilmes</option>
            <option value="berazategui">Berazategui</option>
            <option value="fcio_varela">Florencio Varela</option>
        </select>
        <label for="localidad">Localidad:</label>
        <select id="localidad" name="localidad" class="controls">
        </select>
        <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
        <input class="botons" type="submit" value="Registrar" name="register">
        <p><a href="IniciarSesion.html">¿Ya tengo Cuenta?</a></p>
    </form>
        <?php
        include("../Back/registrar_back.php");
        ?>
    <script>
        const localidades = {
            quilmes: ["Bernal", "Don Bosco", "Ezpeleta", "Quilmes", "San Francisco Solano", "Villa la Florida"],
            berazategui: ["Villa España", "Plátanos", "Hudson", "Ranelagh", "El Pato", "Juan María Gutiérrez", "Sourigues", "Pereyra"],
            fcio_varela: ["Bosques", "Estanislao Severo Zeballos", "San Juan Bautista", "Gobernador Julio A. Costa", "Ingeniero Juan Allan", "Villa Brown", "Villa San Luis", "Villa Santa Rosa", "Villa Vatteone", "La Capilla"]
        };

        const partidoSelect = document.getElementById('partido');
        const localidadSelect = document.getElementById('localidad');

        function updateLocalidades() {
            const selectedPartido = partidoSelect.value;
            const options = localidades[selectedPartido] || [];
            localidadSelect.innerHTML = '';

            options.forEach(localidad => {
                const optionElement = document.createElement('option');
                optionElement.value = localidad.toLowerCase().replace(/\s+/g, '_');
                optionElement.textContent = localidad;
                localidadSelect.appendChild(optionElement);
            });
        }

        updateLocalidades();

        partidoSelect.addEventListener('change', updateLocalidades);
    </script>
</body>
</html>

