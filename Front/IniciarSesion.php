<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para Iniciar Sesión</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/registro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
          <li><a href="Incidentes.php">Incidentes</a></li>
          <li><a href="MisionVision.html">Misión y Visión</a></li>
          <li><a href="Contacto.html">Contacto</a></li>
        </ul>
      </nav>
    <section class="form-register">
        <h4>Inicio de Sesión</h4>
        <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Usuario/Mail">
        
        <div class="password-container">
            <input class="controls" type="password" name="contraseña" id="contraseña" placeholder="Ingrese su Contraseña">
            <button type="button" class="toggle-password" id="toggle-password">
                <i class="fas fa-eye"></i>
            </button>
        </div>

        <input class="controls" type="text" name="dni" id="dni" placeholder="Ingrese su DNI">
        
        <p>¿Olvidaste tu <a href="#">Contraseña?</a></p>
        <input class="botons" type="submit" value="Iniciar">
        <p><a href="Registro.html">¿No tienes Cuenta?</a></p>
    </section>
    <script>
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