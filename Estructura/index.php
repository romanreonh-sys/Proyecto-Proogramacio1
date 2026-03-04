    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Inicio de Sesion</title>
    </head>
    <body>
        <form action="InicioSesion.php" method="POST">
            <H1>Iniciar Sesion</H1>
            <hr>
            <?php
            if (isset($_GET['error'])) {
            ?>
                <p class="error">
                    <?php 
                    echo $_GET['error']; 
                    ?>
                    
                </p>
            <?php
            }
            ?>
            
            <!-- Colocar Icono de usuario -->
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="Usuario" placeholder="Nombre de Usuario">

            <!-- Colocar Icono de contraseña -->
            <label for="password">Contraseña:</label>
            <input type="password" name="Clave" placeholder="Clave">
            <hr>
            <button type="submit">Iniciar Sesion</button>
            <a href="Registrarse.php">Crear Cuenta</a>
        </form>
    </body>
    </html>