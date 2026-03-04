<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Esto asume que tienes tu conexión PDO configurada en este archivo
    require 'conexion.php'; 

    $usuario = trim($_POST['usuario']);
    $nombre_completo = trim($_POST['nombre_completo']);
    $clave_plana = $_POST['clave'];

    if (empty($usuario) || empty($nombre_completo) || empty($clave_plana)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $clave_hasheada = md5($clave_plana);

        try {
            $sql = "INSERT INTO usuarios (usuario, nombre_completo, clave) VALUES (:usuario, :nombre_completo, :clave)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':nombre_completo', $nombre_completo);
            $stmt->bindParam(':clave', $clave_hasheada);

            if ($stmt->execute()) {
                header("Location: InicioSesion.php?mensaje=registrado");
                exit();
            }
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "El nombre de usuario ya existe.";
            } else {
                $error = "Error crítico de base de datos: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>REGISTRARSE</h1>
        
        <?php if(isset($error)): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="Registrarse.php" method="POST">
            <div class="input-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario" required>
            </div>

            <div class="input-group">
                <label for="nombre_completo">Nombre Completo</label>
                <input type="text" id="nombre_completo" name="nombre_completo" placeholder="Ingrese su nombre completo" required>
            </div>

            <div class="input-group">
                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave" placeholder="Ingrese su clave" required>
            </div>

            <button type="submit">Registrar</button>
            <p class="enlace-login">¿Ya tienes cuenta? <a href="InicioSesion.php">Iniciar Sesión</a></p>
        </form>
    </div>
</body>
</html>