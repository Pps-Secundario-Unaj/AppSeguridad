<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/registro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <body>
        <nav>
          <input type="checkbox" id="check">
          <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
          </label>
          <a href="#" class="enlace">
            <img src="logo3.png" alt="" class="logo">
          </a>
          <ul>
            <li><a href="IniciarSesion.php">Iniciar Sesión</a></li>
            <li><a href="Incidentes.php">Incidentes</a></li>
            <li><a href="MisionVision.html">Misión y Visión</a></li>
            <li><a href="Contacto.html">Contacto</a></li>
          </ul>
        </nav>
    <section class="form-register">
        <h4>Formulario para Registrarse</h4>
        <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
        <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido">
        <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
        
        <div class="password-container">
            <input class="controls" type="password" name="contraseña" id="contraseña" placeholder="Ingrese su Contraseña">
            <button type="button" class="toggle-password" id="toggle-password">
                <i class="fas fa-eye"></i>
            </button>
        </div>

        <input class="controls" type="tel" name="telefono" id="telefono" placeholder="Ingrese su Teléfono">
        <input class="controls" type="text" name="dni" id="dni" placeholder="Ingrese su DNI">
        <input class="controls" type="text" name="direccion" id="direccion" placeholder="Ingrese su Dirección">
        
        <label for="partido">Partido:</label>
        <select id="partido" name="partido" class="controls">
            <option value="quilmes" selected>Quilmes</option>
            <option value="berazategui">Berazategui</option>
            <option value="fcio_varela">Florencio Varela</option>
        </select>
        
        <label for="localidad">Localidad:</label>
        <select id="localidad" name="localidad" class="controls"></select>
        
        <p>Estoy de acuerdo con <a href="#">Términos y Condiciones</a></p>
        <input class="botons" type="submit" value="Registrar">
        <p><a href="IniciarSesion.php">¿Ya tengo Cuenta?</a></p>
    </section>
    
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

        // Mostrar/Ocultar contraseña
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('contraseña');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    </script>
</body>
</html>

