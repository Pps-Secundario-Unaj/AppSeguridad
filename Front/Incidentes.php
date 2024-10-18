<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Incidentes</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/incidentes.css">
</head>
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
          <li><a class="active"  href="Registro.html">Registró</a></li>
          <li><a href="IniciarSesion.html">Iniciar Sesión</a></li>
          <li><a href="MisionVision.html">Misión y Visión</a></li>
          <li><a href="Contacto.html">Contacto</a></li>
        </ul>
      </nav>
    <form class="form-register" method="post">
        <h4>Formulario para Registrar Incidentes</h4>
            <div>
                <label>
                    <input type="radio" name="tipo_incidente" value="personal" class="controls" checked>
                    Personal
                </label>
                <label>
                    <input type="radio" name="tipo_incidente" value="de_terceros" class="controls">
                    De Terceros
                </label>
            </div>
                
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" class="controls" onchange="toggleExtraInfo()">
                <option value="robo">Robo</option>
                <option value="intento_de_robo">Intento de Robo</option>
                <option value="hurto">Hurto</option>
                <option value="otros">Otros</option>
            </select>
                
            <div id="extra-info" class="extra-info">
                <label for="otros">Especifique otro tipo de incidente:</label>
                <input class="controls" type="text" id="otros_desc" name="otros_desc" placeholder="Describa el incidente">
            </div>
        
            <label for="observaciones">Observaciones: (comente el suceso)</label>
            <textarea class="controls observaciones" id="observaciones" name="observaciones" rows="4" placeholder="Describa aquí lo ocurrido..."></textarea>
                
            <label for="partido">Ubicación del Incidente</label>
            <select id="partido" name="partido">
                <option value="quilmes" selected>Quilmes</option>
                <option value="berazategui">Berazategui</option>
                <option value="fcio_varela">Florencio Varela</option>
            </select>

            
            <label for="direccion">Dirección del incidente:</label>
            <input class="controls" type="text" id="direccion" name="direccion" placeholder="Describa el incidente">
            
                
            <label for="localidad">Localidad:</label>
            <select id="localidad" name="localidad"></select>
                
            <input class="botons" type="submit" value="Enviar" name="boton_inc">
    </form>
    <?php
        include("../Back/registrar_incidente.php");
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
        
            function toggleExtraInfo() {
                const tipoSelect = document.getElementById('tipo');
                const extraInfoDiv = document.getElementById('extra-info');
                if (tipoSelect.value === 'otros') {
                    extraInfoDiv.style.display = 'block'; // Mostrar campo extra
                } else {
                    extraInfoDiv.style.display = 'none'; // Ocultar campo extra
                }
            }
        
            updateLocalidades();
            partidoSelect.addEventListener('change', updateLocalidades);
        </script>
</html>